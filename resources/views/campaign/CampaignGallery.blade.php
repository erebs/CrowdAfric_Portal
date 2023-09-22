@extends('layouts.Admin')
@section('title')
campaign-gallery
  @endsection
 
@section('contents')
<style type="text/css">
 


  .box{
    width: 1200px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    grid-gap: 15px;
    margin: 0 auto;
  }
  .cardd{
    position: relative;
    width: 300px;
    height: 350px;
    background: #fff;
    margin: 0 auto;
    border-radius: 4px;
    box-shadow:0 2px 10px rgba(0,0,0,.2);
  }
  .cardd:before,
  .cardd:after
  {
    content:"";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 4px;
    background: #fff;
    transition: 0.5s;
    z-index:-1;
  }
  .cardd:hover:before{
  transform: rotate(20deg);
  box-shadow: 0 2px 20px rgba(0,0,0,.2);
  }
  .cardd:hover:after{
  transform: rotate(10deg);
  box-shadow: 0 2px 20px rgba(0,0,0,.2);
  }
  .cardd .imgBx{
  position: absolute;
  top: 10px;
  left: 10px;
  bottom: 10px;
  right: 10px;
  background: #222;
  transition: 0.5s;
  z-index: 1;
  }
  
  .cardd:hover .imgBx
  {
    bottom: 80px;
  }

  .cardd .imgBx img{
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
  }

  .cardd .details{
      position: absolute;
      left: 10px;
      right: 10px;
      bottom: 10px;
      height: 60px;
      text-align: center;
  }

  .cardd .details h2{
   margin: 0;
   padding: 0;
   font-weight: 600;
   font-size: 20px;
   color: #777;
   text-transform: uppercase;
  } 

  .cardd .details h2 span{
  font-weight: 500;
  font-size: 16px;
  color: #f38695;
  display: block;
  margin-top: 5px;
   } 

</style>
 <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery</h1>
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
            <h3 class="card-title">Details </h3>

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
                 <p class="lead"> Campaign Details </p>
                 
                <table class="table">
                      
                        <th style="width:50%">Campaign  :  {{$camdet->title}}</th>
                        <tr>
                        <td style="width:50%">Total No.Of Images  :  {{count($gallery)}}</td>
                      </tr>
                      
                    </table>
              </div>

              <div class="col-md-6">
                  <p class="lead"> Upload Images </p>
                <form class="edit-content" id="reject" action="/camp-imageadd" enctype="multipart/form-data" method="POST">

                @csrf
                  <input type="file" class="form-control" name="pdf_file" name="pdf_file[]" id="pdf_file[]" multiple style=" background: #ececec;color: black;">

                  
                  <input type="hidden" name="bid1" id="bid1" value="{{$campid}}"><br>
                          <button type="submit" class="btn yellowbtn" id="ab3">Submit</button>
                  </form>        
                       
              </div>
              
            </div>
            <!-- /.row -->
          </div>

        </div>
 
  <div class="box">
      
    @foreach($gallery as $g) 

       <div class="cardd">
         <div class="imgBx">
            <img src="{{asset($g->file)}}" alt="images">
         </div>
         <div class="details">
            <h2><span style="cursor:pointer;" onclick="Delete('{{$g->id}}')">Delete</span></h2>
          </div>
       </div>
@endforeach
       
 
  </div>
















          
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">

function Delete(val)
    {
    
  
 swal({
  title: "Do you want to delete this file ?",
  //text: "Ensure that this student has a valid reason for a this action .",
  icon: "warning",
  buttons: ["No", "Yes"],
})

.then((willDelete) => {
  if (willDelete) {

  var body=val;




$.ajax({

              type:"POST",
              url:'/delete-campgal',
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
                      
                             window.location.reload();
                               
                    }
                  
                
            }
       })

 } 
  
});

} 

    
  function Abc()
  {
                  var name = document.getElementById("pdf_file").files[0].name;
  //alert(name)
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  //if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','pdf']) == -1)
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)

  {
   alert("Invalid File.");
   $('input#pdf_file').val("");
   return false;
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("pdf_file").files[0]);
  var f = document.getElementById("pdf_file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 6000000)
  {
   alert("File Size is very big");
   $('input#pdf_file').val("");
   return false;
  }

  
}

  </script>

  @endsection