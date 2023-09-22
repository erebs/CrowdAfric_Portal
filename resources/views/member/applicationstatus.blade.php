@extends('layouts.Memeber')
@section('title') Fundings  @endsection
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
		

@if (sizeof($fund_face))
				<div class="container-main mt-3">
					<h5>Funding Phaces</h5>
		<div class="row">
			@foreach($fund_face as $f)
			<div class="col-lg-12">
				<div class="paid-status-dv paid-bg">
					<h5 class="paid-main-text mb-0 text-white">{{$f->title}}</h5>
					<h6 class="month mb-0 text-white">{{date('d-M-Y', strtotime($f->date))}} <span class="price">₦ {{$f->amount}}</span> </h6>
					<p class="maoney-status mb-0" onclick="window.location.href=''">{{$f->status}}</p>
				</div>
			</div>
			@endforeach
			@endif
			
		</div>
	</div>





			</div>
	</div>
	<!-- scripts  -->
@endsection