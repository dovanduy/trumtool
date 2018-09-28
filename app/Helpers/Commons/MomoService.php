<?php
namespace App\Helpers\Commons;

use Cache;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\CookieJarInterface;



class MomoService
{
    private $URL = "https://owa.momo.vn";
	private $PATH_API = "/api";
	private $PATH_PUBLIC = "/public";
    private $access_token = "";
    private $phone_number;
    public function __construct()
    {
        $this->access_token = $this->Get_Access_Token();
    }
    public function Get_Access_Token() {
      
        try {
            $client = new \GuzzleHttp\Client();
            $post_builder = array (
                'appCode' => '2.0.39',
                'user' => '01282265058',
                'channel' => 'APP',
                'cmdId' => '5239920907547',
                'deviceOS' => 'Android',
                'pass' => '060195',
                'errorDesc' => '',
                'extra' => 
                array (
                  'AAID' => 'f34665c2-8185-4885-a1a1-2c032021df61',
                  'APPSFLYERID' => '1534745715010-7560038554909333558',
                  'checkSum' => 'xbo8I4Csuav/9vEpHHuu2WVa4jjS+v6yCY4kcFKa0AYXGzcClwJWHQTJBfwOW/C/1cR9dLi/Fxrtb0SxKaHhCw==',
                  'IDFA' => '',
                  'pHash' => 'GrJTeRmEayNnA51K05CssvMHfRUUR33F0ePBq3FxfYw=',
                ),
                'lang' => 'vi',
                'momoMsg' => 
                array (
                  '_class' => 'mservice.backend.entity.msg.LoginMsg',
                  'commentMsg' => '',
                  'lastUpdateVoucher' => 0,
                  'lastUpdateCard' => 0,
                  'isSetup' => false,
                ),
                'msgType' => 'USER_LOGIN_MSG',
                'time' => 1534750849851,
                'result' => true,
                'errorCode' => 0,
                'appVer' => 2301,
                'fullExtra' => 
                array (
                  'AAID' => 'f34665c2-8185-4885-a1a1-2c032021df61',
                  'APPSFLYERID' => '1534745715010-7560038554909333558',
                  'checkSum' => 'xbo8I4Csuav/9vEpHHuu2WVa4jjS+v6yCY4kcFKa0AYXGzcClwJWHQTJBfwOW/C/1cR9dLi/Fxrtb0SxKaHhCw==',
                  'IDFA' => '',
                  'pHash' => 'GrJTeRmEayNnA51K05CssvMHfRUUR33F0ePBq3FxfYw=',
                ),
            );
              $res = $client->post($this->URL.$this->PATH_PUBLIC, [
                'headers' => [
                    'accept: application/json',
                    'authorization: Basic Ong=',
                    'Content-Type: application/octet-stream; charset=utf-8',
                    'User-Agent: OmiseAndroid/0.0 Java/0',
                ],
                'json' => $post_builder,
                ['verify' => false],
                // 'curl' => [
                //     CURLOPT_SSL_VERIFYPEER => false,
                //     CURLOPT_SSL_VERIFYHOST => false
                // ],
                "http_errors" => false,
            ]);
            $msg = array();
            $res = $res->getBody()->getContents();
            
            $errorCode = $this->getValue($res, '"errorCode":',',');
            
            if($errorCode != false){
                return false;
            }else{
                $token = $this->getValue($res, '"AUTH_TOKEN":"','"');
                return $token;
            }
        }catch (\Exception $e) {
            \Log::info($e);
            return false;
        }              

    }

