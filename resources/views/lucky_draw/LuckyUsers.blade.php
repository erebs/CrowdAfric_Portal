
@extends('layouts.Admin1')

@section('title')
{{$cmp->title}}
  @endsection

 
@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lucky Users</h1>
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
                <table id="exm1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Lucky Draw</th>
                    <th>Name</th>
                    <th>CA Id</th>
                    <th>Mobile</th>
                    <th>Approved At</th>
                    <!-- <th>Action</th>                    -->
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($luck_res as $u )
                    @php
                    $dt1 = date("d-m-Y", strtotime($u->created_at));
                    @endphp
                    
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->GetLucky->title}}</td>
                     <td>{{$u->GetUser->full_name}}</td>
                     <td>{{$u->GetUser->code.$u->GetUser->ca_id}}</td>
                     <td>{{$u->GetUser->phone_number}}</td>
                     <td>{{$dt1}}</td>
                     
                     
                    <!-- <td><a href="/approved-luckyappdetails/{{encrypt($u->application_id)}}" target="_blank" style="cursor: pointer;background-color: #dd778c;border:none;" class="btn btn-danger btn-sm"><b> View</b></a></td> -->
                   
  
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


  function Reject(val)
    {
    
  
 swal({
  title: "Do you want to reject this application ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/activate-campcat',
              data: {
        _token: @json(csrf_token()),
        body: body
       
        },
               
              dataType:"json",
              success:function(data)
                {
                  //$('.loader').hide();
                  //$('.overlay').hide();

                  if(data['success'])
                    {
                       swal({
                              title: "Category activated successfully.",
                             // text: "This member moved and Password send to your Email",
                              icon: "success",
                              buttons: "Ok",
                               closeOnClickOutside: false
  
                            })

                      .then((willDelete) => {
                       if (willDelete) {
                             window.location.href=window.location.href;
                                  } 

                            });

                     
                    }
                  
                
            }
       })

 } 
  
});

} 


function Block(val)
    {
    
  
 swal({
  title: "Do you want to block this category ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/block-campcat',
              data: {
        _token: @json(csrf_token()),
        body: body
       
        },
               
              dataType:"json",
              success:function(data)
                {
                  //$('.loader').hide();
                  //$('.overlay').hide();

                  if(data['success'])
                    {
                       swal({
                              title: "Category blocked successfully.",
                              //text: "Username and Password send to your Email",
                              icon: "success",
                              buttons: "Ok",
                               closeOnClickOutside: false
  
                            })

                      .then((willDelete) => {
                       if (willDelete) {
                             window.location.href=window.location.href;
                                  } 

                            });

                     
                    }
                  
                
            }
       })

 } 
  
});

} 



</script>


@endsection

