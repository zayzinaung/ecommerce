@extends('backend.template.template')
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
			403 <small>Page Access Denied.</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin/')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">403</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12 page-500">
				<div class="number">
					403
				</div>
				<div class="details">
					<h3>Oops! You're lost.</h3>
					<p>
						You Can't access this Page..<br/>Please Contact to Administrator<br/>
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