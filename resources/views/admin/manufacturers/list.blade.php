@extends('layouts.admin')
@section('page_heading','Listing manufacturers')
@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-sm-12">
    	  <div id="ajax_loading" class="col-sm-8"></div>	
    	  <div class="col-sm-4">
		   <a href="#" id="sync_manufacturers" class="btn btn-default pull-right" >Sync manufacturers</a>
		  </div> 
    </div>
</div>
<hr/>
<div class="row" id="server_listing">
@include('admin._partials.notifications')
@if($manufacturers)
	<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>IMID</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($manufacturers as $key => $manufacturer)
					<tr>
						<tr >
						<td style="width:5% !important;">{{$manufacturer->id}}</td>
						<td>{{$manufacturer->itemmaster_id}}</td>
						<td>{{$manufacturer->name}}</td>
						<td style="width:15% !important;">
						<div style="float:left;">	
							<a href="{{URL::to('admin/manufacturer/' .$manufacturer->id . '/edit')}}" class="btn-link btn"><i class="fa fa-pencil fa-fw"></i></a>
							{{ Form::open(['url' => ['admin/manufacturer/' .$manufacturer->id . '/delete'], 'method' => 'delete', "class" => "pull-right"]) }}
								<button class="btn-link btn" type="submit" onclick="return confirm('Do you want to delete this?')"><i  class="fa fa-trash fa-fw"></i></button>
							{{ Form::close() }}
							<!--<a href="{{URL::to('admin/sub_manufacturer/add/' .$manufacturer->id)}}" class="btn-link btn" title="Add sub manufacturer"><i class="fa fa-glass fa-fw"></i></a>-->
						</div>	
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>	
			{{ $manufacturers->render() }}
		</div>
	
	@else
	    <div class="alert alert-warning " role="alert">
	        <i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  There is nothing to show.
	    </div>
	@endif	
	</div>
</div>
@endsection
