@extends('backend.template.template')
@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
			{{ $code }} <small>Something wrong.</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin/')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">{{ $code }}</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12 page-500">
				<div class="number">
					{{ $code }}
				</div>
				<div class="details">
					<h3>Oops! Something went wrong.</h3>
					<p>
						We are fixing it!<br/>Please come back in a while.<br/>
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