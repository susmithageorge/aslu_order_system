@extends('layouts.admin')
@section('page_heading','Listing orders')
@section('section')
<div class="col-sm-12">
<div class="row" id="server_listing">
@if($orders)
	<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th># ID</th>
						<th>Dealer</th>
						<th>Name</th>
						<th style="width:10% !important;">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($orders as $key => $order)
					<tr>
						<tr >
						<td style="width:5% !important;">{{$order->id}}</td>
						<td>{{$order->dealer->name}}</td>
						<td>{{$order->name}}</td>
						<td >
						<div style="float:left;">	
							<a href="{{URL::to('admin/order/' .$order->id . '/view')}}" class="btn-link btn"><i class="fa fa-pencil fa-fw"></i> View order</a>
							{{ Form::open(['url' => ['admin/order/' .$order->id . '/delete'], 'method' => 'delete', "class" => "pull-right"]) }}
								<button class="btn-link btn" type="submit" onclick="return confirm('Do you want to delete this?')"><i  class="fa fa-trash fa-fw"></i></button>
							{{ Form::close() }}
							<!--<a href="{{URL::to('admin/sub_order/add/' .$order->id)}}" class="btn-link btn" title="Add sub order"><i class="fa fa-glass fa-fw"></i></a>-->
						</div>	
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>	
			{{ $orders->render() }}
		</div>
	
	@else
	    <div class="alert alert-warning " role="alert">
	        <i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  There is nothing to show.
	    </div>
	@endif	
	</div>
</div>
@endsection
