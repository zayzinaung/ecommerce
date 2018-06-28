@extends('backend.template.template')
@section('content')
<script type="text/javascript">
	$(function(){
    	/*Showing the permission of the selected role in right side */
    	$("#role_id").change(function(){
       		if( (roleId = $(this).val()) ){
        		var url = "{{URL::to('/admin/permission/getPermissionByRole"+"/"+roleId+"/true')}}";
        		/*Reterive modules that the current role can access*/

        		$.post("{{URL::to('/admin/role/get_role/')}}"+"/"+roleId,{},function(data){
          			permObj = $.parseJSON(data);
          			$('.role-text').html(permObj['description']);

         			/* attach a link to edit modules */
          			edit = "{{URL::to('/admin/permission/view_permission/')}}"+permObj['description'];
          			$('.edit-link').html("<a href='"+edit+"'> edit permission here</a> ");
        		});

        		$.post(url,{},function(data){
          			var list = "";
             		console.log(data); 
            		dataObj =  $.parseJSON(data);
            		if (dataObj.length > 0) {
			            $.each(dataObj, function(key, val) {                 
			            	list += "<li>"+ val['permission'] +" module </li>";              
			            });
            		} else {
               			list += "<li> no permission </li>" ;
            		}
          
          			$("#role-detail").html(list);
        		});
        
       		}
      		return false;
    	});
	});
</script>
<div class="page-content">
	<h3 class="page-title">
		User <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/user')}}">User</a>
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
						<span aria-hidden="true" class="icon-user"></span> User Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/user', 'class'=>'form-horizontal')) }} 
						<div class="form-body">

							<h3 class="form-section">User<small> informations</small></h3>
									
							@if ($errors->has('name') || $errors->has('email') || $errors->has('email') || $errors->has('username')|| $errors->has('password') || $errors->has('role_id')) 
								<div class="alert alert-danger">
									You have some form errors. Please check below.
								</div>
							@endif

							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3">Name<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('name', Input::old('name'), array('class'=>'form-control','placeholder'=>'Name')) }}
									@foreach($errors->get('name') as $error)
									    	<span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('email')) has-error @endif">
								<label class="control-label col-md-3">Email<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('email', Input::old('email'), array('class'=>'form-control','placeholder'=>'Email')) }}
									@foreach($errors->get('email') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('username')) has-error @endif">
								<label class="control-label col-md-3">Username<span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::text('username', Input::old('username'), array('class'=>'form-control','placeholder'=>'Username')) }}
									@foreach($errors->get('username') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('password')) has-error @endif">
								<label class="control-label col-md-3">Password <span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::password('password', array('class' => 'form-control','placeholder'=>'Password')) }}
									@foreach($errors->get('password') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('passconf')) has-error @endif">
								<label class="control-label col-md-3">Re-enter Password <span class="required">* </span></label>
								<div class="col-md-4">
									{{ Form::password('passconf', array('class' => 'form-control','placeholder'=>'Confirm Password')) }}
									@foreach($errors->get('passconf') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('role_id')) has-error @endif">
								<label class="control-label col-md-3">Role<span class="required">* </span></label>
								<div class="col-md-4">
									<select name="role_id" class="form-control" id="role_id">
										<option value="">Choose Role</option>
										<?php foreach ($roles as $row) {?>
										<option value="<?php echo $row->id; ?>"><?php echo ucfirst($row->description); ?></option>  
										<?php } ?>
									</select>
									@foreach($errors->get('role_id') as $error)
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
								
					{{Form::close()}}
					<!-- END FORM-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
		<div class="col-md-5 alert alert-danger">
			<p>The selected role, <strong class="role-text"> Select Role </strong> , can have access to the follwoing modules</p>
			<ul id="role-detail"></ul>
			<p class="edit-link"></p>
		</div>
	</div>
</div>
@stop