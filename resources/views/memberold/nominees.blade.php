@extends('layouts.Memeber')
@section('title') Guarantors @endsection
@section('content')
	<!-- nav  -->
	<!-- <div class="navigation-top">
		<div class="container-main">
			<div class="nav-main-top">
				<div class="back-btn-nav" onclick="window.location.href='/member/profile/{{$mid}}'">
					<i class="ri-arrow-left-s-line"></i>
				</div>
				<h5 class="page-name-nav mb-0">Guarantors</h5>
			</div>
		</div>
	</div> -->
	<!-- nav end  --> 
	<div class="container-main mt-3">
		<div class="row">
			<form class="form-bank-details nomine-dv-main">
				<div class="form-group">
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="text" class="form-control" id="n1" placeholder="Name">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="number" class="form-control" id="m1" placeholder="Mobile Number">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-------------------------- -->
	<div class="container-main mt-4">
		<div class="row">
			<form class="form-bank-details nomine-dv-main">
				<div class="form-group">
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="text" class="form-control" id="n2" placeholder="Name">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="number" class="form-control" id="m2" placeholder="Mobile Number">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-------------------------- -->
	<div class="container-main mt-4">
		<div class="row">
			<form class="form-bank-details nomine-dv-main">
				<div class="form-group">
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="text" class="form-control" id="n3" placeholder="Name">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="number" class="form-control" id="m3" placeholder="Mobile Number">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
		<!-------------------------- -->
		<div class="container-main mt-4">
			<div class="row">
				<form class="form-bank-details nomine-dv-main">
					<div class="form-group">
						<div class="col-lg-12">
							<div class="form-main-dv-nominee">
								<input type="text" class="form-control" id="n4" placeholder="Name">
								<i class="ri-edit-2-line"></i>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-main-dv-nominee">
								<input type="number" class="form-control" id="m4" placeholder="Mobile Number">
								<i class="ri-edit-2-line"></i>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
			<!-------------------------- -->
	<div class="container-main mt-4">
		<div class="row">
			<form class="form-bank-details nomine-dv-main">
				<div class="form-group">
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="text" class="form-control" id="n5" placeholder="Name">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-main-dv-nominee">
							<input type="number" class="form-control" id="m5" placeholder="Mobile Number">
							<i class="ri-edit-2-line"></i>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="col-lg-12 mt-4">
				<div class="apply-btn-category">
					<button type="button" class="btn finish-application-btn primary-bg text-white mb-0" onclick="Save()" id="ab1">Submit</button>
					<button class="btn finish-application-btn primary-bg text-white mb-0" id="ab2" disabled ><i class="fa fa-spinner fa-spin"></i>  Submit</button>
				</div>
			</div><br><br>
	<!-- scripts  -->

<script type="text/javascript">
	function Save()
    {
    
$('#ab2').hide();
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

  data.append('_token', "{{ csrf_token() }}");
    
      $.ajax({
    
        type:"POST",
        url:"/member/add-nominee",
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
						  text: "Guarantors added successfully",
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
						   //window.location.href=window.location.href
						  },
						}).showToast();
          }

        }
    
    
    
    
      })
    
    
    
    
    
    
    }

</script>



@endsection