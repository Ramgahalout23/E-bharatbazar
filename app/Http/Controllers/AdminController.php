<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function login(Request $req){
     if($req->isMethod('post')){
        $data =$req->input();
        if (Auth::attempt(['email'=>$data['username'],'password'=>$data['password']])){
           return redirect('admin/dashboard');
        }else
        return redirect ('/admin')->with('flash_message_error','Invalid Username or Password');

     }
         return view('admin/admin_login');
   }

   public function dashboard(){
      return view('admin/dashboard');
   }

   public function logout(){
    Session::flush();
         return redirect('/admin')->with('flash_message_success', 'logout Suceessfully!');
         }
}
