@extends('layouts.admin')
@section('page_heading','Edit product - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Edit product</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/product/' . $product->id . '/edit')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label >Name</label>
							<div>
								<input type="name" class="form-control" name="name" value="{{{ Input::old('name' , $product->name ) }}}">
							</div>
						</div>
						<div class="form-group">
							<label >Manufacturer</label>
							<div>
								{{ Form::select('manufacturer_id', $manufacturers, Input::old('manufacturer_id' , $product->manufacturer_id ), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							<label >Code</label>
							<div>
								<input type="name" class="form-control" name="code" value="{{ Input::old('code' , $product->code ) }}">
							</div>
						</div>
						<div class="form-group">
							<label >Std rate</label>
							<div>
								<input type="number" step="any"  class="form-control" name="std_rate" value="{{ Input::old('std_rate' , $product->std_rate ) }}">
							</div>
						</div>
						<div class="form-group">
							<label >Sales rate</label>
							<div>
								<input type="number" step="any"  class="form-control" name="sales_rate" value="{{ Input::old('sales_rate' , $product->sales_rate ) }}">
							</div>
						</div>
						<div class="form-group">
							<label >Market rate</label>
							<div>
								<input type="number" step="any"  class="form-control" name="market_rate" value="{{ Input::old('market_rate' , $product->market_rate ) }}">
							</div>
						</div>
						<div class="form-group">
							<label >Min retail price</label>
							<div>
								<input type="number" step="any"  class="form-control" name="min_retail_price" value="{{ Input::old('min_retail_price' , $product->min_retail_price ) }}">
							</div>
						</div>
						<div class="form-group">
							<label >Max retail price</label>
							<div>
								<input type="number" step="any"  class="form-control" name="max_retail_price" value="{{ Input::old('max_retail_price' , $product->max_retail_price ) }}">
							</div>
						</div>

						<div class="form-group">
							<div class="pull-right">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Update
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
