
@extends('layouts.Memeber')
@section('title') Campaigns @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<h5 class="page-name-nav mb-0">My profile</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  --> 
	<div id="exTab1" class="container-main trip-page-tab-main tab-profile-page">	
		<div class="row ">
				

				<div class="col-lg-12 mt-4">
					<div class="tab-content clearfix">
						
						


						
						<div class="tab-pane active" id="3a">
							<div class="repayment-dv-funding">
								@if (sizeof($repay))
								<div class="heading-dv-funding">
									<h6 class="fund-text-main">Pending Repayments</h6>
								</div>
								@foreach($repay as $r)
								@php
								$title=DB::table('campaigns')->select('title')->where('id',$r->GetApp->campaign_id)->first();
								@endphp
								<div class="paid-status-dv pay-now-bg">
									<h5 class="paid-main-text mb-0 text-white">{{$title->title}}</h5>
									<h6 class="month mb-0 text-white">Due Date : {{date('d-M-Y', strtotime($r->due_date))}} </h6>
					
								@if($r->fine!=0)
								<h6 class="month mb-0 text-white">Fine :  <span class="price">₦ {{$r->fine}}</span> </h6>
								<h6 class="month mb-0 text-white">Amount :  <span class="price">₦ {{$r->amount}} + ₦ {{$r->fine}}</span> </h6>
								@endif
								<h6 class="month mb-0 text-white">Amount :  <span class="price">₦ {{$r->amount}}</span> </h6>
								@if($r->payment_approval!='')
								<h6 class="month mb-0 text-white">Approval :  <span class="price">{{$r->payment_approval}}</span> </h6>
								@endif
								@if($r->payment_approval=='Rejected')
								<h6 class="month mb-0 text-white">Reason :  <span class="price">{{$r->rejection_reason}}</span> </h6>
								@endif
								@if($r->pay_status=='Pending')
								<!-- <a class="pay-now-btn mb-0 mt-3" data-toggle="modal" data-target="#modal-fullscreen" onclick="Abc('{{$r->id}}','{{$r->amount}}','{{$r->fine}}')">Pay now</a> -->
								<a class="pay-now-btn mb-0 mt-3" href="/member/repaystatus/{{$r->application_id}}" style="text-decoration: none;">View</a>
								@elseif($r->pay_status=='Paid')
								<p class="pay-now-btn mb-0 mt-3" onclick="window.location.href=''">Paid</p>
								@endif
								</div>
								@endforeach
								@endif


								@if (sizeof($apps))
								<!-- <div class="heading-dv-funding">
									<h6 class="fund-text-main">Campaigns</h6>
								</div> -->
								@foreach($apps as $a)
								
									@if($a->status=='Approved' || $a->status=='Special')
									<div class="inner-col-blog dv-funding" onclick="window.location.href='/member/repaystatus/{{$a->id}}'">
									@elseif($a->status=='Rejected')
									<div class="inner-col-blog dv-funding" onclick="Reject()">
									@elseif($a->status=='Cancelled')
									<div class="inner-col-blog dv-funding" onclick="Cancel()">
									@elseif($a->status=='Completed')
									<div class="inner-col-blog dv-funding" onclick="window.location.href='/member/repaystatus/{{$a->id}}'">
									@else
									<div class="inner-col-blog dv-funding" onclick="Pending()">
									@endif
									<div class="inner-box-blog mr-4">
										<img class="blog-image" src="{{asset($a->GetCamp->photo)}}" alt="blog-image" style="height:80px;">
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

<!-- Modal Fullscreen -->
	<div class="modal modal-category-first modal-category-subt-dv fade modal-fullscreen" id="modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<i class="ri-close-line close" style="opacity: unset;font-weight: 200;float: left;" data-bs-dismiss="modal" aria-label="Close" onclick="CloseModal()"></i>
					<h5 class="text-center text-white text-modal-one">Make sure your <br> details are correct</h5>
				<form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
					<div class="col-lg-12">
						
					</div>
					<input type="hidden" name="public_key" value="FLWPUBK_TEST-716caf0cf2e24c6d481e47fb1d8e1578-X" />
					<input type="hidden" name="customer[name]" value="Arun" />
					<input type="hidden" name="customer[id]" value="1" />
					<input type="hidden" name="customer[camp]" value="5" />
					<input type="hidden" name="tx_ref" id="tx_ref" />
					<input type="hidden" name="amount" id="amount" />
					<input type="hidden" name="currency" value="NGN" />
  				<input type="hidden" name="meta[token]" value="54" />
  				<input type="hidden" name="redirect_url" value="https://portal.crowdafrik.com/member/repay-payment" />
					<div class="col-lg-12">
						<div class="form-group">
							<input type="text" class="form-control" name="customer[email]" placeholder="Confirm your email" value="{{$member->email_id}}" readonly>
							
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<input type="text" class="form-control" name="mobile" value="{{$member->phone_number}}" readonly>
						</div>
					</div>
					<div class="col-lg-12 mt-10">
						<div class="pay-dv-on-modal">
							<!-- <h6 class="pay-on-modal">Proceed to pay</h6> -->
							<input type="submit" class=" btn btn-proceed-to-pay" name="submit" value="Proceed to pay">
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>


	<!-- tabs end  -->
	<script type="text/javascript">

		 function Abc(val,amt,fine) {

var uniqueId = $.now() + '-' + val;
        $('#tx_ref').val(uniqueId);
    var total= parseInt(amt)+parseInt(fine);    
 $('#amount').val(total);
 }
		function Logout()
		{
			AppInterface.Logout();
		}

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


		        function CloseModal() {
  $('#modal-fullscreen').modal('hide'); // Close the modal
  $('body').removeClass('modal-open'); // Remove the modal-open class from the body element to remove the background effects
  $('.modal-backdrop').remove(); // Remove the modal backdrop element
}
  
	</script>



@endsection

