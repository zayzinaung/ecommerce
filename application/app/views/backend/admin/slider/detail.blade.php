@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Product Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/slider')}}">Slider Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-equalizer"></span> Slider Information - {{ $slider->slider_name }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i = 0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Name</th>
						<td>{{ $slider->slider_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Image</th>
						<td>
							@if($slider->slider_image != '')
								<img src="{{ URL::to('uploads/sliders/'.$slider->slider_image) }}" alt="{{ $slider->slider_name }}" title="{{ $slider->slider_name }}" class="img-rounded" width="250">
							@else
								<img src="{{ URL::to('uploads/no_icon.png') }}" alt="{{ $slider->slider_name }}" title="{{ $slider->slider_name }}" class="img-rounded" width="50">
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Description</th>
						<td>{{ $slider->description }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop