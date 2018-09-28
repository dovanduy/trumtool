<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paybill;
use App\Models\DataPhone;
use App\Helpers\Commons\PayBillMobi;
class DataPhoneController extends Controller
{
    protected $dataphone;
	public function __construct(DataPhone $dataphone){
        $this->dataphone = $dataphone;
	}
    public function getView(){
        $datapphones = $this->dataphone->get();
        return view('dashboard.DataPhoneMobi', compact('datapphones'));
    }
    public function getToken(Request $request){
        $data = array();
        $phoneNumber = $request->get('phoneNumber');
        $otp = $request->get('otp');
        $deviceId = $request->get('deviceId');
        $res = PayBillMobi::getTokens($phoneNumber, $otp ,$deviceId);
        return $res;
    }
    public function addPhone(Request $request){
        $data = array();
        $phoneNumber = $request->get('phoneNumber');
        $deviceId = $request->get('deviceId');
        $otp = $request->get('otp');
        $token = $request->get('token');
        $add = new DataPhone();
        $add->phoneNumber = $phoneNumber;
        $add->otp = $otp;
        $add->deviceId = $deviceId;
        $add->token = $token;
        $add->user_id = 1;
        $add->status = true;
        $add->note = "Hoạt động";
        if($add->save()){
            return redirect()->route('dataphonemobiaddphone.store')->with('success', 'Thêm ' . $phoneNumber . ' thành công');
        }else{
            return redirect()->route('dataphonemobiaddphone.store')->with('error', 'Thêm ' . $phoneNumber . ' thất bại');
        }
    }
    public function Delete($phoneNumber){
        $data = array();
        $delete = $this->dataphone->where('phoneNumber', $phoneNumber)->delete();
        if($delete){

        }else{

        }
    }
}
