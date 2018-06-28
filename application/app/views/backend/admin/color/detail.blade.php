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
				<a href="{{URL::to('admin/product_info')}}">Product Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/color')}}">Color Information</a>
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
				<span aria-hidden="true" class="icon-list"></span> Color Information - {{ $color->color_name }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i=0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Name</th>
						<td>{{ $color->color_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Image</th>
						<td>
							@if($color->color_icon != '')
								<img src="{{ URL::to('uploads/color_images/'.$color->color_image) }}" alt="{{ $color->color_name }}" title="{{ $color->color_name }}" class="img-rounded" width="50">
							@else
								<img src="{{ URL::to('uploads/no_icon.png') }}" alt="{{ $color->color_name }}" title="{{ $color->color_name }}" class="img-rounded" width="50">
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Code</th>
						<td>{{ $color->color_code }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop