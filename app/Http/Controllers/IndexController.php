<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners;
use App\Category;
use App\Products;
class IndexController extends Controller
{
    function index(){
        $banners = Banners::where('status','1')->orderby('sort_order','asc')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->where('status','1')->get(); 
        $products = Products::where('status','1')->paginate(6);
        return view('Ebharatbazar/index')->with(compact('banners','categories','products'));

    }
    public  function categories($category_id){
        $categories = Category::with('categories')->where(['parent_id'=>0])->where('status','1')->get(); 
        $products = Products::where('status','1')->where(['category_id'=>$category_id])->get();
        $product_name = Category::where('status','1')->where(['id'=>$category_id])->first();
        return view('Ebharatbazar.category')->with(compact('categories','products','product_name'));

    }
    public function about(){
        return view('Ebharatbazar.aboutus');
    }
}
