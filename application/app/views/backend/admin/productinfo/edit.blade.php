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
						<span aria-hidden="true" class="icon-list"></span> Product Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($product_info, array('method' => 'PUT', 'route'=> array('admin.product_info.update', $product_info->id),  'class'=>'form-horizontal',  'files'=>true)) }}
					
						<div class="form-body">

							<h3 class="form-section">Product Information</h3>
							
							@if ($errors->has('name') || $errors->has('type'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $product_info->id }}">
							
							<div class="form-group  @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-4">Product Information Label<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', $product_info->product_label, array('class'=>'form-control','placeholder'=>'Product Information Label')) }}
									@foreach($errors->get('name') as $error)
							            		<span class="help-block"> {{ $error }}</span>
							        		@endforeach
								</div>
							</div>
							
							<div class="form-group @if ($errors->has('type')) has-error @endif">
				                                	<label class="control-label col-md-4">Choose Type<span class="required">* </span></label>
				                                	<ul class="col-md-8" style="list-style:none;">
				                                		{{ Form::radio('type', 'textarea', $product_info->input_type == 'textarea') }} Textarea
				                                		{{ Form::radio('type', 'text', $product_info->input_type == 'text') }} Text
								    	@foreach($errors->get('type') as $error)
										<span class="help-block"> {{ $error }} </span>
									@endforeach
				                               	 	</ul>
				                            </div>

						</div>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-4 col-md-9">
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