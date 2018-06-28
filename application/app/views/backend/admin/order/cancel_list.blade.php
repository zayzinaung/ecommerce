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
				Order Cancel List
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
					<h4>Are you sure you want to Delete this Order?</h4>
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
							<th>Restore</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						@if ( $orders )
						<?php $i = 0; ?>
						@foreach ($orders as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<?php $time = strtotime($row->order_date); $date = date($date_format,$time); ?>
								<td>
									{{$prefix}}-{{ $date }}-{{ $row->bill_no }}
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
									@if(User::hasPermTo(MODULE,'edit'))
									{{ Form::open(array('url'=>'admin/order/restore_order', 'class'=>'form-horizontal')) }}
									{{ Form::hidden('bill_no', $row->bill_no)}}
									{{ Form::hidden('cancel', $row->is_cancel)}}
							            	@if($row->is_cancel==1)
							            		<button type="submit" class="btn purple-plum">
							                			<span aria-hidden="true" class="icon-action-undo"></span>
							            		</button>
							            	@else
							            		<button type="submit" class="btn purple-plum">
							                			<span aria-hidden="true" class="icon-action-undo"></span>
							            		</button>
							            	@endif
							            	{{ Form::close() }}
							            	@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/order/'.strtolower($row->bill_no)) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View" target="_blank"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.order.destroy', $row->bill_no), 'style'=>'display: inline')) }}
											<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete" ><span aria-hidden="true" class="icon-trash"></span></button>
										{{ Form::close() }}
									@endif
								</td>
							</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop