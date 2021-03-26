<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image As Image;
use App\Products;
use App\Category;
use App\ProductAttributes;
use App\ProductsImages;
use App\ProductsAttributes;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if($request->ismethod('post')){
            $data = $request->all();
        //  echo "<pre>";print_r($data);die;
            $product = new Products;
            $product->name = $data['product_name'];
            $product->category_id = $data['category_id'];
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
            return redirect('admin/view-product')->with('flash_message_success','Product has been added !');
        }
       //Categories Dropdown menu Code
       $categories = Category::where(['parent_id'=>0])->get();
       $categories_dropdown = "<option value='' selected disabled>Select</option>";
       foreach($categories as $cat){
           $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
           $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
           foreach($sub_categories as $sub_cat){
               $categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

           }
       }
       return view('admin.product.add_product')->with(compact('categories_dropdown'));
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
    'category_id'=>$data['category_id'],
    'code'=>$data['product_code'],'color'=>$data['product_color'],
    'description'=>$data['product_description'],'price'=>$data['product_price'],
    'image'=>$upload_success]);

    return redirect()->back()->with('flash_message_success','Product has been updated!!');
}
    $productDetails = Products::where(['id'=>$id])->first();
     //Category dropdown code
     $categories = Category::where(['parent_id'=>0])->get();
     $categories_dropdown = "<option value='' selected disabled>Select</option>";
     foreach($categories as $cat){
         if($cat->id==$productDetails->category_id){
             $selected = "selected";
         }else{
             $selected = "";
         }
         $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
     //code for showing subcategories in main category
     $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
     foreach($sub_categories as $sub_cat){
         if($sub_cat->id==$productDetails->category_id){
             $selected = "selected";
         }else{
             $selected = "";
         }
     $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
     }
 }

  return view('admin.product.edit_product')->with(compact('productDetails','categories_dropdown'));

}

public function deleteProducts($id=null){
   $product_image =Products::where(['id'=>$id])->first();
if (file_exists($product_image->image))
{
    unlink($product_image->image);
}
    Products::where(['id'=>$id])->delete();
    Alert::success('Success', 'Product has been deleted');
    return redirect()->back()->with('flash_message_error','Product Deleted');

}
public function updateStatus(Request $request,$id=null){
    $data = $request->all();
    Products::where('id',$data['id'])->update(['status'=>$data['status']]);

}
public function productDetail($id =null)    {

    $productDetails= Products::where('id',$id)->first();
    // echo $productDetails;die;
    return view('Ebharatbazar.product_detail')->with(compact('productDetails'));

}

public function addAttributes(Request $request,$id=null){
    $productDetails= Products::with('attributes')->where(['id'=>$id])->first();
    if($request->isMethod('post')){
        $data = $request->all();
        foreach($data['sku'] as $key =>$val){
            if(!empty($val)){
                //Prevent duplicate SKU Record
                $attrCountSKU = ProductAttributes::where('sku',$val)->count();
                if($attrCountSKU>0){
                    return redirect('/admin/add-attributes/'.$id)->with('flash_message_error','SKU is already exist please select another sku');
                }//Prevent duplicate Size Record
                $attrCountSizes = ProductAttributes::where(['product_id'=>$id,'size'=>$data['size']
                [$key]])->count();
                if($attrCountSizes>0){
                return redirect('/admin/add-attributes/'.$id)->with('flash_message_error',''.$data['size'][$key].'Size is already exist please select another size');
                }
                $attribute = new ProductAttributes;
                $attribute->product_id = $id;
                $attribute->sku = $val;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->save();
            
            }
        }
        return redirect('/admin/add-attributes/'.$id)->with('flash_message_success','Products attributes added successfully!');
        // echo"<pre>";print_r($data);die;
    }
    return view('admin.product.add_attributes')->with(compact('productDetails'));

    
}
public function deleteAttribute($id=null){
    ProductAttributes::where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_message_error','Product Attribute is deleted!');

}

public function editAttribute(Request $request,$id=null ){
    if($request->isMethod('post')){
      $data= $request->all();
      foreach($data['attr'] as $key=>$attr){
        ProductAttributes::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
      }
      return redirect()->back()->with('flash_message_success','Products Attributes Updated!!!');
    }
}

public function addImages(Request $request,$id=null){
    $productDetails = Products::where(['id'=>$id])->first();
    if($request->isMethod('post')){
        $data = $request->all();
        if($request->hasfile('image')){
            $files = $request->file('image');
            foreach($files as $file){
                $image = new ProductsImages;
                $extension = $file->getClientOriginalExtension();
                $filename = rand(111,9999).'.'.$extension;
                $image_path = 'uploads/products/'.$filename;
                Image::make($file)->save($image_path);
                $image->image = $filename;
                $image->product_id = $data['product_id'];
                $image->save();
            }
        }
        return redirect('/admin/add-images/'.$id)->with('flash_message_success','Image has been updated');
    }
    $productImages = ProductsImages::where(['product_id'=>$id])->get();
    return view('admin.product.add_images')->with(compact('productDetails','productImages'));
}

public function deleteAltImage($id=null){
$productImage =ProductsImages::where(['id'=>$id])->first();
$image_path= 'uploads/products/';
if (file_exists($image_path.$productImage->image))
{
    unlink($image_path.$productImage->image);
}
   ProductsImages::where(['id'=>$id])->delete();
   Alert::success('Deleted','Success Message');
   return redirect()->back()->with('flash_message_success','Products Attributes Updated!!!');
  
}
}
