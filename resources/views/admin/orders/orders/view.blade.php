@extends('users.users')
@section('content')
<!-- PAGE CONTENT BEGINS -->
<div class="container">
	<div class="row">
		<div class="col-sm-11">
			<div class="panel panel-default">
				<div class="panel-heading">Order #{{$order->id}}-{{$order->name}}</div>

				<div class="panel-body">
					@include ('admin._partials.notifications')
					<!-- ./ notifications -->
								<div class="row container-fluid">
								  <div class="col-md-5">
								  	<label for="from">Dealer</label>
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											{{$order->dealer->name}}
										</div>
									</div>
								  </div>
								  <div class="col-md-5">
								  	<label for="from">Manufacturer</label>
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											{{$order->manufacturer->name}}
										</div>
									</div>	
								  </div>
								  <div class="col-md-2">
								  	<label for="from">Added by</label>
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											{{$order->user->name}}
										</div>
									</div>	
								  </div>
								</div>
								<div class="row" >
									<div class="col-md-12 table-responsive" id="">
											<br/>
											<table class="table table-bordered" id="item_list_table">
											<tr>
												<th>##</th>
												<th width="40%">Prod Name</th>
												<th width="15%">Quantity</th>
												<th class="hidden-480">Remarks</th>
												<th width="5%"  >MRP</th>
												<th width="5%"  >Price</th>
											</tr>
											@foreach($order->items as $i=>$item)
												<tr class="tr_list_items">
													<td>{{$i+1}}</td>
													<td>{{$item->name}}</td>
													<td>{{$item->quantity}}</td>
													<td class="hidden-480">{{$item->remarks}}</td>
													<td>{{number_format($item->product->max_retail_price, 2)}}</td>
													<td>{{number_format($item->price, 2)}}/-</td>
												</tr>
											@endforeach
										</table>
									</div>				
								</div>		
								<div class="row">
									<div class="col-md-6">
										{{ Form::open(array('method'=> 'DELETE', 'route' => array('userordersdestroy', $order->id))) }}
				                        	<button  data-placement="left" data-toggle="tooltip" title="Delete order" type="submit" class="btn btn-warning" onclick="return confirm('Do you want to delete this order ?')"><i class="fa fa-trash-o"></i> Delete</button>
										{{ Form::close() }}	
									</div>
									<div class="col-md-6">
										<a class="btn btn-primary pull-right" href="{{URL::to('/users/orders/' . $order->id . '/export')}}">Export to xls</a>
		                            	<a class="btn btn-link pull-right" href="{{URL::to('/users/orders')}}">Cancel</a>
	                    			</div>
	                    		</div>	
	            </div><!-- /.box -->
	        </div>
		</div>
	</div>
</div>
<link href="{{ asset('/public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/public/assets/js/bootstrap-select.min.js')}}"></script>
<style>
.price_box {
  outline: none;
  border: none !important;
  -webkit-box-shadow: none !important;
  -moz-box-shadow: none !important;
  box-shadow: none !important;
}
</style>
@endsection