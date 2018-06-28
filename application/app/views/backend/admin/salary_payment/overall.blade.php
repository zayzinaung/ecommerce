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
					<a href="{{URL::to('admin/salary_payment')}}">Salary Payment</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Overall Salary Payment List
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-calendar"></i>Salary Payment Management
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
								<th>Salary Month</th>
								<th>Paid Date</th>
								<th>Total Salary Amount</th>
								<th>Status</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($payroll as $key=>$row) { ?>
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ date('F \' Y',strtotime($key)) }}</td>
									<td>{{ $key }}</td>
									<td>{{ $row }}</td>
									<td><?php echo "<span class='btn green btn-xs' style='padding-left:15px;padding-right:15px;'>Paid</span>";  ?></td>
									<td><a href="{{ URL::to('admin/salary_payment/salary_list/'.$key) }}" class="btn green-meadow"><i class="fa fa-eye fa fa-white"></i></a></td>
								</tr>	
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop