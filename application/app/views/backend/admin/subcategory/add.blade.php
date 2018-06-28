@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Subcategory <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/subcategory')}}">Subcategory</a>
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
						<span aria-hidden="true" class="icon-list"></span> Subcategory Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/subcategory', 'class'=>'form-horizontal')) }}
						<div class="form-body">

							<h3 class="form-section">Subcategory<small> informations</small></h3>
							
							@if ($errors->has('name')) 
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							@if(count($categories) != 0)
								<div class="form-group">
									<label class="control-label col-md-3">Category Name <span class="required">* </span></label>
									<div class="col-md-4">
										@foreach ($categories as $cat)
			                                				<?php $category_options[$cat->id] = $cat->category_name; ?>
			                            					@endforeach
			                            					{{ Form::select('category_name', $category_options, null, array('class'=>'form-control m-wrap large')) }}
									</div>
								</div>

								<div class="form-group @if ($errors->has('name')) has-error @endif">
									<label class="control-label col-md-3">Subcategory Name <span class="required">* </span></label>
									<div class="col-md-4">
										{{ Form::text('name', Input::old('name'), array('class'=>'form-control','placeholder'=>'Subcategory Name')) }}
										@foreach($errors->get('name') as $error)
										    	<span class="help-inline"> {{ $error }}</span>
										@endforeach
									</div>
								</div>
							@else
								<div class="alert alert-danger">
									Please create atleast one category first.
								</div>
							@endif
						</div>
								
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
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