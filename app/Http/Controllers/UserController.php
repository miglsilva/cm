<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class UserController extends Controller
{
    public function getSignup(){
    	return view('user.signup');
    }

    public function postSignup(Request $request){
    	$this->validate($request , [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
    		]);

    	$user = new User([
            'name' => $request->input('name'),
    		'email' => $request->input('email'),
    		'password' => bcrypt($request->input('passsword'))
    		]);
    	$user->save();

        Auth::login($user);

    	return redirect()->route('user.profile');
    }
    public function getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required|min:6|',
        ]);

        $userdata = array(
            'email' => $request->input('email'),
            'password' => $request->input('passsword')
        );
 
        if(Auth::attempt($userdata)){
            return view('user.profile');
        }
    }

    public function getProfile(){
        return view('user.profile');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('product.index');  
    }
    
}
