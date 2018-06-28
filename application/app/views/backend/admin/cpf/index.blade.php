@extends('backend.template.template')
@section('content')
<script type="text/javascript">

function BootboxContent(){    
            var frm_str = '<form class="form-horizontal">'
                              + '<div class="form-group">'
	                              + '<label for="month" class="control-label col-md-3">Choose Month</label>'    
	                              + '<div class="col-md-4">'
	                              + '<input id="month" class="date form-control" readOnly="true" style="cursor:pointer;" placeholder="CPF Month" type="text">'
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
		        title: "CPF Payment Month",
		        buttons: {
		           success: {
		              label: "Generate Now!",
		              className: "btn-primary",
		              callback: function() {
			      var month = $('#month').val();
			       if(month) {
		                          window.location = link+'/'+month;		                          
		                   }
		                   else{
		                   	bootbox.alert("Please choose the CPF payment month first !")
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
			CPF Payment <small>management</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{URL::to('admin/cpf')}}">CPF Payment</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					CPF Payment List
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-dollar"></i>CPF Payment Management
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<?php if(User::hasPermTo(MODULE,'create')){ ?>
						<div class="btn-group">
							<a href="#" rel="{{ URL::to('admin/cpf/create') }}" class="btn blue-madison tooltips pay_now" data-placement="bottom" data-original-title="Click To Generate CPF"><i class="fa fa-dollar fa fa-white"></i>
								Generate CPF
							</button></a>
						</div>
					<?php } ?>
				</div>
				
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
					<!-- Start Delete confirrm text !-->
					<span class="hide" id="delete_text">
						<h4>Are you sure you want to Delete this Generated CPF ?</h4>
					            <h4>This action can't be undo. </h4>
				           </span>
				           <!-- End Delete confirrm text !-->
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						<thead>
							<tr>
								<th>#</th>
								<th>Month</th>
								<th>Contribution by Employee</th>
								<th>Contribution by Employer</th>
								<th>Total CPF</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($cpf as $row) {?>
									<td>{{++$i }}</td>
									<td>{{ date('F Y',strtotime('01-'.$row->month)) }}</td>
									<td>{{ $row->employee }}</td>
									<td>{{ $row->employer }}</td>
									<td>{{ $row->employee + $row->employer }}</td>
									<td>
										<?php  if(User::hasPermTo(MODULE,'edit')){?>
											<a href="{{ URL::to('admin/cpf/'.$row->id.'/edit/') }}" class="btn blue-madison tooltips" data-placement="bottom" data-original-title="Refresh Generated CPF"><i class="fa fa-refresh icon-white"></i></a>
										<?php } ?>
										<?php if(User::hasPermTo(MODULE,'delete')){ ?>
											{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.cpf.destroy', $row->id), 'style'=>'display: inline')) }}
												<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o icon-white"></i></button>
											{{ Form::close() }}
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