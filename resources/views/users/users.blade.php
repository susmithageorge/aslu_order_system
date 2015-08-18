<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order system | User Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/public/ace_admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- FontAwesome 4.3.0 -->
        <link href="{{ asset('/public/assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        
        <!-- Theme style -->
        <link href="{{ asset('/public/ace_admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link href="{{ asset('/public/ace_admin/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
         <!-- jQuery 2.1.3 -->
        <script src="{{ asset('/public/ace_admin/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="{{ asset('/public/assets/js/jquery.js')}}" type="text/javascript"></script>
    </head>
    <body class="skin-green">
        <div class="wrapper">
            @include('users.includes.header')
            @include('users.includes.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    Dashboard
                    <small>home</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li  style="display:none;" id="loading-indicator"><img src="{{ asset('/public/assets/img/loading.gif')}}"/> Loading content..</li>
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1
                </div>
                <strong></strong>
                <br/>
            </footer>
        </div><!-- ./wrapper -->

       
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset('/public/ace_admin/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('/public/ace_admin/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/public/ace_admin/dist/js/app.js') }}" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script>
            $(function(){
                var no_of_list = 5;
                $("#add_more_element").on("click", function(e){
                    //var no_of_list = $(".input_elements").last().val();
                     e.preventDefault(); // prevent default anchor behavior    
                     $('#item_list_table tr').eq(++no_of_list).show();
                   // $(".hidden_list").show('slow')
                    return false;
                })
                make_items_list();
                $("#order_manufacturer_select").on("change", function() {
                    make_items_list();
                });
            })

            $(document).on("change", ".selectpicker", function(){
                var $prod_id  = $(this).val();
                var $price_input = $(this).closest("tr").find("input.price_box_listing");
                var $prod_qty = $(this).closest("tr").find("input.prod_qty_input").val();
                if($prod_id > 0){
                    $.ajax({
                        url: "{{URL::to('users/orders/pluck_mrp')}}/" + $prod_id
                    }).done(function(response) {
                        var $mul_price  = response * $prod_qty;
                        $mul_price = $mul_price.toFixed(2);
                        $price_input.val($mul_price);
                        return false;
                    });
                } else {
                    return false;
                }    
            });

            $(document).on("blur", ".prod_qty_input", function(){
                var $prod_qty  = $(this).val();
                var $price_input = $(this).closest("tr").find("input.price_box_listing");
                var $prod_id = $(this).closest("tr").find("select.product_name_list").val();
                if($prod_id > 0){
                    $.ajax({
                        url: "{{URL::to('users/orders/pluck_mrp')}}/" + $prod_id
                    }).done(function(response) {
                        var $mul_price  = response * $prod_qty;
                        $mul_price = $mul_price.toFixed(2);
                        $price_input.val($mul_price);
                        return false;
                    });
                } else {
                    return false;
                }    
            });                

            function make_items_list(){
                    var $manufacturer_select_val = $("#order_manufacturer_select").val();
                    var $return_element = $("#items_list");
                    if($manufacturer_select_val > 0){
                        $.ajax({
                          url: "{{URL::to('users/orders/add_items')}}/" + $manufacturer_select_val,
                          async:false,
                        }).done(function(response) {
                          $return_element.html(response);
                          $('.selectpicker').selectpicker('render');
                        });
                    }else{
                        $return_element.html('<p class="bg-warning">Select Manufacturer to continue</p>');
                    }
            }

             $(document).bind("ajaxSend", function(){
               $("#loading-indicator").show();
             }).bind("ajaxComplete", function(){
               $("#loading-indicator").hide();
             });

        </script>    
    </body>
</html>