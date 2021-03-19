<?php

namespace App\Http\Controllers;
use App\Category;
use RealRashid\SweetAlert\Facades\Alert;
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

    $categories = Category::get();
    return view('admin.category.view_category',['category'=> $categories]);
}

public function editCategory(Request $request,$id=null ){

    if($request->isMethod('post')){
        $data = $request->all();
        Category::where(['id'=>$id])->update(['name'=>$data['category_name'],
        'parent_id'=>$data['parent_id'],'description'=>$data['category_description']
        ,'url'=>$data['category_url']]);
        return redirect('/admin/view-categories')->with('flash_message_success','Category Updated Successfully!!!');
    }
    $levels = Category::where(['parent_id'=>0])->get();
    $categoryDetails = Category::where(['id'=>$id])->first();
    // dd($categoryDetails);
    return view('admin.category.edit_category')->with(compact('levels','categoryDetails'));
}
public function deleteCategory($id=null){
    Category::where(['id'=>$id])->delete();
    Alert::Success('Deleted','Category Deleted Successfully !');
    return redirect()->back();
}
public function updateStatus(Request $request,$id=null){
    $data = $request->all();
    Category::where('id',$data['id'])->update(['status'=>$data['status']]);

}
}
