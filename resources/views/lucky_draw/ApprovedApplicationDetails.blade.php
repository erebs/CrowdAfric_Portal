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
                    
                    <b>CA Id</b> <a class="float-right" style="color: green;">{{$application->GetUser->ca_id}}</a>
                   
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
              <!-- <option value="Approved">Approve</option> -->
                <option value="Completed" @if($application->status=='Complete') selected @endif>Complete</option>
              <option value="Rejected" @if($application->status=='Rejected') selected @endif>Reject</option>
            
              
            </select>
                 
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card">
              <div class="card-header" style="background-color: #d11409;color: white;">
                <h3 class="card-title">Nominees</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <ul class="list-group list-group-unbordered mb-3">
                  
               
                  <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Nominee 1</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee1}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile1}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Nominee 2</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee2}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile2}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Nominee 3</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee3}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile3}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Nominee 4</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->nominee4}}</span><br>
                    <a href="" target="_blank" style="color: black;"> <b>Mobile</b>    
                    <span class="float-right" style="font-size: 12px;">{{$application->mobile4}}</span>
                  
                   </a>
                  </li>
                   <li class="list-group-item" >
                     <a href="" target="_blank" style="color: black;"> <b>Nominee 5</b>    
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
                  <li class="nav-item"><a class="nav-link" href="#acc" data-toggle="tab">Documents</a></li>
                  <li class="nav-item"><a class="nav-link" href="#fun" data-toggle="tab">Funding</a></li>
                  @if($fund!=0)
                  <li class="nav-item"><a class="nav-link" href="#funface" data-toggle="tab">Funding Phase</a></li>
                  <li class="nav-item"><a class="nav-link" href="#repay" data-toggle="tab">Repayments</a></li>
                  @endif
                 
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
                            <td style="padding: 0 15px;">{{$application->local_area}} </td>
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Country  : </td>
                            @if($application->country_id!='')
                            <td style="padding: 0 15px;">{{$application->GetCon->name}} </td>
                             @endif
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">State  : </td>
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
                            <td style="padding: 0 15px;">$ {{$application->amount}} </td>

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
                </a>

                @endforeach
              
                
                      </div> 
                    </div>                    
                  </div>

                  
                  <div class="tab-pane" id="fun">
                    
                    @if($fund==0)
                    <span style="font-size: 20px;font-weight:bold">Funding Details</span>
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Amount ($)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="amount" value="0" oninput="TotalInt()">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Month</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="month" oninput="TotalInt()" value="0">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Interest (%)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="interest" oninput="TotalInt()" value="0">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Total interest ($)</label>
                        <div class="col-sm-10">
                         <input type="number" class="form-control" id="tot_interest" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Total Amount ($)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="tot_amount" readonly>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="button" class="btn" id="ab1" onclick="SaveFund()" style="background-color: #d11409;color: white;">Submit</button>
                            <button type="button"  class="btn" id="ab2" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
                        </div>
                      </div>
                    </form>

                    @else

                    <div class="post">
                      
                        <span style="font-size: 20px;font-weight:bold">Funding Details</span>
                          <table style="border-collapse: separate;
                          border-spacing: 0 1em;padding: 15px 15px;">
                          <tr>
                            <td style="font-weight: bold;">Amount  : </td>
                            <td style="padding: 0 15px;">$ {{$funds->amount}} </td>
                        </tr>
                          
                        <tr>
                            <td style="font-weight: bold;">Month  : </td>
                            <td style="padding: 0 15px;">{{$funds->month}} </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Interest  : </td>
                            <td style="padding: 0 15px;">{{$funds->month_interest}} % </td>
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Total Interest  : </td>
                            <td style="padding: 0 15px;">$ {{$funds->total_interest}} </td>
                        </tr> 
                        <tr>
                            <td style="font-weight: bold;">Total Amount  : </td>
                            <td style="padding: 0 15px;">$ {{$funds->total_amount}} </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Status  : </td>
                            <td style="padding: 0 15px;">{{$funds->status}} </td>
                        </tr>  
                            
                        </table>
                      </div>
                     
 <span style="font-size: 20px;font-weight:bold">Update Funding Details</span><br><br><br>

                      <div class="post">

                      <div class="user-block">

                    <form class="form-horizontal">
                      <div class="form-group row">
                        <input type="hidden" class="form-control" id="fid" value="{{$funds->id}}">
                        <label for="inputName" class="col-sm-2 col-form-label">Amount ($)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="amount1" value="{{$funds->amount}}" oninput="TotalInt1()">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Month</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="month1" value="{{$funds->month}}" oninput="TotalInt1()">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Interest (%)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="interest1" value="{{$funds->month_interest}}" oninput="TotalInt1()">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Total interest</label>
                        <div class="col-sm-10">
                         <input type="number" class="form-control" id="tot_interest1" readonly value="{{$funds->total_interest}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Total Amount</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="tot_amount1" readonly value="{{$funds->total_amount}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="fstat">

                            <option value="">Choose</option>
                            <option value="Pending" @if($funds->status=='Pending') selected @endif>Pending</option>
                            <option value="Approved" @if($funds->status=='Approved') selected @endif>Approve</option>
                            
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="button" class="btn" id="ab3" onclick="EditFund()" style="background-color: #d11409;color: white;">Update</button>
                            <button type="button"  class="btn" id="ab4" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Update</button>
                        </div>
                      </div>
                    </form>
</div>
</div>

                    @endif





                  </div>

                   @if($fund!=0)

                  <div class="tab-pane" id="funface">
                <span style="font-size: 20px;font-weight:bold">Add Funding Phase</span><br><br>
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Title : </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="ftitle" oninput="TotalInt()" placeholder="Enter title">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Amount ($) : </label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="famount" placeholder="Enter amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Date : </label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="fdate">
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="button" class="btn" id="ab5" onclick="SaveFundface()" style="background-color: #d11409;color: white;">Submit</button>
                            <button type="button"  class="btn" id="ab6" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
                        </div>
                      </div>
                    </form><br>



  <span style="font-size: 20px;font-weight:bold">Funding Phase</span><br><br>
  <span style="font-size: 20px;font-weight:bold">Total alloted amount  : $ {{$fundfacesum}}   ,  Balance amount  : $ {{$funds->amount-$fundfacesum}}</span><br><br>

                    <div class="timeline timeline-inverse">

                      @php
                      $sm=0;
                      $amt=0;
                      $bal=$funds->amount-$fundfacesum;
                      @endphp
                      @foreach($fundface as $f)
                        @php
                    $sm=$sm+$f->amount;
                     $amt=$funds->amount-$sm;
                      @endphp
                      <div class="time-label">
                        <span class="bg-danger">
                          {{ date("d-m-Y", strtotime($f->date)); }}
                        </span>
                      </div>

                      <div>
                        <i class="fas fa-clock bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-trash" style="color:red;cursor: pointer;" onclick="DeleteFace('{{$f->id}}')"></i> </span>

                          <h3 class="timeline-header"><a>Title  :</a> {{$f->title}}</h3>
                          <h3 class="timeline-header"><a>Amount :</a>$ {{$f->amount}}</h3>
                          <h3 class="timeline-header"><a>Status :</a>   {{$f->status}}</h3>

                           <div class="timeline-footer">
                             <select class="form-control col-md-3" onchange="FundfaceStatus(this.value,'{{$f->id}}')" id="facestatus">
              <option value="">Choose</option>
              <option value="Approved">Approve</option>
              <option value="Rejected">Reject</option>
              <option value="Pending">Pending</option>
              
            </select>
                 
                          </div>
                        </div>
                      </div>
                       @php
                         $sm=$f->amount;
                      @endphp
                    
                      @endforeach
                      

                    </div>
                  </div>
                  @else
                  @php
                    $bal=0;
                  @endphp
                  @endif


                  @if($fund!=0)

                  <div class="tab-pane" id="repay">
                <span style="font-size: 20px;font-weight:bold">Add Repayment</span><br><br>
                    <form class="form-horizontal">
                      
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Amount ($) : </label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="ramount" placeholder="Enter amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Due Date : </label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="rdate">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Fine ($) : </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="fine" value="0">
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="button" class="btn" id="ab7" onclick="SaveRepayment()" style="background-color: #d11409;color: white;">Submit</button>
                            <button type="button"  class="btn" id="ab8" disabled="" style="background-color: #d11409;color: white;"> <i class="fa fa-spinner fa-spin"></i>  Submit</button>
                        </div>
                      </div>
                    </form><br>



  <span style="font-size: 20px;font-weight:bold">Repayment Phases</span><br><br>
  <span style="font-size: 20px;font-weight:bold">Total repaid amount  : $ {{$repaysum}}   ,  Balance amount  : $ {{$funds->total_amount-$repaysum}}</span><br><br>

                    <div class="timeline timeline-inverse">

                      @php
                      
                      $bal1=$funds->total_amount-$repaysum;
                      @endphp
                      @foreach($repay as $r)
                        
                      <div class="time-label">
                        <span class="bg-danger">
                          {{ date("d-m-Y", strtotime($r->created_at)); }}
                        </span>
                      </div>

                      <div>
                        <i class="fas fa-clock bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-trash" style="color:red;cursor: pointer;" onclick="DeleteRepay('{{$r->id}}')"></i> </span>

                          
                          <h3 class="timeline-header"><a>Amount :</a>$ {{$r->amount}}</h3>
                          <h3 class="timeline-header"><a>Due date  :</a>  {{ date("d-m-Y", strtotime($r->due_date)); }}</h3>
                          <h3 class="timeline-header"><a>Fine  :</a>$ {{$r->fine}}</h3>
                          <h3 class="timeline-header"><a>Status  :</a> {{$r->status}}</h3>
                        

                          <div class="timeline-footer">
                           
                             <select class="form-control col-md-3" onchange="RepayStatus(this.value,'{{$r->id}}')" id="facestatus">
              <option value="">Choose</option>
              <option value="Approved">Approve</option>
              <option value="Rejected">Reject</option>
              <option value="Pending">Pending</option>
              
            </select>
                 
                          </div>
                        </div>
                      </div>
                       
                      @endforeach
                      

                    </div>
                  </div>
                  @else
                  @php
                    $bal1=0;
                  @endphp
                  @endif






                  




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

function TotalInt()
    {
      var amt=$('input#amount').val();
      var mnt=$('input#month').val();
      var intr=$('input#interest').val();

      var tot=(parseInt(amt)*parseInt(intr))/100;

  var totintr = parseInt(tot)*parseInt(mnt);

  var totamt = parseInt(amt)+parseInt(totintr);
  $('#tot_interest').val(totintr);
    $('#tot_amount').val(totamt);

    } 

    function TotalInt1()
    {
      var amt1=$('input#amount1').val();
      var mnt1=$('input#month1').val();
      var intr1=$('input#interest1').val();

      var tot1=(parseInt(amt1)*parseInt(intr1))/100;

  var totintr1 = parseInt(tot1)*parseInt(mnt1);

  var totamt1 = parseInt(amt1)+parseInt(totintr1);
  $('#tot_interest1').val(totintr1);
    $('#tot_amount1').val(totamt1);

    }      

function SaveFund()
    {
    

      var amount=$('input#amount').val();
    
      if(amount=='')
      {
        $('#amount').css('border','1px solid red');
        
        return false;
      }
      else
        $('#amount').css('border','1px solid #CCC');

      var month=$('input#month').val();
    
      if(month=='')
      {
        $('#month').css('border','1px solid red');
        
        return false;
      }
      else
        $('#month').css('border','1px solid #CCC');

      var interest=$('input#interest').val();
    
      if(interest=='')
      {
        $('#interest').css('border','1px solid red');
        
        return false;
      }
      else
        $('#interest').css('border','1px solid #CCC');

      var tot_interest=$('input#tot_interest').val();
    
      if(tot_interest=='')
      {
        $('#tot_interest').css('border','1px solid red');
        
        return false;
      }
      else
        $('#tot_interest').css('border','1px solid #CCC');

      var tot_amount=$('input#tot_amount').val();
    
      if(tot_amount=='')
      {
        $('#tot_amount').css('border','1px solid red');
        
        return false;
      }
      else
        $('#tot_amount').css('border','1px solid #CCC');

      
     $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('amount', amount);
      data.append('month', month);
      data.append('interest', interest);
      data.append('tot_interest', tot_interest);
      data.append('tot_amount', tot_amount);
      data.append('user_id', '{{$application->user_id}}');
      data.append('appid', '{{$application->id}}');

      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/fund-add",
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
                       title: "Funding details added successfully",
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

         

        }
    
    
    
    
      })
    
    
    
    
    
    
    } 


    function EditFund()
    {
    

      var amount1=$('input#amount1').val();
    
      if(amount1=='')
      {
        $('#amount1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#amount1').css('border','1px solid #CCC');

      var month1=$('input#month1').val();
    
      if(month1=='')
      {
        $('#month1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#month1').css('border','1px solid #CCC');

      var interest1=$('input#interest1').val();
    
      if(interest1=='')
      {
        $('#interest1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#interest1').css('border','1px solid #CCC');

      var tot_interest1=$('input#tot_interest1').val();
    
      if(tot_interest1=='')
      {
        $('#tot_interest1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#tot_interest1').css('border','1px solid #CCC');

      var tot_amount1=$('input#tot_amount1').val();
    
      if(tot_amount1=='')
      {
        $('#tot_amount1').css('border','1px solid red');
        
        return false;
      }
      else
        $('#tot_amount1').css('border','1px solid #CCC');

    var fstat=$('#fstat option:selected').val();
    
      if(fstat=='')
      {
        $('#fstat').css('border','1px solid red');
        
        return false;
      }
      else
        $('#fstat').css('border','1px solid #CCC');

var fid=$('input#fid').val();
      
     $('#ab3').hide();
      $('#ab4').show();

      data = new FormData();
      data.append('amount1', amount1);
      data.append('month1', month1);
      data.append('interest1', interest1);
      data.append('tot_interest1', tot_interest1);
      data.append('tot_amount1', tot_amount1);
      data.append('fstat', fstat);
      data.append('fid', fid);

      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/fund-update",
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
                       title: "Funding details updated successfully",
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

         

        }
    
    
    
    
      })
    
    
    } 



        function SaveFundface()
    {
    

      var avbal='{{$bal}}';
//alert(avbal);
      var ftitle=$('input#ftitle').val();
    
      if(ftitle=='')
      {
        $('#ftitle').css('border','1px solid red');
        
        return false;
      }
      else
        $('#ftitle').css('border','1px solid #CCC');

      var famount=$('input#famount').val();
    

      if(famount=='')
      {
        $('#famount').css('border','1px solid red');
        
        return false;
      }
      else if(parseInt(famount)>parseInt(avbal))
      {
        swal({
                       title: "Amount exceeds total amount",
                       closeOnClickOutside: false,
                       icon: "error",
                      buttons: "Ok",
                    })
        $('#famount').css('border','1px solid red');
        
        return false;
      }
      else
        $('#famount').css('border','1px solid #CCC');

      var fdate=$('input#fdate').val();
    
      if(fdate=='')
      {
        $('#fdate').css('border','1px solid red');
        
        return false;
      }
      else
        $('#fdate').css('border','1px solid #CCC');
var fid=$('input#fid').val();
      
     $('#ab5').hide();
      $('#ab6').show();

      data = new FormData();
      data.append('ftitle', ftitle);
      data.append('famount', famount);
      data.append('fdate', fdate);
      data.append('fid', fid);

      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/fundface-add",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab6').hide();
              $('#ab5').show();
             
               swal({
                       title: "Funding faces added successfully",
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

         

        }
    
    
    
    
      })
    
    
    } 


     function SaveRepayment()
    {
    

     var avbal1='{{$bal1}}';
//alert(avbal);

      var ramount=$('input#ramount').val();
    
      if(ramount=='')
      {
        $('#ramount').css('border','1px solid red');
        
        return false;
      }
      else if(parseInt(ramount)>parseInt(avbal1))
      {
        swal({
                       title: "Amount exceeds total amount",
                       closeOnClickOutside: false,
                       icon: "error",
                      buttons: "Ok",
                    })
        $('#ramount').css('border','1px solid red');
        
        return false;
      }
      else
        $('#ramount').css('border','1px solid #CCC');

      var rdate=$('input#rdate').val();
  
      if(rdate=='')
      {
        $('#rdate').css('border','1px solid red');
        
        return false;
      }
      
      else
        $('#rdate').css('border','1px solid #CCC');

      var fine=$('input#fine').val();
    
      if(fine=='')
      {
        $('#fine').css('border','1px solid red');
        
        return false;
      }
      else
        $('#fine').css('border','1px solid #CCC');
      
     $('#ab7').hide();
      $('#ab8').show();

      data = new FormData();
      data.append('ramount', ramount);
      data.append('rdate', rdate);
      data.append('fine', fine);
      data.append('user_id', '{{$application->user_id}}');
      data.append('appid', '{{$application->id}}');

      data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/repayment-add",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab8').hide();
              $('#ab7').show();
             
               swal({
                       title: "Repayment details added successfully",
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

         

        }
    
    
    
    
      })
    
    
    } 





