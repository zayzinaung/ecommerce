@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Offline Sale <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/offline_sale')}}">Offline Sale Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Offline Sale Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-basket-loaded"></span> Offline Sale Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				@if(User::hasPermTo(MODULE,'create'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/offline_sale/create') }}" >
							<button id="sample_editable_1_new" class="btn blue-madison">
								<i class="fa fa-plus"></i> Add New
							</button>
						</a>
					</div>
				@endif
				<div class="btn-group" style="float:right">
					<a href="{{ URL::to('admin/offline_sale_list/report_pdf') }}" class="btn btn-sm grey-cascade" target="_blank" style="margin-right:10px">
						<i class="fa fa-file-pdf-o"></i> Save as PDF
					</a>
					<a href="{{ URL::to('admin/offline_sale_list/report_excel') }}" class="btn btn-sm grey-cascade" target="_blank">
						<i class="fa fa-file-excel-o"></i> Report to Excel
					</a>
				</div>
			</div>
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
			<div class="table-responsive">
				<!-- Start Delete confirrm text !-->
                			<!-- End Delete confirrm text !-->
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th style="width:15%">Customer Name</th>
							<th style="width:15%">Customer Email</th>
							<th style="width:23%">Product Name</th>
							<th style="width:10%">Per Price</th>
							<th style="width:10%">Order Qty</th>
							<th style="width:10%">Total Amount</th>
							<th style="width:10%">Selling Date</th>
							<th style="width:7%">MOP</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($offline as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $row->member_name }}</td>
								<td>{{ $row->email_address }}</td>
								<td>
									<?php $product = Product::find($row->product_id); ?>
									{{ $product->product_name }}
								</td>
								<td>{{ $currency }} {{ $row->per_price }}</td>
								<td>{{ $row->order_quantity }}</td>
								<td>{{ $currency }} {{ $row->total_amount }}</td>
								<td>{{ date($date_format,$row->selling_date) }}</td>
								<td>
									@if ( $row->cash == 1 )
										Cash
									@elseif ( $row->cheque != null )
										Cheque
									@elseif ( $row->enet != null )
										Enet
									@elseif ( $row->other != null )
										Other
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop