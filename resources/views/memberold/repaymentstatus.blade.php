@extends('layouts.Memeber')
@section('title') Repayments @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<div class="back-btn-nav" onclick="window.location.href='home.html'">
					<i class="ri-arrow-left-s-line"></i>
				</div>
				<h5 class="page-name-nav mb-0">Lorem Ipsum</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  --> 
	<div class="container-main mt-4">
		<div class="row">
			<div class="col-lg-12">
				<div class="banner-status-application">
					<img class="img-status" src="{{asset($appdet->GetCamp->photo)}}" alt="">
				</div>
			</div>
		
			<div class="col-lg-12 mt-3">
		<div class="inner-col-blog dv-funding">
									
									<div class="inner-box-blog" style="padding:15px;">
											<h6 class="application-status-text mb-0" style="font-weight: bold;">{{$appdet->GetCamp->title}}</h6>
											
					<p class="application-status-text mb-0 mt-2">Granted Amount : ₦ {{$fund->amount}}</p>
					<p class="application-status-text mb-0">Total Month : {{$fund->month}}</p>
					<p class="application-status-text mb-0">Monthly Interest : {{$fund->month_interest}} %</p>
					<p class="application-status-text mb-0">Total Interest : ₦ {{$fund->total_interest}}</p>
					<p class="application-status-text mb-0">Total Amount : ₦ {{$fund->total_amount}}</p>
					<p class="application-status-text mb-0">Status : {{$fund->status}}</p>
					
									</div>
								


								</div>
							</div>
		

@if (sizeof($repay))
				<div class="container-main mt-3">
					<h5>Repayments</h5>
		<div class="row">
			@foreach($repay as $r)
			<div class="col-lg-12">
				
				<div class="paid-status-dv pay-now-bg">
					<h5 class="paid-main-text mb-0 text-white"></h5>
					<h6 class="month mb-0 text-white">Due Date : {{date('d-M-Y', strtotime($r->due_date))}} </h6>
					
					@if($r->fine!=0)
					<h6 class="month mb-0 text-white">Fine :  <span class="price">$ {{$r->fine}}</span> </h6>
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
					<a class="pay-now-btn mb-0" data-toggle="modal" data-target="#modal-fullscreen" onclick="Abc('{{$r->id}}','{{$r->amount}}','{{$r->fine}}')">Pay now</a>
					@elseif($r->pay_status=='Paid')
					<p class="pay-now-btn mb-0">Paid</p>
					@endif
				</div>
			</div>
			@endforeach
			@endif
			
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
						<div class="form-group">
							<input type="text" class="form-control" id="cm" value="{{$appdet->GetCamp->title}}" readonly>
						</div>
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
							<input type="text" class="form-control" name="customer[email]" placeholder="Confirm your email" value="{{$mem->email_id}}" readonly>
							
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<input type="text" class="form-control" name="mobile" value="{{$mem->phone_number}}" readonly>
						</div>
					</div>
					<div class="col-lg-12 mt-5">
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
	<!-- scripts  -->



<script type="text/javascript">
	        function CloseModal() {
  $('#modal-fullscreen').modal('hide'); // Close the modal
  $('body').removeClass('modal-open'); // Remove the modal-open class from the body element to remove the background effects
  $('.modal-backdrop').remove(); // Remove the modal backdrop element
}

 function Abc(val,amt,fine) {

var uniqueId = $.now() + '-' + val;
        $('#tx_ref').val(uniqueId);
    var total= parseInt(amt)+parseInt(fine);    
 $('#amount').val(total);
 }
</script>






@endsection