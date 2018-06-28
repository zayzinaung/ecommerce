@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Profit and Loss Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/profitandloss')}}">Profit and Loss Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Profit and Loss Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-wallet"></span> Profit and Loss Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				{{ Form::open(array('url'=>'admin/profitandloss/show', 'class'=>'form-horizontal', 'method'=>'GET')) }}
				<div class="btn-group">
					{{ Form::text('from_date','', array('class'=>'form-control datepicker','placeholder'=>'From')) }}
				</div>
				<div class="btn-group">
					{{ Form::text('to_date','', array('class'=>'form-control datepicker','placeholder'=>'To')) }}
				</div>
				<div class="btn-group">
					<button type="submit" class="btn green-meadow"><span aria-hidden="true" class="icon-magnifier-add"></span> Generate</button>
				</div>
				{{ Form::close() }}
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
							<th>Created Date</th>
							<th>From Date &amp; To Date</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($profitandloss as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ date($date_format, strtotime($row->created_at)) }}</td>
								<td>{{ date($date_format, $row->from_date) }} to {{ date($date_format, $row->to_date) }}</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/profitandloss/show?from_date='.date($date_format, $row->from_date).'&to_date='.date($date_format, $row->to_date)) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.profitandloss.destroy', $row->id), 'style'=>'display: inline')) }}
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