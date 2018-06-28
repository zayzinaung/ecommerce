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
					Staff List
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-emoticon-smile"></span> Staff Management
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
							<a href="{{ URL::to('admin/staff/create') }}" > <button id="sample_editable_1_new" class="btn blue-madison">
								Add New <i class="fa fa-plus"></i>
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
					<h4>Are you sure you want to Delete this staff ?</h4>
	                			<h4>This action can't be undo. </h4>
                			</span>
                			<!-- End Delete confirrm text !-->
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>NRIC/FIN </th>
								<th>Email</th>
								<th>Salary (SGD) </th>
								<th>DOB</th>
								<th>Is Active</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0; ?>
							@foreach ( $staff as $row )
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $row->name }}</td>
									<td>{{ $row->fin }}</td>
									<td>{{ $row->email }}</td>
									<td>{{ $row->salary }}</td>
									<td>
									<?php
								                  $age = date('Y')-date('Y',$row->dob);
								                  echo date('d-m-Y',$row->dob).'(Age-'.$age.')';
								          ?>
								        	</td>
								        	<td>
								        		@if($row->status == 0)
											<a href="{{ URL::to('admin/staff/change_status/'.$row->id.'/1') }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="Change Inactive"><span aria-hidden="true" class="icon-check"></span></a>
										@else
											<a href="{{ URL::to('admin/staff/change_status/'.$row->id.'/0') }}" class="btn red-sunglo tooltips" data-placement="bottom" data-original-title="Change Active"><span aria-hidden="true" class="icon-close"></span></a>
										@endif
								        	</td>
									<td>
										@if(User::hasPermTo(MODULE,'view'))
											<a href="{{ URL::to('admin/staff/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></i></a>
										@endif
										@if(User::hasPermTo(MODULE,'edit'))
											<a href="{{ URL::to('admin/staff/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></a>
										@endif
										@if(User::hasPermTo(MODULE,'delete'))
											{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.staff.destroy', $row->id), 'style'=>'display: inline')) }}
												<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete" ><span aria-hidden="true" class="icon-trash"></button>
											{{ Form::close() }}
										@endif
									</td>
								</tr>	
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop