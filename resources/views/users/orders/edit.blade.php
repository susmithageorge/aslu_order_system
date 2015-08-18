@extends('admin/layout/default')
@section('page_title', 'Edit Cities')
@section('page_description', 'Edit cities')
@section('content')
<div class="main-content">
		<div class="main-content-inner">
			<!-- #section:basics/content.breadcrumbs -->
			<div class="breadcrumbs" id="breadcrumbs">
				{!! Breadcrumbs::render('admin_cities_edit') !!}
				<!-- #section:basics/content.searchbox -->
				<div class="nav-search" id="nav-search">
					<form class="form-search" method="post" action="{{ url('admin/cities/search') }}">
						{!! csrf_field() !!}
						<span class="input-icon">
							<input type="text" name="key" placeholder="Search ..." class="nav-search-input" autocomplete="off" />
							<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span> 
					</form>
				</div>
				<!-- /section:basics/content.searchbox -->
			</div>
			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
			<!-- #section:settings.box -->
			<!-- /.ace-settings-container -->
			<!-- /section:settings.box -->
			<div class="row">
				@include ('admin._partials.page_header')
				<div class="col-xs-12">
					<!-- Notifications -->
					@include ('partials.notifications')
					<!-- ./ notifications -->
					<!-- PAGE CONTENT BEGINS -->
					<div class="row">
						<div class="col-sm-8">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">Edit Cities</h4>
								</div>
							<div class="widget-body">
						<div class="widget-main no-padding">
						<form method="post" action="{{ url('admin/cities/post_edit') }}" >
						<!-- <legend>Form</legend> -->
							<div class="widget-main">
								{!! csrf_field() !!}
										<div class="space space-8"></div>
											<input type="hidden" name="id" value="{{ $cities->id }}" />
						 	<label for="type">Country</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
			{!! Form::select('country',$countries,$cities->country_id,array("class"=>"form-control", "id"=>"countries_list")) !!}							
									</div>
								</div>
								
									<label for="from">City</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
										<input type="text" class="form-control" name="city" placeholder="From" value="{{ Input::old('city' , $cities->city ) }}" required />
									</div>
								</div>
								<label for="from">Other Names</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
										<input type="text" multiple="" class="form-control" name="other_names[]" class="select2" placeholder="Other names" value="{{ Input::old('other_names' , jsonTocomma($cities->other_names) ) }}" required />
									</div>
								</div>
									<label for="name">State Code</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
										<input type="text" class="form-control" name="statecode" placeholder="State code" value="{{ Input::old('state_code' , $cities->state_code ) }}" required />
									</div>
								</div>
									<label for="name">Zip code</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
										<input type="text" class="form-control" name="zipcode" placeholder="Zip code" value="{{ Input::old('zip' , $cities->zip ) }}" required />
									</div>
								</div>
									<label for="name">Latitude</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
										<input type="text" class="form-control" name="latitude" placeholder="Latitude" value="{{ Input::old('latitude' , $cities->latitude ) }}" required />
									</div>
								</div>
									<label for="name">Longitude</label>
								<div class="row">
									<div class="col-xs-8 col-sm-11">
										<input type="text" class="form-control" name="longitude" placeholder="Longitude" value="{{ Input::old('longitude' , $cities->longitude ) }}" required />
									</div>
								</div>
							</div>
								<div class="form-actions center">
										<a href="{{ URL::to('admin/cities/index') }}"> <button type="button" class="btn btn-link pull-left">Cancel
				                     	<i class="ace-icon icon-on-right bigger-110"></i>
					                  </button></a>
							            &nbsp;
								<button type="submit" class="btn btn-sm btn-success">
									Submit
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
	</div><!-- /.row -->
	</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->
</script>
<style type="text/css"> 
#s2id_admin{
	width:615px;
}
</style>
<script src="{{ asset('assets/themes/backend/js/select2.js') }}"></script>
<script type="text/javascript">
	jQuery(function($) {
		$('.select2').css('width','615px').select2({allowClear:true})
		$('#select2-multiple-style .btn').on('click', function(e){
			var target = $(this).find('input[type=radio]');
			var which = parseInt(target.val());
			if(which == 2) $('.select2').addClass('tag-input-style');
			else $('.select2').removeClass('tag-input-style');
		});
	});
</script>
@endsection