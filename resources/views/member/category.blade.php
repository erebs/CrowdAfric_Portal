@extends('layouts.Memeber')
@section('title') Campaigns @endsection
@section('content')
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
							<input type="text" class="form-control" id="cm" placeholder="" readonly>
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
							<input type="submit" class=" btn btn-proceed-to-pay" name="submit" value="Proceed to application processing fee">
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">

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


@endsection
