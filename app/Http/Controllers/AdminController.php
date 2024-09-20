<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
   public function dashboard(){

    return view('adminpage');

   }
   public function adminloginpage(){

    return view('auth.adminlogin');

   }

   public function adminlogin(Request $request){

    $request->validate([

        'email'=>'required|email',
        'password'=>'required'
    ]);

    if(Auth::guard('admins')->attempt([
       // in db
        'email'=>$request->email,
        'password'=>$request->password
   ])){

    return redirect()->route('admin.dashboard');

   }else{

      return redirect()->route('admin.loginpage');
   }
    }
}
