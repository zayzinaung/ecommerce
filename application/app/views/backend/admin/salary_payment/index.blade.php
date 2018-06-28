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
					<a href="{{URL::to('admin')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{URL::to('admin/salary_payment')}}">Salary Payment</a>
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
					<i class="fa fa-dollar"></i>Salary Payment Management
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
								<th>IC/WP</th>
								<th>Date of Birth</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($staff as $row) {?>
									<td>{{++$i }}</td>
									<td>{{ ucfirst($row->name)}}</td>
									<td>{{ $row->fin}}</td>
									<td>{{ date('j F Y',$row->dob)}}</td>
									<td>
										<?php if(User::hasPermTo(MODULE,'view')){?>
											<a href="{{ URL::to('admin/salary_payment/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><i class="fa fa-eye icon-white"></i></a>
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