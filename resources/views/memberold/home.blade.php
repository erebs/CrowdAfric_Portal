

@extends('layouts.Memeber')
@section('title') Home @endsection
@section('content')


		<!-- header   -->
    <header>
			<div class="container-main">
				<div class="nav-main">
					<div class="logo">
						<img class="logo-main" src="{{asset('/member/images/CrowdAfrik 1.png')}}" alt="logo" style="width:130px;">
					</div>
					<div class="search-box">
						<i class="ri-search-line" onclick="window.location.href='/member/search/{{$mid}}'"></i>
					</div>
				</div>
			</div>
		</header>
		<!-- header end  -->
		<!-- main wrapper home  -->
		<div class="container-main">
			<div class="row">
				<div class="col-lg-12">
					<div class="area-funding">
						<h4 class="text-white text-center funding-head-text mb-0">Sectors we fund</h4>
						<p class="text-center mb-0 funding-sub-text">We fund diverse sectors, driving African economic growth and opportunity.</p>
						<p class="text-center mb-0 funding-sub-text">There are {{$campcnt}} ongoing campaigns.</p>
						<h5 class="text-center funding-aply-btn btn  mb-0" data-toggle="modal" data-target="#modal-fullscreen-apply">Apply</h5>
					</div>
				</div>

@if (sizeof($app))
				<div class="col-lg-12">
					<div class="main-head-dv-home">
						<h4 class="main-head-text-home">Your Pending Applications</h4>
					</div>
				</div>
				@foreach($app as $a)
				<div class="col-lg-12">
				
				<div class="paid-status-dv pay-now-bg">
					<h5 class="paid-main-text mb-0 text-white"></h5>
					<h6 class="month mb-0 text-white">{{ Str::limit($a->GetCamp->title, 30, '...') }} </h6>
					<h6 class="month mb-0 text-white">You have 1 pending application </h6>
					<p class="pay-now-btn mb-0" onclick="window.location.href='/member/fundingform/{{$a->campaign_id}}/{{$mid}}'">Continue</p>
					
				</div>
			</div>
			@endforeach
	@endif		


				<!-- heading  -->
				<div class="col-lg-12">
					<div class="main-head-dv-home">
						<h4 class="main-head-text-home">Categories</h4>
					</div>
				</div>
				<!-- content dv home  -->

				@foreach($camp_cat as $c)
				<div class="col-lg-12">
					<div class="content-dv-home" onclick="window.location.href='/member/campaigns/{{$c->id}}/{{$mid}}'">
						<img class="home-main-image" src="{{asset($c->photo)}}" alt="">
						<h5 class="mb-0 main-heading-content-home">{{$c->title}}</h5>
						<p class="mb-0 main-sub-heading-content-home">{{ Str::limit(strip_tags(preg_replace('/&nbsp;/', ' ', $c->description)), 50, '...') }}</p>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>
		<!-- Modal Fullscreen -->
		<div class="modal modal-category-first fade modal-fullscreen" id="modal-fullscreen-apply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body">
						<i class="ri-close-line close" data-bs-dismiss="modal" style="opacity: unset;font-weight: 200;float: left;" aria-label="Close" onclick="CloseModal()"></i>
						<div class="box-modal">
							<div class="container-main">
								<div class="row">
									@foreach($camp_cat as $c)
									<div class="col-4" onclick="window.location.href='/member/campaigns/{{$c->id}}/{{$mid}}'">
										<div class="grid-box-category border-modal">
											<h6>	<center><img src="{{asset($c->icon)}}" style="width:28px;padding-top: 5px;"></center></h6>
											<h6 class="grid-text-category text-modal-box mt-3">{{ Str::limit(($c->title), 10, '...') }}</h6>
										</div>
									</div>
									@endforeach
									
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<script type="text/javascript">
	
	function CloseModal() {
  $('#modal-fullscreen-apply').modal('hide'); // Close the modal
  $('body').removeClass('modal-open'); // Remove the modal-open class from the body element to remove the background effects
  $('.modal-backdrop').remove(); // Remove the modal backdrop element
}

</script>


@endsection



