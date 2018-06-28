@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Subcategory <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/subcategory')}}">Subcategory</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Subcategory List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-list"></span> Subcategory Management - {{ $subcategory->subcategory_name }}
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
						<th>Subcategory Name</th>
						<td>{{ $subcategory->subcategory_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Category</th>
						<?php $category = Common::query_single_data('categories','id',$subcategory->category_id,'category_name'); ?>
						<td>{{ $category->category_name }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop