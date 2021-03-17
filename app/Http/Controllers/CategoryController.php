<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public  function addCategory (Request $request){

        if($request->isMethod('post')){
            $data=$request->all();
            // echo "<pre>";print_r($data);die;
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->url = $data['category_url'];
            $category->description = $data['category_description'];
            $category->save();
            return redirect('admin/view-categories')->with('flash_message_success','Product has been added !');
        }
        $levels = Category::where(['parent_id'=>0])->get();
                // echo "<pre>";print_r($levels);die;

       return view('admin.category.add_Category')->with(compact('levels'));
}
public function viewCategory(){
    return "hello";
}
}
