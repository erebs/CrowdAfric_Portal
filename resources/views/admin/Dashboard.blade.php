@extends('layouts.Admin')
@section('title')
dashboard
  @endsection
 
@section('contents')
<style type="text/css">

</style>

@php

$usr=DB::table('users')->count();
$acmp=DB::table('campaigns')->where('status','Active')->count();
$ccmp=DB::table('campaigns')->where('status','Completed')->count();
$nnoti=DB::table('notifications')->where('status','Active')->count();

@endphp
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            
             
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        

        <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$usr}}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$acmp}}</h3>

                <p>Active Campaigns</p>
              </div>
              <div class="icon">
                <i class="fas fa-bullhorn"></i>
              </div>
              <a href="/campaign" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- <div class="col-md-4 col-xl-3">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 style="color:white;"></h3>

                <p style="color:white;">Frauds</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-secret"></i>
              </div>
              <a href="/frauds" class="small-box-footer" style="color:white !important;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> -->

        <div class="col-md-4 col-xl-3">
            <div class="small-box" style="background-color:#c4789b;">
              <div class="inner">
                <h3 style="color:white;">{{$ccmp}}</h3>

                <p style="color:white;">Completed Campaigns</p>
              </div>
              <div class="icon">
                <i class="fas fa-bullhorn"></i>
              </div>
              <a href="/campaign" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="small-box" style="background-color:#1ea683;">
              <div class="inner">
                <h3 style="color:white;">{{$nnoti}}</h3>

                <p style="color:white;">Active Notifications</p>
              </div>
              <div class="icon">
                <i class="fa fa-bell"></i>
              </div>
              <a href="/notifications" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
       
      
       </div>
      
      <br><div class="row">
          <div class="col-md-12">

 <h3>Latest Applications</h3>

             <div class="card">
              <div class="card-header border-transparent">
                <!-- <h3 class="card-title"><br><b>( {{date("d-m-Y", strtotime(date('Y-m-d')))}} )</b></h3> -->
                <div class="card-tools">
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> -->
                  <div class="btn-group" style="float: right;">
                    <button type="button" class="btn" style="float: right;background-color: #d11409;color: white;" onclick="window.location.href='/pending-campaigns-applications'">View all</button>
                    
                  </div>
                </div>

              </div>
            
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                        
                    <tr>
                       <th>Sl.No</th>
                      <th>Name</th>                     
                      <th>Mobile</th>
                      <th>Payment</th>
                      <th>Status</th>
                      <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($application as $ap)
                     
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>  <a style="color: black;font-weight: bold;">{{$ap->GetUser->full_name}}</a></td>
                      <td><span class="" style="padding: 10px 10px;">{{$ap->GetUser->phone_number}}</span></td>
                      <td><span class="" style="padding: 10px 10px;">{{$ap->payment_status}}</span></td>
                       <td><span class="" style="padding: 10px 10px;">{{$ap->status}}</span></td>


                      <td><a href="/pending-appdetails/{{encrypt($ap->id)}}" target="_blank" style="cursor: pointer;background-color: #dd778c;border:none;" class="btn btn-danger btn-sm"><b> View</b></a></td>
                    </tr>

                    @endforeach 
                 
                    
                    </tbody>

                  </table>
                </div>
              </div>
              <!-- <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Completed Rides</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Cancelled Rides</a>
              </div> -->
            </div>
<!-- Today's Ride Bookings -->

<!-- Today's Service Bookings -->             
             
            
          </div>

<!-- Today's Service Bookings -->  

<!-- Ads -->  

          <div class="col-md-4">







          </div>


         </div>


    





    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
   @endsection