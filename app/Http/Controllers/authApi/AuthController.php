<?php

namespace App\Http\Controllers\authApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
          "name"=>"required",
           "email"=>"required|unique:users,email|email",
          // confirmed: make you write password twice to ensure that twice match
           "password"=>"required|confirmed"
           ]);
              $user=new User();
              $user->name=$request->name;
              $user->email=$request->email;
              $user->password=bcrypt($request->password);
              $user->rule=1;
              $user->save();

              $token=Str::random(60);

              $massage=[
                  "name"=>$user,
                  "token"=>$token,
                  "massage"=>"welcome new user",
                  "status"=> 201
                   ];

                   return response($massage,201);

                   // $user=User::create([
              //     'name'=>$data['name'],
              //     'email'=>$data['email'],
              //     'password'=>bcrypt($data['password'])
              // ]);

          }



          public function login(Request $request){

              $request->validate([
                   "email"=>"required",
                   "password"=>"required"
                   ]);

             $user= User::where("email","=",$request->email)->first();

            if(!$user || !Hash::check($request->password,$user->password)){
              return response("enter right pass or email") ;
          }
              $token= $user->createToken('myToken')->plainTextToken;

              $massage=[
                  "name"=>$user,
                  "token"=>$token,
                  "massage"=>"login true",
                  "status"=> 201
                   ];

                   return response($massage,201);



          }


          public function logout(){

          auth()->user()->tokens()->delete();

          return [
              "massage"=>"log out done",
               ];
          }

}
