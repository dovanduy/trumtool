<?php
namespace App\Helpers\Commons;
class StringUtils {
  public $byte_max = 127;
  public $byte_min = -128;
  public $custom_password = "mBCCS#2014";
  public $keydefault = array(77, 64, 110, 72, 102, 103, -23, 67, 54, -128, 74, 57, 48, 84, 86, 51);
  public $hexhars = array(100, 97, 50, 102, 55, 53, 54, 52, 56, 57, 49, 98, 99, 48, 101, 51);
  
  public $bccsgw_user = "d75c507cf9d4a80d5be1924a3d0c790fbd5b9aa53d8c5f5066d0d8f632bcb26814fc22840211ab1ed617be90f58390ef";
  public $bccsgw_pass = "7e406d34b24a4a7c8439c5b3105b014e839c7c5f183bbc1a79a9f2e5b27a400114fc22840211ab1ed617be90f58390ef";
  
  public $method = 'AES-128-ECB';
  
  public function __construct()
  {
  }
  
  public function encrypt($str) {
    $str = $this->pkcs5_pad($str, 16);
    $encrypted = openssl_encrypt($str, $this->method, $this->generateSecretKeySpec(), OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING);
    return $this->toHexa($encrypted);
  }
  
  public function decrypt($str) {
    $encrypted = implode(array_map("chr",  $this->stringToBytes($str)));
    $decrypted = openssl_decrypt($encrypted, $this->method, $this->generateSecretKeySpec(), OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING);
    $dec_s = strlen($decrypted);
    $padding = ord($decrypted[$dec_s-1]);
    return substr($decrypted, 0, -$padding);
  }

  public function pkcs5_pad($text, $blocksize) {
    $pad = $blocksize - (strlen($text) % $blocksize);
    return $text . str_repeat(chr($pad), $pad);
  } 
  
  public function generateSecretKeySpec() {
    $key = $this->keydefault;
    $pwd = str_split($this->custom_password);
    foreach($pwd as $i => $v) {
      $key[$i] = $this->toByte((ord($v) + $this->keydefault[$i]));
    }
    return implode(array_map("chr", $key));
  }
  
  public function toByte($byte) {
    if ($byte > $this->byte_max)
      return ($byte - $this->byte_max + $this->byte_min - 1);
    else
      return $byte;
  }
  
  public function toHexa($str) {
    $array = array();
    $bytes = unpack('C*', $str);
    foreach($bytes as $v) {
      $i = $v & 255;
      $array[] = $this->hexhars[$i >> 4];
      $array[] = $this->hexhars[$i & 15];
    }
    return implode(array_map("chr", $array));
  }
  
  public function stringToBytes($str) {
    if (strlen($str) % 2 != 0) {
      $str = '0'.$str;
    }
    $length = strlen($str) / 2;
    $bArr = array();
    for ($i = 0; $i < $length; $i++) {
      $bArr[$i] = $this->toByte(($this->indexInHexhars($str{($i * 2)}) << 4));
      $bArr[$i] = $this->toByte(($bArr[$i] | ($this->indexInHexhars($str{(($i * 2) + 1)}) & 15)));
    }
    return $bArr;
  }
  
  public function indexInHexhars($char) {
    $c = ord($char);
    $i = 0;
    while ($i < count($this->hexhars) && $this->hexhars[$i] != $c) {
      $i++;
    }
    return $i;
  }
}