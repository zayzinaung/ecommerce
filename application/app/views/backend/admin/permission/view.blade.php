@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
.checker {
	margin: 0 5px 0 0!important;
}
</style>
@stop

@section('content')
<script type="text/javascript">
	$(function(){
		$('.savePerm').click(function(){
        	var check_item =[];
        	$(':checkbox:checked').each(function(index,element){
				var id = $(this).parents('.module').find('.perm_id').val();
				var desc = $(this).val();
				check_item[index] ={id: id , description: desc };
    		});            
			$.post('{{URL::to("/admin/permission/add_sub_permission")}}', {data : check_item , id4role : $('#id4role').val() }, function(data) {});
			$('#success').removeClass('hide');
          	return false;
        });

        $('body').click(function(){
			$("#success").addClass('hide');
        });

        $('.remove-module').click(function(){
			if(confirm('You are about to delete')){
				$.ajax({
                    type : 'GET',                        
                    url : $(this).attr('src'),
                    success : function(success){}    
				});
				$(this).parents('.module').fadeOut('fast');
            }
        });
  	});
</script>
<div class="page-content">
    <h3 class="page-title">
        Role <small>management</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
			<li>
            	<span aria-hidden="true" class="icon-home"></span>
            	<a href="{{URL::to('admin/')}}">Home</a>
            	<i class="fa fa-angle-right"></i>
			</li>
          	<li>
            	<a href="{{URL::to('admin/role')}}">Role</a>
              	<i class="fa fa-angle-right"></i>
          	</li>
          	<li>
            	Permission Role List
          	</li>
        </ul>
    </div>
    <div class="row-fluid">
    	<div class="portlet box blue-madison">
			<div class="portlet-title">
        		<div class="caption">
          			<span aria-hidden="true" class="icon-user"></span> Role Permission Management
        		</div>
        		<div class="tools">
          			<a href="javascript:;" class="collapse"></a>
        		</div>
      		</div>

      		<div class="portlet-body">
      			@if( Session::get('success') )
				<div class="alert alert-success">
					{{ Session::get('success') }}
				</div>
			@endif
			@if( Session::get('error') )
				<div class="alert alert-danger">
					{{ Session::get('error') }}
				</div>
			@endif
      			<div class="row">
      				<div class="col-md-12">

				        <div id="success" class="alert alert-block alert-success hide">
				            <strong> Changes have been saved ! </strong>
				        </div>

        				<div class="col-md-6">
					<h3>Change <a>{{ $role->description }}</a> Permission</h3>  
 					{{ Form::open(array('url'=>'admin/permission', 'class'=>'form-horizontal row-fluid')) }}
          					<input type="hidden" name="id4role" id="id4role" value="{{ $role->id }}">
					@foreach ($permission as $permission)
					          <?php
					            	$perm = $permission->permission;
					            	$roleDesc = $role->description;
					          ?>

	            				<div class="row module">
	                					<div class="col-md-10">
	                  						<input type="hidden" name="perm_id" class="perm_id" value="{{ $permission->id }}">
	                  						<legend>{{ $permission->permission }}</legend>

						                    <p>
						                    	<label for="view{{ $perm }}" class="checkbox" >
						                    		<input id="view{{ $perm }}" <?php  User::roleHasPermTo($roleDesc,'view',$perm); ?> type="checkbox" name="descriptions[]" value="view_{{ $perm }}" />View
						                      	</label>
						                    </p>

						                    <p>
						                    	<label class="checkbox" for="create{{ $perm }}"> 
						                    		<input id="create{{ $perm }}" <?php  User::roleHasPermTo($roleDesc,'create',$perm); ?> type="checkbox" name="descriptions[]" value="create_{{ $perm }}" />Create
						                      </label>
						                    </p>

						                    <p>
						                    	<label class="checkbox" for="edit{{ $perm }}">
						                    		<input id="edit{{ $perm }}" <?php User::roleHasPermTo($roleDesc,'edit',$perm); ?> type="checkbox" name="descriptions[]" value="edit_{{ $perm }}" />Edit
						                     </label>
						                    </p>

						                    <p>
						                    	<label class="checkbox" for="delete{{ $perm }}">
						                      	<input id="delete{{ $perm }}" <?php  User::roleHasPermTo($roleDesc,'delete',$perm); ?> type="checkbox" name="descriptions[]" value="delete_{{ $perm }}" />Delete
						                    	</label>
						                    </p>
	                   					</div>
	                  					
	                  					@if(!($permission->permission == 'user' || $permission->permission == 'role'))
						                    <div class="col-md-2">            
						                        <a href="#" class="tooltips" data-placement="top" data-original-title="delete module"><h5 class="remove-module" src="{{URL::to('admin/permission/delete/'.$permission->id)}}" ><i class="fa fa-remove"></i> Remove</h5></a>
						                    </div>
	                    					@endif
	            				</div>
	            			@endforeach

               				<input type="button" rel="{{URL::to('/admin/permission/add_sub_permission')}}" class="savePerm btn blue-madison" value="Save Changes" style="margin-top:20px">
              				{{Form::close()}}
        				</div>

	        			<div class="col-md-5">
	                			{{ Form::open(array('method' => 'GET', 'route' => array('admin.permission.create'), 'style'=>'display: inline', 'class'=>'form-horizontal row')) }}
	                  				<legend>Add New Module to <a>{{ $role->description }}</a></legend>
	                  				<input type="hidden" name="role_id" value="{{ $role->id }}" />
	                  				<input type="hidden" name="current_roleDesc" value="{{ $role->description }}" />
	                  			
	                  				<p class="col-md-8">
				                    	<select name="module" required class="form-control">
				                    		@foreach ($modules as $key => $value)
				                      		@if($value == 'user' || $value == 'module'|| $value == 'role')

				                      		@else
				                      			<option value="{{ $value }}">{{ $value }}</option>
				                      		@endif
				                    		@endforeach
				                    </select>
	                  				</p>

			                  		<p class="col-md-4">
			                    			<button type="submit" class="btn blue-madison"><i class="fa fa-plus"></i>  Add New Permission</button>
			                  		</p>
	               			{{Form::close()}}
	        			</div>
	        		</div>
     			</div>
     		</div>
     	</div>
    </div>
</div>
@stop