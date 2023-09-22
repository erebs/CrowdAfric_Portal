
@extends('layouts.Memeber')
@section('title') My profile @endsection
@section('content')
	<!-- nav  -->
	<div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<h5 class="page-name-nav mb-0">My profile</h5>
			</div>
		</div>
	</div>
	<!-- nav end  --> 
	<div id="exTab1" class="container-main trip-page-tab-main tab-profile-page">	
		<div class="row ">
				<div class="tab-dv-trip mt-4">
					<ul  class="nav nav-pills tab-space">
						<li class="active tab-switch tab-profile">
							<a  href="#1a" data-toggle="tab" class="tab-text" >Account</a>
						</li>
						<li class="tab-switch tab-profile"> 
							<a href="#2a" data-toggle="tab" class="tab-text" >  Funding</a>
						</li>
						<li	class="tab-switch tab-profile">
							<a href="#3a" data-toggle="tab" class="tab-text" >  Repayment</a>
						</li>
					</ul>
				</div>

				<div class="col-lg-12 mt-4">
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">
							<div class="account-section">
								<div class="profile-box">
									 <div class="image-box">
										<img class="user-image-profile" src="{{asset('/member/images/Ellipse 1.png')}}" alt="">
									</div>
									<div class="user-details">
										<h5 class="mb-0 user-name-profile">{{$member->full_name}}</h5>
										<p class="user-number-profile mb-0">{{$member->phone_number}}</p>
										<p class="user-email-profile mb-0">{{$member->email_id}}</p>
									</div>
									<h6 class="log-out" onclick="Logout()">Logout</h6>
								</div>
								<!-- ================ -->
								<div class="profile-options-dv">
									<div class="options-profile" onclick="window.location.href='/member/personaldetails/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/user-3-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Personal Details</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>
									<div class="options-profile" onclick="window.location.href='/member/bankdetail/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/bank-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Bank details</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>
									<div class="options-profile" onclick="window.location.href='/member/nominees/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/team-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Guarantors</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>
									<div class="sub-text-profile-dv">
										<h6 class="sub-text-profile">Dashboard</h6>
									</div>
									<div class="options-profile" onclick="window.location.href='/member/aboutus/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/file-info-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">About us</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>
									<div class="options-profile" onclick="window.location.href='/member/terms/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/bookmark-3-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Terms and condition</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>

									<div class="options-profile" onclick="window.location.href='/member/privacy_policy/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/eye-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Privacy Policy</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>

									<div class="options-profile" onclick="window.location.href='/member/contact/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/contacts-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Contact us</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>

									<div class="options-profile" onclick="window.location.href='/member/faq/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/question-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">FAQ</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>

									<div class="options-profile" onclick="window.location.href='/member/help/{{$member->id}}'">
										<div class="icon-dv">
											<img class="icon-profile" src="{{asset('/member/images/hand-heart-line.svg')}}" alt="">
										</div>
										<h6 class="text-option mb-0">Help</h6>
										<i class="ri-arrow-right-s-line"></i>
									</div>


								</div>
							</div>
						</div>
						<div class="tab-pane" id="2a">
							<div class="funding-dv">
								

								@if (sizeof($apps))
								<div class="heading-dv-funding">
									<h6 class="fund-text-main">Campaigns</h6>
								</div>

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
										<img class="blog-image" src="{{asset('/member//images/Mask group.png')}}" alt="blog-image">
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




















						
						<div class="tab-pane" id="3a">
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
								<div class="heading-dv-funding">
									<h6 class="fund-text-main">Campaigns</h6>
								</div>
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
										<img class="blog-image" src="{{asset('/member//images/Mask group.png')}}" alt="blog-image">
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

