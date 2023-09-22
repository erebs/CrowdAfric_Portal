@extends('layouts.Memeber')
@section('title') search.hide @endsection
@section('content')
	<!-- search bar -->
	<div class="container-main">
		<div class="row">
			<div class="col-12 mt-4">
				<div class="inner-col-search search-fixed ">
					<i class="ri-close-line yamama-color pr-2" onclick="CloseSearch()"></i>
					<form class="search-wrapper cf">
						<input type="text" placeholder="Search here..." style="box-shadow: none" oninput="Search()" id="s1">
						
					</form>
				</div>
				<hr>
				<!-- suggestion search  -->
				<div class="suggesttion-search" id="Searchsec" style="margin-top:60px;">
					
					@foreach($cont as $c)
						<h6 class="suggestion-name" onclick="GetCon('{{$c->id}}','{{$c->name}}','{{$c->mobile_code}}')"><a style="color:grey !important;text-decoration: none;">{{$c->name}}</a></h6>
                    		<hr>
                    		@endforeach
					
				</div>
				<!-- suggestion search  -->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
		function CloseSearch()
		{
			AppInterface.GoBack();
		}

		function GetCon(id,name,code)
		{
			// alert(id);
			// alert(name);
			// alert(code);

			AppInterface.conSearch(id,name,code);
		}


		
		//AppInterface.stateSearch('id');


		function Search()

            {
                	var cn=$('input#s1').val();
                	
                
                 $.post("/member/get-cont", {cn: cn,_token: "{{ csrf_token() }}"}, function(result) {

                  $('#Searchsec').html(result);
             });
             }     
	</script>
@endsection