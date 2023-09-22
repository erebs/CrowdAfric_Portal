@extends('layouts.Memeber')
@section('title') Personal Details @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<div class="back-btn-nav" onclick="window.location.href='/member/profile/{{$mid}}'">
					<i class="ri-arrow-left-s-line"></i>
				</div>
				<h5 class="page-name-nav mb-0">Personal Details</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  --> 

	<div class="container-main mt-3">
		<div class="row">
			<form class="form-bank-details">
				<div class="form-group">
					
					
					
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Age</label>
							<input type="number" class="form-control" id="age" placeholder="" value="{{$member->age}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Town </label>
							<input type="text" class="form-control" id="town" placeholder="" value="{{$member->town}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Post Code </label>
							<input type="text" class="form-control" id="postcode" placeholder="" value="{{$member->post_code}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Community </label>
							<input type="text" class="form-control" id="community" placeholder="" value="{{$member->community}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Address</label>
							<textarea class="form-control" id="address" rows="3">{{$member->address}}</textarea>
							<i class="ri-edit-2-line"></i>
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
		</div>
	</div>
	<!-- scripts  -->

<script type="text/javascript">
	function Save()
    {
    
$('#ab2').hide();
      var age=$('input#age').val();
    
      if(age=='')
      {
        $('#age').css('border','1px solid red');
        $('#age').focus();
        return false;
      }
      else
        $('#age').css('border','1px solid #000');


      var town=$('input#town').val();
    
      if(town=='')
      {
        $('#town').css('border','1px solid red');
        $('#town').focus();
        return false;
      }
      else
        $('#town').css('border','1px solid #000');


      var postcode=$('input#postcode').val();
    
      if(postcode=='')
      {
        $('#postcode').css('border','1px solid red');
        $('#postcode').focus();
        return false;
      }
      else
        $('#postcode').css('border','1px solid #000');


      var community=$('input#community').val();
    
      if(community=='')
      {
        $('#community').css('border','1px solid red');
        $('#community').focus();
        return false;
      }
      else
        $('#community').css('border','1px solid #000');

      var address=$('#address').val();
    
      if(address=='')
      {
        $('#address').css('border','1px solid red');
        $('#address').focus();
        return false;
      }
      else
        $('#address').css('border','1px solid #000');


     $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('userid', '{{$mid}}');
       data.append('age', age);
        data.append('town', town);
        data.append('postcode', postcode);
         data.append('community', community);
        data.append('address', address);

  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/member/personaldet-update",
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
						  text: "Updated successfully",
						  duration: 3000,
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
						  },
						}).showToast();
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    }

</script>



@endsection