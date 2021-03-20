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
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Products::paginate(3);
        return view('Ebharatbazar/index')->with(compact('banners','categories','products'));

    }
}
