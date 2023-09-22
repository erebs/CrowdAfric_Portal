@extends('layouts.Memeber')
@section('title') Payment @endsection
@section('content')
	<div class="container-main">
		<div class="row">
			<div class="col-lg-12">
				<div class="payment-success">
					<center>
					<lottie-player src="https://lottie.host/93ce3ca5-8bce-4800-8710-21898c4192c6/ApIYmfLVhk.json" background="#ffffff" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1" mode="normal"></lottie-player>
				</center>
					<h4 class="payment-success-text text-center mb-0" >Payment success 🎉</h4>
					<p class="text-center payment-success-sub-text mb-0">Congratulations! Your tranaction is succesful,	you can start your course now.</p>
					<p class="primary-color text-center navgtion-text-succes-page" onclick="window.location.href='/member/fundingform/{{$cid}}/{{$mid}}'">Continue</p>
				</div>
			</div>
		</div>
	</div>
	<!-- <<div class="vector-paymnt-pg">
		<img class="vectr-image-paymnt-succes" src="{{asset('/member/images/vector-payment-success.png')}}" alt="">
	</div> -->
@endsection