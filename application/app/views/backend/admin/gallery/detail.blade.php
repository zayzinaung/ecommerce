@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Gallery <small>information</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/galleries/list')}}">Gallery List</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Gallery List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-grid"></span> Gallery - {{ $gallery->name }}
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
						<td>{{ $gallery->name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Image</th>
						<td><img src="{{ URL::to('uploads/gallery/'.$gallery->image) }}" width="100"></td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Alt</th>
						<td>{{ $gallery->alt }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Title</th>
						<td>{{ $gallery->title }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop