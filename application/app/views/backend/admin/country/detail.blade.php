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
				<a href="{{URL::to('admin/country')}}">Country Information</a>
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
				<span aria-hidden="true" class="icon-flag"></span> Country Information - {{ $country->country_name }}
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
						<td>{{ $country->country_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Flag</th>
						<td>
							@if($country->flag != '')
								<img src="{{ URL::to('uploads/flags/'.$country->flag) }}" alt="{{ $country->country_name }}" title="{{ $country->country_name }}">
							@else
								<img src="{{ URL::to('uploads/no_icon.png') }}" alt="{{ $country->country_name }}" title="{{ $country->country_name }}" class="img-rounded" width="50">
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Code</th>
						<td>{{ $country->country_code }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Calling Code</th>
						<td>{{ $country->calling_code }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop