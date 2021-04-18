<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    public function userLoginRegister(){
        return view('Ebharatbazar.users.login_register');
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                return redirect()->back()->with('flash_message_error','Email is already exist');
            }else{
             //adding user in table
             $user = new User;
             $user->name = $data['name'];
             $user->email = $data['email'];
             $user->password = bcrypt($data['password']);
             $user->save();
             if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('frontSession',$data['email']);
                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart'->where('session_id',$session_id))->update(['email'=>$data['email']]);
                }
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);
                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('cart'->where('session_id',$session_id))->update(['email'=>$data['email']]);
                    }
                }
                return redirect('/Cart');
        }   
        }
    }
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
        //    echo "<pre>";print_r($data);die;
         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('/Cart');
         }else{
            return redirect()->back()->with('flash_message_error','Invalid username and password!');
        }
        }
    }
    public function logout(){
        Session::forget('frontSession');
        Auth::logout();
        return redirect('/');
    }

    public function account(Request $request){
        return view('Ebharatbazar.users.account');
    }
}
