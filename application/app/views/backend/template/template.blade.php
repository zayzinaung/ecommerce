<!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en" class="no-js">
    <!--<![endif]-->
        <!-- BEGIN HEAD -->
        <head>
            <meta charset="utf-8"/>
            <title>Ikloudit E-commerce | System</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport"/>
            <meta content="" name="description"/>
            <meta content="" name="author"/>
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link rel="shortcut icon" href="{{ URL::to('backend/img/icon.png') }}" />

            <?php
                 $theme = General_setting::where('type','=','theme')->first();
            ?>
            
            {{ HTML::style('backend/plugins/font-awesome/css/font-awesome.min.css') }}
            {{ HTML::style('backend/plugins/simple-line-icons/simple-line-icons.min.css') }}
            {{ HTML::style('backend/plugins/bootstrap/css/bootstrap.min.css') }}
            {{ HTML::style('backend/plugins/uniform/css/uniform.default.css') }}
            {{ HTML::style('backend/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
            {{ HTML::style('backend/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}
            {{ HTML::style('backend/plugins/jquery-tags-input/jquery.tagsinput.css') }}
            {{ HTML::style('backend/plugins/bootstrap-datepicker/css/datepicker.css') }}
            {{ HTML::style('backend/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css') }}
            {{ HTML::style('backend/plugins/bootstrap-datetimepicker/css/datetimepicker.css') }}
            {{ HTML::style('backend/plugins/gritter/css/jquery.gritter.css') }}
            {{ HTML::style('backend/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}
            {{ HTML::style('backend/plugins/bootstrap-select/bootstrap-select.min.css') }}
            {{ HTML::style('backend/plugins/select2/select2.css') }}
            {{ HTML::style('backend/plugins/jquery-multi-select/css/multi-select.css') }}

            {{ HTML::style('backend/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}

            {{ HTML::style('backend/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
            {{ HTML::style('backend/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}
            <!-- END GLOBAL MANDATORY STYLES -->
            
            <!-- BEGIN PAGE STYLES -->
            {{ HTML::style('backend/css/error.css') }}
            {{ HTML::style('backend/css/components.css') }}
            {{ HTML::style('backend/css/plugins.css') }}
            {{ HTML::style('backend/layout/css/layout.css') }}
            {{ HTML::style('backend/layout/css/themes/'.$theme->format.'.css') }}
            {{ HTML::style('backend/layout/css/custom.css') }}
            {{ HTML::style('backend/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}
            {{ HTML::style('backend/plugins/waitMe/waitMe.css') }}
            <!-- END PAGE STYLES -->

            {{ HTML::script('backend/plugins/jquery-1.11.0.min.js') }}
            {{ HTML::script('backend/plugins/jquery-migrate-1.2.1.min.js') }}
            {{ HTML::script('backend/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}
            {{ HTML::script('backend/plugins/bootstrap/js/bootstrap.min.js') }}
            {{ HTML::script('backend/plugins/bootstrap/js/tooltips.js') }}
            {{ HTML::script('backend/plugins/jquery.multifile.js') }}
            {{ HTML::script('backend/plugins/waitMe/waitMe.js') }}
            <script type="text/javascript">
            	$(function(){
                    var path = '<?php echo Request::url(); ?>';
                    var module = '<?php echo Request::segment(2); ?>';
                    var calendar_manager = '<?php echo Request::segment(3); ?>';
                    if(calendar_manager == 'monthly_view') {
                        var link = '{{ URL::to("admin/"); }}' +'/'+ module+'/'+ calendar_manager+'/'+'<?php echo Request::segment(4); ?>';
                        var active = $('.sub-menu a[href="'+  link +'"]');
                        $(active).parents("li").addClass('active');
                    } else if(calendar_manager == 'calendar_manager' || calendar_manager == 'fingerprint_unassigned' || calendar_manager == 'monitoring') {
                        var link = '{{ URL::to("admin/"); }}' +'/'+ module+'/'+ calendar_manager;
                        var active = $('.sub-menu a[href="'+  link +'"]');
                        $(active).parents("li").addClass('active');
                    } else if(path.indexOf(module) > -1 ) {      
            	      	var link = '{{ URL::to("admin/"); }}' +'/'+ module;
                        var active = $('.sub-menu a[href="'+  link +'"]');
                        $(active).parents("li").addClass('active');
                    }

                    /* ajax loading bar */
                    function run_waitMe(){
                        $('body').waitMe({
                            effect: 'win8',
                            text: 'Please wait...',
                            bg: 'rgba(255,255,255,0.7)',
                            color:'#000',
                            sizeW:'',
                            sizeH:''
                        });
                    }
                    function stop_waitMe(){
                        $('body').waitMe('hide');
                    }
                    /* ajax loading bar */

                    $('.delete-product-image').click(function(){            
                        if(confirm("You are about to delete!")){
                        $.post($(this).attr('rel'),{},function(data){
                            location.reload();
                        });
                        $(this).parents('.product_image').fadeOut('fast');
                        }
                    });
            	});
            </script>

            <style>
            .checker{
                float:left;
                margin-top: 10px!important;
            }
            </style>

            @yield('style')
        </head>
        <!-- END HEAD -->

        <!-- BEGIN BODY -->
            <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
            <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
            <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
            <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
            <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
            <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
            <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
            <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
            <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
            <body class="page-header-fixed page-quick-sidebar-over-content">
                
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

                <!-- BEGIN HEADER -->
                <div class="page-header navbar navbar-fixed-top">
                    <!-- BEGIN HEADER INNER -->
                    <div class="page-header-inner">
                        <!-- BEGIN LOGO -->
                        <div class="page-logo" style="background-color:#fff">
			                <a href="{{URL::to('admin/home') }}">
			                    <img src="{{ URL::to('frontend/img/logo.png') }}" alt="logo" class="logo-default" width="125"/>
                            </a>
                            <div class="menu-toggler sidebar-toggler hide">
				                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                            </div>
                		</div>
                		<!-- END LOGO -->
                		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
                		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
                		<!-- END RESPONSIVE MENU TOGGLER -->
                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <div class="top-menu">
                			<ul class="nav navbar-nav pull-right">
                				<!-- BEGIN USER LOGIN DROPDOWN -->

                                                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                                            <a href="{{ URL::to('admin/order') }}" data-target="{{ URL::to('admin/order') }}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="icon-basket-loaded"></i>
                                                            <?php
                                                                        $order_count = Order::where('delivered_on','=',0)->count();
                                                            ?>
                                                            @if ( $order_count > 0 )
                                                            <span class="badge badge-default">{{ $order_count }} </span>
                                                            @endif
                                                            </a>
                                                            <ul class="dropdown-menu extended notification">
                                                                        <li><p>Hello Admin, {{ $order_count }} order/s are incomplete.</p></li>
                                                            </ul>
                                                    </li>
                                                    
                                                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                                            <a href="{{ URL::to('admin/product') }}" data-target="{{ URL::to('admin/product') }}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="icon-list"></i>
                                                            <?php
                                                                        $products = Product::all();
                                                                        $allproduct = array();
                                                            ?>
                                                            @if ( count($products) != 0 )
                                                                        @foreach ( $products as $p )
                                                                                <?php $product_qty = $p->quantity - $p->quantity_use; ?>
                                                                                @if ( $product_qty < 5 )
                                                                                            <?php $allproduct[] = $p->id; ?>
                                                                                @endif
                                                                        @endforeach
                                                                        <?php $product_count = count($allproduct); ?>
                                                            @else
                                                                        $product_count = 0;
                                                            @endif
                                                            
                                                            @if ( $product_count > 0 )
                                                            <span class="badge badge-default">{{ $product_count }} </span>
                                                            @endif
                                                            </a>
                                                            <ul class="dropdown-menu extended notification">
                                                                        <li><p>Hello Admin, {{ $product_count }} product/s are less than five quantities.</p></li>
                                                            </ul>
                                                    </li>

                                                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="icon-user"></i>
                                                            <?php
                                                                        $today_date = Date('Y-m-d');
                                                                        $user_count = User::where("created_at","like","%".$today_date."%")->count();
                                                            ?>
                                                            @if ( $user_count > 0 )
                                                            <span class="badge badge-default">{{ $user_count }} </span>
                                                            @endif
                                                            </a>
                                                            <ul class="dropdown-menu extended notification">
                                                                        <li><p>Hello Admin, {{ $user_count }} user/s are registered today.</p></li>
                                                            </ul>
                                                    </li>

                                                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="icon-star"></i>
                                                            <?php $review_count = Review::where("created_at","like","%".$today_date."%")->count(); ?>
                                                            @if ( $review_count > 0 )
                                                            <span class="badge badge-default">{{ $review_count}} </span>
                                                            @endif
                                                            </a>
                                                            <ul class="dropdown-menu extended notification">
                                                                        <li><p>Hello Admin, {{ $review_count }} review/s today.</p></li>
                                                            </ul>
                                                    </li>

                				<li class="dropdown dropdown-user">
                					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                                        <span class="username username-hide-on-mobile">
                                                			         <i class="fa fa-user" style="font-size:18px"></i> <?php echo Session::get('name');?>
                                                                        </span>
                                                                        <i class="fa fa-angle-down"></i>
                					</a>
                					<ul class="dropdown-menu">
                						<li>
                							<a href="{{ URL::to('admin/user/'.Session::get('user_id').'/edit') }}">
                							<span aria-hidden="true" class="icon-user"></span> My Profile </a>
                						</li>
                						<li>
                							<a href="{{ URL::to('admin/sessions/logout') }}">
                							<span aria-hidden="true" class="icon-logout"></span> Log Out </a>
                						</li>
                					</ul>
                				</li>
                				<!-- END USER LOGIN DROPDOWN -->
                			</ul>
                		</div>
                		<!-- END TOP NAVIGATION MENU -->
                	</div>
                	<!-- END HEADER INNER -->
                </div>
                <!-- END HEADER -->
                <div class="clearfix"></div>
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                	<!-- BEGIN SIDEBAR -->
                	<div class="page-sidebar-wrapper">
                		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                		@include("backend.template.sidebar")
                	</div>
                	<!-- END SIDEBAR -->
                	<!-- BEGIN CONTENT -->
                	<div class="page-content-wrapper">
                		@yield('content')
                	</div>
                	<!-- END QUICK SIDEBAR -->
                </div>
                <!-- END CONTAINER -->
                <!-- BEGIN FOOTER -->
                <div class="page-footer">
                	<div class="page-footer-inner">
                		{{ date('Y') }} &copy; Ikloudit E-commerce.
                	</div>
                	<div class="page-footer-tools">
                		<span class="go-top">
                		<i class="fa fa-angle-up"></i>
                		</span>
                	</div>
                </div>
                <!-- END FOOTER -->

                <?php
                    $date = Common::get_date();
                    $date = str_replace('d', 'dd', $date);
                    $date = str_replace('m', 'mm', $date);
                    $date = str_replace('Y', 'yyyy', $date);
                ?>
                {{ Form::hidden('date_format',$date) }}

                <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
                <!-- BEGIN CORE PLUGINS -->
                <!--[if lt IE 9]>
                <script src="../../assets/global/plugins/respond.min.js"></script>
                <script src="../../assets/global/plugins/excanvas.min.js"></script> 
                <![endif]-->
                {{ HTML::script('backend/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
                {{ HTML::script('backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
                {{ HTML::script('backend/plugins/jquery.blockui.min.js') }}
                {{ HTML::script('backend/plugins/jquery.cokie.min.js') }}
                {{ HTML::script('backend/plugins/uniform/jquery.uniform.min.js') }}
                {{ HTML::script('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
                {{ HTML::script('backend/plugins/jquery.sparkline.min.js') }}
                {{ HTML::script('backend/plugins/flot/jquery.flot.min.js') }}
                {{ HTML::script('backend/plugins/flot/jquery.flot.resize.min.js') }}
                {{ HTML::script('backend/plugins/flot/jquery.flot.categories.min.js') }}
                {{ HTML::script('backend/plugins/jquery.pulsate.min.js') }}
                {{ HTML::script('backend/plugins/bootstrap-daterangepicker/moment.min.js') }}
                {{ HTML::script('backend/plugins/bootstrap-daterangepicker/daterangepicker.js') }}
                {{ HTML::script('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
                {{ HTML::script('backend/plugins/gritter/js/jquery.gritter.js') }}
                {{ HTML::script('backend/plugins/jquery-validation/js/jquery.validate.min.js') }}
                {{ HTML::script('backend/plugins/backstretch/jquery.backstretch.min.js') }}
                {{ HTML::script('backend/plugins/jquery.pulsate.min.js') }}

                {{ HTML::script('backend/plugins/bootstrap-select/bootstrap-select.min.js') }}
                {{ HTML::script('backend/plugins/select2/select2.min.js') }}
                {{ HTML::script('backend/plugins/jquery-multi-select/js/jquery.multi-select.js') }}
                {{ HTML::script('backend/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}

                {{ HTML::script('backend/plugins/datatables/media/js/jquery.dataTables.min.js') }}
                {{ HTML::script('backend/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}

                {{ HTML::script('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
                {{ HTML::script('backend/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}
                {{ HTML::script('backend/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}
                {{ HTML::script('backend/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}

                {{ HTML::script('backend/plugins/jquery-validation/js/jquery.validate.min.js') }}
                {{ HTML::script('backend/plugins/jquery-validation/js/additional-methods.min.js') }}

                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                {{ HTML::script('backend/plugins/bootbox/bootbox.min.js') }}
                {{ HTML::script('backend/plugins/ckeditor/ckeditor.js') }}
                {{ HTML::script('backend/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}
                {{ HTML::script('backend/scripts/metronic.js') }}
                {{ HTML::script('backend/layout/scripts/layout.js') }}
                {{ HTML::script('backend/layout/scripts/quick-sidebar.js') }}
                {{ HTML::script('backend/scripts/index.js') }}
                <!-- END PAGE LEVEL PLUGINS -->

                @yield('scripts')

                <script>
                    jQuery(document).ready(function() {
                    Metronic.init(); // init metronic core componets
                    Layout.init(); // init layout
                    QuickSidebar.init(); // init quick sidebar
                    Index.init();
                    //Index.initIntro();
                    Index.initDashboardDaterange();

                    $('.bs-select').selectpicker({
                        iconBase: 'fa',
                        tickIcon: 'fa-check'
                    });

                    $("#touchspin_demo1").TouchSpin({          
                        buttondown_class: 'btn red',
                        buttonup_class: 'btn green',
                        min: 0,
                        max: 30,
                        stepinterval: 1,
                        prefix: 'Month'
                    }); 
    
                    if('<?php echo Request::segment(1); ?>'=='admin' && '<?php echo Request::segment(2); ?>'=='home' && '<?php echo Request::segment(3); ?>'!='back_up')
                    {
                        if (!jQuery.plot) {
                            return;
                        }
                        var data = [];
                        var income = [
                            [1, '<?php echo Common::get_yearly_income_array("01"); ?>'],
                            [2, '<?php echo Common::get_yearly_income_array("02"); ?>'],
                            [3, '<?php echo Common::get_yearly_income_array("03"); ?>'],
                            [4, '<?php echo Common::get_yearly_income_array("04"); ?>'],
                            [5, '<?php echo Common::get_yearly_income_array("05"); ?>'],
                            [6, '<?php echo Common::get_yearly_income_array("06"); ?>'],
                            [7, '<?php echo Common::get_yearly_income_array("07"); ?>'],
                            [8, '<?php echo Common::get_yearly_income_array("08"); ?>'],
                            [9, '<?php echo Common::get_yearly_income_array("09"); ?>'],
                            [10, '<?php echo Common::get_yearly_income_array("10"); ?>'],
                            [11, '<?php echo Common::get_yearly_income_array("11"); ?>'],
                            [12, '<?php echo Common::get_yearly_income_array("12"); ?>']
                        ];
                        var expense = [
                            [1, '<?php echo Common::get_yearly_expense_array("01"); ?>'],
                            [2, '<?php echo Common::get_yearly_expense_array("02"); ?>'],
                            [3, '<?php echo Common::get_yearly_expense_array("03"); ?>'],
                            [4, '<?php echo Common::get_yearly_expense_array("04"); ?>'],
                            [5, '<?php echo Common::get_yearly_expense_array("05"); ?>'],
                            [6, '<?php echo Common::get_yearly_expense_array("06"); ?>'],
                            [7, '<?php echo Common::get_yearly_expense_array("07"); ?>'],
                            [8, '<?php echo Common::get_yearly_expense_array("08"); ?>'],
                            [9, '<?php echo Common::get_yearly_expense_array("09"); ?>'],
                            [10, '<?php echo Common::get_yearly_expense_array("10"); ?>'],
                            [11, '<?php echo Common::get_yearly_expense_array("11"); ?>'],
                            [12, '<?php echo Common::get_yearly_expense_array("12"); ?>']
                        ];

                        var plot = $.plot($("#chart_2"), [{
                            data: income,
                            label: "Profit",
                            lines: {
                                lineWidth: 1,
                            },
                            shadowSize: 0
                            }, {
                            data: expense,
                            label: "Loss",
                            lines: {
                                lineWidth: 1,
                            },
                            shadowSize: 0
                            }
                        ], {
                            series: {
                                lines: {
                                    show: true,
                                    lineWidth: 2,
                                    fill: true,
                                    fillColor: {
                                        colors: [{
                                                opacity: 0.05
                                            }, {
                                                opacity: 0.01
                                            }
                                        ]
                                    }
                                },
                                points: {
                                    show: true,
                                    radius: 3,
                                    lineWidth: 1
                                },
                                shadowSize: 2
                            },
                            grid: {
                                hoverable: true,
                                clickable: true,
                                tickColor: "#eee",
                                borderColor: "#eee",
                                borderWidth: 1
                            },
                            colors: ["#35AA47", "#d12610", "#52e136"],
                            xaxis: {
                                ticks: 11,
                                tickDecimals: 0,
                                tickColor: "#eee",
                            },
                            yaxis: {
                                ticks: 11,
                                tickDecimals: 0,
                                tickColor: "#eee",
                            }
                        });

                        function showTooltip(x, y, contents) {
                            $('<div id="tooltip">' + contents + '</div>').css({
                                position: 'absolute',
                                display: 'none',
                                top: y + 5,
                                left: x + 15,
                                border: '1px solid #333',
                                padding: '4px',
                                color: '#fff',
                                'border-radius': '3px',
                                'background-color': '#333',
                                opacity: 0.80
                            }).appendTo("body").fadeIn(200);
                        }

                        var previousPoint = null;
                        $("#chart_2").bind("plothover", function (event, pos, item) {
                            $("#x").text(pos.x.toFixed(2));
                            $("#y").text(pos.y.toFixed(2));

                            if (item) {
                                if (previousPoint != item.dataIndex) {
                                    previousPoint = item.dataIndex;

                                    $("#tooltip").remove();
                                    var x = 'Month(' +item.datapoint[0]+')',
                                        y = item.datapoint[1]+' SGD';

                                    showTooltip(item.pageX, item.pageY, item.series.label + " of " + x + " = " + y);
                                }
                            } else {
                                $("#tooltip").remove();
                                previousPoint = null;
                            }
                        });
                    }

                    $('#back').click(function(){
                        window.history.back();
                    });

                    $('.select2').select2({
                        placeholder: "Select option",
                        allowClear: true
                    });

   	        $('.timepicker-24').timepicker({
                        autoclose: true,
                        minuteStep: 15,
                        minTime: 1,
                        showSeconds: false,
                        showMinutes: false,
                        showMeridian: false
                    });

                    $('.timepicker-24').attr('ReadOnly','true');
                    $('.timepicker-24').css('cursor','pointer');

   	        if (jQuery().datepicker) {
                        var val = $('input[name=date_format]').val();
                        $('.datepicker').datepicker({
                        	 format : val,
            	           autoclose: true
                        });
                        $('.datepicker').attr('ReadOnly','true');
                        $('.datepicker').css('cursor','pointer');
                    }

                    $(".mask-dob").inputmask("d-m-y", {
                        "placeholder": "dd-mm-yyyy"
                    });

                    $(".license_key").inputmask("****-****-****-****-****", {
                        placeholder: " ",
                        clearMaskOnLostFocus: true
                    }); //default

                    $('.monthpicker').datepicker({
                        viewMode: "months", 
                        minViewMode: "months",
                        format : 'mm-yyyy',
                        autoclose: true
                    });
                    $('.monthpicker').attr('ReadOnly','true');
                    $('.monthpicker').css('cursor','pointer');
                    
                    $('.delete').click(function(){
   	                    var currentForm = $(this).closest("form");
                        bootbox.confirm({
                            title: 'Delete',
                            message: $('#delete_text').html(),
                            buttons: {
                                'cancel': {
                		            label: 'No',
                		            className: 'btn green col-md-4 pull-left'
                                },
                                'confirm': {
                		            label: 'Yes',
                		            className: 'btn red col-md-4 pull-right'
                                }
                            },
                            callback: function(result) {
                		        if (result) {
                		            currentForm.submit();
                		        }
                            }
                        });
                    });
                    
                    $('.update').click(function(){
                        var currentForm = $(this).closest("form");
                        bootbox.confirm({
                            title: 'Update Information',
                            message: $('#update_text').html(),
                            buttons: {
                                'cancel': {
                                    label: 'No',
                                    className: 'btn green col-md-4 pull-left'
                                },
                                'confirm': {
                                    label: 'Yes',
                                    className: 'btn red col-md-4 pull-right'
                                }
                            },
                            callback: function(result) {
                                if (result) {
                                    currentForm.submit();
                                }
                            }
                        });
                    });

                    $('.show').click(function(){
                        var message = $(this).attr('rel');
                        bootbox.alert({
                            title: 'Description',
                            message: message
                        });
                    });

                    $('#sample_2').dataTable( {           
                        "aoColumnDefs": [
                            { "aTargets": [ 0 ] }
                        ],
                        "aaSorting": [[0, 'asc']],
                        "aLengthMenu": [
                            [15, 20, 25 ,-1],
                            [15, 20, 25 ,"All"] // change per page values here
                        ],
                        // set the initial value
                        "iDisplayLength": 15,
                    });

                    jQuery('#sample_2_wrapper .dataTables_filter input').addClass("m-wrap input-medium"); // modify table search input
                    jQuery('#sample_2_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown

                    $('#attend_sample_2').dataTable({
                        "aoColumnDefs": [{ "bSearchable": true, "aTargets": [0] },{ "bSortable": false, "aTargets": ['_all']}],
                        "aLengthMenu": [
                            [15, 20, 25 ,-1],
                            [15, 20, 25 ,"All"] // change per page values here
                        ],
                        // set the initial value
                        "iDisplayLength": 15,
                    });

                    jQuery('#attend_sample_2_wrapper .dataTables_filter input').addClass("m-wrap input-medium"); // modify table search input
                    jQuery('#attend_sample_2_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown

                    $('.row_5').dataTable( {           
                        "aoColumnDefs": [
                            { "aTargets": [ 0 ] }
                        ],
                        "aaSorting": [[0, 'asc']],
                        "aLengthMenu": [
                            [5, 10, 15 ,-1],
                            [5, 10, 15 ,"All"] // change per page values here
                        ],
                        // set the initial value
                        "iDisplayLength": 5,
                    });

                    jQuery('.row_5_wrapper .dataTables_filter input').addClass("m-wrap input-medium"); // modify table search input
                    jQuery('.row_5_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();

                    if($('#calendar').parents(".portlet").width() <= 720) {
                             $('#calendar').addClass("mobile");
                                
                    } else {
                            $('#calendar').removeClass("mobile");
                    }
                });
            </script>

        <!-- END JAVASCRIPTS -->
        </body>
        <!-- END BODY -->
    </html>