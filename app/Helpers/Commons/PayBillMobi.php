<?php

namespace App\Helpers\Commons;

use Cache;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\CookieJarInterface;
class PayBillMobi
{
  
	public static function getOTP($phoneNumber){
        $client = new \GuzzleHttp\Client();
       
        $random = PayBillMobi::randomcharcter();
        
       
         $data = array();
            $res = $client->post('https://next.mobifone.vn/SmartTopupApi2/webresources/manualLogin/phoneNumber', [
                'headers' => [
                    
                    'User-Agent' => 'okhttp/3.4.1',
                    'deviceId' => $random,
                        ],
                'form_params' => [
                    'MSISDN' => $phoneNumber,
                    'osType' => 'Android',
                    'osVersion' => '8.0.0',
                    'appLanguage' => 'en',
                ],
                ['verify' => false],
                "http_errors" => false,
            ]);
            $statuscode = $res->getStatusCode();
            $res =  json_decode($res->getBody()->getContents(), true);
            $data['statuscode'] = $statuscode;
            if($statuscode == 200){
                $data['isSuccess'] = $res['isSuccess'] ;
                $data['deviceId'] = $random;
            }else{
                if($res['message']){
                    $data['message'] = $res['message'];
                }
                if($res['fields']){
                    $data['fields'] = $res['fields'];
                }
            }
        return json_encode($data);
    }

   
    public static function getTokens($phoneNumber, $otp , $deviceid){
       
        $client = new \GuzzleHttp\Client();
        $data = array();
            $res = $client->request('POST', 'https://next.mobifone.vn/SmartTopupApi2/webresources/manualLogin/otp', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'User-Agent' => 'okhttp/3.4.1',
                    'deviceId' => $deviceid,
                    ],
                'form_params' => [
                    'phoneNumber' => $phoneNumber,
                    'otp' => $otp,
                 
                ],
                ['verify' => false],
                "http_errors" => false,
            ]);
            $statuscode= $res->getStatusCode();
            
            $res =  json_decode($res->getBody()->getContents(), true);
         
            $data['statuscode'] = $statuscode;
            if($statuscode == 200){
                $data['token'] = $res['token'] ;
            }else{
                if (array_key_exists('message', $res)) {
                    $data['message'] = $res['message'];
                } else {
                    $data['message'] = "Lỗi OTP";
                }
                if (array_key_exists('fields', $res)) {
                    $data['fields'] = $res['fields'];
                } else {
                    $data['fields'] = "Lỗi OTP";
                }
               
            }
        return ($data);
    }
    public static function topup($phoneNumber, $token , $pin, $seri, $captcha, $promoCode){
        $client = new \GuzzleHttp\Client();
        $data = array();
            $api = 'https://next.mobifone.vn/SmartTopupApi2/webresources/topup/manualTopup?phoneNumber='.$phoneNumber.'&pin='.$pin.'&serial='.$seri.'&promoCode='.$promoCode.'&valueCaptcha='.$captcha;
            $res = $client->request('GET', $api, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'User-Agent' => 'okhttp/3.4.1',
                    'token' => $token,
                    ],
            ['verify' => false],
            "http_errors" => false,
            ]);
            $statuscode = $res->getStatusCode();
            $res =  json_decode($res->getBody()->getContents(), true);
            
            $data['statuscode'] = $statuscode;
            if($statuscode == 200){
                $data['isSuccess'] = $res['isSuccess'];
                $data['valueTopupSuccess'] = $res['valueTopupSuccess'];
                
            }else if($statuscode == 600){
                if (array_key_exists('message', $res)) {
                    $data['message'] = $res['message'];
                } else {
                    $data['message'] = "Lỗi ";
                }
                if (array_key_exists('fields', $res)) {
                    $data['fields'] = $res['fields'];
                } else {
                    $data['fields'] = "Lỗi ";
                } 
            }else{
                $data['message'] = $res['message'];
            }
        return $data;
    }
    
    
    public static function randomcharcter(){
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $randstring = '';
        // for ($i = 0; $i < 10; $i++) {
        //     $randstring .= $characters[rand(0, strlen($characters))];
        // }
        // return $randstring;
        $randstring = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited
   
       for ($i=0; $i < 10; $i++) {
           $randstring .= $codeAlphabet[random_int(0, $max-1)];
       }
   
       return $randstring;
    }
}
