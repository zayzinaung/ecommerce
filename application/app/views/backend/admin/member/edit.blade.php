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
						<span aria-hidden="true" class="icon-users"></span> Member Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					{{ Form::model($member, array('method' => 'PUT', 'route'=> array('admin.member.update', $member->id),  'class'=>'form-horizontal')) }}
					
						<div class="form-body">

							<h3 class="form-section">Member<small> informations</small></h3>
							
							@if ($errors->has('name'))
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<input type="hidden" name="id" value="{{ $member->id }}">
							
							<div class="form-group  @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Name<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', $member->username,array('class'=>'form-control')) }}
									@foreach($errors->get('name') as $error)
							            		<span class="help-block"> {{ $error }}</span>
							        		@endforeach
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Email<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('email', $member->email,array('class'=>'form-control','disabled'=>'disabled')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Phone<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('phone', $member->phone,array('class'=>'form-control','disabled'=>'disabled')) }}
								</div>
							</div>
							
                                				<div class="form-group">
								<label class="control-label col-md-3">Gender Neutral</label>
								<div class="col-md-4">
									{{ Form::radio('neutral', 'Mr', $member->neutral == 'Mr') }} Mr
                                						{{ Form::radio('neutral', 'Mrs', $member->neutral == 'Mrs') }} Mrs
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Landline</label>
								<div class="col-md-4">
									{{ Form::text('landline', $member->landline,array('class'=>'form-control')) }}
								</div>
							</div>

							<div class="form-group  @if ($errors->has('address')) has-error @endif">
								<label class="control-label col-md-3">Address<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::textarea('address', $member->address, array('class'=>'form-control','rows'=>'3')) }}
									@foreach($errors->get('address') as $error)
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
					{{Form::close()}}
					<!-- END FORM-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>
@stop