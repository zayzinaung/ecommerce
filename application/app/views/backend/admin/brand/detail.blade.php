@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Brand <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/brand')}}">Brand</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Brand List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-list"></span> Brand Management - {{ $brand->brand_name }}
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
						<th>Brand Name</th>
						<td>{{ $brand->brand_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Brand Icon</th>
						<td>
							@if($brand->brand_icon != '')
								<img src="{{ URL::to('uploads/brand_icons/'.$brand->brand_icon) }}" alt="{{ $brand->brand_name }}" title="{{ $brand->brand_name }}" class="img-rounded" width="50">
							@else
								<img src="{{ URL::to('uploads/no_icon.png') }}" alt="{{ $brand->brand_name }}" title="{{ $brand->brand_name }}" class="img-rounded" width="50">
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop