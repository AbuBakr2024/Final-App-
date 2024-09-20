<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;


class usercontroller extends Controller
{
    public function user()
    {         //name of model
                $user=user::all();
                return view('auth.user')->with("user",$user);
        }

}
