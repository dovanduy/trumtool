<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckSeriMobiController extends Controller
{
   public function getView(){
    	return view ('dashboard.Mobicheckseri');
    }
    public function checkSeri(Request $request){

    }
}
