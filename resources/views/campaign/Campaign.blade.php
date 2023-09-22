
@extends('layouts.Admin')
@section('title')
campaign
  @endsection
 
@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Campaigns</h1>
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
                
                  <button type="button" class="btn yellowbtn" value="Submit" onclick="window.location.href='/add-campaign'" id="renewbt1" style="float: right;">  Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Icon</th>
                    <!-- <th>Description</th> -->
                   <!--  <th>Content 1</th>
                    <th>Content 2</th> -->
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                    <th>Gallery</th>
                    
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($camp as $u )

                    @php
                    $dt1 = date("d-m-Y", strtotime($u->created_at));
                    @endphp
                    
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->title}}</td>
                     <td>{{$u->GetCat->title}}</td>

                   <td><a href="{{asset($u->photo)}}" target="_blank"><i class="fa fa-image" aria-hidden="true" style="color:black !important;font-size: 25px;"></i></a></td>
                    <td><a href="{{asset($u->icon)}}" target="_blank"><i class="fa fa-image" aria-hidden="true" style="color:black !important;font-size: 25px;"></i></a></td>

                   <!-- <td>{!! $u->description !!}</td> -->
                  <!--  <td>{!! $u->content1 !!}</td>
                   <td>{!! $u->content2 !!}</td> -->
                    <td>
                      <select class="form-control" onchange="ChangeStatus(this.value,'{{$u->id}}')">
                        <option value="Active" @if($u->status=='Active') selected @endif>Active</option>
                        <!-- <option value="Pending">Pending</option> -->
                        <option value="Completed" @if($u->status=='Completed') selected @endif>Completed</option>

                      </select>

                    </td>
                   <td>{{$dt1}}</td>
              
                  <td>
                     
                    <a href="/edit-campaign/{{encrypt($u->id)}}" target="_blank" style="cursor: pointer;background-color: #28e653;border:none;" class="btn btn-danger btn-sm"><b>View/Edit</b></a>
                   
                    </td>
  
              
                  <td>
                     
                    <a href="/campaign-gallery/{{encrypt($u->id)}}" target="_blank" style="cursor: pointer;background-color: #dd778c;border:none;" class="btn btn-danger btn-sm"><b> View</b></a>
                   
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

