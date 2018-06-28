@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Pages <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/pages')}}">Pages</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Pages List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-docs"></span> Pages Management - {{ $pages->title }}
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
						<th>Title</th>
						<td>{{ $pages->title }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Image</th>
						<td>
							@if ( $pages->image != '' )
							<img src="{{ URL::to('uploads/pages/'.$pages->image) }}" alt="{{ $pages->title }}" title="{{ $pages->title }}" width="100">
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Description</th>
						<td>{{ $pages->description }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop