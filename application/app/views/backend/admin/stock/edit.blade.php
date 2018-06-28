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
						<span aria-hidden="true" class="icon-calculator"></span> Stocks Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($stock, array('method' => 'PUT', 'route'=> array('admin.stock.update', $stock->id),  'class'=>'form-horizontal')) }}
					
						<div class="form-body">

							<h3 class="form-section">Stocks Information</h3>
							
							@if ($errors->has('name') || $errors->has('date') || $errors->has('amount') )
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $stock->id }}">

							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Stock Name<span class="required">* </span></label>
								<div class="col-md-6">
									{{ Form::text('name', $stock->stock_name,array('class'=>'form-control')) }}
									@foreach($errors->get('name') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('date')) has-error @endif">
								<label class="control-label col-md-3">Buying Date<span class="required">* </span></label>
								<div class="col-md-6">
									{{ Form::text('date', date($date_format,$stock->buying_date),array('class'=>'form-control datepicker')) }}
									@foreach($errors->get('date') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('amount')) has-error @endif">
								<label class="control-label col-md-3">Amount ( {{ $currency }} )<span class="required">* </span></label>
								<div class="col-md-6">
									{{ Form::text('amount', $stock->amount,array('class'=>'form-control')) }}
									@foreach($errors->get('amount') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Quantity</label>
								<div class="col-md-6">
									{{ Form::text('quantity', $stock->quantity,array('class'=>'form-control')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Bought From</label>
								<div class="col-md-6">
									{{ Form::text('bought_from', $stock->bought_from,array('class'=>'form-control')) }}
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