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
				<span aria-hidden="true" class="icon-calculator"></span> Stocks Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				@if(User::hasPermTo(MODULE,'create'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/stock/create') }}" >
							<button id="sample_editable_1_new" class="btn blue-madison">
								<i class="fa fa-plus"></i> Add New
							</button>
						</a>
					</div>
				@endif
				<div class="btn-group" style="float:right">
					<a href="{{ URL::to('admin/stocks/report_pdf') }}" class="btn btn-sm grey-cascade" target="_blank" style="margin-right:10px">
						<i class="fa fa-file-pdf-o"></i> Save as PDF
					</a>
					<a href="{{ URL::to('admin/stocks/report_excel') }}" class="btn btn-sm grey-cascade" target="_blank">
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
				<span class="hide" id="delete_text">
					<h4>Are you sure you want to Delete this Product Information ?</h4>
	                			<h4>This action can't be undo. </h4>
                			</span>
               			<!-- End Delete confirrm text !-->
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Stock Name</th>
							<th>Buying Date</th>
							<th>Amount</th>
							<th>Quantity</th>
							<th>Bought From</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($stock as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $row->stock_name }}</td>
								<td>{{ date($date_format, $row->buying_date) }}</td>
								<td>{{ $currency }} {{ $row->amount }}</td>
								<td>{{ $row->quantity }}</td>
								<td>{{ $row->bought_from }}</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/stock/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'edit'))
										<a href="{{ URL::to('admin/stock/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.stock.destroy', $row->id), 'style'=>'display: inline')) }}
											<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete" ><span aria-hidden="true" class="icon-trash"></span></button>
										{{ Form::close() }}
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