    public function CheckVina($phone_number) {
        $this->phone_number = $phone_number;
        if($this->access_token != false){
            $clientTime = round(microtime(true) * 1000);
            try{
                $client = new \GuzzleHttp\Client();
                $post_builder =	array (
                    'appCode' => 'EU 2.0.39',
                    'user' => '01282265058',
                    'channel' => 'APP',
                    'cmdId' => '5635772360897',
                    'deviceOS' => 'Android',
                    'pass' => '',
                    'errorDesc' => '',
                    'extra' => 
                    array (
                      'checkSum' => 'R+HK/JMOzqU9ev9ckVFmwJziJXmTbuDg8STyxC9NW5YH+d/ldYCGlaCWYuGPjZjyGj0DevTBSA0nDMnm8HPTgw==',
                    ),
                    'lang' => 'vi',
                    'momoMsg' => 
                    array (
                      'user' => '01282265058',
                      'category' => 23,
                      'clientTime' => $clientTime,
                      'serviceId' => 'VINAHCM',
                      'serviceName' => 'MobiFone trả sau',
                      'tranType' => 7,
                      'pageNumber' => 1,
                      'parentTranType' => 3,
                      'billId' => $phone_number,
                      'quantity' => 1,
                      'fee' => 0,
                      'statusName' => '[{"key":"%totalAmount%","value":"0đ"},{"key":"%billId%","value":"'.$phone_number.'"},{"key":"%amount%"},{"key":"%originalAmount%"},{"key":"%serviceName%","value":"MobiFone trả sau"},{"key":"%reference2%"}]',
                      'tranData' => '[{"key":"%totalAmount%","value":"0đ"},{"key":"%billId%","value":"'.$phone_number.'"},{"key":"%amount%"},{"key":"%originalAmount%"},{"key":"%serviceName%","value":"MobiFone trả sau"},{"key":"%reference2%"}]',
                      'moneySource' => 1,
                      'rowCardId' => NULL,
                      'desc' => 'Ví MoMo',
                      'partnerCode' => 'momo',
                      'partnerId' => $phone_number,
                      '_class' => 'mservice.backend.entity.msg.TranHisMsg',
                      'giftId' => '',
                      'useVoucher' => 0,
                      'extras' => '{"vpc_CardType":"SML","vpc_TicketNo":""}',
                    ),
                    'msgType' => 'NEXT_PAGE_MSG',
                    'time' => $clientTime,
                    'result' => true,
                    'errorCode' => 0,
                    'appVer' => 2301,
                    'fullExtra' => 
                    array (
                      'checkSum' => 'R+HK/JMOzqU9ev9ckVFmwJziJXmTbuDg8STyxC9NW5YH+d/ldYCGlaCWYuGPjZjyGj0DevTBSA0nDMnm8HPTgw==',
                    ),
                );
                $res = $client->post($this->URL.$this->PATH_PUBLIC, [
                    'headers' => [
                        'accept: application/json',
                        // 'authorization: Bearer '.$this->access_token,
                        'Content-Type: application/json; charset=utf-8',
                        'authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiMDEyODIyNjUwNTgiLCJwaW4iOiIwNjAxOTUiLCJpbWVpIjoiYTY3ZGM2MDI4ODQ1MDNlYSIsImlhdCI6MTUzNzk2NzAyOCwiZXhwIjoxNTM3OTcwNjI4fQ.hxiXTtIpyg6kv35mLcRdDkpvfJ6Rwbuat6YZMgDD8xw',
                        
                        'User-Agent: okhttp/3.4.1',
                    ],
                    'json' => $post_builder,
                    ['verify' => false],
                    // 'curl' => [
                    //     CURLOPT_SSL_VERIFYPEER => false,
                    //     CURLOPT_SSL_VERIFYHOST => false
                    // ],
                    "http_errors" => false,
                ]);
               
                $res = $res->getBody()->getContents();
                $errorCode = $this->getValue($res, '"errorCode":', ',');
                dd($res);
                if($errorCode == -83){
                    $this->access_token = $this->Get_Access_Token();
                    $this->CheckVina($this->phone_number);
                }
                dd($res);
            }catch (\Exception $e) {
                \Log::info($e);
                return 0;
            }  
        }else{
            dd(111);
        }

} 
    public function getValue($string,$start,$end){
        $p1=strpos($string,$start);
        if($p1===FALSE)
            return FALSE;
        $p1+=strlen($start);
        $p2=strpos($string,$end,$p1);
        if($p2===FALSE)
            return FALSE;
        return substr($string,$p1,$p2-$p1);
    }
}