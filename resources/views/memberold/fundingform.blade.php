@extends('layouts.Memeber')
@section('title') Funding Application @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<div class="back-btn-nav" onclick="window.location.href='home.html'">
					<i class="ri-arrow-left-s-line"></i>
				</div>
				<h5 class="page-name-nav mb-0">Fill up the form Enter details</h5>
			</div>
		</div>
	</div> -->

	<div class="modal modal-category-first modal-category-subt-dv fade modal-fullscreen" id="modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<i class="ri-close-line close" style="opacity: unset;font-weight: 200;float: left;" data-bs-dismiss="modal" aria-label="Close" onclick="CloseModal()"></i>
					<h5 class="text-center text-white text-modal-one">Do you want to  <br> cancel application</h5>
				<form>
					
					
					<div class="col-lg-12">
						<div class="form-group">
							<textarea class="form-control" id="reas" placeholder="Reason for cancellation"></textarea>
						</div>
					</div>
					
					<div class="col-lg-12 mt-5">
						<div class="pay-dv-on-modal">
							<!-- <h6 class="pay-on-modal">Proceed to pay</h6> -->
							<input type="button" class=" btn btn-proceed-to-pay" name="submits" value="Submit" onclick="Cancel()">
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	<!-- nav end  -->
	<div class="container-main">
		<div class="row mt-3">
		<div class="col-lg-12 mb-3">
			<div class="cancel-text">
				<a href="#" data-toggle="modal" data-target="#modal-fullscreen" class="cancel-text-form">Cancel</a>
			</div>
		</div>
			
			<!-- forms  -->
			<form class="funding-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="plan" placeholder="Campaign name" value="{{$appid->GetCamp->title}}" readonly>
					</div>
					
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="plot" placeholder="Plot size if farming">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="location" placeholder="Location of the intended business*">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="address" placeholder="Address of the intended business*">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="post" placeholder="Postcode/Town*">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="local_area" placeholder="Local Government Area*">
					</div>
				</div>
				<!-- <div class="col-lg-12">
					<div class="form-group">
						<label for="local_area" class="custom-file-upload">
  <input type="file" class="form-control" name="pdf_file" id="pdf_file" />
  
</label>

					</div>
				</div> -->
				<!-- <div class="col-md-6 col-xl-4">
					<div class="form-group">
						<div style="border-radius: 8px;padding: 3px;" class="input-group browse-btn">
							<span style="margin-left: 15px; color:#999; margin-top:6px;"  id="showFileName"></span>
							<span style="display: table;margin-left: auto;margin: 5px;border-radius: 5px;display: table;margin-left: auto;"  class="input-group-btn primary-bg">
								<label style="margin-bottom: 0px;font-weight: 400;padding: 4px 10px;border-radius: 7px;font-size: 14px;"  class="btn slava-primary-bg btn-file text-white" for="multiple_input_group">
									<div class="input required">
										<input class="custom-file-input input-browse-form" id="pdf_file" name="pdf_file" type="file" placeholder="Upload Profile Photo">
									</div>
									Browse
								</label>
							</span>
						</div>
					</div>
				</div> -->
				<div class="col-lg-12">
					<div class="btn-form-input mb-3">
						<input type="file" name="pdf_file" id="pdf_file" class="file-btn-append">
						<div class="input-append-main">
							<input type="text" name="file-name" id="file-name" class="file-name-btn-dv" readonly="readonly" placeholder="Upload document">
							<input type="button" class="btn" value="Browse" onclick="openFileSelector()">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="annual_turnover" placeholder="Estimated annual turnover">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="add-nominee-dv">
						<h6 class="nominee-main-head">Add 5 Guarantors*</h6>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- nomine form  -->
	<div class="container-main nominee-box-main">
		<div class="row">

			@if($nmcnt==0)


			<form class="add-nominee-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="n1" placeholder="Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="m1" placeholder="Phone number">
					</div>
				</div>
			</form>
			<form class="add-nominee-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="n2" placeholder="Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="m2" placeholder="Phone number">
					</div>
				</div>
			</form>
			<form class="add-nominee-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="n3" placeholder="Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="m3" placeholder="Phone number">
					</div>
				</div>
			</form>
			<form class="add-nominee-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="n4" placeholder="Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="m4" placeholder="Phone number">
					</div>
				</div>
			</form>
			<form class="add-nominee-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="n5" placeholder="Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="m5" placeholder="Phone number">
					</div>
				</div>
			</form>
			@else
			@php
			$i=1;
			@endphp
		@foreach($nom as $n)
			<form class="add-nominee-form">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="n{{$i}}" value="{{$n->name}}" placeholder="Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<input type="text" class="form-control" id="m{{$i}}" value="{{$n->mobile}}" placeholder="Phone number">
					</div>
				</div>
			</form>
			@php
			$i++;
			@endphp
			@endforeach

			@endif
			<div class="col-lg-12 mt-4">
				<div class="finish-btn-dv">
					
					<button type="button" class="btn finish-application-btn primary-bg text-white mb-0" onclick="Save()" id="ab1">Submit</button>
					<button class="btn finish-application-btn primary-bg text-white mb-0" id="ab2" disabled ><i class="fa fa-spinner fa-spin"></i>  Submit</button><br><br>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">


	function Cancel()
    {

      var reas=$('#reas').val();
    
      // if(reas=='')
      // {
      //   $('#reas').css('border','1px solid red');
      //   $('#reas').focus();
      //   return false;
      // }
      // else
      //   $('#reas').css('border','1px solid #000');

      data = new FormData();
      data.append('appid', '{{$appid->id}}');
      data.append('reas', reas);
  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/member/cancel-application",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
             
               Toastify({
						  text: "Cancelled successfully",
						  duration: 2000,
						  newWindow: true,
						  // close: true,
						  gravity: "bottom", // `top` or `bottom`
						  position: "center", // `left`, `center` or `right`
						  stopOnFocus: true, // Prevents dismissing of toast on hover
						  style: {
						    background: "linear-gradient(to right, green, green)",
						  },
						  callback: function () {
						   // alert("sss");
						    AppInterface.GoBack();
						  },
						}).showToast();
          }

        }
    
    
    
    
      })


     
}


      function CloseModal() {
  $('#modal-fullscreen').modal('hide'); // Close the modal
  $('body').removeClass('modal-open'); // Remove the modal-open class from the body element to remove the background effects
  $('.modal-backdrop').remove(); // Remove the modal backdrop element
}

