@extends('layouts.Memeber')
@section('title') Appliaction success @endsection
@section('content')
	<div class="container-main">
		<div class="row">
			<div class="col-lg-12">
				<div class="payment-success">
					<img class="payment-image" src="{{asset('/member/images/Application-Processing.png')}}" alt="">
					<h4 class="payment-success-text text-center mb-0">Your application is currently being processed.. </h4>
					<!-- <p class="text-center payment-success-sub-text mb-0">Congratulations! Your application submitted successfully.</p> -->
					
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="vector-paymnt-pg">
		<img class="vectr-image-paymnt-succes" src="./images/vector-payment-success.png" alt="">
	</div> -->
	<!-- ---  -->
@endsection