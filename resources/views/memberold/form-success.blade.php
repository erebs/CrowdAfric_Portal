@extends('layouts.Memeber')
@section('title') Appliaction success @endsection
@section('content')
	<div class="container-main">
		<div class="row">
			<div class="col-lg-12">
				<div class="payment-success">
					<img class="payment-image" src="{{asset('/member/images/Application-Success.png')}}" alt="">
					<h4 class="payment-success-text text-center mb-0">Application submission successful 🎉</h4>
					<p class="text-center payment-success-sub-text mb-0">Congratulations! Your application submitted successfully.</p>
					<h5 class="primary-color text-center navgtion-text-succes-page" onclick="window.location.href='/member/home/{{$mid}}'">Back to Home</h5>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="vector-paymnt-pg">
		<img class="vectr-image-paymnt-succes" src="./images/vector-payment-success.png" alt="">
	</div> -->
	<!-- ---  -->
@endsection