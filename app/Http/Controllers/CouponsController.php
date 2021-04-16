<?php

namespace App\Http\Controllers;
use App\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();    
            //echo"<pre>"; print_r($data);die;
            $coupon = new Coupons;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->save();
            return redirect('/admin/view-coupons')->with('flash_message_success','Coupon has been added Successfully');
          }
        return view('admin.coupons.add_coupon'); 
    }
}
