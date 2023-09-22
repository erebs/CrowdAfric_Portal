
@extends('layouts.Admin')
@section('title')
admins
  @endsection
 
@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrators</h1>
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
              <div class="card-header">
                
                  <button type="button" class="btn yellowbtn" value="Submit" onclick="window.location.href='/add-admin'" id="renewbt1" style="float: right;">  Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Mail Id</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>                    
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($adm as $u )

                    @php
                    $dt1 = date("d-m-Y", strtotime($u->created_at));
                    @endphp
                    
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->name}}</td>
                     <td>{{$u->mobile}}</td>
                     <td>{{$u->mail_id}}</td>
                    <td>{!! $u->description !!}</td>
                     <td>{{$u->status}}</td>
                     <td>{{$dt1}}</td>
                  <td>
                     
                    <a href="/edit-admin/{{encrypt($u->id)}}" style="cursor: pointer;background-color: #28e653;border:none;" class="btn btn-danger btn-sm"><b>Edit</b></a>
                   
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


   function ChangeStatus(val,cid)
    {
      $.ajax({

              type:"POST",
              url:'/camp-status',
              data: {
        _token: @json(csrf_token()),
        body: val,
        body1: cid,
       
        },
               
              dataType:"json",
              success:function(data)
                {
                  //$('.loader').hide();
                  //$('.overlay').hide();

                  if(data['success'])
                    {
                       swal({
                              title: "Status changed successfully.",
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

  function Activate(val)
    {
    
  
 swal({
  title: "Do you want to activate this category ?",
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

