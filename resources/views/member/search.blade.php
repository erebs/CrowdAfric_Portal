@extends('layouts.Memeber')
@section('title') search.hide @endsection
@section('content')
<style type="text/css">
/* Reset default list styles */
ol, ul {
    list-style-type: none;
    padding: 0;
    margin-left: 10px;

}

/* Style the first-level list items */
ol > li {
    margin-bottom: 10px; /* Optional spacing between first-level list items */
}

/* Style the second-level list items */
ol > li > ol > li {
    margin-left: 20px; /* Add indentation to the second-level list items */
}


</style>
	<!-- search bar -->
	<div class="container-main">
		<div class="row">
			<div class="col-12 mt-4">
				<div class="inner-col-search search-fixed">
					<i class="ri-close-line yamama-color pr-2" onclick="CloseSearch()"></i>
					<form class="search-wrapper cf">
				<input type="text" placeholder="Search here..." style="box-shadow: none" oninput="Search()" id="s1">
						<!-- <button type="submit">Search</button> -->
					</form>
				</div>
				<hr>
				<!-- suggestion search  -->
				<div class="suggesttion-search" id="Searchsec" style="margin-top: 60px;">

					@if(sizeof($camp_cat))
			           
			          <h5 class="suggestion-name">* categories</h5>
			            @foreach($camp_cat as $c)
			            
					<h6 class="suggestion-name"><img style="width:25px;" src="{{asset($c->icon)}}"> &nbsp&nbsp   <a href="/member/campaigns/{{$c->id}}/{{$mid}}" style="color:grey !important;text-decoration: none;">{{$c->title}}</a></h6>
                    	<hr>
                    	@endforeach
                    	@endif

                    	@if(sizeof($camp_cat))

                    <h5 class="suggestion-name">* Campaigns</h5>
                    @foreach($camp as $cm)
                    <h6 class="suggestion-name"><img style="width:25px;" src='{{asset($cm->icon)}}'> &nbsp&nbsp   <a href="/member/campaigns-select/{{$cm->cat_id}}/{{$mid}}/{{$cm->id}}" style="color:grey !important;text-decoration: none;">{{$cm->title}}</a></h6>
                    <hr>
                    @endforeach
                    	@endif
    	

   
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


                
                 $.post("/member/get-cat", {cat:cat,mid:mid,_token: "{{ csrf_token() }}"}, function(result) {

                  $('#Searchsec').html(result);
             });
             }     
	</script>
@endsection