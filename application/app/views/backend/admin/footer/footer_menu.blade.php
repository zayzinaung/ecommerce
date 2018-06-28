@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Footer Menu <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/footer_cms')}}">Footer Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Footer Menu List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-compass"></span> Footer Menu Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">

			<div class="table-toolbar">
				@if(User::hasPermTo(MODULE,'edit'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/footer/order_menu') }}" >
							<button id="sample_editable_1_new" class="btn blue-madison">
								<span aria-hidden="true" class="icon-shuffle"></span> Reorder List
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
							<th>Available Page</th>
							<th>Order No.</th>
							<th>Is Active</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($footer_menu as $row)
							<?php $page = Page::find($row->id); ?>
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $page->title }}</td>
								<td>
									@if ( $row->footer_active == 1 )
										{{ $row->footer_ordering }}
									@else
										-
									@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'edit'))
										{{ Form::open(array('url'=>'admin/footer/is_active', 'class'=>'form-horizontal')) }}
										{{ Form::hidden('id', $row->id) }}
								            	@if($row->footer_active == 1)
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
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop