<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class DataPhone extends Model
{
    public function updateToken($phoneNumber, $otp, $token, $status){
        return DB::table('data_phones')
            ->where('phoneNumber', $phoneNumber)
            ->update(['otp' => $otp , 'token' =>$token, 'status' =>$status]);
    }
}
