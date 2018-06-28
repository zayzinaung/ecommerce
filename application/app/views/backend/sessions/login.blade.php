<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<title>Ikloudit E-commerce | System Login</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		{{ HTML::style('backend/plugins/font-awesome/css/font-awesome.min.css') }}
		{{ HTML::style('backend/plugins/simple-line-icons/simple-line-icons.min.css') }}
		{{ HTML::style('backend/plugins/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('backend/plugins/uniform/css/uniform.default.css') }}
		{{ HTML::style('backend/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		{{ HTML::style('backend/plugins/select2/select2.css') }}
		{{ HTML::style('backend/css/login-soft.css') }}
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN THEME STYLES -->
		{{ HTML::style('backend/css/components.css') }}
		{{ HTML::style('backend/css/plugins.css') }}
		{{ HTML::style('backend/css/layout.css') }}
		{{ HTML::style('backend/css/default.css') }}
		{{ HTML::style('backend/css/custom.css') }}
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="{{ URL::to('backend/img/icon.png') }}" />
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
	<body class="login">
		<!-- BEGIN LOGO -->
		<div class="logo">
			<a href="#">
				<img src="{{ URL::to('frontend/img/logo.png') }}" alt="logo" class="logo-default" width="300"/>
			</a>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler"></div>
		<!-- END SIDEBAR TOGGLER BUTTON -->
		<!-- BEGIN LOGIN -->
		<div class="content">
			<!-- BEGIN LOGIN FORM -->
			{{ Form::open(array('url'=>'admin/sessions/login'), array('class'=>'login-form')) }}
				<h3 class="form-title">Login to your account</h3>
				@if ($errors->has('username') && $errors->has('password'))
				<div class="alert alert-warning">
					<span>{{ $errors->first('username') }}<br>{{ $errors->first('password') }}</span>
				</div>
				@else
					@if ($errors->has('username'))
					<div class="alert alert-warning">
						<span>{{ $errors->first('username') }}</span>
					</div>
					@endif
					@if ($errors->has('password'))
					<div class="alert alert-warning">
						<span>{{ $errors->first('password') }}</span>
					</div>
					@endif
				@endif
				@if (Session::get('error_message'))
				<div class="alert alert-danger">
					<span>{{ Session::get('error_message') }}</span>
				</div>
				@endif

				<div class="form-group @if ($errors->first('username')) error @endif">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Username</label>
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="Username" name="username" autofocus="autofocus">
					</div>
				</div>

				<div class="form-group @if ($errors->first('password')) error @endif">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
					</div>
				</div>
		
				<div class="form-actions">
					<label class="checkbox">
					<button type="submit" class="btn blue pull-right">
					Login <i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>
			{{Form::close()}}
			<div class="forget-password">
				<h4>Forgot your password ?</h4>
				<p>
					 no worries, click <strong>
					 <a href="{{ URL::to('admin/sessions/forget') }}" >here</a>
					</strong>
					to reset your password.
				</p>
			</div>
			<!-- END LOGIN FORM -->
		</div>
		<!-- END LOGIN -->
		<!-- BEGIN COPYRIGHT -->
		<div class="copyright">
			 {{ date('Y') }} &copy; Ikloudit E-commerce.
		</div>
		<!-- END COPYRIGHT -->

		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->
		{{ HTML::script('backend/plugins/jquery-1.11.0.min.js') }}
		{{ HTML::script('backend/plugins/jquery-migrate-1.2.1.min.js') }}
		{{ HTML::script('backend/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}
		{{ HTML::script('backend/plugins/bootstrap/js/bootstrap.min.js') }}
		{{ HTML::script('backend/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
		{{ HTML::script('backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
		{{ HTML::script('backend/plugins/jquery.blockui.min.js') }}
		{{ HTML::script('backend/plugins/jquery.cokie.min.js') }}
		{{ HTML::script('backend/plugins/uniform/jquery.uniform.min.js') }}
		{{ HTML::script('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
		{{ HTML::script('backend/plugins/backstretch/jquery.backstretch.min.js') }}
		{{ HTML::script('backend/plugins/select2/select2.min.js') }}
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		{{ HTML::script('backend/scripts/metronic.js') }}
		{{ HTML::script('backend/scripts/layout.js') }}
		{{ HTML::script('backend/scripts/quick-sidebar.js') }}
		<!-- END PAGE LEVEL SCRIPTS -->
		<script>
			jQuery(document).ready(function() {
				Metronic.init(); // init metronic core components
				Layout.init(); // init current layout
				QuickSidebar.init(); // init quick sidebar
		       	// init background slide images
			    $.backstretch([
						"backend/img/bg/1.jpg",
						"backend/img/bg/2.jpg",
						"backend/img/bg/3.jpg",
						"backend/img/bg/4.jpg"
				    ], {
						fade: 1000,
						duration: 8000
				    }
			    );
			});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>