<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image As Image;
use RealRashid\SweetAlert\Facades\Alert;
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
                $destination = 'uploads/banners/';
                $upload_success = $request->file('image')->move($destination, $imageName);
                Image::make($upload_success)->save($upload_success);
                $banner->image = $upload_success;
            }
            $banner->save();
            return redirect('/admin/banners')->with('flash_message_success','Banners has been Added Successfully!!');
        }
        return view('admin.banner.add_banner');
    }

    public function editBanner(Request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // Upload Image
            if ($request->hasFile('image')) {
                $filename = rand(11111, 99999) . '.' . $request->file('image')->getClientOriginalExtension();
                $destination = 'uploads/banners/';
                $upload_success = $request->file('image')->move($destination, $filename);
                Image::make($upload_success)->save($upload_success);
            }
            else if(!empty($data['current_image'])){
                $upload_success = $data['current_image'];
                // dd($fileName);
            }else{
                $upload_success = '';
            }
            Banners::where('id',$id)->update(['name'=>$data['banner_name'],
            'text_style'=>$data['text_style'],'content'=>$data['banner_content'],'link'=>$data['link'],
            'sort_order'=>$data['sort_order'],'image'=>$upload_success]);
            return redirect('/admin/banners')->with('flash_message_success','Banner has been Update Successfully');
        }
        $bannerDetails = Banners::where(['id'=>$id])->first();

        return view('admin.banner.edit_banner')->with(compact('bannerDetails'));
    }

    public function deleteBanner($id=null){
        Banners::where(['id'=>$id])->delete();
        Alert::success('Deleted Successfully', 'Success Message');
        return redirect()->back()->with('flash_message_error','Banner Deleted');
    }
    public function updateStatus(Request $request,$id=null){
        $data = $request->all();
        Banners::where('id',$data['id'])->update(['status'=>$data['status']]);

    }
}

