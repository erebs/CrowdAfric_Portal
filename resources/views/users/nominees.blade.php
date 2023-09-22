
@extends('layouts.Admin')
@section('title')
 guarantors
  @endsection
 
@section('contents')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Guarantors</h1>
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

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">User Details </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                 
                 
                <table class="table">
                      
                        <th style="width:50%">Name  :  {{$usr->full_name}}</th>
                        <th style="width:50%">Phone No.  :  {{$usr->phone_number}}</th>
                        
                      
                      
                    </table>
              </div>

              
              
            </div>
            <!-- /.row -->
          </div>

        </div>
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
                    <th>Registered On</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($nominees as $u )
                    @php
                     $dt1 = date("d-m-Y h:i a", strtotime($u->created_at));
                    @endphp
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->name}}</td>
                    <td>{{$u->mobile}}</td>
                    <td>{{$dt1}}</td>
                    <td>{{$u->status}}</td>
                   

                    <td>
                     
                    <!-- <a style="cursor: pointer;background-color: #28e653;border:none;" onclick="Promote('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Edit</b></a> -->
                    @if($u->status=='Active')
                    <a style="cursor: pointer;background-color: red;border:none;" onclick="Block('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Block</b></a>
                    @else
                    <a style="cursor: pointer;background-color: #28e653;border:none;" onclick="Activate('{{$u->id}}')" class="btn btn-danger btn-sm"><b> Activate</b></a>

                    @endif
                   
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

 function Activate(val)
    {
    
  
 swal({
  title: "Do you want to activate this Guarantor ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/activate-nominee',
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
                              title: "Guarantor activated successfully.",
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
  title: "Do you want to block this Guarantor ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/block-nominee',
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
                              title: "Guarantor blocked successfully.",
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

