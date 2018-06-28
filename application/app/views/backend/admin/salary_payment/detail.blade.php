@extends('backend.template.template')
@section('content')
	<div class="page-content">
		<h3 class="page-title">
			Salary Payment Records <small>management</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{URL::to('admin/salary_payment')}}">Salary Payment</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Salary Payment Records List
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-dollar"></i>Salary Payment Records For {{ $staff->name }}
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
					<!-- Start Delete confirrm text !-->
					<span class="hide" id="delete_text">
						<h4>Are you sure you want to Delete this Paid Salary Payment Records ?</h4>
				                	<h4>This action can't be undo. </h4>
				           </span>
				           <!-- End Delete confirrm text !-->
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						<thead>
							<tr>
								<th>Month</th>
								<th>Full Name</th>
								<th>Gross Salary (SGD)</th>
								<th>Comission (SGD) </th>
								<th>Overtime Pay (SGD)</th>
								<th>Salary advance (SGD)</th>
								<th>Contribution By Employee (SGD)</th>
								<th>Total Salary (SGD) </th>
								<th>Payment Created Date</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($salary_payment as $row) {?>
							<tr>
									<td>{{ date('F Y',strtotime('01-'.$row->month)) }}</td>
									<td>{{ $staff->name }}</td>
									<td>{{ $row->gross_salary }}</td>
									<td>{{ $row->comission }}</td>
									<td>{{ $row->overtime }}</td>
									<td>{{ $row->salary_advance }}</td>
									<td>{{ $row->conByEmp }}</td>
									<td>{{ $row->amount }}</td>
									<td>{{ date('d-m-Y',$row->payment_date) }}</td>
									<td>
										<?php if(User::hasPermTo(MODULE,'delete')){ ?>
											{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.salary_payment.destroy', $row->id), 'style'=>'display: inline')) }}
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