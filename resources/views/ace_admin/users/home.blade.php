@extends('users.user')
@section('content')
<!-- Small boxes (Stat box) -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-10">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">Welcome {{Auth::user()->name}}</h3>
                <!-- tools box -->

                <div class="box-body">
                    
                        
                           
                            <div class="container-fluid" style="min-height:200px;">
                                <div class="row">
                                    
                                </div>    
                            </div>
                           
                                
                       
                   
                </div>
            </div>
        </div>
    </section>
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-2 connectedSortable">
        <!-- Map box -->
        <div class="box box-solid">
            <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                   
                    </div><!-- /. tools -->
                    <i class="fa fa-map-marker"></i>
                    <h3 class="box-title">
                    Login
                    </h3>
            </div>
            <div class="box-body">
            	<div id="selected_item_details" style="height: 250px; width: 100%;">
				    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('admin._partials.notifications')
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Login</button>

                               <!-- <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a> -->
                            </div>
                        </div>
                    </form>  
				</div>
            </div><!-- /.box-body-->
            <div class="box-footer no-border">
                <div class="row">
                    <div class="col-xs-12 text-center" style="border-right: 1px solid #f4f4f4">
                        <div id="sparkline-1"></div>
                        <div class="knob-label"></div>
                    </div><!-- ./col -->
                </div><!-- /.row -->
            </div>
        </div>
	    <!-- /.box -->
	    <!-- solid sales graph -->
	    
    </section><!-- right col -->
</div><!-- /.row (main row) -->
@endsection
