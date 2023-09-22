@extends('layouts.Memeber')
@section('title') Payment @endsection
@section('content')
	<div class="container-main">
		<div class="row">
			<div class="col-lg-12">
				<div class="payment-success">
					<center>
					<lottie-player src="https://lottie.host/0d45d26e-1a71-408c-8e4e-e00bb2a40878/GsrCXqF4L4.json" background="#fff" speed="1" style="width: 300px; height: 300px" loop  autoplay direction="1" mode="normal"></lottie-player>
				</center>
					<h4 class="payment-success-text text-center mb-0" >Payment Cancelled</h4>
					<p class="text-center payment-success-sub-text mb-0">Sorry! Your tranaction is cancelled.</p>
					<p class="primary-color text-center navgtion-text-succes-page" onclick="">Back</p>
				</div>
			</div>
		</div>
	</div>
	<!-- <<div class="vector-paymnt-pg">
		<img class="vectr-image-paymnt-succes" src="{{asset('/member/images/vector-payment-success.png')}}" alt="">
	</div> -->
@endsection