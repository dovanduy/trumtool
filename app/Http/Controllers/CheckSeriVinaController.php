<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckSeriVinaController extends Controller
{
    public function getView(){
    	return view ('dashboard.Vinacheckseri');
    }
}
