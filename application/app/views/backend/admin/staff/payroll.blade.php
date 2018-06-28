@extends('backend.template.template')
@section('content')
<script type="text/javascript">

function BootboxContent(){    
            var frm_str = '<form class="form-horizontal">'
                              + '<div class="form-group">'
	                              + '<label for="month" class="control-label col-md-3">Choose Month</label>'    
	                              + '<div class="col-md-4">'
	                              + '<input id="month" class="date form-control" readOnly="true" style="cursor:pointer;" placeholder="Salary Month" type="text">'
	                              + '</div>'
                              + '</div>'
                              + '</form>';

            var object = $('<div/>').html(frm_str).contents();

            object.find('.date').datepicker({
               	viewMode: "months", 
       	 	minViewMode: "months",
	        	format : 'mm-yyyy',
		 autoclose: true}).on('changeDate', function (ev) {
                   $(this).blur();
                   $(this).datepicker('hide');
            });

             return object
        }

$(document).ready(function() {  
	$('.pay_now').click(function(){
	        var link    = $(this).attr('rel');

	           bootbox.dialog({
		        message: BootboxContent,
		        title: "Salary Payment Month",
		        buttons: {
		           success: {
		              label: "Pay Now!",
		              className: "btn-primary",
		              callback: function() {
			      var month = $('#month').val();
			       if(month) {
		                          window.location = link+'/'+month;		                          
		                   }
		                   else{
		                   	bootbox.alert("Please choose the salary payment month first !")
		                   }
			        
			     }
		           }
		        }
		});  
    	});
 });
</script>
	<div class="page-content">
		<h3 class="page-title">
			Staff Payroll <small>management</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin/')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{URL::to('admin/staff/payroll')}}">Staff Payroll</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Staff Payroll List
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-dollar"></i>Staff Payroll Management
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
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

				<div class="table-responsive">
		
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>NRIC/FIN </th>
								<th>DOB</th>
								<th>Age Group</th>
								<th>Salary (SGD) </th>
								<th>Contribution by Employee</th>
								<th>Contribution by Employer</th>
								<th>Net Salary</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($staff as $row) {?>
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $row->name }}</td>
									<td>{{ $row->fin }}</td>
									<td>{{ date('d-m-Y',$row->dob) }}</td>
									<td>{{ Staff::getAgeGroup($row->dob) }}</td>
									<td>{{ $row->salary }}</td>
									<td>{{ $employee = Staff::getConByEmployee($row->dob,$row->salary) }}</td>
									<td>{{ $employer = Staff::getConByEmployer($row->dob,$row->salary) }}</td>
									<td>{{ $row->salary - $employee }}</td>
									<td>
										<?php if(User::hasPermTo(MODULE,'view')){ ?>
											<a href="#" rel="{{ URL::to('admin/staff/pay/'.$row->id) }}" class="btn green-meadow tooltips pay_now" data-placement="bottom" data-original-title="Click To Pay"><i class="fa fa-dollar fa fa-white"></i> Pay</a>
										<?php } ?>
									</td>
								</tr>	
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop