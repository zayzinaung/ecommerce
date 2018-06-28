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
						<span aria-hidden="true" class="icon-directions"></span> Shipping Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

				{{ Form::model($shipping, array('method' => 'PUT', 'route'=> array('admin.shipping.update', $shipping->id),  'class'=>'form-horizontal')) }}
				<!-- BEGIN FORM-->
				<div class="form-body">

					<h3 class="form-section">Shipping Information</h3>

					@if ($errors->has('day') || $errors->has('amount'))
						<div class="alert alert-danger">
							You have some form errors. Please check below.
						</div>
					@endif

					<input type="hidden" name="id" value="{{ $shipping->id }}">

					<div class="form-group  @if ($errors->has('day')) has-error @endif">
						<label class="control-label col-md-3">Day<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('day', $day, array('class'=>'form-control')) }}
							@foreach($errors->get('day') as $error)
							          <span class="help-block"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@if ( $shipping->method == 'Charges Shipping' )
					<div class="form-group  @if ($errors->has('amount')) has-error @endif">
						<label class="control-label col-md-3">Amount<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('amount', $amount, array('class'=>'form-control')) }}
							@foreach($errors->get('amount') as $error)
							          <span class="help-block"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@endif

				</div>

				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Update</button>
							<button type="button" class="btn grey-cascade" id="back">Cancel</button>
						</div>
					</div>
				</div>					
				{{ Form::close() }}
				<!-- END FORM-->

				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>
@stop