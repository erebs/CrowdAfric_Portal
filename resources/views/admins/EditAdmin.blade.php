@extends('layouts.Admin')
@section('title')
 add-admin
  @endsection 
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right custom-breadcrumb">
              <li class="breadcrumb-item"><a href="/admins"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
      <form>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                
                 <div class="form-group">
                  <label>Name *</label>
                  <input type="text" name="title" id="name" class="form-control" value="{{$adm->name}}">
                </div>
                <div class="form-group">
                  <label>Mobile No. *</label>
                  <input type="text" name="title" id="mobile" class="form-control" value="{{$adm->mobile}}">
                </div>
                <div class="form-group">
                  <label>Mail Id *</label>
                  <input type="text" name="title" id="mail" class="form-control" value="{{$adm->mail_id}}">
                </div>
                <div class="form-group">
                  <label>Username. *</label>
                  <input type="text" name="title" id="uname" class="form-control" value="{{$adm->username}}">
                </div>

                <div class="form-group">
                  <label>Status. *</label>
                  <select class="form-control" id="st">
                    <option value="Active" @if($adm->status=='Active') selected @endif>Approve</option>
                    <option value="Blocked" @if($adm->status=='Blocked') selected @endif>Block</option>
                  </select>
                </div>
                 
              </div>


              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                  <label>Description </label>
                  <textarea class="form-control ckeditor" rows="5" cols="5" id="desc">{{$adm->description}}</textarea>
                </div>
                
                
              </div>

            </div>
              <center>
                
                  
                  <button type="button" class="btn yellowbtn" onclick="AddAdmin()" id="submitButton">Submit</button>
                  <button type="button" class="btn yellowbtn" id="submitButton1"> <i class="fa fa-spinner fa-spin"></i>   Submit</button>
              
                </center>
          </div>
        </div>
    </section>





  














    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>


function AddAdmin()
{
      
      
    var name=$('input#name').val();
    if(name=='')
    {
        $('#name').focus();
        $('#name').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#name').css({'border':'1px solid #CCC'});

    var mobile=$('input#mobile').val();
    if(mobile=='')
    {
        $('#mobile').focus();
        $('#mobile').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#mobile').css({'border':'1px solid #CCC'});

    var mail=$('input#mail').val();
    if(mail=='')
    {
        $('#mail').focus();
        $('#mail').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#mail').css({'border':'1px solid #CCC'});

    var uname=$('input#uname').val();
    if(uname=='')
    {
        $('#uname').focus();
        $('#uname').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#uname').css({'border':'1px solid #CCC'});

    var st=$('#st option:selected').val();
    if(st=='')
    {
        $('#st').focus();
        $('#st').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#st').css({'border':'1px solid #CCC'});

    var desc=CKEDITOR.instances.desc.getData();
    if(desc=='')
    {

        alert('Pleade add description');
        return false;
    }
    else
  
    $('#desc').css({'border':'1px solid #CCC'});




    $('#submitButton').hide();
      $('#submitButton1').show();
    
          data = new FormData();

data.append('name', name);
data.append('mobile', mobile);
data.append('mail', mail);
data.append('uname', uname);
data.append('desc', desc);
data.append('st', st);
data.append('aid', '{{$adm->id}}');

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/admin-edit",
data:data,
dataType:"json",
contentType: false,
//cache: false,
processData: false,

success:function(data)
{
  if(data['success'])
  {
     $('#submitButton1').hide();
    $('#submitButton').show();
    swal({
                                  title: "Admin updated successfully",
                                  closeOnClickOutside: false,
                                  icon: "success",
                                  buttons: "Ok",
      
                                })
    
                          .then((willDelete) => {
                           if (willDelete) {
                                 window.location.href='/admins';
                                      } 
    
                                });
                            
  }

    if(data['err'])
  {
     $('#submitButton1').hide();
    $('#submitButton').show();
    swal({
                                  title: "Username already exists",
                                  closeOnClickOutside: false,
                                  icon: "error",
                                  buttons: "Ok",
      
                                })
    
                          
                            
  }

 

}




})



}





function Chkformat()
{
                  var name = document.getElementById("pdf_file").files[0].name;
  //alert(name)
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  //if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','pdf']) == -1)
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)

  {
   swal({
            title: "Invalid file format !",
            text: "Upload JPG/JPEG/PNG file",
            icon: "warning",
            buttons: "Ok",
            });
   $('input#pdf_file').val("");
   return false;
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("pdf_file").files[0]);
  var f = document.getElementById("pdf_file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 300000)
  {
   swal({
            title: "File size is very big !",
            text: "maximum file size is 300kb.",
            icon: "warning",
            buttons: "Ok",
            });
   $('input#pdf_file').val("");
   return false;
  }

  
                }



function Chkformat1()
{
                  var name = document.getElementById("pdf_file1").files[0].name;
  //alert(name)
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  //if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','pdf']) == -1)
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)

  {
   swal({
            title: "Invalid file format !",
            text: "Upload JPG/JPEG/PNG file",
            icon: "warning",
            buttons: "Ok",
            });
   $('input#pdf_file1').val("");
   return false;
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("pdf_file1").files[0]);
  var f = document.getElementById("pdf_file1").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 300000)
  {
   swal({
            title: "File size is very big !",
            text: "maximum file size is 300kb.",
            icon: "warning",
            buttons: "Ok",
            });
   $('input#pdf_file1').val("");
   return false;
  }

  
                }               

    

    
</script>
@endsection

