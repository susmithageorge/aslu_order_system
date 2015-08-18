@extends('users.users')
@section('content')
<!-- PAGE CONTENT BEGINS -->
<div class="container">
	<div class="row">
		<div class="col-md-11">
			<div class="panel panel-default">
				<div class="panel-heading">Add new order</div>

				<div class="panel-body">
					@include ('admin._partials.notifications')
					<!-- ./ notifications -->
					<form class="form-horizontal" role="form" method="POST" action="{{URL::to('/users/order/add')}}">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								
								<div class="row">
								  <div class="col-md-6">
								  	<label for="from">Select Dealer</label>
									<div class="row">
										<div class="col-xs-8 col-sm-11">
											{{Form::select('dealer_id', $dealers, Input::old('dealer_id'), array("class" => "form-control", "required"))}}
										</div>
									</div>
								  </div>
								  <div class="col-md-6">
								  	<label for="from">Select Manufacturers</label>
									<div class="row">
										<div class="col-xs-8 col-sm-11">
											{{Form::select('manufacturer_id', $manufacturers, Input::old('manufacturer_id'), array("class" => "form-control", "required",  "id" => "order_manufacturer_select"))}}
										</div>
									</div>	
								  </div>
								</div>
								<hr/>
								<div class="row" >
									<div class="col-md-12" id="items_list">
										<p class="bg-warning">Select Manufacturer to continue</p>
									</div>				
								</div>		
								<div class="row">
									<div class="col-md-10">
		                            		<button type="submit" class="btn btn-primary pull-right">Generate</button>
		                            		<a class="btn btn-link pull-right" id="add_more_element">Add more</a>
	                    			</div>
	                    		</div>		
	                	</form>
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