@extends('layouts.Memeber')
@section('title') search.hide @endsection
@section('content')
	<!-- search bar -->
	<div class="container-main">
		<div class="row">
			<div class="col-12 mt-4">
				<div class="inner-col-search">
					<i class="ri-close-line yamama-color pr-2" onclick="CloseSearch()"></i>
					<form class="search-wrapper cf">
						<input type="text" placeholder="Search here..." style="box-shadow: none" oninput="Search()" id="s1">
						<!-- <button type="submit">Search</button> -->
					</form>
				</div>
				<hr>
				<!-- suggestion search  -->
				<div class="suggesttion-search" id="Searchsec">
					
					
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

		function Search()

            {
                	var cat=$('input#s1').val();
                	var mid='{{$mid}}';
                
                 $.post("/member/get-cat", {cat: cat,mid: mid,_token: "{{ csrf_token() }}"}, function(result) {

                  $('#Searchsec').html(result);
             });
             }     
	</script>
@endsection