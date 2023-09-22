@extends('layouts.Memeber')
@section('title') Contact us @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<div class="back-btn-nav" onclick="window.location.href='/member/profile/{{$mid}}'">
					<i class="ri-arrow-left-s-line"></i>
				</div>
				<h5 class="page-name-nav mb-0">About us</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  --> 
	<!-- about us content  -->
	<div class="container-main">
		<div class="row">
			
			<!-- about us conetnt  -->
			<div class="col-lg-12">
				<div class="about-us-detail-content">

				<br>

				<form class="form-bank-details">
				<div class="form-group">
					
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Subject</label>
							<input type="text" class="form-control" id="subject" placeholder="" value="">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Message</label>
							<textarea class="form-control" id="msg" rows="3"></textarea>
						</div>
					</div>
					<div class="col-lg-12 mt-4">
				<div class="apply-btn-category">
					<button type="button" class="btn finish-application-btn primary-bg text-white mb-0" onclick="Save()" id="ab1">Submit</button>
					<button class="btn finish-application-btn primary-bg text-white mb-0" id="ab2" disabled ><i class="fa fa-spinner fa-spin"></i>  Submit</button>
				</div>
			</div>

				</div>
			</form>

			<br>
					
				<p>Or please feel free to contact us at any time by email <a href="mailto:contact@crowdafrik.com">contact@crowdafrik.com</a></p>
					
				</div>

				

			</div>
		</div>
	</div>
	<!-- about us conetnt end  -->
<script type="text/javascript">
	function Save()
    {
    
		$('#ab2').hide();
      var subject=$('input#subject').val();
    
      if(subject=='')
      {
        $('#subject').css('border','1px solid red');
        $('#subject').focus();
        return false;
      }
      else
        $('#subject').css('border','1px solid #000');


      var msg=$('#msg').val();
    
      if(msg=='')
      {
        $('#msg').css('border','1px solid red');
        $('#msg').focus();
        return false;
      }
      else
        $('#msg').css('border','1px solid #000');



     $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('userid', '{{$mid}}');
       data.append('subject', subject);
        data.append('msg', msg);


  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/member/contact-request",
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
              
               Toastify({
						  text: "Submitted successfully",
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
						  // window.location.href=window.location.href
						  	$('#msg').val('');
						  	$('#subject').val('');
						  },
						}).showToast();
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    }
</script>



@endsection