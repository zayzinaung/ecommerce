@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Discount <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/discount')}}">Discount Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Discount Detail
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-link"></span> Discount Information - {{ ucwords($discount->method) }} Method
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i = 0; ?>
					@if ( $discount->method == 'price' )
					<tr>
						<td>{{ ++$i }}</td>
						<th>Method Name</th>
						<td>Base on Price Method</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Price</th>
						<td>{{ $currency }} {{ $price }}</td>
					</tr>
					@elseif ( $discount->method == 'qty' )
					<tr>
						<td>{{ ++$i }}</td>
						<th>Method Name</th>
						<td>Base on Quantity Method</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Quantity</th>
						<td>{{ $qty }}</td>
					</tr>
					@endif
					<tr>
						<td>{{ ++$i }}</td>
						<th>Discount Rate</th>
						<td>{{ $discount_rate }} %</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Remark</th>
						<td>{{ $remark }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop