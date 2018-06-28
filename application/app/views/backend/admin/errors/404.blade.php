@extends('backend.template.template')
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
			404 <small>Page Not Found.</small>
		</h3>
		<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{URL::to('admin/')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">404</a>
					</li>
				</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12 page-404">
				<div class="number">
					404
				</div>
				<div class="details">
					<h3>Oops! You're lost.</h3>
					<p>
						We can not find the page you're looking for.<br/>
						<a href="{{URL::to('admin/')}}">
							Return home
						</a>
					</p>
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
@stop