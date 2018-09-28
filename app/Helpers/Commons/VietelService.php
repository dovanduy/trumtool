<?php

namespace App\Helpers\Commons;

use Cache;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\CookieJarInterface;
use Carbon\Carbon;
use App\Models\Account;
use Symfony\Component\Security\Core\Util;
use App\Helpers\Commons\StringUtils;
class VietelService
{
    public $username;
    public $password;
    public $req;
    public $utils;
    public $api ="https://171.255.192.120:8115/BCCSGatewayWS/BCCSGatewayWS?wsdl";
    public $version = '3.3.8';
    public $serial;
    public $bccsgw_user = "d75c507cf9d4a80d5be1924a3d0c790fbd5b9aa53d8c5f5066d0d8f632bcb26814fc22840211ab1ed617be90f58390ef";
    public $bccsgw_pass = "7e406d34b24a4a7c8439c5b3105b014e839c7c5f183bbc1a79a9f2e5b27a400114fc22840211ab1ed617be90f58390ef";  
    public $result;
    public function __construct()
    {
        $this->ultis = new StringUtils();
        $account = Account::where('type_account_id', 2)->where('status', 1)->first();
       
        if($account != NULL){
            $this->username = $this->ultis->encrypt($account->username);
            $this->password = $this->ultis->encrypt($account->password);
            $this->bccsgw_user = $this->ultis->decrypt($this->bccsgw_user);
            $this->bccsgw_pass = $this->ultis->decrypt($this->bccsgw_pass);
        }else{
            $this->username = "null";
            $this->password = "null";
            $this->bccsgw_user = $this->ultis->decrypt($this->bccsgw_user);
            $this->bccsgw_pass = $this->ultis->decrypt($this->bccsgw_pass);
        }
    }
    