function DeleteFace(val)
    {

      if(val!='')

      {

       swal({
              title: "Do you want continue ?",
              //text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

.then((willDelete) => {

      data = new FormData();
     
  data.append('fundfaceid',val);
  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/fundface-delete",
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
                       title: "Funding phase deleted successfully",
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

        }
    
    
    
    
      })
    
    
    
    
  
});
}
    
    
    } 


function DeleteRepay(val)
    {

      if(val!='')

      {

       swal({
              title: "Do you want continue ?",
              //text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

.then((willDelete) => {

      data = new FormData();
     
  data.append('repayid',val);
  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/repay-delete",
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
                       title: "Deleted successfully",
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

        }
    
    
    
    
      })
    
    
    
    
  
});
}
    
    
    } 









 function applicationStatus(val)
    {

      if(val!='')

      {

       swal({
              title: "Do you want continue ?",
              text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

.then((willDelete) => {

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
                       window.location.href='/lucky-users/' + '{{encrypt($application->campaign_id)}}';
                               } 
    
                    });
          }

        }
    
    
    
    
      })
    
    
    
    
  
});
}
    
    
    } 


    function FundfaceStatus(val1,val2)
    {

      if(val1!='')

      {

       swal({
              title: "Do you want continue ?",
              //text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

.then((willDelete) => {


      data = new FormData();
     
  data.append('fid',val2)
  data.append('st',val1);
  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/fundface-status",
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
                       title: "Status changed successfully",
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

        }
    
    
    
    
      })
    
    
    
    
  
});
}
    
    
    } 


    function RepayStatus(val1,val2)
    {

      if(val1!='')

      {

       swal({
              title: "Do you want continue ?",
              //text: "Ensure that the application validated thoroughly.",
              icon: "warning",
              buttons: ["No", "Yes"],
            })

.then((willDelete) => {


      data = new FormData();
     
  data.append('rid',val2)
  data.append('st',val1);
  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/repay-status",
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
                       title: "Status changed successfully",
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

        }
    
    
    
    
      })
    
    
    
    
  
});
}
    
    
    } 
  </script>
  @endsection