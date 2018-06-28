@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Member <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/member')}}">Member</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Add New
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-7">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption">
						<span aria-hidden="true" class="icon-users"></span> Member Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/member', 'class'=>'form-horizontal')) }}
					
						<div class="form-body">

							<h3 class="form-section">Member<small> informations</small></h3>
							
							@if ($errors->has('username') || $errors->has('email') || $errors->has('phone') || $errors->has('address') ||  $errors->has('password') || $errors->has('confirm_password') )
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<div class="form-group @if ($errors->has('username')) has-error @endif">
								<label class="control-label col-md-3">Name<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('username', Input::old('username'),array('class'=>'form-control')) }}
									@foreach($errors->get('username') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('email')) has-error @endif">
								<label class="control-label col-md-3">Email<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('email', Input::old('email'),array('class'=>'form-control')) }}
									@foreach($errors->get('email') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
					                     	<label class="col-lg-3 control-label">Gender Neutral<span class="require">*</span></label>
					                        	<div class="col-lg-4">
					                         		{{ Form::radio('neutral', 'Mr', true) }} Mr.
                                						{{ Form::radio('neutral', 'Mrs') }} Mrs.
					                        	</div>
					                 	</div>

							<div class="form-group @if ($errors->has('phone')) has-error @endif">
								<label class="control-label col-md-3">Phone<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('phone', Input::old('phone'),array('class'=>'form-control')) }}
									@foreach($errors->get('phone') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
                        						<label class="col-lg-3 control-label">Landline</label>
                        						<div class="col-lg-4">
                          							{{ Form::text('landline','',array('class'=>'form-control')) }}
                        						</div>
                     	 				</div>

                      					<div class="form-group @if ($errors->has('address')) has-error @endif">
                        						<label class="col-lg-3 control-label">Address <span class="required">*</span></label>
                        						<div class="col-lg-4">
                          							{{ Form::textarea('address','', array('class'=>'form-control','rows'=>2)) }}
                          							@foreach($errors->get('address') as $error)
                            								<span class="help-inline"> {{ $error }}</span>
                          							@endforeach
                        						</div>
                      					</div>

                      					<div class="form-group">
                        						<label for="countries" class="col-lg-3 control-label">Country <span class="required">*</span></label>
                       			 			<div class="col-lg-4">
                          							<select class="form-control tech" name="country" id="country">
                            							<?php foreach ( $countries as $country ) { $a = '' ?>
                            							<?php if ( $country->country_name == 'Singapore' ) { $a = 'selected'; } ?>
                            								<option value="{{ $country->id }}" data-image="{{ URL::to('/uploads/flags/'.$country->flag) }}" {{ $a }}>{{ $country->country_name }}</option>
                            							<?php } ?>
                        							</select>
                        						</div>
                      					</div>

                      					<div class="form-group @if ($errors->has('password')) has-error @endif">
								<label class="control-label col-md-3">Password<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::password('password', array('class' => 'form-control')) }}
									@foreach($errors->get('password') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('confirm_password')) has-error @endif">
								<label class="control-label col-md-3">Confirm Password<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::password('confirm_password', array('class' => 'form-control')) }}
									@foreach($errors->get('confirm_password') as $error)
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
					{{ Form::close() }}
					<!-- END FORM-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>
@stop

@section('scripts')

{{ HTML::style('backend/ddselect/dd.css') }}
{{ HTML::style('backend/ddselect/skin2.css') }}
{{ HTML::script('backend/ddselect/jquery.dd.min.js') }}

<script type="text/javascript">
    $(document).ready(function(e) {
          $("#country").msDropdown({roundedCorner:false});
    });
     </script>
@stop