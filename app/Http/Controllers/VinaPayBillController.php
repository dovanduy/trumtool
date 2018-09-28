<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paybill;
use App\Helpers\Commons\PayBillVina;
class VinaPayBillController extends Controller
{
    public function getView(){
        return view('dashboard.VinaPaybill');
    }
    public function TopUp(Request $request){
        $phoneNumber = $request->get('phoneNumber');
        $codeCard = $request->get('codeCard');
        
        $res = PayBillVina::paybill($phoneNumber, $codeCard);
        dd($res);
        $statuscode = $res['error_code'];
        
        return redirect()->back()->with('error','Opps!! Vcoin của bạn không đủ. nạp để tiếp tục nhé');
    }
}
