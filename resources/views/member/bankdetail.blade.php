@extends('layouts.Memeber')
@section('title') Bank Details @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<div class="back-btn-nav" onclick="window.location.href='/member/profile/{{$mid}}'">
					<i class="ri-arrow-left-s-line"></i>
				</div>
				<h5 class="page-name-nav mb-0">Bank Details</h5>
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
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Account number</label>
							<input type="number" class="form-control" id="acc_num" placeholder="" value="{{$member->acc_num}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">IFSC Code</label>
							<input type="text" class="form-control" id="ifsc_code" placeholder="" value="{{$member->ifsc_code}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Account holder name</label>
							<input type="text" class="form-control" id="acc_name" placeholder="" value="{{$member->acc_name}}">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv">
							<label for="exampleFormControlInput1" class="label-form-common mb-0">Branch</label>
							<input type="text" class="form-control" id="acc_branch" placeholder="" value="{{$member->acc_branch}}">
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
      var acc_num=$('input#acc_num').val();
    
      if(acc_num=='')
      {
        $('#acc_num').css('border','1px solid red');
        $('#acc_num').focus();
        return false;
      }
      else
        $('#acc_num').css('border','1px solid #000');


      var ifsc_code=$('input#ifsc_code').val();
    
      if(ifsc_code=='')
      {
        $('#ifsc_code').css('border','1px solid red');
        $('#ifsc_code').focus();
        return false;
      }
      else
        $('#ifsc_code').css('border','1px solid #000');


      var acc_name=$('input#acc_name').val();
    
      if(acc_name=='')
      {
        $('#acc_name').css('border','1px solid red');
        $('#acc_name').focus();
        return false;
      }
      else
        $('#acc_name').css('border','1px solid #000');


      var acc_branch=$('input#acc_branch').val();
    
      if(acc_branch=='')
      {
        $('#acc_branch').css('border','1px solid red');
        $('#acc_branch').focus();
        return false;
      }
      else
        $('#acc_branch').css('border','1px solid #000');


     $('#ab1').hide();
      $('#ab2').show();

      data = new FormData();
      data.append('userid', '{{$mid}}');
       data.append('acc_name', acc_name);
        data.append('acc_num', acc_num);
        data.append('acc_branch', acc_branch);
         data.append('ifsc_code', ifsc_code);

  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/member/bankdet-update",
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
						  },
						}).showToast();
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    }

</script>



@endsection