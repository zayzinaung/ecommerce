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
				<span aria-hidden="true" class="icon-users"></span> Member Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				@if(User::hasPermTo(MODULE,'create'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/member/create') }}" >
							<button id="sample_editable_1_new" class="btn blue-madison">
								<i class="fa fa-plus"></i> Add New
							</button>
						</a>
					</div>
				@endif
				<div class="btn-group" style="float:right">
					<a href="{{ URL::to('admin/members/report_pdf') }}" class="btn btn-sm grey-cascade" target="_blank" style="margin-right:10px">
						<i class="fa fa-file-pdf-o"></i> Save as PDF
					</a>
					<a href="{{ URL::to('admin/members/report_excel') }}" class="btn btn-sm grey-cascade" target="_blank">
						<i class="fa fa-file-excel-o"></i> Report to Excel
					</a>
				</div>
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
					<h4>Are you sure you want to Delete this Product Information ?</h4>
	                			<h4>This action can't be undo. </h4>
                			</span>
                			<!-- End Delete confirrm text !-->
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Landline</th>
							<th>Created Date</th>
							<th>Is Active</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						@if ( $member )
						<?php $i = 0; ?>
						@foreach ($member as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $row->username }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->phone }}</td>
								<td>{{ $row->landline }}</td>
								<td>{{ Date($date_format, strtotime($row->created_at)) }}</td>
								<td>
									@if(User::hasPermTo(MODULE,'edit'))
										{{ Form::open(array('url'=>'admin/member/is_active', 'class'=>'form-horizontal')) }}
										{{ Form::hidden('id', $row->id)}}
										{{ Form::hidden('active', $row->is_active)}}
								            	@if($row->is_active==1)
								            		<button type="submit" class="btn purple-plum">
								                			<i class="fa fa-check-square-o"></i>
								            		</button>
								            	@else
								            		<button type="submit" class="btn purple-plum">
								                			<i class="fa fa-square-o"></i>
								            		</button>
								            	@endif
								            	{{ Form::close() }}
							            	@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/member/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'edit'))
										<a href="{{ URL::to('admin/member/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.member.destroy', $row->id), 'style'=>'display: inline')) }}
											<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete" ><span aria-hidden="true" class="icon-trash"></span></button>
										{{ Form::close() }}
									@endif
								</td>
							</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop