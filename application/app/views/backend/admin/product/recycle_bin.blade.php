@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Products<small> management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/product')}}">Products</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Recycle Bin
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-list"></span> Recycle Bin
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
							<th>Name</th>
							<th>Code</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Latest Updated</th>
							<td>Restore</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($product as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $row->product_name }}</td>
								<td>{{ $row->product_no }}</td>
								<td>{{ $currency }} {{ $row->price }}</td>
								<td>{{ $row->quantity }}</td>
								<td>{{ date($date_format,strtotime($row->updated_at)) }}</td>
								<td>
									@if(User::hasPermTo(MODULE,'edit'))
									{{ Form::open(array('url'=>'admin/product/restore_product', 'class'=>'form-horizontal')) }}
									{{ Form::hidden('id', $row->id)}}
									{{ Form::hidden('delete', $row->is_delete)}}
							            	@if($row->is_delete==1)
							            		<button type="submit" class="btn purple-plum">
							                			<span aria-hidden="true" class="icon-action-undo"></span>
							            		</button>
							            	@else
							            		<button type="submit" class="btn purple-plum">
							                			<span aria-hidden="true" class="icon-action-undo"></span>
							            		</button>
							            	@endif
							            	{{ Form::close() }}
							            	@endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/product/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'edit'))
										<a href="{{ URL::to('admin/product/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.product.destroy', $row->id), 'style'=>'display: inline')) }}
										<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Delete" ><span aria-hidden="true" class="icon-trash"></span></button>
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