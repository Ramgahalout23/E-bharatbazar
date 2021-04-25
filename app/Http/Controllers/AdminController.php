<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AdminController extends Controller
{
   public function login(Request $req)
   {
      if ($req->isMethod('post')) {
         $data = $req->input();
         $adminCount = Admin::where(['username' => $data['username'], 'password' => md5($data['password']), 'status' => 1])->count();
         //  echo "<pre>";print_r($adminCount);die;
         if ($adminCount > 0) {
            Session::put('adminSession', $data['username']);
            return redirect('admin/dashboard');
         } else {

            return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');
         }
      }
      return view('admin/admin_login');
   }

   public function dashboard()
   {
      return view('admin/dashboard');
   }

   public function logout()
   {
      Session::forget('adminSession');
      Session::forget('session_id');
      return redirect('/admin')->with('flash_message_success', 'loged out Suceessfully!');
   }


   public function changePassword(Request $request)
   {
      $userDetail = Admin::where(['status' => 1])->first();
      if ($request->isMethod('post')) {
         $data = $request->all();
         $adminCount = Admin::where([
            'username' => Session::get('adminSession'),
            'password' => md5($data['current_pwd']), 'status' => 1
         ])->count();
         if ($adminCount == 1) {
            $new_pwd = md5($data['new_pwd']);
            Admin::where('username', Session::get('adminSession'))->update([
               'password' => $new_pwd,
               'username' => $data['username']
            ]);
            return redirect()->back()->with('flash_message_success', 'Password is Updated Successfully!!');
         } else {
            return redirect()->back()->with('flash_message_error', 'Current Password is incorrect!');
         }
      }
      return view('admin.user_profile')->with(compact('userDetail'));
   }
}
