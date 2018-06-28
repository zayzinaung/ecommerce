@extends('backend.template.template')
@section('content')
{{ HTML::style('css/profile.css')}}
<!-- END PLUGINS USED BY X-EDITABLE -->
<!-- BEGIN X-EDITABLE PLUGIN-->
{{ HTML::style('backend/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}
{{ HTML::style('backend/plugins/bootstrap-editable/inputs-ext/address/address.css')}}

{{ HTML::style('backend/plugins/bootstrap-modal/css/bootstrap-modal.css')}}
{{ HTML::style('backend/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}

{{HTML::script('backend/plugins/moment.min.js')}}
{{HTML::script('backend/plugins/jquery.mockjax.js')}}
  <!-- END PLUGINS USED BY X-EDITABLE -->
  <!-- BEGIN X-EDITABLE PLUGIN -->
{{HTML::script('backend/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js')}}
{{HTML::script('backend/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}
{{HTML::script('backend/plugins/bootstrap-modal/js/bootstrap-modal.js')}}

<script type="text/javascript" >
  $(document).ready(function() { 
   //global settings 
        var uploadPath = '{{URL::to("uploads"); }}';
        var baseUrl = '{{URL::to("/"); }}';

        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = baseUrl+'/admin/staff/update_staff_info';
        $.fn.editableform.buttons = '<button type="submit" class="btn blue editable-submit"><i class="fa fa-check"></i></button>';
        $.fn.editableform.buttons += '<button type="button" class="btn editable-cancel"><i class="fa fa-remove"></i></button>';

        //editables element samples 
        $('.update_info').editable({
            type: 'text',
            pk: '<?php echo $staff->id; ?>',
            name: $('this').attr('id'),
            title: 'Enter '+ $('this').attr('id')
        });

         $('#contract-form').submit(function(e) {
            var urlToGo = $(this).attr('rel');
            var formData = new FormData($(this)[0]);
            $('#contract-status').append('<img src="'+baseUrl+'/img/loading.gif">');
            $.ajax({
                url: urlToGo,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success : function(currentData){            
                 // var currentData = $.parseJSON(data);            
                  if(currentData['success'] != undefined){              
                    $('#contract-link').attr('href',uploadPath+'/contracts/'+currentData['file-name']);
                    $('#contract-status').addClass('alert alert-success');
                    $('#contract-status').html(currentData['success']);
                  }
                  if(currentData['error'] != undefined){
                     $('#contract-status').addClass('alert alert-error');
                     $('#contract-status').html(currentData['error']);
                  }
                }
            });      
            e.preventDefault();
          });

        $('#resume-form').submit(function(e) {
          var urlToGo = $(this).attr('rel');
          var formData = new FormData($(this)[0]);
          $('#resume-status').append('<img src="'+baseUrl+'/img/loading.gif">');
          $.ajax({
              url: urlToGo,
              type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success : function(currentData){            
               // var currentData = $.parseJSON(data);            
                if(currentData['success'] != undefined){              
                  $('#resume-link').attr('href',uploadPath+'/resumes/'+currentData['file-name']);
                  $('#resume-status').addClass('alert alert-success');
                  $('#resume-status').html(currentData['success']);
                }
                if(currentData['error'] != undefined){
                   $('#resume-status').addClass('alert alert-error');
                   $('#resume-status').html(currentData['error']);
                }
              }
          });      
          e.preventDefault();
        });

      $('#profile-form').submit(function(e) {
        var url = $(this).attr('rel');
        var formData = new FormData($(this)[0]);
        $('#profile-status').append('<img src="'+baseUrl+'/img/loading.gif">');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success : function(currentData){            
             // var currentData = $.parseJSON(data);
              if(currentData['success'] != undefined){              
                $('.profile img').attr('src', uploadPath +'/profiles/'+currentData['file-name'] );
                $('#profile-status').addClass('alert alert-success');
                $('#profile-status').html(currentData['success']);
              }
              if(currentData['error'] != undefined){
                 $('#profile-status').addClass('alert alert-error');
                 $('#profile-status').html(currentData['error']);
              }
            }
        });      
        e.preventDefault();
      });

});
</script>




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
					Staff Detail
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-emoticon-smile"></span> Staff Management - <?php echo $staff->name; ?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
				</div>
			</div>
			<!-- BEGIN PAGE CONTENT-->
			<div class="portlet-body">
			<div class="table-toolbar">
						<div class="btn-group pull-right">
							<a data-target="#add_attribute_modal" data-toggle="modal" > <button id="add_new" class="btn blue-madison">
								<i class="fa fa-plus"></i> Add New Attribute 
							</button></a>
						</div>
			</div>

			<div class="row profile">
				<div class="col-md-12">
					<!--BEGIN TABS-->
					<div class="tabbable tabbable-custom tabbable-full-width">
						
							<div class="tab-pane active" >
								<div class="row profile-account">

									<div class="col-md-3">
									<div class="row-fluid">
									<?php   $details = ($staff->data)?unserialize($staff->data):array();  ?>
								                     <a  data-target="#change_profile_modal" data-toggle="modal" class="thumbnail"><img src="<?php echo Staff::get_file($staff->id,'profiles'); ?>" alt="" /></a>
								           </div>
								           <div class="row-fluid">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li>
								                                <a data-toggle="tab" href="#tab_1-1">
								                                <i class="fa fa-user"></i> 
								                                Personal Detail
								                                </a> 
								                                <span class="after"></span>                                    
								                              </li>
								                              <li ><a data-toggle="tab" href="#tab_2-2"><i class="fa fa-envelope"></i> Contact Details</a></li>
								                              <li ><a data-toggle="tab" href="#tab_3-3"><i class="fa fa-book"></i> Educational Details</a></li>
								                              <li ><a data-toggle="tab" href="#tab_4-4"><i class="fa fa-group"></i> Employement Details </a></li>
								                              <li class="active" ><a data-toggle="tab" href="#tab_5-5"><i class="fa fa-info"></i> Other Informations </a></li>
										</ul>
									</div>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_1-1" class="tab-pane">
												<h4><i class="fa fa-user"></i>  Personal Details</h4>
										                            <div class="margin-top-10">              

										                              <table width="100%"  class="table table-bordered table-striped">
										                                <tr>
										                                  <th width="20%">Join Date</th>
										                                  <td width="80%"><a href="#" id="id"><?php echo date('d-m-Y',$staff->join_date); ?></a></td>
										                                </tr>
										                   
										                                <tr>
										                                  <th width="20%">Name</th>
										                                  <td width="80%"><a href="#" id="name"><?php echo $staff->name; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Father Name</th>
										                                  <td><a href="#" class="update_info" id="fathername"><?php echo @$details['fathername']; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Date of Birth</th>
										                                  <td><a href="#" id="dob" ><?php echo date('d-m-Y',$staff->dob); ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Identification Type</th>
										                                  <td><a href="#" id="ic_type" ><?php echo $staff->ic_type; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>NRIC/FIN</th>
										                                  <td><a href="#" id="fin" ><?php echo $staff->fin; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Permit Exp</th>
										                                  <td><a href="#" id="fin_exp_date" ><?php echo $staff->fin_exp_date; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Passport No</th>
										                                  <td><a href="#" id="ppn" ><?php echo $staff->ppn; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Passport Exp</th>
										                                  <td><a href="#" id="ppn_exp_date" ><?php echo $staff->ppn_exp_date; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Email</th>
										                                  <td><a href="#"  id="email"><?php echo $staff->email; ?></a></td>
										                                </tr>
										                              </table>
										                                        
										                            </div>
											</div>
											<div id="tab_2-2" class="tab-pane">
												<h4><i class="fa fa-envelope"></i> Contact Details</h4>
										                            <div class="margin-top-10">              

										                               <table width="100%" class="table table-striped table-bordered">
										                                <tr>
										                                  <th width="20%">Current Address</th>
										                                  <td width="80%"><a href="#" class="update_info" data-type="textarea" id="address"><?php echo @$details['address']; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Current City</th>
										                                  <td><a href="#" class="update_info" id="city"><?php echo @$details['city']; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Phone</th>
										                                  <td><a href="#" class="update_info" id="phone"><?php echo @$details['phone']; ?></a></td>
										                                </tr>
										                                <tr>
										                                  <th>Emergency Phone</th>
										                                  <td><a href="#" class="update_info" id="em_phone"><?php echo @$details['em_phone']; ?></a></td>
										                                </tr>
										                                </table>

										                            </div>
											</div>
											<div id="tab_3-3" class="tab-pane">
												<h4><i class="fa fa-book"></i>  Educational Details</h4>
									                            <div class="margin-top-10">              

									                              <table width="100%" class="table table-striped table-bordered">
									                           
									                                <tr>
									                                  <th width="20%">Bachelor Degree</th>
									                                  <td width="80%"><a href="#" class="update_info" id="degree"><?php echo @$details['degree']; ?></a></td>
									                                </tr>
									                                <tr>
									                                  <th>Certificates</th>
									                                  <td><a href="#" class="update_info" id="certificate"><?php echo @$details['certificate']; ?></a></td>
									                                </tr>
									                                </table>

									                            </div>
											</div>
											<div id="tab_4-4" class="tab-pane">
												 <h4><i class="fa fa-group"></i> Employement Details</h4>
									                            <div  class="margin-top-10">              

									                                <table width="100%" class="table table-striped table-bordered table-hover">
									                                  <tr>
										                                  <th>Designation</th>
										                                  <td><a href="#"  id="designation"><?php echo $staff->designation; ?></a></td>
										                      </tr>
									                                  <tr>
									                                    <th width="20%">Location</th>
									                                    <td width="80%"><a href="#" class="update_info" id="location"><?php echo @$details['location']; ?></a></td>
									                                  </tr>
									                                  <tr>
									                                  <th>Department</th>
									                                  <td><a href="#" class="update_info" id="department"><?php echo @$details['department']; ?></a></td>
									                                </tr>
									                                 <tr>
									                                  <th>Experiences</th>
									                                  <td><a href="#" class="update_info" id="experience"><?php echo @$details['experience']; ?></a></td>
									                                </tr>
									                                </table>

									                            </div>
											</div>

											<div id="tab_5-5" class="tab-pane active">
												<h4><i class="fa fa-info"></i>  Other Informations</h4>
									                            <div class="margin-top-10">              

									                                  <table width="100%" class="table table-striped table-bordered table-hover">
								
									                                  <tr>
									                                  <th>Salary</th>
									                                  <td><?php echo $staff->salary; ?></td>
									                                  </tr>
									                                <tr>
									                                  <th>Picture / Resume / Contact </th>
									                                  <td><a href="#change_profile_modal" id="modal_ajax_btn" data-toggle="modal" >View or Upload</a></td>
									                                </tr>

									                                <?php
									                                  foreach ($details as $key=>$details) {
									                                  if($key != 'department' && $key != 'fathername' && $key != 'bank_account' && $key != 'address' && $key != 'city' && $key != 'phone' && $key != 'em_phone' && $key != 'degree' && $key != 'certificate' && $key != 'location' && $key != 'experience' ){
									                                 ?>
									                                	 <tr>
										                                  <th><?php echo $key; ?></th>
										                                  <td><a href="#" class="update_info" id="<?php echo $key; ?>"><?php echo @$details; ?></a><a href="{{ URL::to('admin/staff/remove_attribute/'.$staff->id.'/'.$key) }}"  data-placement='top' data-original-title='Remove'  class="btn tooltips" ><i class="icon-close"></i></a></td>
										                                </tr>
									                                <?php } } ?>

									                             


									                                </table>
									                   

									                            </div>
											</div>
								
										</div>
									</div>
									<!--end col-md-9-->
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="add_attribute_modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      {{ Form::open(array('url'=>'admin/staff/add_new_attribute', 'class'=>'form-horizontal')) }} 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4>Add New Atttribute</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value="<?php echo $staff->id; ?>">
        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ Input::old('name') }}" />
      </div>
     
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn red">Cancel</button>
        <button type="submit" class="btn green">Add Now</button>
      </div>
       {{Form::close()}}
</div>



  <div id="change_profile_modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4>Upload Panel</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Picture</a></li>
          <li><a href="#tab2" data-toggle="tab">Resume</a></li>
          <li><a href="#tab3" data-toggle="tab">Contract</a></li>
        </ul>
        <div class="tab-content">

          <div class="tab-pane active" id="tab1">
              <form id="profile-form" rel="{{ URL::to('admin/staff/upload/'.$staff->id.'/profiles'); }}" enctype="multipart/form-data">           
                  <h4>Picture</h4>
                  <p id="profile-status"><p>
                  <input name="userfile" type="file" class="'form-control"/><br>
                  <button type="submit" class="btn blue"><i class="icon icon-upload"></i>  Upload  </button><br/>
                  <ul>
                    <li>max size - 1024kb</li>
                    <li>dimension - 150x150</li> 
                    <li>allowed type - gif,jpg,jpeg,png</li>                    
                  </ul>
              </form>
          </div>

          <div class="tab-pane" id="tab2">
             <form id="resume-form" rel="{{ URL::to('admin/staff/upload/'.$staff->id.'/resumes'); }}" enctype="multipart/form-data">           
                  <h4> Resume </h4>
                  <p id="resume-status"><p>
                  <input name="userfile" type="file" class="'form-control" /><br>
                  <button type="submit" class="btn blue"><i class="icon icon-upload"></i>  Upload  </button>
                  <a id="resume-link" target="_blank" href="<?php echo Staff::get_file($staff->id,'resumes'); ?>" class="btn green"> <i class="icon icon-eye-open"></i> View Resume</a>
                  <ul>
                    <li>max size - 400kb</li> 
                    <li>allowed type - pdf,docx,doc</li>                    
                  </ul>
              </form>
          </div>

          <div class="tab-pane" id="tab3">
            <form id="contract-form" rel="{{ URL::to('admin/staff/upload/'.$staff->id.'/contracts'); }}" enctype="multipart/form-data"> 
                  <h4> Contract </h4>          
                  <p id="contract-status"><p>
                  <input name="userfile" type="file" class="'form-control"/><br>
                  <button type="submit" class="btn blue"><i class="icon icon-upload"></i>  Upload  </button>
                  <a id="contract-link"  target="_blank" href="<?php echo Staff::get_file($staff->id,'contracts'); ?>" class="btn green"> <i class="icon icon-eye-open"></i> View Contract</a>
                  <ul>
                    <li>max size - 400kb</li>                    
                    <li>allowed type - pdf,docx,doc</li>                    
                  </ul>
              </form>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn blue">Done</button>
      </div>
    </div>


@stop