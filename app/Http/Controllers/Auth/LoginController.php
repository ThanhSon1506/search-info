<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function checkLogin(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
       if(Auth::attempt($data)){
            return redirect()->route('dashboard');
       }else {
            return redirect()->route('admin.auth.login')->with('mess','Thông tin đăng nhập không chính xác');
       }
   }

   function logoutAdmin(){
       Auth::logout();
       return redirect('/admin');
   }
   
}
