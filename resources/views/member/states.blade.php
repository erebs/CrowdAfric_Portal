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
					
					@foreach($st as $s)
						<h6 class="suggestion-name" onclick="GetState('{{$s->id}}','{{$s->name}}')"><a style="color:grey !important;text-decoration: none;">{{$s->name}}</a></h6>
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

		function GetState(id,name)
		{
			 // alert(id);
			 // alert(name);

			AppInterface.stateSearch(id,name);
		}

		function Search()

            {
                	var st=$('input#s1').val();
                	var cn='{{$cid}}';
                	
                
                 $.post("/member/get-st", {st: st,cn: cn,_token: "{{ csrf_token() }}"}, function(result) {

                  $('#Searchsec').html(result);
             });
             }     
	</script>
@endsection