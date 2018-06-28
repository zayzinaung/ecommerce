@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Order <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/order')}}">Order Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Order Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-basket-loaded"></span> Order Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="btn-group">
					<a href="{{ URL::to('admin/orders/cancel_list') }}" >
						<button id="sample_editable_1_new" class="btn red-sunglo">
							<span aria-hidden="true" class="icon-trash"></span> Order Cancel List
						</button>
					</a>
				</div>
				<div class="btn-group" style="float:right">
					<a href="{{ URL::to('admin/orders/report_pdf') }}" class="btn btn-sm grey-cascade" target="_blank" style="margin-right:10px">
						<i class="fa fa-file-pdf-o"></i> Save as PDF
					</a>
					<a href="{{ URL::to('admin/orders/report_excel') }}" class="btn btn-sm grey-cascade" target="_blank">
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
					<h4>Are you sure you want to add this Orer to Cancel list ?</h4>
	                			<h4>This action can't be undo. </h4>
                			</span>
                			<!-- End Delete confirrm text !-->
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Consignment No.</th>
							<th>Bill no</th>
							<th>Order Date</th>
							<th>MOP</th>
							<th>Shipping</th>
							<th>Payment Method</th>
							<th>Shipment Status</th>
							<th>Option</th>
							<th>Receipt</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($orders as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<?php $time = strtotime($row->order_date); $date = date($date_format,$time); ?>
								<td>
									{{ $prefix }}-{{ $date }}-{{ $row->bill_no }}
								</td>
								<td>
									{{ $row->bill_no }}
								</td>
								<td>
									{{ $date }}
								</td>
								<td>
									{{ ucfirst($row->payment_method) }}
								</td>
								<td>
									@if ( $row->shipment_level != 0 )
										Free Shipping
									@else
										Charges Shipping
									@endif
								</td>
								<td>
									@if ( $row->payment_method != 'paypal' )
										@if ( $row->is_paid == 0 )
											<a href="{{ URL::to('admin/order/order_payment/'.strtolower($row->bill_no)) }}" style="color:red">Unpaid</a>
										@else
											Paid
										@endif
									@else
										Paid
									@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'edit'))
										<a href="{{ URL::to('admin/order/'.strtolower($row->bill_no).'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Update Shipment"><span aria-hidden="true" class="icon-note"></span></a>
										<?php $level = Shipment_level::find($row->shipment_level); ?>
										@if ( $level != null )
											<span>{{ $level->level_status_message }}</span>
										@else
											@if ( $row->courier_name == null && $row->courier_no == null && $row->delivered_on == 0 )
												<span>{{ $stage->level_status_message }}</span>
											@else
												<span>{{ $stage3->level_status_message }}</span>
											@endif
										@endif
									@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/order/'.strtolower($row->bill_no)) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View" target="_blank"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('url'=>'admin/order/addto_cancel/'.$row->bill_no, 'class'=>'form-horizontal','style'=>'display: inline')) }}
										<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Cancel Order" ><span aria-hidden="true" class="icon-ban"></span></button>
										{{ Form::close() }}
									@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/order/view_receipt/'.strtolower($row->bill_no)) }}" class="btn purple-plum tooltips" data-placement="bottom" data-original-title="Export Receipt"><i class="fa fa-file-pdf-o fa fa-white"></i></a>
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