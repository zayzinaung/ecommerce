@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Stocks Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/stock')}}">Stocks Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Stocks Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-calculator"></span> Stocks Information - {{ $stock->stock_name }}
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
						<th>Stock Name</th>
						<td>{{ $stock->stock_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Buying Date</th>
						<td>{{ date($date_format, $stock->buying_date) }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Amount</th>
						<td>{{ $currency }} {{ $stock->amount }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Quantity</th>
						<td>{{ $stock->quantity }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Bought From</th>
						<td>{{ $stock->bought_from }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop