@extends('layouts.Admin')
@section('title')
 edit-campaign
  @endsection 
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Campaign </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right custom-breadcrumb">
              <li class="breadcrumb-item"><a href="/campaign"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></li>
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
                  <label>Category *</label>
                  
                  <select name="ct" id="ct" class="form-control">
                    <option value="">Choose</option>
                    @foreach($cat as $c)

                    <option value="{{$c->id}}" @if($camp->cat_id==$c->id) selected @endif>{{$c->title}}</option>
                    @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <label>Title *</label>
                  <input type="text" name="title" id="title" class="form-control" value="{{$camp->title}}">
                </div>
                <div class="form-group">
                  <label>Fee (₦) *</label>
                  <input type="text" name="fee" id="fee" class="form-control" value="{{$camp->fee}}">
                </div>

                 <div class="form-group">
                  <label>Description *</label>
                  <textarea class="form-control ckeditor" rows="3" cols="3"  id="desc">{{$camp->description}}</textarea>
                </div>
                <div class="form-group">
                  <label>Content 1</label>
                  <textarea class="form-control ckeditor" rows="3" cols="3"  id="desc1">{{$camp->content1}}</textarea>
                </div>
                 
              </div>


              <!-- /.col -->
              <div class="col-md-6">

               <div class="form-group">
                  <label>Content 2 </label>
                  <textarea class="form-control ckeditor" rows="3" cols="3" id="desc2">{{$camp->content2}}</textarea>
                </div>
                
                <div class="form-group">
                  <label>Image *<br><span style="font-size:10px;">( 600px * 300px )</span></label><br>
                <input type="file" name="pdf_file" id="pdf_file" onchange="Chkformat()" style=" background: #ececec;color: black;padding: 1em;">
                </div>

                <div class="form-group">
                  <label>Icon *<br><span style="font-size:10px;">( 300px * 300px )</span></label><br>
                <input type="file" name="pdf_file1" id="pdf_file1" onchange="Chkformat1()" style=" background: #ececec;color: black;padding: 1em;">
                </div>


                
              </div>

            </div>
              <center>
                
                  
                  <button type="button" class="btn yellowbtn" onclick="AddCat()" id="submitButton">Submit</button>
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


function AddCat()
{
      
     var ct=$('#ct option:selected').val();
    if(ct=='')
    {
        $('#ct').focus();
        $('#ct').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#ct').css({'border':'1px solid #CCC'}); 
    var title=$('input#title').val();
    if(title=='')
    {
        $('#title').focus();
        $('#title').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#title').css({'border':'1px solid #CCC'});

   var fee=$('input#fee').val();
    if(fee=='')
    {
        $('#fee').focus();
        $('#fee').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#fee').css({'border':'1px solid #CCC'});

    var desc=CKEDITOR.instances.desc.getData();
    if(desc=='')
    {

        alert('Pleade add description');
        return false;
    }
    else
  
    $('#desc').css({'border':'1px solid #CCC'});

  var desc1=CKEDITOR.instances.desc1.getData();

  var desc2=CKEDITOR.instances.desc2.getData();




    $('#submitButton').hide();
      $('#submitButton1').show();
    
          data = new FormData();

data.append('ct', ct);
data.append('campid', '{{$camp->id}}');
data.append('title', title);
data.append('fee', fee);
data.append('desc', desc);
data.append('desc1', desc1);
data.append('desc2', desc2);
data.append('img', $('#pdf_file')[0].files[0]);
data.append('img1', $('#pdf_file1')[0].files[0]);

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/camp-edit",
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
                                  title: "Campaign updated successfully",
                                  closeOnClickOutside: false,
                                  icon: "success",
                                  buttons: "Ok",
      
                                })
    
                          .then((willDelete) => {
                           if (willDelete) {
                                 window.location.href='/campaign';
                                      } 
    
                                });
                            
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

