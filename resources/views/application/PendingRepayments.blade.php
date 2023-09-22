
@extends('layouts.Admin')
@section('title')
 repayments
  @endsection
 
@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment pending repayments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="/girokab-admin/customer-area"><i class="fa fa-arrow-left" aria-hidden="true"></i>  back</a></li> -->

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Mail Id</th>
                    <th>Campaign</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($repay as $u )
                    @php
                     $dt1 = date("d-M-Y", strtotime($u->due_date));
                   $apps=DB::table('applications')->select('campaign_id')->where('id',$u->application_id)->first();
                   $camp=DB::table('campaigns')->select('title')->where('id',$apps->campaign_id)->first();
                    @endphp
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->GetUser->full_name}}</td>
                    <td>{{$u->GetUser->phone_number}}</td>
                    <td>{{$u->GetUser->email_id}}</td>
                    <td>{{$camp->title}}</td>
                    <td>Amount : ₦ {{$u->amount}}<br>
                        Fine : ₦ {{$u->fine}}
                    </td>
                    <td>{{$dt1}}</td>
                    
                   <td>
                          <a href="/approved-appdetails/{{encrypt($u->application_id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a>


                    </td>

                
                 
                      
                  </tr>

                  @endforeach
               
    
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  




<!-- Page specific script -->

<script>


 

</script>


@endsection

