@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Product Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/product_info')}}">Product Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/country')}}">Country Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				New
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-7">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption">
						<span aria-hidden="true" class="icon-flag"></span> Country Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/country', 'class'=>'form-horizontal', 'files' => true)) }}
						<div class="form-body">

							<h3 class="form-section">Country Information</h3>
							
							@if ($errors->has('name') || $errors->has('code') || $errors->has('country_calling')) 
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Name<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', Input::old('name'), array('class'=>'form-control','placeholder'=>'Country Name')) }}
									@foreach($errors->get('name') as $error)
									    	<span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('code')) has-error @endif">
								<label class="control-label col-md-3">Code<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('code', Input::old('code'), array('class'=>'form-control','placeholder'=>'Country Code')) }}
									@foreach($errors->get('code') as $error)
									    	<span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
					            		<label class="control-label col-md-3">Flag<span class="required">* </span></label>
					            		<div class="col-md-6">
					                			{{ Form::file('flag[]', ['class' => 'multi max-1 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
					                			@foreach($errors->get('flag') as $error)
					                    				<span class="help-inline"> {{ $error }}</span>
					                			@endforeach
					            		</div>
					        		</div>

							<div class="form-group @if ($errors->has('country_calling')) has-error @endif">
								<label class="control-label col-md-3">Calling Code<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('country_calling', Input::old('country_calling'), array('class'=>'form-control','placeholder'=>'Calling Code')) }}
									@foreach($errors->get('country_calling') as $error)
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
</div>
@stop