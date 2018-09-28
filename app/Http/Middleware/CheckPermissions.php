<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use Route;
use Flash;
use App\Models\Role;
use App\Models\RoleUser;

class CheckPermissions
{
    protected $roles;
    protected $roleUser;
    public function __construct(Role $roles, RoleUser $roleUser){
        $this->roles = $roles;
        $this->roleUser = $roleUser;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = explode('.', Route::currentRouteName());
        
        if(Auth::user()->isadmin !=1 ){

            //
            if($this->checkPermisson(Route::currentRouteName()) == true){
                return $next($request);
            }
            
            if(!empty($routeName[1]) && !empty($routeName[0])){
                
                $route = $this->checkRoute($routeName[1], $routeName[0]);
               
            } else {
                $route = $routeName;
            }

            $getRouteName  = $this->roles->where('name', $route)->first();
           
            if(empty($getRouteName))
            {
                Flash::error('Bạn không có quyền truy cập vào chức năng này .');
                return redirect()->route('page403.index');
            }
            
            $usersPermissions = $this->roleUser
                                ->where('user_id',Auth::user()->id)
                                ->where('roles_id', $getRouteName->id)->count();  
                               
            if($usersPermissions != 1)
            {
                Flash::error('Bạn không có quyền truy cập vào chức năng này .');
                return redirect()->route('page403.index');
            }

            
        }
        
        
         return $next($request);
    }

    public function checkRoute($action, $param){
        
        switch ($action){
            case 'index': return $param.'.index';
            case 'create': return $param.'.create,'.$param.'.store';
            case 'store': return $param.'.create,'.$param.'.store';
            case 'edit': return $param.'.edit,'.$param.'.update';
            case 'update': return $param.'.edit,'.$param.'.update';
            case 'destroy': return $param.'.destroy';
            default: return $param.'.index';
        }
    }

    public function checkPermisson($routeName){
       
           if($routeName=="paybillmobi.create" || $routeName=="checkPhonemobi.store" || $routeName=="getOTPmobi.store" || $routeName=="getTokenmobi.store"
        || $routeName=="topupmobi.store"){

            $routeName = "paybillmobi.create,checkPhonemobi.store,getOTPmobi.store,getTokenmobi.store,topupmobi.store";
            $getRouteName  = $this->roles->where('name', $routeName)->first();
            
            $usersPermissions = $this->roleUser
                                ->where('user_id',Auth::user()->id)
                                ->where('roles_id', $getRouteName->id)->count();
            
            if($usersPermissions == 1)
            {
                return true;
            }else{
                return false;
            }
        }else if($routeName=="dataphonemobi.create" || $routeName=="dataphonemobigetoken.store" || $routeName=="dataphonemobiaddphone.store"){

            $routeName = "dataphonemobi.create,dataphonemobigetoken.store,dataphonemobiaddphone.store";
            $getRouteName  = $this->roles->where('name', $routeName)->first();
            
            $usersPermissions = $this->roleUser
                                ->where('user_id',Auth::user()->id)
                                ->where('roles_id', $getRouteName->id)->count();
            
            if($usersPermissions == 1)
            {
                return true;
            }else{
                return false;
            }
        }
    }
}
