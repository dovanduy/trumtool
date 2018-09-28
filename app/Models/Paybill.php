<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Paybill extends Model
{
    public function isUser(){
		return $this->hasOne('App\User', 'id', 'id_user');
    }
    public function getData($userId, $networdId){
        
        return DB::table('paybills')->where('user_id', $userId)->where('network_id', $networdId)->get();
    }
}
