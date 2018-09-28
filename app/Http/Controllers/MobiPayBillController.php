<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Commons\PayBillMobi;
use App\Models\Paybill;
use App\Models\DataPhone;
use Auth;
class MobiPayBillController extends Controller
{
    protected $Paybill, $dataphone, $network_id;
	public function __construct(Paybill $Paybill, DataPhone $dataphone){
        $this->Paybill = $Paybill;
        $this->dataphone = $dataphone;
        $this->network_id = 2;
	}
    public function getView(){
        
        if(Auth()->user()->isadmin == 1){
            $paybillmobis = $this->Paybill->where('network_id', $this->network_id )->get();
        }else{
            $paybillmobis = $this->Paybill->where('network_id', $this->network_id )->where('user_id', Auth::id())->get();
        }
      
        return view('dashboard.MobiPaybill', compact('paybillmobis'));
        // return response()->json([
        //     'html' => view('dashboard.MobiPaybill', compact('paybillmobis'))->render(),
        // ]);
       
    }
    public function checkPhone(Request $request){
        $data = array();
        $phoneNumber = $request->get('phoneNumber');
        $count = $this->dataphone->where('phoneNumber', $phoneNumber)->where('status',1)->count();
        if($count > 0){
            $data['statuscode'] = 200;
            $data['message'] = "Số " . $phoneNumber . "bạn có thể tiếp tục nạp thẻ";
        }else{
            $data['statuscode'] = 500;
            $data['message'] = "Số " . $phoneNumber . " chưa tồn tại  hoặc lỗi . Bạn cần phải get OTP để tiếp tục";
        }
        return json_encode($data);
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
        $statuscode = $res['statuscode'];
        if($statuscode == 200){
            $token = $res['token'];
            $count = $this->dataphone->where('phoneNumber', $phoneNumber)->count();
            if($count == 0){
                $add = new DataPhone();
                $add->phoneNumber = $phoneNumber;
                $add->otp = $otp;
                $add->token = $token;
                $add->deviceId = $deviceId;
                $add->status = true;
                $add->user_id = Auth::id();
                if($add->save()){
                    $statuscode = 200;
                    $message = "Thêm " .$phoneNumber ." thành công";
                }else{
                    $statuscode = 500;
                    $message = "Thêm " .$phoneNumber ." lỗi";
                }
            }else{

                $status = true;
                $update = $this->dataphone->updateToken($phoneNumber, $otp, $token,$status);
                if($update){
                    $statuscode = 200;
                    $message = "Update " .$phoneNumber ." thành công";
                }else{
                    $statuscode = 500;
                    $message = "Update " .$phoneNumber ."lỗi";
                }
            }
        }else{
            $message = $res['message'];
        }
        $data['statuscode'] = $statuscode;
        $data['message'] = $message;
        return json_encode( $data);
    }
    public function TopUp(Request $request){
       
        $phoneNumber = $request->get('phoneNumber');
        $codeCard = $request->get('codeCard');
        $seri ="";
        $promoCode ="";
        $captcha = $request->get('captcha');
        $info = $this->dataphone->where('phoneNumber', $phoneNumber)->first();
        $data = array();
        if($info != null){
            
            $cardValue =0;
            $note = "";
            $status =false;
            $token = $info->token;
            $res = PayBillMobi::topup($phoneNumber, $token , $codeCard, $seri, $captcha, $promoCode);
            $statuscode = $res['statuscode'];
            
            if($statuscode == 200){
                
                $cardValue = $res['valueTopupSuccess'];
                $data['message'] = "Nạp thành công thuê bao: " .$phoneNumber + " mệnh giá : " .$cardValue;
                $note = "Thành công";
                $status = true;
                $add = new Paybill();
                $add->phone_number = $phoneNumber;
                $add->codeCard = $codeCard;
                $add->cardValue = $cardValue;
                $add->network_id = $this->network_id;
                $add->user_id = Auth::id();
                $add->status = $status;
                $add->note = $note;
               
                if($add->save()){
                    
                }else{
                    $data['statuscode'] == 401;
                    $data['message'] = "Đã xảy ra lỗi, liên hệ Admin để xử lý";
                    // $data = json_encode($data);
                }
            }else if($statuscode == 600){
                $data['message'] = $res['message'];
                $note = $res['message'];
                $status = false;
            }else if($statuscode == 401){
                $update = $this->dataphone->where('phoneNumber',$phoneNumber)->update(['status' => 0 , 'note' =>"token lỗi"]);
                $data['statuscode'] = 401;
                $data['message'] = "Token lỗi, bạn vui lòng lấy lại OTP";
                // $data = json_encode($data);
            }
           
        }else{
            
           
            $data['statuscode'] == 401;
            $data['message'] = "Lỗi, bạn vui lòng kiểm tra lại số điện thoại";
            // $data = json_encode($data);
        }
        return json_encode($data);
    }
}
