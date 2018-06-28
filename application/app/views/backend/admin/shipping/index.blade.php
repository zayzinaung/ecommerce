@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Shipping <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/shipping')}}">Shipping Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Shipping Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-directions"></span> Shipping Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
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
                			<!-- End Delete confirrm text !-->
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Method</th>
							<th>Day</th>
							<th>Amount</th>
							<th>Is Active</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($shipping as $row)
							<?php  $desc = unserialize($row->description); ?>
							<tr>
								<td>{{ ++$i }}</td>
								<td>
									<span>{{ $row->method }}</span>
								</td>
								<td>
									<span>{{ $desc['day'] }}</span>
								</td>
								<td>
									@if ( $row->method == 'Charges Shipping' )
									<span>{{ $currency }} {{ $desc['amount'] }}</span>
									@else
									<span>-</span>
									@endif
								</td>
								<td>
									@if ( $row->method == 'Charges Shipping' )
										@if(User::hasPermTo(MODULE,'edit'))
										{{ Form::open(array('url'=>'admin/shipping/is_active', 'class'=>'form-horizontal')) }}
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
								          @endif
								</td>
								<td>
									@if(User::hasPermTo(MODULE,'view'))
										<a href="{{ URL::to('admin/shipping/'.$row->id) }}" class="btn green-meadow tooltips" data-placement="bottom" data-original-title="View"><span aria-hidden="true" class="icon-eye"></span></a>
									@endif
									@if(User::hasPermTo(MODULE,'edit'))
										<a href="{{ URL::to('admin/shipping/'.$row->id.'/edit/') }}" class="btn blue-hoki tooltips" data-placement="bottom" data-original-title="Edit"><span aria-hidden="true" class="icon-pencil"></span></a>
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