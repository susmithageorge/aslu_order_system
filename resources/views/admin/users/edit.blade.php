@extends('layouts.admin')
@section('page_heading','Edit User - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		@include('admin._partials.notifications')
		<div class="col-md-12">
			<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Edit User</div>
				<div class="panel-body">
					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/user/' . $user->id .  '/edit')}}">
					<div class="row col-md-12">
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
								<label >Email address</label>
								<div>
									<input type="email" class="form-control" name="email" value="{{ Input::old('email' , $user->email ) }}" required>
									@if ($errors->has('email'))
									    <span class="alert-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>
							</div>
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
										<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
											Update user
										</button>
									</div>
								</div>
							
						</div>	
					</div>
					</form>
				</div>
			</div>
			</div>
			<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Change Password</div>
				<div class="panel-body">
					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/user/'. $user->id .'/changepassword')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row col-md-12">	
						<div class="row col-md-12">
							<div class="form-group">
								<label >Password</label>
								<div>
									<input type="password" class="form-control" name="password" value="" required>
									@if ($errors->has('password'))
									    <span class="alert-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label >Confirm Password</label>
								<div>
									<input type="password" class="form-control" name="password_confirmation" value="" required>
									@if ($errors->has('password_confirmation'))
									    <span class="alert-danger">{{ $errors->first('password_confirmation') }}</span>
									@endif
								</div>
							</div>

							<div class="form-group">
									<div class="pull-right">
										<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
											Change password
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
