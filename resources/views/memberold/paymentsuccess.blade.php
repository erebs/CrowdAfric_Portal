@extends('layouts.Memeber')
@section('title') Payment @endsection
@section('content')
	<div class="container-main">
		<div class="row">
			<div class="col-lg-12">
				<div class="payment-success">
					<img class="payment-image" src="{{asset('/member/images/Payment-Success.png')}}" alt="">
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