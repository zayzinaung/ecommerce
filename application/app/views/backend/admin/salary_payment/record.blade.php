@extends('backend.template.template')
@section('content')
	<div class="page-content">
		<h3 class="page-title">
			Salary Payment <small>management</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin/')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{URL::to('admin/salary_payment/salary_record')}}">Salary Payment</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Salary Payment List
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-calendar"></i>Salary Payment Record For {{$date }}
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-responsive">
				<!-- Start Delete confirrm text !-->
				<!-- <span class="hide" id="delete_text">
					<h4>Are you sure you want to Delete this staff ?</h4>
	                <h4>This action can't be undo. </h4>
                </span> -->
                <!-- End Delete confirrm text !-->
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>DOB</th>
								<th>Amount</th>
								<th>Payment Mode</th>
								<th>Payment Date</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($payroll as $row) { ?>
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ Staff::find($row['staff_id'])->name }}</td>
									<td>{{ date('d-m-Y',Staff::find($row['staff_id'])->dob) }}</td>
									<td>{{ $row['total_amount'] }}</td>
									<td>{{ $row['method'] }}</td>
									<td>{{ date('d-m-Y',$row['payment_date']) }}</td>
									<td><a href="{{ URL::to('admin/salary_payment/'.$row['id']) }}" class="btn green-meadow"><i class="fa fa-eye fa fa-white"></i></a></td>
								</tr>	
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop