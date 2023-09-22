
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
            <h1>Applications</h1>
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
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Category</th>
                    <th>Campaign</th>
                    <th>Registered On</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($apps as $a)
                   @php
                     $dt1 = date("d-M-Y", strtotime($a->created_at));
                     $cam=DB::table('campaigns')->select('cat_id')->where('id',$a->campaign_id)->first();
                     $cat=DB::table('campaign_categories')->select('title')->where('id',$cam->cat_id)->first();
                    @endphp 
                  <tr>
                    <td>{{$loop->iteration}}</td>
                     <td>{{$cat->title}}</td>
                    <td>{{$a->GetCamp->title}}</td>
                    <td>{{$dt1}}</td>
                    <td>{{$a->status}}</td>
                    @if($a->status=='Started')
<td><a href="/pending-appdetails/{{encrypt($a->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a></td>
                    @elseif($a->status=='Submitted' || $a->status=='submitted')
<td><a href="/pending-appdetails/{{encrypt($a->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a></td>
                    @elseif($a->status=='On Hold')

                     <td><a href="/pending-appdetails/{{encrypt($a->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a></td>
                        
                    @elseif($a->status=='Approved' || $a->status=='Special')
    <td><a href="/approved-appdetails/{{encrypt($a->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a></td>
                    @elseif($a->status=='Completed')
    <td><a href="/completed-appdetails/{{encrypt($a->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a></td>
                    @elseif($a->status=='Rejected' || $a->status=='Cancelled')
                        <td><a href="/rejected-appdetails/{{encrypt($a->id)}}" target="_blank" style="cursor: pointer;border:none;background-color: #17a2b8" class="btn btn-primary btn-sm"><b> View</b></a></td>
                       @endif 
                  
                    
                   
                    
                   
                      


                    

              
                
                 
                      
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

   

</script>


@endsection

