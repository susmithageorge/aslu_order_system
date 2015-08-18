@extends('layouts.admin')
@section('page_heading','Listing products')
@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-sm-12">
    	  <div id="ajax_loading" class="col-sm-8"></div>	
    	  <div class="col-sm-4">
		   <a href="#" id="sync_products" class="btn btn-default pull-right" >Sync products</a>
		  </div> 
    </div>
</div>
<hr/>
<div class="row" id="server_listing">
@include('admin._partials.notifications')
@if($products)
	<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>ItID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Manufacturer</th>
						<th>MRP</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($products as $key => $product)
					<tr>
						<tr >
						<td style="width:5% !important;">{{$product->id}}</td>
						<td>{{$product->itemmaster_id}}</td>
						<td>{{$product->code}}</td>
						<td>{{$product->name}}</td>
						<td>{{$product->manufacturer->name}}</td>
						<td>{{number_format($product->max_retail_price, 2)}}</td>
						<td style="width:15% !important;">
						<div style="float:left;">	
							<a href="{{URL::to('admin/product/' .$product->id . '/edit')}}" class="btn-link btn"><i class="fa fa-pencil fa-fw"></i></a>
							{{ Form::open(['url' => ['admin/product/' .$product->id . '/delete'], 'method' => 'delete', "class" => "pull-right"]) }}
								<button class="btn-link btn" type="submit" onclick="return confirm('Do you want to delete this?')"><i  class="fa fa-trash fa-fw"></i></button>
							{{ Form::close() }}
							<!--<a href="{{URL::to('admin/sub_product/add/' .$product->id)}}" class="btn-link btn" title="Add sub product"><i class="fa fa-glass fa-fw"></i></a>-->
						</div>	
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>	
			{{ $products->render() }}
		</div>
	
	@else
	    <div class="alert alert-warning " role="alert">
	        <i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  There is nothing to show.
	    </div>
	@endif	
	</div>
</div>
@endsection
