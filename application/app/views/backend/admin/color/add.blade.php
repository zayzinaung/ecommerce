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
				<a href="{{URL::to('admin/color')}}">Color Information</a>
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
						<span aria-hidden="true" class="icon-list"></span> Color Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/color', 'class'=>'form-horizontal', 'files' => true)) }}
						<div class="form-body">

							<h3 class="form-section">Color Information<small> management</small></h3>
							
							@if ($errors->has('name') || $errors->has('code')) 
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Name</label>
								<div class="col-md-4">
									{{ Form::text('name', Input::old('name'), array('class'=>'form-control','placeholder'=>'Color Name')) }}
									@foreach($errors->get('name') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
					            		<label class="control-label col-md-3">Image<span class="required">* </span></label>
					            		<div class="col-md-6">
					                			{{ Form::file('color_image[]', ['class' => 'multi max-1 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
					                			@foreach($errors->get('color_image') as $error)
					                    				<span class="help-inline"> {{ $error }}</span>
					                			@endforeach
					            		</div>
					        		</div>

							<div class="form-group @if ($errors->has('code')) has-error @endif">
								<label class="control-label col-md-3">Code<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('code', Input::old('code'), array('class'=>'form-control','placeholder'=>'Color Code')) }}
									@foreach($errors->get('code') as $error)
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