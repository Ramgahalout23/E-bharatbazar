         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
               <!-- sidebar menu -->
               <ul class="sidebar-menu">
                  <li class="active">
                     <a href="{{url('/admin/dashboard')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>
                  <li class="treeview">
                    <a href="#">
                    <i class="fa fa-list-alt"></i><span>Categories</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                       <li><a href="{{url('admin/add-category')}}">Add Categories</a></li>
                       <li><a href="{{url('/admin/view-category')}}">View Categories</a></li>
                    </ul>
                 </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa  fa-product-hunt"></i><span>Products</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('admin/add-product')}}">Add Products</a></li>
                        <li><a href="{{url('/admin/view-product')}}">View Products</a></li>
                     </ul>
                  </li>

               </ul>
            </div>
            <!-- /.sidebar -->
         </aside>
