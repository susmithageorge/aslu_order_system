@extends('layouts.admin')
@section('page_heading','Listing orders - Admin')
@section('section')
<!-- PAGE CONTENT BEGINS -->
<div class="row" id="server_listing">

@if($order)
	<div class="col-sm-12">
					<!-- ./ notifications -->
							@include('admin._partials.notifications')
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
								<hr/>
								<div class="row" >
									<div class="col-md-12 table-responsive" id="">
											<br/>
											<table class="table table-bordered" id="item_list_table">
											<tr>
												<th>##</th>
												<th width="40%">Prod Name</th>
												<th width="10%">Quantity</th>
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
								<hr/>
								<div class="row">
									<div class="col-md-6">
										{{ Form::open(array('method'=> 'DELETE', 'route' => array('adminordersdestroy', $order->id))) }}
				                        	<button  data-placement="left" data-toggle="tooltip" title="Delete order" type="submit" class="btn btn-warning" onclick="return confirm('Do you want to delete this order ?')"><i class="fa fa-trash-o"></i> Delete</button>
										{{ Form::close() }}	
									</div>
									<div class="col-md-6">
										<a class="btn btn-primary pull-right" href="{{URL::to('/admin/orders/' . $order->id . '/export')}}">Export to xls</a>
										@if($order->sent_flag == 0)
					                    	<a data-toggle="tooltip"  class="btn btn-link pull-right"title="Change status" href="{{URL::to('/admin/orders/' . $order->id . '/change_status')}}" onclick="return confirm('Do you want to change status to Sent?')"><i class="fa fa-exchange"></i> Mark sent</a>
					                    @else
					                    	<a data-toggle="tooltip"  class="btn btn-link pull-right"title="Change status" href="{{URL::to('/admin/orders/' . $order->id . '/change_status')}}" onclick="return confirm('Do you want to change status to Unsent?')"><i class="fa fa-exchange"></i>  Mark unsent</a>
					                    @endif
										
		                            	<a class="btn btn-link pull-right" href="{{URL::to('/admin/orders')}}">Cancel</a>
	                    			</div>
	                    		</div>	
	                    		<br/>
	            </div><!-- /.box -->

	       </div>
@endif	       
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