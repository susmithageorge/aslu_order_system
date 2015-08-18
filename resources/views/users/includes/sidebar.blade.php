<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
            </div>
        </div>
      
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li><a href="{{URL::to('users/orders')}}"><i class="fa fa-book"></i> Orders</a></li>
            <li><a href="{{URL::to('users/orders/new')}}"><i class="fa fa-plus text-danger"></i> Create New Order</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Documentations</a></li>
            <li><a href="{{URL::to('logout')}}"><i class="fa fa-user text-info"></i> Logout</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>