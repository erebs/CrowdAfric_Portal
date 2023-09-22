@extends('layouts.Admin')
@section('title')
applications
  @endsection
 
@section('contents')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cancelled Applications</h1>
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
                   <th>Country/State</th>
                    <!-- <th>Created At</th> -->
                     <th>Payment</th>
                    <!-- <th>Status</th> -->
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
                   <td>{{$v->GetCon->name}}/{{$v->GetState->name}}</td>
                    <!-- <td>{{$dt1}}</td> -->
                     <td>{{$v->payment_status}}</td>
                    <!-- <td>{{$v->status}}</td> -->
                    <td><a href="/cancelled-appdetails/{{encrypt($v->id)}}" target="_blank" style="cursor: pointer;background-color: #dd778c;border:none;" class="btn btn-danger btn-sm"><b> View</b></a></td>
              
                
                     
                      
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
                        <h5 class="text-muted">Find Application</h5>
                        <form action="/cancelled-application-search" method="post" target="_blank">
                          @csrf
                          <input type="hidden" name="campid" value="{{$camp->id}}">
                        <select class="form-control" onchange="SelectState(this.value)" name="country">
                          <option value="">Choose Country</option>
                          @foreach($con as $c)
                          <option value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach
                          
                        </select><br>

                        <select class="form-control" id="state" name="state">
                          <option value="">Choose State</option>
                          
                        </select><br>
                        
                        <button type="submit" class="btn" id="ab1" style="background-color: #d11409;color: white;"><i class="fa fa-search" aria-hidden="true"></i>   Search</button>
                        </form>
              
                    </div>
                </div>
                <div class="card card-info">
                    <!-- <div class="card-block flex-column">
                        <img src="{{ asset('admin/img/logo/login.png')}}" style="width: 150px;">
                    </div> -->
                    <div class="card-body card-block-a">
                        <h5 class="text-muted">Quick Links</h5>
              <ul class="list-unstyled">
                @foreach($all_camp as $c)
                <li>
    <i class="fa fa-dot-circle" aria-hidden="true" style="font-size: 10px;"></i>  <a href="/cancelled-applications/{{encrypt($c->id)}}" class="btn-link text-primary"> {{$c->title}}</a>
                </li>
              @endforeach  
                
              </ul>
              
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

    <script type="text/javascript">
  
function SelectState(val)

{

    $.post("/get-state", { cid: val,_token: "{{ csrf_token() }}"}, function(result) {

      $('#state').html(result);

    });
  
}


</script>



@endsection

