@extends('layouts.Memeber')
@section('title') Notifications @endsection
@section('content')

	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<h5 class="page-name-nav mb-0">Notifications</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  -->
	<div class="container-main mt-4">
		<div class="row">

			@foreach($noti as $n)
			<div class="col-lg-12">
				<div class="inner-col-blog" >
					<div class="inner-box-blog mr-4">
						@if($n->campaign==0 || $n->campaign=='')
						<img class="blog-image" src="{{asset('/member/images/Mask group.png')}}" alt="blog-image">
						@else
						<img class="blog-image" src="{{asset($n->GetCamp->photo)}}" style="height:100px;" alt="blog-image">
						@endif
					</div>
					<div class="inner-box-blog">
						<h5 class="mb-0 notification-heading">{{$n->title}}</h5>
						<p class="notification-sml-text mb-0">{!! $n->msg !!}</p>
					</div>
					<!-- <h6 class="blog-post-time">3hr Ago</h6> -->
				</div>
			</div>
			@endforeach
			
			
			
		</div>
	</div>

@endsection



