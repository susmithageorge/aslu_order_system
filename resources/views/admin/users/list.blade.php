@extends('layouts.admin')
@section('page_heading','Listing users')
@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-6">
		  <a href="{{URL::to('/admin/user/add')}}" id="add_users" class="btn btn-default">Add new user</a>
		  <!--<a href="{{URL::to('/admin/sub_user/add')}}" id="add_sub_users" class="btn btn-default">Add new sub user</a>-->
    </div>
</div>
<hr/>
<div class="row" id="server_listing">
@include('admin._partials.notifications')
@if($users)
	<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Address</span></th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $key => $user)
					<tr>
						<tr >
						<td style="width:5% !important;">{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->address}}</td>
						<td style="width:15% !important;">
						<div style="float:left;">	
							<a href="{{URL::to('admin/user/' .$user->id . '/edit')}}" class="btn-link btn"><i class="fa fa-pencil fa-fw"></i></a>
							{{ Form::open(['url' => ['admin/user/' .$user->id . '/delete'], 'method' => 'delete', "class" => "pull-right"]) }}
								<button class="btn-link btn" type="submit" onclick="return confirm('Do you want to delete this user?')"><i  class="fa fa-trash fa-fw"></i></button>
							{{ Form::close() }}
							<!--<a href="{{URL::to('admin/sub_user/add/' .$user->id)}}" class="btn-link btn" title="Add sub user"><i class="fa fa-glass fa-fw"></i></a>-->
						</div>	
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>	
			{{ $users->render() }}
		</div>
	
	@else
	    <div class="alert alert-warning " role="alert">
	        <i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  There is nothing to show.
	    </div>
	@endif	
	</div>
</div>
@endsection
