<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Commons\VietelService;
use App\Helpers\Commons\MomoService;
use App\Models\Checkseri;

use Auth;
class CheckSeriViettelController extends Controller
{
    protected $checkseri, $network_id;
	public function __construct(Checkseri $checkseri){
        $this->checkseri = $checkseri;
       
        $this->network_id = 1; //1 viettel, 2 mobi 3 vina
	}
    public function getView(){
        
        if(Auth::user()->isadmin ==1){
            $datas= $this->checkseri->get();
        }else{
            $datas= $this->checkseri->where('user_id',Auth::user()->id )->get();
        }
        
    	return view ('dashboard.Viettelcheckseri',compact('datas'));
    }
    public function checkSeri(Request $request){
        $VietelService = new VietelService();
        $serial = $request->get('serial');
        $res = $VietelService->CheckSeri($serial);
        $statuscode =  $res['error'];
         $add = new CheckSeri();
         $add->seriNumber =  $serial;
         $add->cardValue = $res['cardValue'];
         $add->dateUsed = $res['dateUsed'];
         $add->isdn = $res['isdn'];
         $add->cardExpired = $res['cardExpired'];
         $add->ownerName = $res['ownerName'];
         $add->network_id = $this->network_id;
         $add->user_id = Auth::id();
         
         $add->note =$res['msg'];
         if($res['dateUsed'] == NULL && $statuscode == 0){
            $add->status = 0;
         }else if($statuscode == 0){
            $add->status = 1;
         }else{
            $add->status = 2;
         }
         $add->save();
        
        return $res;
    }
}
