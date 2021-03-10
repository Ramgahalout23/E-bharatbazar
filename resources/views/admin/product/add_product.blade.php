@extends('admin.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <div class="header-icon">
              <i class="fa fa-product-hunt"></i>
           </div>
           <div class="header-title">
              <h1>Add Product</h1>
              <small>Add Products</small>
           </div>
        </section>
        <!-- Main content -->
        <section class="content">
           <div class="row">
              <!-- Form controls -->
              <div class="col-sm-12">
                 <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                       <div class="btn-group" id="buttonlist">
                          <a class="btn btn-add " href="clist.html">
                          <i class="fa fa-list"></i>  Add Products </a>
                       </div>
                    </div>
                    <div class="panel-body">
                       <form class="col-sm-6">
                          <div class="form-group">
                             <label>Product Name</label>
                             <input type="text" class="form-control" placeholder="Enter Product Name"  name="product_name" id="product_name"required>
                          </div>
                          <div class="form-group">
                             <label>Product Code</label>
                             <input type="text" class="form-control" placeholder="Enter Product Code" name="product_code" id="product_code"required>
                          </div>
                          <div class="form-group">
                             <label>Product Color</label>
                             <input type="text" class="form-control" placeholder="Enter Product Color" name="product_color" id="product_colour"required>
                          </div>
                          <div class="form-group">
                            <label>Product Prize</label>
                            <input type="text" class="form-control" placeholder="EnterProduct Prize"name="product_prize" id="product_prize" required>
                         </div>
                          <div class="form-group">
                             <label>Product Description</label>
                           <textarea name="product_description" id="product_description" class="form-control"></textarea>
                          </div>

                          <div class="form-group">
                            <label>Picture upload</label>
                            <input type="file" name="picture">
                            <input type="hidden" name="old_picture">
                         </div>
                          <div class="reset-button">
                             <a href="#" class="btn btn-success">Save</a>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>
           </div>
        </section>
        <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->
@endsection
