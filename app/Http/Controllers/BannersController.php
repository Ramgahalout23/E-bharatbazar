<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image As Image;
use App\Banners;

class BannersController extends Controller
{
    public function banners(){
        $bannerDetails = Banners::get();
        return view('admin.banner.banners')->with(compact('bannerDetails'));
    }

    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $banner = new Banners;
            $banner->name = $data['banner_name'];
            $banner->text_style = $data['text_style'];
            $banner->sort_order = $data['sort_order'];
            $banner->content = $data['banner_content'];
            $banner->link = $data['link'];
            // Upload Image
            if ($request->hasFile('image')) {
                $imageName = rand(11111, 99999) . '.' . $request->file('image')->getClientOriginalExtension();
                $destination = 'uploads/Banners/';
                $upload_success = $request->file('image')->move($destination, $imageName);
                Image::make($upload_success)->resize(500,500)->save($upload_success);
                $banner->image = $upload_success;
            }
            $banner->save();
            return redirect('/admin/banners')->with('flash_message_success','Banners has been Added Successfully!!');
        }
        return view('admin.banner.add_banner');
    }
}
