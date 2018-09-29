<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Commons\PayBillMobi;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function getView404(){
        return view('page.404');
    }
    public function getView403(){
        return view('page.403');
    }
    public function getOTP(Request $request){
        $phoneNumber = $request->get('phoneNumber');
        $res = PayBillMobi::getOTP($phoneNumber);
        return $res;
    }
    public function getToken(Request $request){
        $data = array();
        $phoneNumber = $request->get('phoneNumber');
        $otp = $request->get('otp');
        $deviceId = $request->get('deviceId');
        $res = PayBillMobi::getTokens($phoneNumber, $otp ,$deviceId);
        return $res;
    }
    
}
