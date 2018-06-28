@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Gallery <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/gallery')}}">Gallery</a>
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
				<span aria-hidden="true" class="icon-grid"></span> Gallery Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				
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
							<th>Name</th>
							<th>Data</th>
							<th>Is Active</th>
							<td>Option</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Facebook Gallery</td>
							<td>{{ $get_fbgallery->facebook_id }}</td>
							<td>
								@if(User::hasPermTo(MODULE,'edit'))
									{{ Form::open(array('url'=>'admin/gallery/is_active', 'class'=>'form-horizontal')) }}
									{{ Form::hidden('type', $facebook_gallery->type)}}
							            	@if($facebook_gallery->format == 'active')
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
								@if(User::hasPermTo(MODULE,'edit'))
									<a href="{{ URL::to('admin/facebook_gallery/edit/'.$get_fbgallery->id) }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
								@endif
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Gallery</td>
							<td>-</td>
							<td>
								@if(User::hasPermTo(MODULE,'edit'))
									{{ Form::open(array('url'=>'admin/gallery/is_active', 'class'=>'form-horizontal')) }}
									{{ Form::hidden('type', $gallery->type)}}
							            	@if($gallery->format == 'active')
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
									<a href="{{ URL::to('admin/galleries/list') }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
								@endif
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop