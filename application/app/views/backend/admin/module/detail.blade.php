@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Module <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/home')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/module')}}">Module</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Module List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-user"></span> Module Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i=0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Name</th>
						<td>{{ $module->name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Description</th>
						<td>{{ $module->description }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop