@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		User <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/user')}}">User</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				User List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-user"></span> User Management - {{ $user->username }}
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
						<td>{{ $user->name }}</td>
					</tr>	
					<tr>
						<td>{{ ++$i }}</td>
						<th>Username</th>
						<td>{{ $user->username }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Email</th>
						<td>{{ $user->email }}</td>
					</tr>	
					<tr>
						<td>{{ ++$i }}</td>
						<th>Address</th>
						<td>{{ $user->address }}</td>
					</tr>	
					<tr>
						<td>{{ ++$i }}</td>
						<th>Join Date</th>
						<td>{{ date($date_format,strtotime($user->created_at)) }}</td>
					</tr>		
				</table>
			</div>
		</div>
	</div>
</div>
@stop