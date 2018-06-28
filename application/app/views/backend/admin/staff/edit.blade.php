@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Staff <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/staff')}}">Staff</a>
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
								<span aria-hidden="true" class="icon-emoticon-smile"></span> Staff
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							 {{ Form::model($staff, array('method' => 'PUT', 'route'=> array('admin.staff.update', $staff->id),  'class'=>'form-horizontal')) }} 
								<div class="form-body">

									<h3 class="form-section">Staff <small>Basic informations</small></h3>
									
									@if ($errors->has('name') || $errors->has('email') || $errors->has('dob') || $errors->has('nrc')) 
									<div class="alert alert-danger">
										You have some form errors. Please check below.
									</div>
									 @endif

									 <div class="form-group @if ($errors->has('salutation')) has-error @endif">
										<label class="control-label col-md-3">Salutation <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<select name="salutation" placeholder="" class="form-control select2">
										                    <option value="dr">Dr</option>
										                    <option value="m/s">M/S</option>
										                    <option value="mdm">Mdm</option>
										                    <option value="miss">Miss</option>
										                    <option value="mr">Mr</option>
										                    <option value="mrs">Mrs</option>
										                    <option value="ms">Ms</option>              
										           </select>
											@foreach($errors->get('salutation') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        		@endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('name')) has-error @endif">
										<label class="control-label col-md-3">Name <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<input type="text" name="name" placeholder="Name" class="form-control" value="{{ $staff->name; }}" />
											@foreach($errors->get('name') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('email')) has-error @endif">
										<label class="control-label col-md-3">Email <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<input type="text" name="email" placeholder="Email" class="form-control" value="{{ $staff->email; }}" />
											@foreach($errors->get('email') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('ictype')) has-error @endif">
										<label class="control-label col-md-3">Identification Type <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<select name="ictype" placeholder="" class="form-control select2">
										                  <option vlaue="pr">Singaporean/PR(Pink/Blue) IC</option>
										                    <option vlaue="wp">Work Permit</option>
										                    <option vlaue="sp">Special Pass</option>
										                    <option vlaue="ep">Employment Pass</option>
										                    <option vlaue="dp">Dependent Pass</option>   
										           </select>
											@foreach($errors->get('ictype') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        		@endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('fin')) has-error @endif">
										<label class="control-label col-md-3">NRIC/FIN <span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<input type="text" name="fin" placeholder="" class="form-control" value="{{ $staff->fin }}" />
											@foreach($errors->get('fin') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('fin_exp_date')) has-error @endif">
										<label class="control-label col-md-3">Permit Exp 
										</label>
										<div class="col-md-4">
											<input type="text" name="fin_exp_date" placeholder="Date" class="form-control datepicker" value="{{ $staff->fin_exp_date }}" />
											@foreach($errors->get('fin_exp_date') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('ppn')) has-error @endif">
										<label class="control-label col-md-3">Passport No<span class="required">
										* </span>
										</label>
										<div class="col-md-4">
											<input type="text" name="ppn" placeholder="No." class="form-control" value="{{ $staff->ppn }}" />
											@foreach($errors->get('ppn') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('ppn_exp_date')) has-error @endif">
										<label class="control-label col-md-3">Passport Exp
										</label>
										<div class="col-md-4">
											<input type="text" name="ppn_exp_date" placeholder="Date" class="form-control datepicker" value="{{ $staff->ppn_exp_date }}" />
											@foreach($errors->get('ppn_exp_date') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('dob')) has-error @endif">
										<label class="control-label col-md-3">Date of Birth<span class="required">
										* </span>
										</label>
										<div class="col-md-3">
											<input type="text" name="dob" placeholder="Date" class="form-control mask-dob" value="{{ date('d-m-Y',$staff->dob); }}" />
											@foreach($errors->get('dob') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('designation')) has-error @endif">
										<label class="control-label col-md-3">Designation<span class="required">
										* </span>
										</label>
										<div class="col-md-3">
											<input type="text" name="designation" placeholder="Designation" class="form-control" value="{{ $staff->designation; }}" />
											@foreach($errors->get('designation') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('join_date')) has-error @endif">
										<label class="control-label col-md-3">Join Date<span class="required">
										* </span>
										</label>
										<div class="col-md-3">
											<input type="text" name="join_date" placeholder="Date" class="form-control datepicker" value="{{ date('d-m-Y',$staff->join_date); }}" />
											@foreach($errors->get('join_date') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
									        @endforeach
										</div>
									</div>

									<div class="form-group @if ($errors->has('salary')) has-error @endif">
										<label class="control-label col-md-3">Basic Salary<span class="required">
										* </span>
										</label>
										<div class="col-md-2">
											<input type="text" name="salary" placeholder="Amount" class="form-control" value="{{ $staff->salary; }}" />
											@foreach($errors->get('salary') as $error)
									            	<span class="help-inline"> {{ $error }}</span>
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
@stop