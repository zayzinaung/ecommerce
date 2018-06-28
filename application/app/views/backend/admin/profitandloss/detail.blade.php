@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Product Information <small>information</small>
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
				<a href="{{URL::to('admin/fuel')}}">Fuel Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Fuel Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-wallet"></span> Fuel Information - {{ $fuel->fuel_name }}
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
						<th>Fuel</th>
						<td>{{ $fuel->fuel_name }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop