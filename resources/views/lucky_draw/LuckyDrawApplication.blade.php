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
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">Add Lucky Draw</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('udet').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">

          <div class="form-group">
    
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title">
          </div>

          <div class="form-group">
        <input type="number" name="winner" id="winner" class="form-control" placeholder="No.of winners:">
          </div>

          <div class="form-group">
        <select name="cn" id="cn" class="form-control" onchange="SelectState(this.value)">
          <option value="">Choose country</option>
           @foreach($con as $c)
           <option value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach
        </select>
          </div>

          <div class="form-group">
        <select name="st" id="st" class="form-control">
          <option value="">Choose state</option>
          
        </select>
          </div>




      </div>
      <div class="modal-footer" style="border:none;">
        
        <button type="button" class="btn" id="ab1" onclick="SaveDraw()" style="background-color: #d11409;color: white;">Submit</button>
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
            <h1>Applications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Detail</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- <div class="card-header">
          <h3 class="card-title">Driver Approval</h3>

          
        </div> -->
        <div class="card-body">
          <div class="row">
            <div class="col-8 col-md-8 col-lg-8 order-2 order-md-1">
              
              <div class="row">
                <div class="col-11"><br>
                  <h4>{{$camp->title}}</h4><br>
                    
                  <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <!-- <th>Created At</th> -->
                     <th>Payment</th>
                    <th>Status</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($application as $v )
                     @php
                    $dt1 = date("d-m-Y", strtotime($v->created_at));
                    @endphp
                   
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$v->GetUser->full_name}}</td>
                    <td>{{$v->GetUser->phone_number}}</td>
                    <!-- <td>{{$dt1}}</td> -->
                     <td>{{$v->payment_status}}</td>
                    <td>{{$v->status}}</td>
                    <td><a href="/pending-appdetails/{{encrypt($v->id)}}" target="_blank" style="cursor: pointer;background-color: #dd778c;border:none;" class="btn btn-danger btn-sm"><b> View</b></a></td>
              
                
                     
                      
                  </tr>

                  @endforeach
               
    
                  </tbody>
                 
                </table>

                    

                </div>
              </div>
            </div>
            <div class="col-10 col-md-10 col-lg-4 order-1 order-md-2">
                <div class="card card-info">
                    <!-- <div class="card-block flex-column">
                        <img src="{{ asset('admin/img/logo/login.png')}}" style="width: 150px;">
                    </div> -->
                    <div class="card-body card-block-a">
                        <h5 class="text-muted">Lucky Draw</h5>
                      <select class="form-control" onchange="SelectDet(this.value)" name="litem" id="litem">
                          <option value="">Choose</option>
                          @foreach($lk as $l)
                          <option value="{{$l->id}}">{{$l->title}}</option>
                       @endforeach
                          
                        </select>

                        <br><div id="ldet">


                        </div>



                        <a style="float: right;color: blue;font-size: 13px;cursor: pointer;" onclick="AddLuckyDraw()"><u>Add new</u></a>
              <div class="text-center mt-5 mb-3">
                <a onclick="SaveSub()" class="btn yellowbtn" ><i class="fa fa-gift" style="color:white !important;"></i>  Lucky Draw  <i class="fa fa-chevron-right" style="color:white !important;"></i></a>
                <!-- <a href="#" class="btn btn-sm btn-warning">Report contact</a> -->
              </div>
              
                    </div>
                </div>
              
              
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<script>
    function AddLuckyDraw()
{

var modal2 = document.getElementById("udet");

modal2.style.display = "block";

}


function SaveDraw()
    {
    
      var title=$('input#title').val();
    
      if(title=='')
      {
        $('#title').css('border','1px solid red');
        
        return false;
      }
      else
        $('#title').css('border','1px solid #CCC');

      var winner=$('input#winner').val();
    
      if(winner=='')
      {
        $('#winner').css('border','1px solid red');
        
        return false;
      }
      else
        $('#winner').css('border','1px solid #CCC');

      var cn=$('#cn option:selected').val();
    
      // if(cn=='')
      // {
      //   $('#cn').css('border','1px solid red');
        
      //   return false;
      // }
      // else
      //   $('#cn').css('border','1px solid #CCC');

      var st=$('#st option:selected').val();
    
      // if(st=='')
      // {
      //   $('#st').css('border','1px solid red');
        
      //   return false;
      // }
      // else
      //   $('#st').css('border','1px solid #CCC');


// var conid=$('input#cid').val();
      
     $('#ab3').hide();
      $('#ab4').show();

      data = new FormData();
      data.append('title', title);
      data.append('winner', winner);
      data.append('cn', cn);
      data.append('st', st);
      data.append('cid', '{{$camp->id}}');


  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/draw-add",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab4').hide();
              $('#ab3').show();
             
               swal({
                       title: "Lucky draw successfully",
                       closeOnClickOutside: false,
                       icon: "success",
                      buttons: "Ok",
                    })
    
                     .then((willDelete) => {
                      if (willDelete) {
                       window.location.href=window.location.href;
                               } 
    
                    });
          }

          if(data['err'])
          {
              $('#ab4').hide();
              $('#ab3').show();
             
               swal({
                       title: "Country already exists",
                       closeOnClickOutside: false,
                       icon: "error",
                      buttons: "Ok",
                    })
    
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    } 


    function SelectState(val)

{

    $.post("/get-state", { cid: val,_token: "{{ csrf_token() }}"}, function(result) {

      $('#st').html(result);

    });
  
}

    function SelectDet(val)

{

    $.post("/get-luckydet", { cid: val,_token: "{{ csrf_token() }}"}, function(result) {

      $('#ldet').html(result);

    });
  
}





    function SaveSub()
{
  var litem=$('#litem option:selected').val();
  if(litem=='')
  {
    $('#litem').focus();
        $('#litem').css({'border':'1px solid red'});
        return false;
  }
  else
      $('#litem').css({'border':'1px solid #CCC'});

    window.location.href='/lucky-draw-result/' + '{{encrypt($camp->id)}}' + '/' + litem;

}
</script>


@endsection

