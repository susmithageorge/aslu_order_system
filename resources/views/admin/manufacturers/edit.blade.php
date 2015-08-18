@extends('layouts.admin')
@section('page_heading','Edit Manufacturer - Admin')
@section('section')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Manufacturer</div>
				<div class="panel-body">
					@include('admin._partials.notifications')

					<form class="form" role="form" method="POST" action="{{ URL::to('/admin/manufacturer/' . $manufacturer->id . '/edit')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label >Name</label>
							<div>
								<input type="name" class="form-control" name="name" value="{{ Input::old('name' , $manufacturer->name ) }}">
							</div>
						</div>

						<div class="form-group">
							<label>Description</label>
							<div>
								<textarea name="description" id="description" class="form-control" rows="6">{{ Input::old('description' , $manufacturer->description ) }}</textarea>
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
