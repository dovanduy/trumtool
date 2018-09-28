<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addUserRequest;
use App\User;
use App\Models\Role;
use App\Models\RoleUser;
class UserController extends Controller
{
    protected $user;
	public function __construct(User $user){
		$this->user = $user;
		
	}

    public function getViewAddUser(){
    	return view ('manager.adduser');
    }
    public function getViewListUser(){
    	return view ('manager.listuser');
    }
    public function addUser(addUserRequest $request){
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $email = $request->get('email');
        $password = $request->get('password');
        $tcoin = $request->get('tcoin');
        $isadmin = $request->get('isadmin');
        $isactive = $request->get('isactive');
        $phone = $request->get('phone');
        $facebook = $request->get('facebook');
        $data = array();

        $user = new User();
        $user->firstName = $firstName;
        $user->lastName = $firstName;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->tcoin = $tcoin;
        $user->isadmin = $isadmin;
        $user->isactive = $isactive;
        $user->phone = $phone;
        if($user->save()){
            foreach($request->get('permissions') as $key=>$value){
                $role = Role::where('name', $value)->first();
                $roleUser = new RoleUser();
                $roleUser->user_id = $user->id;
                $roleUser->roles_id = $role->id;
                $roleUser->save();
            }
            alert()->success('Post Created', 'Successfully');
            return redirect()->back();
        }else{
            alert()->success('Post Created', 'Succ22222essfully');
            return redirect()->back();
        }
        return json_encode($data);
    }
}
