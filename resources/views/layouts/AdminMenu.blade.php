<!-- Main Sidebar Container -->
<style type="text/css">
  .nav-link.active{
        background-color: #d11409 !important;
  }
  .nav-link:hover{
        background-color: #d11409 !important;
  }
</style>
<aside class="main-sidebar sidebar-dark-primary">
  <!-- Brand Logo -->
<center>
  <span class="logo-icon font-weight-light mr-2">
    
    <img src="{{ asset('admin/img/logo/logo.png')}}" alt="AdminLTE Logo" style="width: 50%;">
    
  </span>
</center>
<!-- <a href="/admin-dashboard" class="brand-link text-center">
  
      <span class="logo-icon font-weight-light mr-2"><img src="{{ asset('admin/img/logo/logo2.png')}}" style="width: 100px;"> </span>
      <span class="brand-text font-weight-light"><img src="{{ asset('admin/img/logo/giro-kab-logo-text.svg')}}" style="width: 130px;" > </span> -->
    <!-- </a> -->

    
  <!-- Sidebar -->

   
  
  <div class="sidebar" style="overflow-y: hidden;">

     <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex active">
        <div class="image">
          <img src="{{ asset('admin/img/'.Auth::guard('admin')->user()->profile_image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/admin-profile" class="d-block" style="color:white;">{{ Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>  -->
    
 <!-- 
     <div class="form-inline" style="background-color:#6100ff;">
        <div class="input-group" data-widget="sidebar-search" style="background-color:#6100ff;">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

    <!-- Sidebar Menu -->
 

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <li class="nav-item" >
              @if($header=='Dashboard')
              <a href="/admin-dashboard" class="nav-link active" style="color: white;">
              @else
              <a href="/admin-dashboard" class="nav-link" style="color: white;">
              @endif  
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                  
                </p>
              </a>
            </li>


            <li class="nav-item">
                @if($header=='Users')
          <a href="#" class="nav-link active" style="color: white;">
            @else
            <a href="#" class="nav-link" style="color: white;">
            @endif 
            <i class="nav-icon fa fa-users"></i>
            <p>
              Users

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/users" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Active</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="/blocked-users" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Blocked</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

            <li class="nav-item">
                @if($header=='Applications')
          <a href="#" class="nav-link active" style="color: white;">
            @else
            <a href="#" class="nav-link" style="color: white;">
            @endif 
            <i class="nav-icon fa fa-tasks"></i>
            <p>
              Applications

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pending-campaigns-applications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Approval Pending</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="/approved-campaigns-applications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Approved</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

            <li class="nav-item">
              <a href="/special-campaigns-applications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Special</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

             <li class="nav-item">
              <a href="/completed-campaigns-applications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Completed</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

             <li class="nav-item">
              <a href="/rejected-campaigns-applications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Rejected</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

             <li class="nav-item">
              <a href="/cancelled-campaigns-applications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Cancelled</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

           <li class="nav-item">
                @if($header=='Repayments')
          <a href="#" class="nav-link active" style="color: white;">
            @else
            <a href="#" class="nav-link" style="color: white;">
            @endif 
            <i class="nav-icon fa fa-credit-card"></i>
            <p>
              Repayments

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/repayment-pending" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Pending</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="/repayment-approval-pending" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Approval Pending</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>

            <li class="nav-item">
              <a href="/expired-repayments" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Due Date Expired</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

        <li class="nav-item" >
              @if($header=='Draw')
              <a href="/lucky-draw-campaigns" class="nav-link active" style="color: white;">
              @else
              <a href="/lucky-draw-campaigns" class="nav-link" style="color: white;">
              @endif  
                <i class="nav-icon fa fa-gift"></i>
                <p>
                  Lucky draw
                  
                </p>
              </a>
            </li>

            <li class="nav-item">
                @if($header=='Campaign')
          <a href="#" class="nav-link active" style="color: white;">
            @else
            <a href="#" class="nav-link" style="color: white;">
            @endif 
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>
              Campaign

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/campaign-categories" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Categories</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="/campaign" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Campaign</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

         <li class="nav-item">
      @if($header=='Addon')
          <a href="#" class="nav-link active" style="color: white;">

            @else

<a href="#" class="nav-link" style="color: white;">
            @endif
            <i class="nav-icon fa fa-plus"></i>
            <p>
              Add On

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(Auth::guard('admin')->user()->is_superadmin==1)
            <li class="nav-item">
              <a href="/admins" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Admins</p>  

              </a>

            </li>
            @endif
            <li class="nav-item">
              <a href="/countries" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Countries</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="/states" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>States</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

        <li class="nav-item">
                @if($header=='Noti')
          <a href="#" class="nav-link active" style="color: white;">
            @else
            <a href="#" class="nav-link" style="color: white;">
            @endif 
            <i class="nav-icon fa fa-bell"></i>
            <p>
              Notifications

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/notifications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Active</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="/completed-notifications" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Completed</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

        <li class="nav-item" >
              @if($header=='Enquiries')
              <a href="/enquiries" class="nav-link active" style="color: white;">
              @else
              <a href="/enquiries" class="nav-link" style="color: white;">
              @endif  
                <i class="nav-icon fa fa-envelope"></i>
                <p>
                  Enquiries
                  
                </p>
              </a>
            </li>




    <li class="nav-item">
      @if($header=='Settings')
          <a href="#" class="nav-link active" style="color: white;">

            @else

<a href="#" class="nav-link" style="color: white;">
            @endif
            <i class="nav-icon fa fa-cog"></i>
            <p>
              Settings

              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/change-password" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p> Change Password</p>  

              </a>

            </li>
            <li class="nav-item">
              <a href="{{ route('admin.logout')}}" class="nav-link" style="color: white;">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
                <span class="badge badge-info right" style="background-color: green;"></span>
              </a>

            </li>
            
          </ul>
        </li>

        <br><br>


       
        
      </ul>
    </nav>
    <br><br> <br>    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>