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
						<span aria-hidden="true" class="icon-link"></span> Discount Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

				{{ Form::model($discount, array('method' => 'PUT', 'route'=> array('admin.discount.update', $discount->id),  'class'=>'form-horizontal')) }}
				<!-- BEGIN FORM-->
				<div class="form-body">

					<h3 class="form-section">Discount Information<small> informations</small></h3>

					@if ($errors->has('discount_rate') || $errors->has('remark'))
						<div class="alert alert-danger">
							You have some form errors. Please check below.
						</div>
					@endif

					<input type="hidden" name="id" value="{{ $discount->id }}">
					
					@if ( $discount->method == 'price' )		
					<div class="form-group  @if ($errors->has('price')) has-error @endif">
						<label class="control-label col-md-3">Total Price ( {{ $currency }} ) <span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('price', $price, array('class'=>'form-control')) }}
							@foreach($errors->get('price') as $error)
							          <span class="help-block"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@elseif ( $discount->method == 'qty' )
					<div class="form-group  @if ($errors->has('qty')) has-error @endif">
						<label class="control-label col-md-3">Total Quantity<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('qty', $qty, array('class'=>'form-control')) }}
							@foreach($errors->get('qty') as $error)
							          <span class="help-block"> {{ $error }}</span>
							@endforeach
						</div>
					</div>
					@endif

					<div class="form-group  @if ($errors->has('discount_rate')) has-error @endif">
						<label class="control-label col-md-3">Discount Rate ( % ) <span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::text('discount_rate', $discount_rate, array('class'=>'form-control')) }}
							@foreach($errors->get('discount_rate') as $error)
							          <span class="help-block"> {{ $error }}</span>
							@endforeach
						</div>
					</div>

					<div class="form-group  @if ($errors->has('remark')) has-error @endif">
						<label class="control-label col-md-3">Remark<span class="required">* </span></label>
						<div class="col-md-4">
							{{ Form::textarea('remark', $remark, ['class' => 'form-control','rows'=>'4']) }}
							@foreach($errors->get('remark') as $error)
							          	<span class="help-block"> {{ $error }}</span>
							@endforeach
						</div>
					</div>

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