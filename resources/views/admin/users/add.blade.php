@extends('layouts.admin')
@section('page_heading','Add user - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Add user</div>
				<div class="panel-body">
				@include('admin._partials.notifications')
					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/user/add')}}">
					<div class="row col-md-6">
						<div class="row col-md-10">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label >Name</label>
								<div>
									<input type="name" class="form-control" name="name" value="{{ old('name') }}" required>
									@if ($errors->has('name'))
									    <span class="alert-danger">{{ $errors->first('name') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label >Email address</label>
								<div>
									<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
									@if ($errors->has('email'))
									    <span class="alert-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label >Password</label>
								<div>
									<input type="password" class="form-control" name="password" value="" required>
									@if ($errors->has('password'))
									    <span class="alert-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>
							</div>
						</div>	
					</div>
					<div class="row col-md-6">	
						<div class="row col-md-10">
								<div class="form-group">
									<label >Address</label>
									<div>
										<textarea name="address" id="address" class="form-control" rows="3">{{ old('address') }}</textarea>
									</div>
								</div>

								<div class="form-group">
									<label>Bio</label>
									<div>
										<textarea name="bio" id="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="pull-right">
										<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
											Add
										</button>
									</div>
								</div>
						</div>		
					</div>	
			   	  </form>
				
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
