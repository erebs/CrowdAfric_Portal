
@extends('layouts.Admin')
@section('title')
campaign-categories
  @endsection
 
@section('contents')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Campaign Categories</h1>
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
                
                  <button type="button" class="btn yellowbtn" value="Submit" onclick="window.location.href='/add-campcategory'" id="renewbt1" style="float: right;">  Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Icon</th>
                    <!-- <th>Description</th> -->
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                    
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($cat as $u )

                    @php
                    $dt1 = date("d-m-Y", strtotime($u->created_at));
                    @endphp
                    
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$u->title}}</td>

                   <td><a href="{{asset($u->photo)}}" target="_blank"><img src="{{asset($u->photo)}}" style="width: 55px;border-radius: 5px;"></a></td>
                    <td><a href="{{asset($u->icon)}}" target="_blank"><img src="{{asset($u->icon)}}" style="width: 55px;border-radius: 5px;"></a></td>

                   <!-- <td>{!! $u->description !!}</td> -->
                    <td>{{$u->status}}</td>
                   <td>{{$dt1}}</td>
              
                  <td>
                     
                    <a href="/edit-campcategory/{{encrypt($u->id)}}" style="cursor: pointer;background-color: #28e653;border:none;" class="btn btn-danger btn-sm"><b> View/Edit</b></a>
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

