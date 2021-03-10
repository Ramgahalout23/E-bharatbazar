<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function addProduct(Request $req){

        return view('admin.product.add_product');

    }
}
