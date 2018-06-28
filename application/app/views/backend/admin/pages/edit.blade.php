@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Pages <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/pages')}}">Pages</a>
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
						<span aria-hidden="true" class="icon-docs"></span> Pages Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($pages, array('method' => 'PUT', 'route'=> array('admin.pages.update', $pages->id),  'class'=>'form-horizontal',  'files'=>true)) }}
					
						<div class="form-body">

							<h3 class="form-section">Pages Information</h3>
							
							@if ($errors->has('name') || $errors->has('title'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $pages->id }}">
							
							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Page Name <span class="required">* </span></label>
								<div class="col-md-7">
									{{ Form::text('name', $pages->name, array('class'=>'form-control')) }}
									@foreach($errors->get('name') as $error)
									    	<span class="help-inline">{{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('title')) has-error @endif">
								<label class="control-label col-md-3">Page Title <span class="required">* </span></label>
								<div class="col-md-7">
									{{ Form::text('title', $pages->title, array('class'=>'form-control')) }}
									@foreach($errors->get('title') as $error)
									    	<span class="help-inline">{{ $error }}</span>
									@endforeach
								</div>
							</div>

  							<div class="form-group">
								<label class="control-label col-md-3">Description</label>
								<div class="col-md-7">
									{{ Form::textarea('description', $pages->description, array('id'=>'editor1','class'=>'ckeditor')) }}
								</div>
							</div>
							
							<div class="form-group">
                                					<label class="control-label col-md-3">Image</label>
                                					<ul class="col-md-7" style="list-style:none;">
                                    					<?php $count = 0; ?>
                                    					<?php foreach ($images as $image) { ++$count; ?>
	                                    				<div class="row-fluid product_image">
	                                        					<span class="delete-product-image" rel="{{ URL::to('admin/pages/delete_image/'.$image->id) }}" style="cursor:pointer;margin-right:5px;"><i class="fa fa-trash"></i> Remove</span> 
	                                        					<div class="row-fluid">
	                                            					<span>
	                                                						<li class="thumbnail col-md-3">
	                                                    						<img src="{{ URL::to('/uploads/pages/'.$image->image) }}">
	                                                						</li>
	                                            					</span>
	                                        					</div>
	                                    				</div>
	                                				<?php } ?>
                                    					<div class="row-fluid">
                                    					<span>
                                        					@if($count != 1)
                                            				<li>
                                                					{{ Form::file('page_image[]', ['class' => 'multi max-1 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
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