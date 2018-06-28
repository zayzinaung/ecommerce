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
						<span aria-hidden="true" class="icon-flag"></span> Country Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($country, array('method' => 'PUT', 'route'=> array('admin.country.update', $country->id),  'class'=>'form-horizontal',  'files'=>true)) }}
					
						<div class="form-body">

							<h3 class="form-section">Country Information<small> management</small></h3>
							
							@if ($errors->has('name') || $errors->has('code') || $errors->has('country_calling'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $country->id }}">
							
							<div class="form-group  @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Name<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', $country->country_name, array('class'=>'form-control','placeholder'=>'Country Name')) }}
									@foreach($errors->get('name') as $error)
							            		<span class="help-block"> {{ $error }}</span>
							        		@endforeach
								</div>
							</div>

							<div class="form-group">
                                					<label class="control-label col-md-3">Flag<span class="required">* </span></label>
                                					<ul class="col-md-6" style="list-style:none;">
                                    					<?php $count = 0; ?>
                                    					<?php foreach ($images as $image) { ++$count; ?>
	                                    				<div class="row-fluid product_image">
	                                        					<span class="delete-product-image" rel="{{ URL::to('admin/country/delete_image/'.$image->id) }}" style="cursor:pointer;margin-right:5px;"><i class="fa fa-trash"></i> Remove</span> 
	                                        					<div class="row-fluid">
	                                            				<span>
	                                                				<li class="thumbnail col-md-3">
	                                                    				<img src="{{ URL::to('/uploads/flags/'.$image->flag) }}">
	                                               				 </li>
	                                            				</span>
	                                        					</div>
	                                    				</div>
	                                				<?php } ?>
                                    					<div class="row-fluid">
                                    					<span>
                                        					@if($count != 1)
                                            					<li>
                                                						{{ Form::file('flag[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
                                            					</li>
                                    					@endif
                                    					</span>
                                    					</div>
                                					</ul>
                            					</div>

                            					<div class="form-group  @if ($errors->has('code')) has-error @endif">
								<label class="control-label col-md-3">Code<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('code', $country->country_code, array('class'=>'form-control','placeholder'=>'Country Code')) }}
									@foreach($errors->get('code') as $error)
							            		<span class="help-block"> {{ $error }}</span>
							       		@endforeach
								</div>
							</div>

							<div class="form-group  @if ($errors->has('country_calling')) has-error @endif">
								<label class="control-label col-md-3">Calling Code<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('country_calling', $country->calling_code, array('class'=>'form-control','placeholder'=>'Calling Code')) }}
									@foreach($errors->get('country_calling') as $error)
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