    public  function Login(){
        
        try {
            $client = new \GuzzleHttp\Client();
            $clientTime = round(microtime(true) * 1000);
            $params = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://webservice.bccsgw.viettel.com/"><soapenv:Header/><soapenv:Body><web:gwOperation><Input><!--Validate BCCSGateway:--><username>'.$this->bccsgw_user.'</username><password>'.$this->bccsgw_pass.'</password><wscode>mbccs_loginBccs2</wscode><!--Zero or more repetitions:--><rawData><![CDATA[<ws:login><mbccsRequestCode>MBCCS1</mbccsRequestCode><requestId>mbccs_loginBccs2;1533025324559;571140107genClientKey</requestId><userName>'.$this->username.'</userName><osType>Android</osType><networkType>PUBLIC</networkType><userName>'.$this->username.'</userName><passWord>'.$this->password.'</passWord><addInfo>14fc22840211ab1ed617be90f58390ef</addInfo><clientTime>'.$clientTime.'</clientTime><version>'.$this->version.'</version><serialSim>89840200021254417873</serialSim><osType>Android</osType><networkType>PUBLIC</networkType></ws:login>]]></rawData></Input></web:gwOperation></soapenv:Body></soapenv:Envelope>';
            $res = $client->post($this->api, [
                'headers' => [
                    'User-Agent' => 'okhttp/3.4.1',
                    'Accept-Encoding: gzip',
                    'Content-Type: text/xml;charset=UTF-8'
                ],
                'body' => $params,
                ['verify' => false],
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false
                ],
                "http_errors" => false,
            ]);
            $statuscode =  $res->getStatusCode();
            $res = $res->getBody()->getContents();
            $errorCode = $this->getValue($res, 'errorCode&gt;','&lt;/errorCode');
            $token = $this->getValue($res, 'token&gt;','&lt;/token');
            
             if($token == null ||  $errorCode ==1){
                    $status = false;
                    $note = "Tài khoản dịch vụ không hoạt động";
                    $update = Account::updateStatus($this->ultis->decrypt($this->username),$status,$note);
                    $account = Account::where('type_account_id', 2)->where('status', 1)->first();
                    if($account != NULL){
                        $this->username = $this->ultis->encrypt($account->username);
                        $this->password = $this->ultis->encrypt($account->password);
                        \Log::info($this->username);
                        $this->Login();
                    }else{
                        $this->username = "NULL";
                        $this->password = "NULL";
                        \Log::info($this->username);
                    }
                }else{
                    $note ="";
                    $updatetoken = Account::updateToken($this->ultis->decrypt($this->username), $token, $note);
                }
            return true;
           
        }catch (\Exception $e) {
            \Log::info($e);
            return 0;
        }
    }
	public  function CheckSeri($serial){
        try {
            
            $this->serial = $serial;
            $token = Account::where('username', $this->ultis->decrypt($this->username))->first()->token;
          
            $client = new \GuzzleHttp\Client();
            $clientTime = round(microtime(true) * 1000);
            $params = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://webservice.bccsgw.viettel.com/"><soapenv:Header/><soapenv:Body><web:gwOperation><Input><!--Validate BCCSGateway:--><username>'.$this->bccsgw_user.'</username><password>'.$this->bccsgw_pass.'</password><wscode>mbccs_getInforCardNumber</wscode><!--Zero or more repetitions:--><rawData><![CDATA[<ws:getInforCardNumber><mbccsRequestCode>MBCCS1</mbccsRequestCode><input><requestId>mbccs_getInforCardNumber;1532502902368;850847542</requestId><userName>'.$this->username.'</userName><osType>Android</osType><vsaMenu>channel.order.mbccs2</vsaMenu><networkType>PUBLIC</networkType><token>'.$token.'</token><serial>'.$serial.'</serial><regType>0</regType></input></ws:getInforCardNumber>]]></rawData></Input></web:gwOperation></soapenv:Body></soapenv:Envelope>';
            $res = $client->post($this->api, [
                'headers' => [
                    'User-Agent' => 'okhttp/3.4.1',
                    'Accept-Encoding: gzip',
                    'Content-Type: text/xml;charset=UTF-8'
                ],
                'body' => $params,
                ['verify' => false],
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false
                ],
                "http_errors" => false,
            ]);
            $res = $res->getBody()->getContents();
            $errorCode = $this->getValue($res, 'errorCode&gt;', '&lt;/errorCode');
           
            if($errorCode == "TOKEN_INVALID"){
                $this->Login();
                $this->CheckSeri($this->serial);
            }else{
                $responeCode = (int)$this->getValue($res, 'responeCode&gt;', '&lt;/responeCode');
            if($responeCode == 0)
            {
                $isdn = $this->getValue($res, 'dateUsed&gt;&lt;isdn&gt;', '&lt;/isdn');
                $cardValue = $this->getValue($res, 'cardValue&gt;', '&lt;/cardValue');
                $dateUsed = $this->getValue($res, 'dateUsed&gt;', '&lt;/dateUsed');
                $ownerCode = $this->getValue($res, 'ownerCode&gt;', '&lt;/ownerCode');
                $ownerId = $this->getValue($res, 'ownerId&gt;', '&lt;/ownerId');
                $ownerName = $this->getValue($res, 'ownerName&gt;', '&lt;/ownerName');
                $provinceCode = $this->getValue($res, 'provinceCode&gt;', '&lt;/provinceCode');
                $provinceName = $this->getValue($res, 'provinceName&gt;', '&lt;/provinceName');
                $stockModelCode = $this->getValue($res, 'stockModelCode&gt;', '&lt;/stockModelCode');
                $stockModelName = $this->getValue($res, 'stockModelName&gt;', '&lt;/stockModelName');
                $cardExpired = $this->getValue($res, 'cardExpired&gt;', '&lt;/cardExpired');
                $this->result = array(
                'error' => 0,
                'msg' => empty($dateUsed) ? 'Thẻ chưa sử dụng' : 'Thẻ đã sử dụng',
                'isdn' => $isdn,
                'cardValue' => $cardValue,
                'dateUsed' => $dateUsed,
                'ownerCode' => $ownerCode,
                'ownerId' => $ownerId,
                'ownerName' => $ownerName,
                'provinceCode' => $provinceCode,
                'provinceName' => $provinceName,
                'stockModelCode' => $stockModelCode,
                'stockModelName' => $stockModelName,
                'cardExpired' => $cardExpired
                );
            }
            else
            {
                $this->result = array(
                'error' => 1,
                'msg' => 'Thẻ không tồn tại',
                'isdn' => '',
                'cardValue' => 0,
                'dateUsed' => '',
                'ownerCode' => '',
                'ownerId' => '',
                'ownerName' => '',
                'provinceCode' => '',
                'provinceName' => '',
                'stockModelCode' => '',
                'stockModelName' => '',
                'cardExpired' => ''
                );
            }
            }
            
            
            
        }catch (\Exception $e) {
            \Log::info($e);
            $this->result = array(
                'error' => 2,
                'msg' => 'Tài khoản dịch vụ không hoạt động',
                'isdn' => '',
                'cardValue' => 0,
                'dateUsed' => '',
                'ownerCode' => '',
                'ownerId' => '',
                'ownerName' => '',
                'provinceCode' => '',
                'provinceName' => '',
                'stockModelCode' => '',
                'stockModelName' => '',
                'cardExpired' => ''
              );
        }
        return $this->result ;
    }
    public function CheckBill($phoneNumber){
        try{
            $client = new \GuzzleHttp\Client();
            $curtime =  round(microtime(true) * 1000);
            $token = Account::where('username', $this->ultis->decrypt($this->username))->first()->token;
            $params = '<?xml version="1.0" encoding="UTF-8"?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://webservice.bccsgw.viettel.com/">
               <soapenv:Header />
               <soapenv:Body>
                  <web:gwOperation>
                     <Input>
                        <!--Validate BCCSGateway:-->
                        <username>'.$this->bccsgw_user.'</username>
                        <password>'.$this->bccsgw_pass.'</password>
                        <wscode>mbccs_searchContract</wscode>
                        <!--Zero or more repetitions:-->
                        <rawData><![CDATA[<ws:searchContract><mbccsRequestCode>MBCCS1</mbccsRequestCode><input><requestId>mbccs_searchContract;'.$curtime.';571495746</requestId><userName>'.$this->username.'</userName><osType>Android</osType><vsaMenu>pm_payment_ctv_mbccs2@@</vsaMenu><networkType>PUBLIC</networkType><version>3.3.8</version><token>'.$token.'</token><isdn>'.$phoneNumber.'</isdn><pageIndex>0</pageIndex><pageSize>50</pageSize></input></ws:searchContract>]]></rawData>
                     </Input>
                  </web:gwOperation>
               </soapenv:Body>
            </soapenv:Envelope>';
            $res = $client->post($this->api, [
                'headers' => [
                    'User-Agent' => 'okhttp/3.4.1',
                    'Accept-Encoding: gzip',
                    'Content-Type: text/xml;charset=UTF-8'
                ],
                'body' => $params,
                ['verify' => false],
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false
                ],
                "http_errors" => false,
            ]);
            $res = $res->getBody()->getContents();
            dd($res);
        }catch (\Exception $e){
            \Log::info($e);
            return 0;
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
