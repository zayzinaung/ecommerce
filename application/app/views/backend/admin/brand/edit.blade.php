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
						<span aria-hidden="true" class="icon-list"></span> Brand Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($brand, array('method' => 'PUT', 'route'=> array('admin.brand.update', $brand->id),  'class'=>'form-horizontal',  'files'=>true)) }}
					
						<div class="form-body">

							<h3 class="form-section">Brand Information</h3>
							
							@if ($errors->has('name'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $brand->id }}">
							
							<div class="form-group  @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Brand Name<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', $brand->brand_name, array('class'=>'form-control','placeholder'=>'Brand Name')) }}
									@foreach($errors->get('name') as $error)
							            		<span class="help-block">{{ $error }}</span>
							        		@endforeach
								</div>
							</div>
							
							<div class="form-group">
                                					<label class="control-label col-md-3">Brand Icon<span class="required">* </span></label>
                                					<ul class="col-md-6" style="list-style:none;">
                                    					<?php $count = 0; ?>
                                    					<?php foreach ($images as $image) { ++$count; ?>
	                                    				<div class="row-fluid product_image">
	                                        					<span class="delete-product-image" rel="{{ URL::to('admin/brand/delete_image/'.$image->id) }}" style="cursor:pointer;margin-right:5px;"><i class="fa fa-trash"></i> Remove</span> 
	                                        					<div class="row-fluid">
	                                            					<span>
	                                                						<li class="thumbnail col-md-3">
	                                                    						<img src="{{ URL::to('/uploads/brand_icons/'.$image->brand_icon) }}">
	                                                						</li>
	                                            					</span>
	                                        					</div>
	                                    				</div>
	                                				<?php } ?>
                                    					<div class="row-fluid">
                                    					<span>
                                        					@if($count != 1)
                                            				<li>
                                                					{{ Form::file('userfile[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
                                            				</li>
                                    					@endif
                                    					</span>
                                    					</div>
                                					</ul>
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