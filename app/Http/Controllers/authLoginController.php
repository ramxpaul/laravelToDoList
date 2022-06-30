<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authLoginController extends Controller
{
    public function login()
     {
        return view('login');
     }


     public function doLogin(Request $request)
     {

        $data = $this->validate($request,[
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);

         if(auth()->attempt($data)){

            return redirect(url('Tasks'));
         }else{

            session()->flash('Message-error', "Error : Invalid Email or Password");

             return back();

         }

     }



     public function Logout(){

            auth()->logout();

            return redirect(url('login'));
     }



}

