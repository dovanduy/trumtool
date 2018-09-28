<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {
      
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->has('remember')))
        {
             //dd("Đăng nhập thành công");
            // Auth::logout();
            return  redirect()->route('dashboard.index');
            $isactive = auth()->user()->isactive;
            $isblock = auth()->user()->isblock;
            if($isactive == 1 && $isblock == 1)
            {
                dd("Đăng nhập thành công");
                // //$this->email->sendEmailLogin($request->get('email'),$request->get('password'));
                // if(auth()->user()->ismember == 1 && auth()->user()->permissions_id == 4){
                //   return  redirect()->route('home..index');
                // } else {
                //   return  redirect()->route('index');
                // }
            } else {
                $mesage = "Tài khoản của bạn đang bị khóa !";
                //Log::info($mesage, auth()->user()->email);
                if($isactive == 0){
                    $mesage = "Tài khoản của bạn chưa kích hoạt !";
                    //Log::info($mesage, auth()->user()->email);
                } else {
                    if($isblock == 0){
                        $mesage = "Tài khoản của bạn đang bị khóa !";
                        //Log::info($mesage, auth()->user()->email);
                    }
                }
                session()->flush();
            }
        } else {
           
            $mesage = "Tên đăng nhập hoặc mật khẩu không đúng !";
            //Log::info($mesage);
        }
        return redirect('/login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $mesage
            ]);
    }
    
    public function logout(){
        $path = '/login';
        session()->flush(); 
        return redirect($path);
    }
}
