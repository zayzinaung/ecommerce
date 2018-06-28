@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Backup <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/home/back_up')}}">Backup</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Backup List
			</li>
		</ul>
	</div>
	
	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-layers"></span> System Backup Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				@if(User::hasPermTo('backup','create'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/home/back_up_now') }}">
							<button id="sample_editable_1_new" class="btn blue-madison">
								<span aria-hidden="true" class="icon-refresh"></span> All Back up Now
							</button>
						</a>
					</div>
				@endif
			</div>

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
							<th>Backup File Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0; foreach ($backup as $b) { 
							//$file = explode('/', $b);
						?>
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $b['basename'] }}</td>
								<td>
									@if(User::hasPermTo('backup','view'))
									   	<a href="{{ URL::to('admin/home/getDownload/'.$b['basename']) }}" class="btn purple-plum tooltips" data-placement="bottom" data-original-title="Download"><i class="fa fa-download fa fa-white"></i></a>
									@endif
								</td>
							</tr>
						<?php }  ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop