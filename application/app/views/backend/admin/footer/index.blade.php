@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Footer Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/footer_cms')}}">Footer Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Footer Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-compass"></span> Footer Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">

			@if( Session::get('success') )
				<div class="alert alert-success">
					{{ Session::get('success') }}
				</div>
			@endif
			@if( Session::get('error') )
				<div class="alert alert-danger">
					{{ Session::get('error') }}
				</div>
			@endif

			<div class="row">
				<div class="col-md-3 col-sm-6">
					<a href="{{ URL::to('admin/footer_cms/'.$first_column->id.'/edit/') }}" class="btn red-sunglo tooltips" data-placement="bottom" data-original-title="Edit First Column"><span aria-hidden="true" class="icon-pencil"></span> First Column</a>
				</div>
				<div class="col-md-3 col-sm-6">
					<a href="{{ URL::to('admin/footer/menu') }}" class="btn red-sunglo tooltips" data-placement="bottom" data-original-title="Edit Second Column"><span aria-hidden="true" class="icon-pencil"></span> Second Column</a>
				</div>
				<div class="col-md-3 col-sm-6">
					<a href="{{ URL::to('admin/footer_cms/'.$third_column->id.'/edit/') }}" class="btn red-sunglo tooltips" data-placement="bottom" data-original-title="Edit Third Column"><span aria-hidden="true" class="icon-pencil"></span> Third Column</a>
				</div>
				<div class="col-md-3 col-sm-6">
					<a href="{{ URL::to('admin/footer_cms/'.$fourth_column->id.'/edit/') }}" class="btn red-sunglo tooltips" data-placement="bottom" data-original-title="Edit Fourth Column"><span aria-hidden="true" class="icon-pencil"></span> Fourth Column</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<img src="{{ URL::to('frontend/img/footer_sample.png') }}" class="img-responsive">
				</div>
			</div>

		</div>
	</div>
</div>
@stop