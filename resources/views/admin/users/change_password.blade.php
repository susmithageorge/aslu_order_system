@extends('layouts.admin')
@section('page_heading','Change password for user '.$user->name.' - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		@include('admin._partials.notifications')
			

				<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Change Password</div>
				<div class="panel-body">
					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/user/'. $user->id .'/changepassword')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row col-md-12">	
							<div class="form-group">
								<label >Name</label>
								<div>
									<span>{{$user->name}}</span>
								</div>
							</div>

							<div class="form-group">
								<label >Username</label>
								<div>
									<span>{{$user->username}}</span>
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
			   	  </form>
				</div>
			</div>
			</div>
</div>
</div>

@endsection			