<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Account extends Model
{
    public static function updateStatus($username, $status, $note){
        return DB::table('accounts')
            ->where('username', $username)
            ->update(['status' => $status,
                        'note'=> $note]);
    }
    public static function updateToken($username, $token, $note){
     
        return DB::table('accounts')
            ->where('username', $username)
            ->update(['token' => $token,
            'note'=> $note]);
    }
}
