@extends('layouts.Admin')
@section('title')
applications
  @endsection
 
@section('contents')

<!-- *************************************** -->
<div class="modal" id="udet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-header" style="background:#d11409;color: white;border:none; ">
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">No.of Winners</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('udet').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">

          <input type="number" class="form-control" name="wnum" id="wnum">



      </div>
      <div class="modal-footer" style="border:none;">
        
        <button type="button" class="btn" id="ab1" onclick="SaveSub()" style="background-color: #d11409;color: white;">Submit</button>
         <button type="button"  class="btn" id="ab2" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- *************************************** -->
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
<!--               <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contacts</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">


            @foreach($luck_res as $a)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <!-- <div class="card-header text-muted border-bottom-0">
                  Digital Strategist
                </div> -->
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{$a->GetUser->full_name}}</b></h2><br>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fa fa-user"></i></span>  {{$a->GetUser->code.$a->GetUser->ca_id}}</li><br>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{$a->GetUser->phone_number}}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <i class="fa fa-gift" style="font-size: 60px;color:#d11409 ;"></i>
                    </div>
                  </div>
                </div>
                <!-- <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div> -->
              </div>
            </div>
            @endforeach
            
             
           
        
          
          </div>
          <div class="text-center mt-5 mb-3">
                <!-- <a onclick="View()" class="btn yellowbtn" ><i class="fa fa-refresh" style="color:white !important;"></i>  Refresh </a> -->
                <a onclick="Save()" class="btn yellowbtn" ><i class="fa fa-refresh" style="color:white !important;"></i>  Submit </a>
                <a onclick="window.location.href='/lucky-submitted-applications/{{encrypt($campid)}}'" class="btn yellowbtn" ><i class="fa fa-refresh" style="color:white !important;"></i>  Cancel </a>
                 <!-- <a href="/lucky-draw-result" class="btn yellowbtn" >  Save  </a> -->
              </div>

        </div>

        <!-- /.card-body -->
       
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

 function Save()
    {
    
  
 swal({
  title: "Do you want to approve these applications ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body='{{$lim}}';


$.ajax({

              type:"POST",
              url:'/approve-apps',
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
                              title: "Applications approved successfully.",
                              //text: "Username and Password send to your Email",
                              icon: "success",
                              buttons: "Ok",
                               closeOnClickOutside: false
  
                            })

                      .then((willDelete) => {
                       if (willDelete) {
                             window.location.href='/lucky-draw-campaigns';
                                  } 

                            });

                     
                    }
                  
                
            }
       })

 } 
  
});

} 

    function View()
{

var modal2 = document.getElementById("udet");

modal2.style.display = "block";

}

    function SaveSub()
{
  var wnum=$('input#wnum').val();
  if(wnum=='')
  {
    $('#wnum').focus();
        $('#wnum').css({'border':'1px solid red'});
        return false;
  }
  else
      $('#wnum').css({'border':'1px solid #CCC'});

    window.location.href='/lucky-draw-result/' + '{{encrypt($campid)}}' + '/' + wnum;

}
</script>



@endsection