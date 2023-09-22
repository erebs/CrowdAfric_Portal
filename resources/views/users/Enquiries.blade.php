
@extends('layouts.Admin')
@section('title')
 EnquiriesEnquiries
  @endsection
 
@section('contents')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Enquiries</h1>
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
                    <th>User</th>
                    <th>CA Id</th>
                    <th>Phone Number</th>
                    <th>Mail Id</th>
                    <th>Subject</th>
                    <th>Message</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($contact as $a)
                  
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$a->GetUser->full_name}}</td>
                    <td>{{$a->GetUser->code.$a->GetUser->ca_id}}</td>
                    <td>{{$a->GetUser->phone_number}}</td>
                    <td>{{$a->GetUser->email_id}}</td>
                    <td>{{$a->subject}}</td>
                    <td>{{$a->msg}}</td>
                     
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

