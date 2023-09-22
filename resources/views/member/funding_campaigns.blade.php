
@extends('layouts.Memeber')
@section('title') Campaigns @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<h5 class="page-name-nav mb-0">Campaigns</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  --> 
	<div id="exTab1" class="container-main trip-page-tab-main tab-profile-page">	
		<div class="row ">
				

			<div class="col-lg-12 mt-4">
					<div class="tab-content clearfix">	
		<div class="tab-pane active" id="2a">
		<div class="funding-dv">
								

								@if (sizeof($apps))
								<!-- <div class="heading-dv-funding">
									<h6 class="fund-text-main">Campaigns</h6>
								</div> -->

								@foreach($apps as $a)
								@if($a->status=='Approved' || $a->status=='Special')
									<div class="inner-col-blog dv-funding" onclick="window.location.href='/member/applicationstatus/{{$a->id}}'">
									@elseif($a->status=='Rejected')
									<div class="inner-col-blog dv-funding" onclick="Reject()">
									@elseif($a->status=='Cancelled')
									<div class="inner-col-blog dv-funding" onclick="Cancel()">
									@elseif($a->status=='Completed')
									<div class="inner-col-blog dv-funding" onclick="window.location.href='/member/applicationstatus/{{$a->id}}'">
									@else
									<div class="inner-col-blog dv-funding" onclick="Pending()">
									@endif
								
									<div class="inner-box-blog mr-4">
										<img class="blog-image" src="{{asset($a->GetCamp->photo)}}" alt="blog-image" style="height: 80px;">
									</div>
									<div class="inner-box-blog">
										<h5 class="mb-0 funding-bx-heading">{{$a->GetCamp->title}}</h5>
										<!-- <p class="funding-sml-text mb-0">Category : </p> -->
										<p class="funding-sml-text mt-2">Applied On : {{date('d-M-Y', strtotime($a->created_at))}}</p>

										<br>
									</div>
									@if($a->status=='Approved' || $a->status=='Special')
									<h6 class="pending-text-funding" style="color:green;">Approved</h6>
									@elseif($a->status=='Rejected' || $a->status=='Cancelled')
									<h6 class="pending-text-funding" style="color:red;">{{$a->status}}</h6>
									@elseif($a->status=='Completed')
									<h6 class="pending-text-funding" style="color:green;">{{$a->status}}</h6>
									@else
									<h6 class="pending-text-funding" style="color:orange;">{{$a->status}}</h6>
									@endif


								</div>
								@endforeach
								@else
								<div class="heading-dv-funding">
									<h6 class="fund-text-main">No applications found</h6>
								</div>

								@endif
								
							</div>
						</div>
</div>
						</div>
					</div>
						</div>
					</div>
						</div>
					</div>
						</div>






	<!-- tabs end  -->
	<script type="text/javascript">
function Reject()
		{
				Toastify({
						  text: "Application rejected",
						  duration: 3000,
						  newWindow: true,
						  // close: true,
						  gravity: "bottom", // `top` or `bottom`
						  position: "center", // `left`, `center` or `right`
						  stopOnFocus: true, // Prevents dismissing of toast on hover
						  style: {
						    background: "linear-gradient(to right, red, red)",
						  },
						  callback: function () {
						   // alert("sss");
						  // window.location.href=window.location.href
						  },
						}).showToast();
		}

		function Cancel()
		{
			Toastify({
						  text: "Application cancelled",
						  duration: 3000,
						  newWindow: true,
						  // close: true,
						  gravity: "bottom", // `top` or `bottom`
						  position: "center", // `left`, `center` or `right`
						  stopOnFocus: true, // Prevents dismissing of toast on hover
						  style: {
						    background: "linear-gradient(to right, red, red)",
						  },
						  callback: function () {
						   // alert("sss");
						  // window.location.href=window.location.href
						  },
						}).showToast();
		}

		function Pending()
		{
			Toastify({
						  text: "Approval pending",
						  duration: 3000,
						  newWindow: true,
						  // close: true,
						  gravity: "bottom", // `top` or `bottom`
						  position: "center", // `left`, `center` or `right`
						  stopOnFocus: true, // Prevents dismissing of toast on hover
						  style: {
						    background: "linear-gradient(to right, red, red)",
						  },
						  callback: function () {
						   // alert("sss");
						  // window.location.href=window.location.href
						  },
						}).showToast();
		}
  
	</script>



@endsection