function openFileSelector() {
			document.getElementById('pdf_file').click();
		}

	function Save()
    {

$('#ab2').hide();
      var plan=$('input#plan').val();
    
      if(plan=='')
      {
        $('#plan').css('border','1px solid red');
        $('#plan').focus();
        return false;
      }
      else
        $('#plan').css('border','1px solid #000');


      var plot=$('input#plot').val();



      var location=$('input#location').val();
    
      if(location=='')
      {
        $('#location').css('border','1px solid red');
        $('#location').focus();
        return false;
      }
      else
        $('#location').css('border','1px solid #000');


      var address=$('input#address').val();
    
      if(address=='')
      {
        $('#address').css('border','1px solid red');
        $('#address').focus();
        return false;
      }
      else
        $('#address').css('border','1px solid #000');

    var post=$('input#post').val();
    
      if(post=='')
      {
        $('#post').css('border','1px solid red');
        $('#post').focus();
        return false;
      }
      else
        $('#post').css('border','1px solid #000');

    var local_area=$('input#local_area').val();


    var annual_turnover=$('input#annual_turnover').val();
    
    var n1=$('input#n1').val();
    
      if(n1=='')
      {
        $('#n1').css('border','1px solid red');
        $('#n1').focus();
        return false;
      }
      else
        $('#n1').css('border','1px solid #000');


      var m1=$('input#m1').val();
    
      if(m1=='')
      {
        $('#m1').css('border','1px solid red');
        $('#m1').focus();
        return false;
      }
      else
        $('#m1').css('border','1px solid #000');

     var n2=$('input#n2').val();
    
      if(n2=='')
      {
        $('#n2').css('border','1px solid red');
        $('#n2').focus();
        return false;
      }
      else
        $('#n2').css('border','1px solid #000');


      var m2=$('input#m2').val();
    
      if(m2=='')
      {
        $('#m2').css('border','1px solid red');
        $('#m2').focus();
        return false;
      }
      else
        $('#m2').css('border','1px solid #000');

     var n3=$('input#n3').val();
    
      if(n3=='')
      {
        $('#n3').css('border','1px solid red');
        $('#n3').focus();
        return false;
      }
      else
        $('#n3').css('border','1px solid #000');


      var m3=$('input#m3').val();
    
      if(m3=='')
      {
        $('#m3').css('border','1px solid red');
        $('#m3').focus();
        return false;
      }
      else
        $('#m3').css('border','1px solid #000');

     var n4=$('input#n4').val();
    
      if(n4=='')
      {
        $('#n4').css('border','1px solid red');
        $('#n4').focus();
        return false;
      }
      else
        $('#n4').css('border','1px solid #000');


      var m4=$('input#m4').val();
    
      if(m4=='')
      {
        $('#m4').css('border','1px solid red');
        $('#m4').focus();
        return false;
      }
      else
        $('#m4').css('border','1px solid #000');

     var n5=$('input#n5').val();
    
      if(n5=='')
      {
        $('#n5').css('border','1px solid red');
        $('#n5').focus();
        return false;
      }
      else
        $('#n5').css('border','1px solid #000');


      var m5=$('input#m5').val();
    
      if(m5=='')
      {
        $('#m5').css('border','1px solid red');
        $('#m5').focus();
        return false;
      }
      else
        $('#m5').css('border','1px solid #000');



     $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('userid', '{{$mid}}');
      data.append('ci', '{{$cid}}');
      data.append('appid', '{{$appid->id}}');
      data.append('plan', plan);
      data.append('plot', plot);
      data.append('location', location);
      data.append('address', address);
      data.append('post', post);
      data.append('local_area', local_area);
      data.append('annual_turnover', annual_turnover);
      data.append('n1', n1);
      data.append('n2', n2);
      data.append('n3', n3);
      data.append('n4', n4);
      data.append('n5', n5);
      data.append('m1', m1);
      data.append('m2', m2);
      data.append('m3', m3);
      data.append('m4', m4);
      data.append('m5', m5);
      data.append('img', $('#pdf_file')[0].files[0]);

  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/member/submit-application",
         data: data,
        dataType:"json",
        contentType: false,
//cache: false,
processData: false,
       
        success:function(data)
        {
          if(data['success'])
          {
              $('#ab2').hide();
              $('#ab1').show();

              window.location.href='/member/form-success' + '/' + '{{$mid}}'
              
               // Toastify({
			// 			  text: "Updated successfully",
			// 			  duration: 2000,
			// 			  newWindow: true,
			// 			  // close: true,
			// 			  gravity: "bottom", // `top` or `bottom`
			// 			  position: "center", // `left`, `center` or `right`
			// 			  stopOnFocus: true, // Prevents dismissing of toast on hover
			// 			  style: {
			// 			    background: "linear-gradient(to right, green, green)",
			// 			  },
			// 			  callback: function () {
			// 			   // alert("sss");
			// 			   window.location.href=window.location.href
			// 			  },
			// 			}).showToast();
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    }

</script>


@endsection