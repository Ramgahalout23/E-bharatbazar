<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            Session::put('frontSession',$data['email']);
            if(!empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                DB::table('cart'->where('session_id',$session_id))->update(['email'=>$data['email']]);
            }
            return redirect('/');
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

    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
    //  echo "<pre>";print_r($data);die;
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_password = $data['current_password'];
            if(Hash::check($current_password,$old_pwd->password)){
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Yours Password is Changed Now!');
            }else{
             return redirect()->back()->with('flash_message_error','Old Password is Incorrect!');
            }
        }
        return view('Ebharatbazar.users.change_password');
    }
    public function changeAddress(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
    //   echo "<pre>";print_r($userDetails);die;
     if($request->isMethod('post')){
         $data = $request->all();
         $user = User::find($user_id);
         $user->name = $data['name'];
         $user->address = $data['address'];
         $user->city = $data['city'];
         $user->state = $data['state'];
         $user->country = $data['country'];
         $user->pincode = $data['pincode'];
         $user->mobile = $data['mobile'];
         $user->save();
         return redirect()->back()->with('flash_message_success','Account Details Has Been Updated!');
         
     }
        $countries = Country::get();
     return view('Ebharatbazar.users.change_address')->with(compact('countries','userDetails'));
 }
}
