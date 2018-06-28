@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Member <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/member')}}">Member</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Member List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-users"></span> Member Management - {{ $member->username }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i = 0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Name</th>
						<td>{{ $member->username }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Email</th>
						<td>{{ $member->email }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Neutral</th>
						<td>{{ $member->neutral }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Phone</th>
						<td>{{ $member->phone }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Landline</th>
						<td>{{ $member->landline }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Address</th>
						<td>{{ $member->address }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop