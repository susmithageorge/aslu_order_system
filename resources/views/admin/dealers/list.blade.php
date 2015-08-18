@extends('layouts.admin')
@section('page_heading','Listing dealers')
@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-sm-12">
    	  <div id="ajax_loading" class="col-sm-8"></div>	
    	  <div class="col-sm-4">
		   <a href="#" id="sync_dealers" class="btn btn-default pull-right" >Sync dealers</a>
		  </div> 
    </div>
</div>
<hr/>
<div class="row" id="server_listing">
@include('admin._partials.notifications')
@if($dealers)
	<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>PMID</th>
						<th>Name</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($dealers as $key => $dealer)
					<tr>
						<tr >
						<td style="width:5% !important;">{{$dealer->id}}</td>
						<td>{{$dealer->party_master_id}}</td>
						<td>{{$dealer->name}}</td>
						<td>{{$dealer->address}}</td>
						<td style="width:15% !important;">
						<div style="float:left;">	
							<a href="{{URL::to('admin/dealer/' .$dealer->id . '/edit')}}" class="btn-link btn"><i class="fa fa-pencil fa-fw"></i></a>
							{{ Form::open(['url' => ['admin/dealer/' .$dealer->id . '/delete'], 'method' => 'delete', "class" => "pull-right"]) }}
								<button class="btn-link btn" type="submit" onclick="return confirm('Do you want to delete this?')"><i  class="fa fa-trash fa-fw"></i></button>
							{{ Form::close() }}
							<!--<a href="{{URL::to('admin/sub_dealer/add/' .$dealer->id)}}" class="btn-link btn" title="Add sub dealer"><i class="fa fa-glass fa-fw"></i></a>-->
						</div>	
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>	
			{{ $dealers->render() }}
		</div>
	
	@else
	    <div class="alert alert-warning " role="alert">
	        <i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  There is nothing to show.
	    </div>
	@endif	
	</div>
</div>
@endsection
