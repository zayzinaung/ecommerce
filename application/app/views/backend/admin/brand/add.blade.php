@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Brand <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/brand')}}">Brand</a>
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
						<span aria-hidden="true" class="icon-list"></span> Brand Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/brand', 'class'=>'form-horizontal', 'files'=>true)) }}
						<div class="form-body">

							<h3 class="form-section">Brand<small> informations</small></h3>
							
							@if ($errors->has('name')) 
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Brand Name <span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', Input::old('name'), array('class'=>'form-control','placeholder'=>'Brand Name')) }}
									@foreach($errors->get('name') as $error)
									    	<span class="help-inline">{{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
						            	<label class="control-label col-md-3">Brand Icon <span class="required">* </span></label>
						            	<div class="col-md-6">
						                		{{ Form::file('userfile[]', ['class' => 'multi max-1 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
						                		@foreach($errors->get('userfile') as $error)
						                    			<span class="help-inline"> {{ $error }}</span>
						                		@endforeach
						            	</div>
						        	</div>

						</div>
								
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
									<button type="reset" class="btn grey-cascade" id="back">Cancel</button>
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