<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- icon cdn  -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
	<!-- css  -->
	<link rel="stylesheet" href="{{asset('member/css/common.css')}}">
	<link rel="stylesheet" href="{{asset('member/css/crowdafrik.css')}}">
	<!-- bootstrap  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <title>Campaingns</title>
</head>
<style type="text/css">
 /* Apply styles to the outermost <ol> element */
  ol {
    margin-left: 40px; /* Adjust the margin as desired */
  }
  
  /* Apply styles to each nested <ol> element */
  ol ol {
    margin-left: 40px; /* Adjust the margin as desired */
  }
  
  /* Apply styles to the list items */
  li {
    margin-bottom: 5px; /* Adjust the margin as desired */
  }
</style>
<body>
	<div class="category-image-section">
		<img src="{{asset($camp_cat->photo)}}" alt="">
		<!-- <div class="back-btn" onclick="window.location.href='/member/home/{{$mid}}'">
			<i class="ri-arrow-left-s-line"></i>
		</div> -->
	</div>
	<div class="container-main">
		<div class="row">
			<div class="col-lg-12">
				<div class="category-main-head-dv">
					<h5 class="mb-0 category-heading">{{$camp_cat->title}}</h5>
					<p class="category-sub-heading mb-0">{!! $camp_cat->description !!}</p>
				</div>
			</div>
			<!-- ------------>
			<div class="col-lg-12">
				<div class="category-grid-main-head-dv">
					<h5 class="grid-main-head-category mb-0">Ongoing Campaigns</h5>
				</div>
			</div>
			
			@foreach($camp as $c)
			<div class="col-4" style="cursor:pointer;" onclick="GetCamp('{{$c->id}}','{{$c->title}}','{{$c->fee}}')">
					

				<div class="grid-box-category">
					<h6>	<center><img src="{{asset($c->icon)}}" style="width:28px;padding-top: 5px;"></center></h6>
				<h6 class="grid-text-category mt-3">{{ Str::limit(($c->title), 15, '...') }}</h6>
				</div>
			</div>
			@endforeach
			
			<div id="camsec">
			
			<div class="col-lg-12">
                <div class="content-on-click-dv ">
                    <h6 class="head-textonclick mb-0">{{$campdet->title}}</h6>
               <br><h6 class="head-textonclick mb-0"><img style="border-radius: 10px;" src="{{asset($campdet->photo)}}"></h6>
                    <p class="text-on-click-content">{!! $campdet->description !!}</p>
                    {!! $campdet->content1 !!}
                    
                    <h3 class="text-on-click-content">Application Processing Fee : ₦ {{$campdet->fee}}</h3>
                </div>
            </div>
            
            <div class="col-lg-12 mt-2">
                <div class="apply-btn-category">
                    <h5 class="btn finish-application-btn primary-bg text-white mb-0" data-toggle="modal" data-target="#modal-fullscreen" style="background-color:red;color:white;">Proceed to application processing fee</h5>
                </div>
            </div>
            </div>
            <br><br>
                
            
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
					@php
					$uniqueId = time() . '-' . $campdet->id;
					@endphp
				<form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
					<div class="col-lg-12">
						<div class="form-group">
							<input type="text" class="form-control" id="cm" placeholder="" value="{{$campdet->title}}" readonly>
						</div>
					</div>
					<input type="hidden" name="public_key" value="FLWPUBK_TEST-716caf0cf2e24c6d481e47fb1d8e1578-X" />
					<input type="hidden" name="customer[name]" value="Arun" />
					<input type="hidden" name="customer[id]" value="1" />
					<input type="hidden" name="customer[camp]" value="5" />
					<input type="hidden" name="tx_ref" id="tx_ref" value="{{$uniqueId}}"/>
					<input type="hidden" name="amount" id="amount" value="{{$campdet->fee}}" />
					<input type="hidden" name="currency" value="NGN" />
  				<input type="hidden" name="meta[token]" value="54" />
  				<input type="hidden" name="redirect_url" value="https://portal.crowdafrik.com/member/app-payment/{{$mid}}" />
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
							<input type="submit" id="xxx" class=" btn btn-proceed-to-pay" name="submit" value="Proceed to application processing fee">
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- swipper slider js end  -->
</body>
</body>
</html>
<script type="text/javascript">
	$('#ab2').hide();

	    var scrollHeight = $(document).height();
				    var windowHeight = $(window).height();
				    var currentPosition = $(window).scrollTop();
				    var newPosition = currentPosition + windowHeight;

				    if (newPosition < scrollHeight) {
				      $("html, body").animate({ scrollTop: newPosition }, 500);
				    } else {
				      $("html, body").animate({ scrollTop: scrollHeight }, 500);
				    }

function dismissModal() {

 window.location.href=window.location.href;
	
}

function Payment() {

var campid=$('input#cmpid').val();
var uid='{{$mid}}';
 window.location.href='/member/app-payment/' + campid + '/' + uid;
	
}
	
	
  function GetCamp(val,title,fee)

            {
                	$('#cm').val(title);
                	$('#cmpid').val(val);
                	$('#amount').val(fee);
					var uniqueId = $.now() + '-' + val;
                	$('#tx_ref').val(uniqueId);


                 $.post("/member/get-camps", {cid: val,_token: "{{ csrf_token() }}"}, function(result) {

                  $('#camsec').html(result);

                  var scrollHeight = $(document).height();
				    var windowHeight = $(window).height();
				    var currentPosition = $(window).scrollTop();
				    var newPosition = currentPosition + windowHeight;

				    if (newPosition < scrollHeight) {
				      $("html, body").animate({ scrollTop: newPosition }, 500);
				    } else {
				      $("html, body").animate({ scrollTop: scrollHeight }, 500);
				    }
                });
            }

            function CloseModal() {
  $('#modal-fullscreen').modal('hide'); // Close the modal
  $('body').removeClass('modal-open'); // Remove the modal-open class from the body element to remove the background effects
  $('.modal-backdrop').remove(); // Remove the modal backdrop element
}


</script>



