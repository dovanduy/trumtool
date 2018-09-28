<?php

namespace App\Helpers\Commons;

use Cache;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\CookieJarInterface;
class PayBillVina
{
  
	
    public static function paybill($phoneNumber, $codeCard){
        $client = new \GuzzleHttp\Client();
           $api ="https://api-myvnpt.vnpt.vn/mapi/services/mobile_payment_recharge";
            $res = $client->request('POST', $api, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    // 'User-Agent' => 'okhttp/3.4.1',
                    ],
                 'json' => [
                    'msisdn' => $phoneNumber,
                    'card_id' => $codeCard,
                ],
                ['verify' => false],
                "http_errors" => false,
            ]);
            $statuscode = $res->getStatusCode();
            $res =  json_decode($res->getBody()->getContents(), true);
            return $res;
    }
}
