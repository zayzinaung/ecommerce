@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Shipping <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/shipping')}}">Shipping Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Shipping Detail
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-directions"></span> Shipping Information - {{ $shipping->method }} Method
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
						<th>Method Name</th>
						<td>{{ $shipping->method }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Day</th>
						<td>{{ $day }}</td>
					</tr>
					@if ( $shipping->method == 'Charges Shipping' )
					<tr>
						<td>{{ ++$i }}</td>
						<th>Amount</th>
						<td>{{ $currency }} {{ $amount }}</td>
					</tr>
					@endif
				</table>
			</div>
		</div>
	</div>
</div>
@stop