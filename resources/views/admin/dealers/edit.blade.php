@extends('layouts.admin')
@section('page_heading','Edit dealer - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Edit dealer</div>
				<div class="panel-body">
					@include('admin._partials.notifications')

					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/dealer/' . $dealer->id . '/edit')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label >Name</label>
							<div>
								<input type="name" class="form-control" name="name" value="{{ Input::old('name' , $dealer->name ) }}">
								@if ($errors->has('name'))
									    <span class="alert-danger">{{ $errors->first('name') }}</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label >City</label>
							<div>
								<input type="name" class="form-control" name="city" value="{{ Input::old('city' , $dealer->city ) }}">
								@if ($errors->has('city'))
									    <span class="alert-danger">{{ $errors->first('city') }}</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label >Email</label>
							<div>
								<input type="name" class="form-control" name="email" value="{{ Input::old('email' , $dealer->email ) }}">
								@if ($errors->has('email'))
									    <span class="alert-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
						</div>	
						<div class="form-group">
							<label>Address</label>
							<div>
								<textarea name="address" id="address" class="form-control" rows="6">{{ Input::old('address' , $dealer->address ) }}</textarea>
								@if ($errors->has('address'))
									    <span class="alert-danger">{{ $errors->first('address') }}</span>
								@endif
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
