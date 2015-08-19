@extends('layouts.admin')
@section('page_heading','Edit Profile - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		@include('admin._partials.notifications')
		<div class="col-md-12">
			<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Profile</div>
				<div class="panel-body">
					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/edit_profile')}}">
					<div class="row col-md-6">
						<div class="row col-md-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label >Name</label>
								<div>
									<input type="name" class="form-control" name="name" value="{{ Input::old('name' , $user->name ) }}" required>
									@if ($errors->has('name'))
									    <span class="alert-danger">{{ $errors->first('name') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label >Username</label>
								<div>
									<input type="text" class="form-control" name="username" value="{{ Input::old('username' , $user->username ) }}" required>
									@if ($errors->has('username'))
									    <span class="alert-danger">{{ $errors->first('username') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label >Email address</label>
								<div>
									<input type="email" class="form-control" name="email" value="{{ Input::old('email' , $user->email ) }}" required>
									@if ($errors->has('email'))
									    <span class="alert-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>
							</div>
						</div>	
					</div>
					<div class="row col-md-6">	
						<div class="row col-md-12">
							<div class="form-group">
								<label >Address</label>
								<div>
									<textarea name="address" id="address" class="form-control" rows="3">{{ Input::old('address' , $user->address ) }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label>Bio</label>
								<div>
									<textarea name="bio" id="bio" class="form-control" rows="3">{{ Input::old('bio' , $user->bio ) }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="pull-right">
									<a href="{{URL::to('/admin/change_password')}}" class="btn btn-link">Change Admin Password</a>
									<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
										Update profile
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
</div>
@endsection
