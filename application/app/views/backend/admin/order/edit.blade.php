@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Shipment Level <small>management</small>
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
				Edit
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-7">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption">
						<span aria-hidden="true" class="icon-basket-loaded"></span> Shipment Level Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>

				<div class="portlet-body form">

				@if ( $order->shipment_level == 3 || ( $order->courier_name != null && $order->courier_no != null && $order->delivered_on != 0 ) )
				<div class="form-body">
					<h3 class="form-section">Shipping Status</h3>
					<div class="form-group">
						<?php $delivered_on = date($date_format); ?>
						<label class="control-label">{{ $level }} {{ $delivered_on }}.</label>
					</div>
				</div>
				@else

				{{ Form::model($order, array('method' => 'PUT', 'route'=> array('admin.order.update', strtolower($order->bill_no)),  'class'=>'form-horizontal')) }}
				<div class="form-body">
					
					@if ( $errors->has('name') || $errors->has('phone') || $errors->has('date') ) 
					<div class="alert alert-danger">
						You have some form errors. Please check below.
					</div>
					@endif

					<!-- Start Update confirrm text !-->
					<span class="hide" id="update_text">
						<h4>Are you sure you want to Save this Information ?</h4>
		                			<h4>This action can't be undo. </h4>
	                			</span>
	                			<!-- End Update confirrm text !-->

					@if ( $order->shipment_level == 0 )
					<h3 class="form-section">Charges Shipping</h3>	
					<div class="form-group @if ($errors->has('name')) has-error @endif">
						<label class="control-label col-md-3">Courier Name<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('name', Input::old('name'), array('class'=>'form-control')) }}
							@foreach($errors->get('name') as $error)
							<span class="help-inline"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					<div class="form-group @if ($errors->has('phone')) has-error @endif">
						<label class="control-label col-md-3">Courier No.<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('phone', Input::old('phone'), array('class'=>'form-control')) }}
							@foreach($errors->get('phone') as $error)
							<span class="help-inline"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					<div class="form-group @if ($errors->has('date')) has-error @endif">
						<label class="control-label col-md-3">Delivered On<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('date', Input::old('date'), array('class'=>'form-control datepicker')) }}
							@foreach($errors->get('date') as $error)
							<span class="help-inline"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@elseif ( $order->shipment_level == 1 )
					<h3 class="form-section">Free Shipping ( {{ $level }} )</h3>	
					<div class="form-group @if ($errors->has('name')) has-error @endif">
						<label class="control-label col-md-3">Courier Name<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('name', Input::old('name'), array('class'=>'form-control')) }}
							@foreach($errors->get('name') as $error)
							<span class="help-inline"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					<div class="form-group @if ($errors->has('phone')) has-error @endif">
						<label class="control-label col-md-3">Courier No.<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('phone', Input::old('phone'), array('class'=>'form-control')) }}
							@foreach($errors->get('phone') as $error)
							<span class="help-inline"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@elseif ( $order->shipment_level == 2 )
					<h3 class="form-section">Free Shipping ( {{ $level }} )</h3>	
					<div class="form-group @if ($errors->has('date')) has-error @endif">
						<label class="control-label col-md-3">Delivered On<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('date', Input::old('date'), array('class'=>'form-control datepicker')) }}
							@foreach($errors->get('date') as $error)
							<span class="help-inline"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@endif

				</div>
				{{ Form::hidden('level',$order->shipment_level) }}
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="button" class="btn blue-madison update" value="x"><i class="fa fa-save"></i> Update</button>
							<button type="button" class="btn grey-cascade" id="back">Cancel</button>
						</div>
					</div>
				</div>	
				{{ Form::close() }}

				@endif
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>
@stop