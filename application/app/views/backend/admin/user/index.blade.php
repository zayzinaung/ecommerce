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
				<span aria-hidden="true" class="icon-user"></span> User Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				@if(User::hasPermTo(MODULE,'create'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/user/create') }}" >
							<button id="sample_editable_1_new" class="btn blue-madison">
								<i class="fa fa-plus"></i> Add New
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
				<!-- Start Delete confirrm text !-->
				<span class="hide" id="delete_text">
					<h4>Are you sure you want to Delete this User ?</h4>
	                			<h4>This action can't be undo. </h4>
                			</span>
                			<!-- End Delete confirrm text !-->
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($user as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $row->name }}</td>
								<td>
									{{ $row->username }}
									@if ( $row->facebook_id != 0 )
									( Facebook )
									@endif
								</td>
								<td>{{ $row->email }}</td>
								<td>
									@if($row->id == 1)
										@if(Session::get('role_id')==1)
											@if(User::hasPermTo(MODULE,'view'))
												<a href="{{ URL::to('admin/user/'.$row->id) }}" class="btn green-meadow tooltips" data-original-title="Detail" data-placement="bottom"><span aria-hidden="true" class="icon-eye"></span></a>
											@endif
											@if(User::hasPermTo(MODULE,'edit'))
												<a href="{{ URL::to('admin/user/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
											@endif
										@endif
									@else
										@if(User::hasPermTo(MODULE,'view'))
											<a href="{{ URL::to('admin/user/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
										@endif
										@if(User::hasPermTo(MODULE,'edit'))
											<a href="{{ URL::to('admin/user/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
										@endif
										@if(User::hasPermTo(MODULE,'delete'))
											{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.user.destroy', $row->id), 'style'=>'display: inline')) }}
												<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete" ><span aria-hidden="true" class="icon-trash"></span></button>
											{{ Form::close() }}
										@endif
									@endif
								</td>
							</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop