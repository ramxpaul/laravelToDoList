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

            return redirect(url('Users'));
         }else{

            session()->flash('Message-error', "Invalid Credentials");

             return back();

         }

     }



     public function Logout(){

            auth()->logout();

            return redirect(url('login'));
     }



}

