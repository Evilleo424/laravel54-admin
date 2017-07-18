<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(){
	    return view('login.index');
    }

	public function login(){
        $this->validate(request(),[
            'name'          => 'required|string',
            'password'      => 'required',
            'is_remember'   => 'integer'
        ]);

        $user = request(['name','password']);
        $is_remember = boolval(request('is_remember'));
        if(Auth::attempt($user,$is_remember)){
            return redirect('/home');
        }else{
            return Redirect::back()->withErrors('账号密码不匹配');
        }
	}

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
