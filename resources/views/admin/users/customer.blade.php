@extends('admin.layouts.master')
@section('title','Customers')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1>Customers</h1>
          <small>Customers</small>
       </div>
    </section>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_success') }}</strong>
    </div>
    @endif

    <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>
    <!-- Main content -->
    <section class="content">
       <div class="row">
          <div class="col-sm-12">
             <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                   <div class="btn-group" id="buttonexport">
                      <a href="#">
                         <h4>View Customers</h4>
                      </a>
                   </div>
                </div>
                <div class="panel-body">
                   <div class="table-responsive">
                      <table id="table_id" class="table table-bordered table-striped table-hover">
                         <thead>
                            <tr class="info">
                               <th>ID</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                         </thead>
                         <tbody>
                            @foreach($userDetails as $customer)
                            <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>
                              <input type="checkbox" class="CustomerStatus btn btn-success" rel="{{$customer->id}}"
                              data-toggle="toggle" data-on="Active" data-of="Inactive" data-onstyle="success" data-offstyle="danger"
                              @if($customer['status']=="1") checked @endif>
                              <div id="myElem" style="display:none;" class="alert alert-success">Active</div>
                              </td>
                               <td>
                               <a href="#" class="btn btn-add btn-sm" title="View More" data-toggle="modal" data-target="#myModal{{$customer->id}}"><i class="fa fa-eye"></i></a>
                               <a href="{{url('/admin/delete-customer/'.$customer->id)}}" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure');"><i class="fa fa-trash-o"></i> </a>
                               </td>
                            </tr>
                            @endforeach
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- /.content -->
 </div>
 @foreach($userDetails as $customer)
 <div class="modal fade in" id="myModal{{$customer->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
             <h1 class="modal-title">{{$customer->name}}</h1>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable">
                  
                   <tbody>
                     <tr>
                         <td class="taskDesc"> Customer Name</td>
                         <td class="taskStatus"> {{$customer->name}}</td>
                     </tr>
                     <tr>
                        <td class="taskDesc"> Customer Email</td>
                        <td class="taskStatus"> {{$customer->email}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> Customer Address</td>
                        <td class="taskStatus"> {{$customer->address}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> State</td>
                        <td class="taskStatus"> {{$customer->state}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> City</td>
                        <td class="taskStatus"> {{$customer->city}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> Country</td>
                        <td class="taskStatus"> {{$customer->country}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> Pincode</td>
                        <td class="taskStatus"> {{$customer->pincode}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> Mobile</td>
                        <td class="taskStatus"> {{$customer->mobile}}</td>
                    </tr>
                    <tr>
                        <td class="taskDesc"> Status</td>
                        <td class="taskStatus"> 
                            @if($customer->status==0)
                            Inactive
                            @else
                            Active
                            @endif
                        </td>
                    </tr>
                  
                   </tbody>
                </table>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
       </div>
 
    </div>

 </div>
 @endforeach

 <!-- /.content-wrapper -->
@endsection