@extends('layouts.Admin')
@section('title')
applications
  @endsection
 
@section('contents')

<style type="text/css">
  .nav-pills .nav-link.active,

.nav-pills .show > .nav-link {
  color: #fff;
  background-color: #f39c12;
}
.nav-link:hover{
    color: white !important;
  }

</style>

<!-- *************************************** -->
<div class="modal" id="block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-header" style="background:#d11409;color: white;border:none; ">
        <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 25px;font-weight: bold;">Reason for Rejection</i></h5><i class="fa fa-times-circle" aria-hidden="true" style="font-weight: bold;font-size: 25px;cursor: pointer;" onclick="document.getElementById('block').style.display='none'"></i>


       
      </div>
      <div class="modal-body">
        <form class="edit-content" id="reject" method="post">

<label>Reason</label>
          <textarea class="form-control" id="reason" rows="5" cols="5"></textarea>
          <input type="hidden" id="buid">

      </div>
      <div class="modal-footer" style="border:none;">
        
        <button type="button" class="btn" id="ab1" onclick="RejectApp()" style="background-color: #d11409;color: white;">Submit</button>
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
            <h1>Application Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:window.open('','_self').close();"><i class="fa fa-times" aria-hidden="true"></i>  close</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="sect1">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-danger card-outline">
              <div class="card-body box-profile">
                

                <h3 class="profile-username text-center">{{$application->GetUser->full_name}}</h3>

                <p class="text-muted text-center">{{$application->GetUser->phone_number}}</p>


                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    
                    <b>CA Id</b> <a class="float-right" style="color: green;">{{$application->GetUser->code.$application->GetUser->ca_id}}</a>
                   
                  </li>
                  <li class="list-group-item">
                    
                    <b>Campaign</b> <a class="float-right" style="color: green;">{{$application->GetCamp->title}}</a>
                   
                  </li>
                  <li class="list-group-item">
                    
                    <b>Application Status</b> <a class="float-right" style="color: green;">{{$application->status}}</a>
                   
                  </li>
                  <li class="list-group-item">
                    
                    <b>Payment Status</b> <a class="float-right" style="color: green;">{{$application->payment_status}}</a>
                   
                  </li>
                  <li class="list-group-item">
                    <b>Created At</b> <a class="float-right" style="color:black;">{{ date("d-m-Y", strtotime($application->created_at)); }}</a>
                  </li>
                  
                  
                  
                </ul>

            <select class="form-control" onchange="applicationStatus(this.value)">
              <option value="">Choose</option>
              <option value="Approved">Approve</option>
              <option value="Special">Make special & Approve</option>
              <option value="Rejected" @if($application->status=='Rejected') selected @endif>Reject</option>
              <option value="On Hold" @if($application->status=='On Hold') selected @endif>On Hold</option>
              
            </select>
                 
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card">
              <div class="card-header" style="background-color: #d11409;color: white;">
                <h3 class="card-title">Guarantors</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <ul class="list-group list-group-unbordered mb-3">
                  
               
                  <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Guarantor 1</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee1}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile1}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Guarantor 2</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee2}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile2}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Guarantor 3</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee3}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile3}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Guarantor 4</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee4}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile4}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Guarantor 5</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee5}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile5}}</span>
                  
                   </a>
                  </li>

          
                </ul>

             
                
              

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Application Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Payment Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#acc" data-toggle="tab">Uploaded Documents</a></li>
                 
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                


                  <div class="tab-pane active" id="activity">
                    <div class="post">
                      <div class="user-block">
                        <span style="font-size: 20px;font-weight:bold">Application Details</span>
                          <table style="border-collapse: separate;
                          border-spacing: 0 1em;padding: 15px 15px;">
                          <tr>
                            <td style="font-weight: bold;">Plan  : </td>
                            <td style="padding: 0 15px;">{{$application->plan}} </td>
                        </tr>
                          
                        <tr>
                            <td style="font-weight: bold;">Location of the intended business  : </td>
                            <td style="padding: 0 15px;">{{$application->location}} </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Address of the intended business  : </td>
                            <td style="padding: 0 15px;">{{$application->address}} </td>
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Postcode/Town  : </td>
                            <td style="padding: 0 15px;">{{$application->post}} </td>
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Local Government Area  : </td>
                            @if($application->local_area!='')
                            <td style="padding: 0 15px;">{{$application->GetArea->name}} </td>
                            @endif
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Country  : </td>
                            @if($application->country_id!='')
                            <td style="padding: 0 15px;">{{$application->GetCon->name}} </td>
                             @endif
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">State/Federal Capital Territory  : </td>
                            @if($application->state_id!='')
                            <td style="padding: 0 15px;">{{$application->Getstate->name}} </td>
                            @endif
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Plotsize if farming  : </td>
                            <td style="padding: 0 15px;">{{$application->plot}} </td>
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Estimated annual turnover  : </td>
                            <td style="padding: 0 15px;">{{$application->annual_turnover}} </td>
                        </tr>    
                        </table>
                      </div>                    
                    </div>                  
                  </div>

                  

                  <div class="tab-pane" id="address">
                    <div class="post">
                      <div class="user-block">
                        <span style="font-size: 20px;font-weight:bold">Payment Details</span>
                          <table style="border-collapse: separate;
                          border-spacing: 0 1em;padding: 15px 15px;">
                          <tr>
                            <td style="font-weight: bold;">Payment Status  : </td>
                            <td style="padding: 0 15px;">{{$application->payment_status}} </td>

                        </tr>
                           <tr>
                            <td style="font-weight: bold;">Paid Amount  : </td>
                            <td style="padding: 0 15px;">₦ {{$application->amount}} </td>

                        </tr>
                        <tr>

                            <td style="font-weight: bold;">Paid Date  : </td>
                            @if($application->payment_status=='Paid')
                            <td style="padding: 0 15px;">{{ date("d-m-Y H:i s", strtotime($application->payment_date)); }} </td>
                            @endif
                        </tr>
                          <tr>
                            <td style="font-weight: bold;">Reference Id : </td>
                            <td style="padding: 0 15px;">{{$application->reference_id}} </td>

                        </tr>
                                                
                    </table>
                      </div> 
                    </div>                   
                  </div>

                  <div class="tab-pane" id="acc">
                 <div class="post">
                      <div class="user-block">
                       
                        @foreach($docs as $d)
               <a class="btn btn-app bg-primary" href="{{asset($d->file)}}" target="_blank">
                  <span class="badge bg-info"></span>
                  <i class="fas fa-file"></i>
                  <span class="mt-2">{{$d->type}}</span><br><br>
                </a>


                @endforeach
              
                
                      </div> 
                    </div>                    
                  </div>

                  




                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script type="text/javascript">

 function applicationStatus(val)
    {

      if(val=='Approved')

      {


       swal({
              title: "Do you want continue ?",
              text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

      .then((willDelete) => {
      if (willDelete) {
      data = new FormData();
     
      data.append('appid','{{$application->id}}');
      data.append('st',val);
      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/application-status",
         data: data,
        dataType:"json",
        contentType: false,
        //cache: false,
        processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {

               swal({
                       title: "Application status changed successfully",
                       closeOnClickOutside: false,
                       icon: "success",
                      buttons: "Ok",
                    })
    
                     .then((willDelete) => {
                      if (willDelete) {
                       window.location.href='/pending-applications/' + '{{encrypt($application->campaign_id)}}';
                               } 
    
                    });
          }

        }
    
    
    
    
       })
    
    
    }
    
  
        });
    }


    if(val=='Special')

      {

       swal({
              title: "Do you want continue ?",
              text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

      .then((willDelete) => {
        if (willDelete) {

      $('#sect1').css({ 'opacity' : 0.1 });

      data = new FormData();
     
      data.append('appid','{{$application->id}}');
      data.append('st',val);
      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/application-special",
         data: data,
        dataType:"json",
        contentType: false,
        //cache: false,
        processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
           $('#sect1').css({ 'opacity' : 1 });

               swal({
                       title: "Application status changed successfully",
                       closeOnClickOutside: false,
                       icon: "success",
                      buttons: "Ok",
                    })
    
                     .then((willDelete) => {
                      if (willDelete) {
                       window.location.href='/pending-applications/' + '{{encrypt($application->campaign_id)}}';
                               } 
    
                    });
          }

        }
    
    
    
    
       })
    
    
    }
    
  
        });
    }

        if(val=='Rejected')

      {
          var modal1 = document.getElementById("block");
          modal1.style.display = "block";
          //$('#buid').val(val);
      }

      if(val=='On Hold')

      {
swal({
              title: "Do you want continue ?",
              text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

      .then((willDelete) => {
        if (willDelete) {

      $('#sect1').css({ 'opacity' : 0.1 });

      data = new FormData();
     
      data.append('appid','{{$application->id}}');
      data.append('st',val);
      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/application-status",
         data: data,
        dataType:"json",
        contentType: false,
        //cache: false,
        processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
           $('#sect1').css({ 'opacity' : 1 });

               swal({
                       title: "Application status changed successfully",
                       closeOnClickOutside: false,
                       icon: "success",
                      buttons: "Ok",
                    })
    
                     .then((willDelete) => {
                      if (willDelete) {
                       window.location.href='/pending-applications/' + '{{encrypt($application->campaign_id)}}';
                               } 
    
                    });
          }

        }
    
    
    
    
       })
    
    
    }
    
  
        });
      }    
    
    } 


    function RejectApp()
    {
      var reason=$('#reason').val();
    
      if(reason=='')
      {
        $('#reason').css('border','1px solid red');
        
        return false;
      }
      else
      $('#reason').css('border','1px solid #CCC');

      var buid=$('input#buid').val();

      $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('reason', reason);
      data.append('appid','{{$application->id}}');
      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/reject-appreason",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab2').hide();
              $('#ab1').show();
             
               swal({
                       title: "Application rejected successfully",
                       closeOnClickOutside: false,
                       icon: "success",
                      buttons: "Ok",
                    })
    
                     .then((willDelete) => {
                      if (willDelete) {
                      window.location.href='/pending-applications/' + '{{encrypt($application->campaign_id)}}';
                               } 
    
                    });
          }


        }
    
    
    
    
      })

    }



  </script>
  @endsection