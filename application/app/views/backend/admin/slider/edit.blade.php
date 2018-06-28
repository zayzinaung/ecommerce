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
				<a href="{{URL::to('admin/slider')}}">Slider Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Edit
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption">
						<span aria-hidden="true" class="icon-equalizer"></span> Slider Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($slider, array('method' => 'PUT', 'route'=> array('admin.slider.update', $slider->id),  'class'=>'form-horizontal',  'files'=>true)) }}
					
						<div class="form-body">

							<h3 class="form-section">Slider Information</h3>
							
							@if ($errors->has('name'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $slider->id }}">
							
							<div class="form-group  @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-2">Name</label>
								<div class="col-md-4">
									{{ Form::text('name', $slider->slider_name, array('class'=>'form-control','placeholder'=>'Slider Name')) }}
									@foreach($errors->get('name') as $error)
							            		<span class="help-block"> {{ $error }}</span>
							        		@endforeach
								</div>
							</div>

							<div class="form-group">
                                					<label class="control-label col-md-2">Image<span class="required">* </span></label>
                                					<ul class="col-md-6" style="list-style:none;">
                                    					<?php $count = 0; ?>
                                    					<?php foreach ($images as $image) { ++$count; ?>
	                                    				<div class="row-fluid product_image" style="float:left">
	                                        					<span class="delete-product-image" rel="{{ URL::to('admin/slider/delete_image/'.$image->id) }}" style="cursor:pointer;margin-right:5px;"><i class="fa fa-trash"></i> Remove</span> 
	                                        					<div class="row-fluid">
	                                            				<span>
	                                                				<li class="thumbnail col-md-3">
	                                                    				<img src="{{ URL::to('/uploads/sliders/'.$image->slider_image) }}">
	                                               				 </li>
	                                            				</span>
	                                        					</div>
	                                    				</div>
	                                				<?php } ?>
                                    					<div class="row-fluid" style="float:left">
                                    					<span>
                                            					<li>
                                                						{{ Form::file('slider_image[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
                                            					</li>
                                    					</span>
                                    					</div>
                                					</ul>
                            					</div>

                            					<div class="form-group  @if ($errors->has('description')) has-error @endif">
								<label class="control-label col-md-2">Description<span class="required">* </span></label>
								<div class="col-md-9">
									{{ Form::textarea('description', $slider->description, array('id'=>'editor1','class'=>'ckeditor')) }}
									@foreach($errors->get('description') as $error)
							            <span class="help-block"> {{ $error }}</span>
							        @endforeach
								</div>
							</div>

						</div>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-2 col-md-9">
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