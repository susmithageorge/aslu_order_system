@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">Order System - Admin</a>
            </div>
            <!-- /.navbar-header -->

         @if (Auth::check())    
            <!-- /.navbar-top-links -->
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li {{ (Request::is('/admin/users') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/admin/users') }}"><i class="fa fa-th-list fa-fw"></i> Users</a>
                        </li>
                        <li {{ (Request::is('/admin/orders') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/admin/orders') }}"><i class="fa fa-th-list fa-fw"></i> Orders</a>
                        </li>
                        <li {{ (Request::is('/admin/dealers') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/admin/dealers') }}"><i class="fa fa-th-list fa-fw"></i> Dealers</a>
                        </li>
                        <li {{ (Request::is('/admin/manufacturers') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/admin/manufacturers') }}"><i class="fa fa-th-list fa-fw"></i> Manufacturers</a>
                        </li>
                        
                        <li {{ (Request::is('/admin/products') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/admin/products') }}"><i class="fa fa-th-list fa-fw"></i> Products</a>
                        </li>
                        
                       
                       
                         <li {{ (Request::is('logout') ? 'class="active"' : '') }}>
                            <a href="{{ url ('logout') }}"><i class="fa fa-user fa-fw"></i> Logout</a>
                        </li>
                        <!--<li {{ (Request::is('*documentation') ? 'class="active"' : '') }}>
                            <a href="{{ url ('documentation') }}"><i class="fa fa-file-word-o fa-fw"></i> Documentation</a>
                        </li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        @else
            <!-- /.navbar-top-links -->
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/auth/login') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/auth/login') }}"><i class="fa fa-dashboard fa-fw"></i> Login</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        @endif  
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

