@extends('admin/layout/default')
@section('page_title', 'Cities')
@section('page_description', 'Search results')
@section('content')
@if($auth_user = Auth::user()) @endif
<div class="main-content">
		<div class="main-content-inner">
			<!-- #section:basics/content.breadcrumbs -->
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>
				{!! Breadcrumbs::render('admin_cities_search') !!}
				<!-- /.breadcrumb -->
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
			</div><!-- /.nav-search -->
			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<!-- #section:settings.box -->
				<!-- /.ace-settings-container -->
				<!-- /section:settings.box -->
				@include ('admin._partials.page_header')
				<div class="row">
					<div class="col-xs-12">
						<!-- Notifications -->
						@include ('partials.notifications')
						<!-- ./ notifications -->
						<!-- PAGE CONTENT BEGINS -->
						<div class="row">
	                        <div class="col-xs-12 " >
									<table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
		                                            <th  width="5%" class="hidden-480">#</th>
		                                            <th>City</th>
		                                            <th>Country</th>
		                                            <th>Other Names</th>
		                                            <th width="10%">Zip</th>
		                                            <th class="hidden-480">Latitude</th>
		                                            <th class="hidden-480">Longitude</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($cities as $city)
	                                        	<tr  class="table-tr-bg-{{{$city->id}}}">
		                                            <td class="hidden-480">{{{ $city->id }}}</td>
		                                            <td>{{{ $city->city }}}</td>
		                                            <td>{{{ $city->country }}}</td>
		                                           <td class="hidden-480">
		                                            	@if(!empty($city->other_names))
		                                            		@if ($city->other_names = jsonTocomma($city->other_names)) @endif
		                                            		{{{ $city->other_names }}}
		                                            	@endif
		                                            </td>
		                                            <td>{{{ $city->zip }}}</td>
		                                            <td class="hidden-480">{{{ $city->latitude }}}</td>
		                                            <td class="hidden-480">{{{ $city->longitude }}}</td>
		                                            <td style="width:15%">
		                                            	<div class="btn-group" style="width:100%;">
			                                            		@if($auth_user->user_role_id == 1 || $auth_user->user_role_id == 2)
			                                            			<a data-toggle="tooltip"  class="btn btn-link btn-sm"title="Edit city" href="{{URL::to('/admin/cities/' . $city->id . '/edit')}}" ><i class="fa fa-pencil"></i></a>
			                                            		@endif
																@if($auth_user->user_role_id == 1)
			                                            			{!! Form::open(array('method'=> 'DELETE', 'route' => array('admincitiesdestroy', $city->id))) !!}
				                                            			<button  data-placement="left" data-toggle="tooltip" title="Delete city" type="submit" class="btn btn-link btn-sm" onclick="return confirm('Do you want to delete this city ?')"><i class="fa fa-trash-o"></i></button>
															    	{!! Form::close() !!}
															    @endif
			                                                </div>
		                                            </td>
		                                        </tr>
	                                        @endforeach
											</tbody>
										</table>
	                                    {!! $cities->render() !!}
	                            </div><!-- /.box -->
	                        @if($auth_user->user_role_id == 1 || $auth_user->user_role_id == 2)
	                        	</div>
	                        		<a href="{{ URL::to('admin/cities/add') }}" class="btn btn-info btn-sm pull-right">Add new city</a>
								</div>
							@endif
							<!-- PAGE CONTENT ENDS -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.page-content -->
		</div>
</div><!-- /.main-content --> 
@endsection
