@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		CPF <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{URL::to('admin')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/cpf')}}">CPF</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				New
			</li>
		</ul>
	</div>

	<div class="row">
	<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet box blue-madison">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-dollar"></i>CPF Management
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							{{ Form::open(array('url'=>'admin/cpf', 'class'=>'form-horizontal')) }} 
							<input type="hidden" name="month" value="{{ $month }}">
								<div class="form-body">
									<div class="alert alert-info">
										CPF Payment For {{ date('F Y',strtotime('01-'.$month))}}
									</div>
									<h3 class="form-section">CPF<small> informations</small></h3>
									
									@if ($errors->has('payment_date')) 
									<div class="alert alert-danger">
										You have some form errors. Please check below.
									</div>
									 @endif

									<div class="form-group">
										<label class="control-label col-md-3">Contribution By Employee <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<span class="form-control">
											{{ $contByEmployee }}
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Contribution By Employer <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<span class="form-control">
											{{ $contByEmployer }}
											</span>
										</div>
									</div>

									<div class="form-group @if ($errors->has('payment_date')) has-error @endif">
										<label class="control-label col-md-3">Payment Date<span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<input type="text" name="payment_date" class="form-control datepicker" value="">
											@foreach($errors->get('payment_date') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        		@endforeach
										</div>
									</div>

								</div>	
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
											<button type="button" class="btn grey-cascade" id="back">Cancel</button>
										</div>
									</div>
								</div>		
								
											
							{{Form::close()}}
							<!-- END FORM-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
</div>
@stop
@stop