<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
        return view('admin.product.add_product');


         }


public function viewProducts()
{
  $product = Products::get();

 return view('admin.product.view_products',['products'=> $product]);
}


public function editProducts(Request $request, $id=null){
    if($request->isMethod('post')){
        $data = $request->all();
        //Upload image
        //   echo "<pre>";print_r($data);die;
        if ($request->hasFile('image')) {
            $filename = rand(11111, 99999) . '.' . $request->file('image')->getClientOriginalExtension();
            $destination = 'uploads/products/';
            $upload_success = $request->file('image')->move($destination, $filename);
            Image::make($upload_success)->resize(500,500)->save($upload_success);
        }else{
        $upload_success = $data['current_image'];
                //  echo "<pre>";print_r($data);die;

    }
    if(empty($data['product_description'])){
        $data['product_description'] = '';
    }
    Products::where(['id'=>$id])->update(['name'=>$data['product_name'],
    'code'=>$data['product_code'],'color'=>$data['product_color'],
    'description'=>$data['product_description'],'price'=>$data['product_price'],
    'image'=>$upload_success]);

    return redirect()->back()->with('flash_message_success','Product has been updated!!');
}
    $productDetails = Products::where(['id'=>$id])->first();

  return view('admin.product.edit_product')->with(compact('productDetails'));

}

public function deleteProducts(Request  $request,  $id=null){
    Products::where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_message_error','Product Deleted');

}

}
