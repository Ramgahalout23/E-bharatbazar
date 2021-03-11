<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image As Image;
use App\Products;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if($request->ismethod('post')){
            $data = $request->all();
        //  echo "<pre>";print_r($data);die;
            $product = new Products;
            $product->name = $data['product_name'];
            $product->code = $data['product_code'];
            $product->color = $data['product_color'];
            if(!empty($data['product_description'])){
                $product->description = $data['product_description'];

            }else{
                $product->description = '';
            }
            $product->price = $data['product_prize'];

            if ($request->hasFile('image')) {
                $imageName = rand(11111, 99999) . '.' . $request->file('image')->getClientOriginalExtension();
                $destination = 'uploads/products/';
                $upload_success = $request->file('image')->move($destination, $imageName);
                Image::make($upload_success)->resize(500,500)->save($upload_success);
                $product->image = $upload_success;
            }
            $product->save();
            return redirect('admin/add-product')->with('flash_message_success','Product has been added !');
        }
        return view('admin.product.add_product')->with('flash_message_error','Something Went Wrong!');;


}
}
