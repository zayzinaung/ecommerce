@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Facebook Gallery <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/gallery')}}">Gallery</a>
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
						<span aria-hidden="true" class="icon-grid"></span> Facebook Gallery Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($get_facebook, array('method' => 'PUT', 'route'=> array('admin.fbgallery.update', $get_facebook->id),  'class'=>'form-horizontal')) }}
					
						<div class="form-body">

							<h3 class="form-section">Facebook Gallery<small> informations</small></h3>
							
							@if ($errors->has('name'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $get_facebook->id }}">
							
							<div class="form-group  @if ($errors->has('facebook_id')) has-error @endif">
								<label class="control-label col-md-3">Facebook ID<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('facebook_id', $get_facebook->facebook_id, array('class'=>'form-control')) }}
									@foreach($errors->get('facebook_id') as $error)
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