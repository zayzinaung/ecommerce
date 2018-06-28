@extends('backend.template.template')

@section('style')
{{ HTML::style('frontend/plugins/raty/jquery.raty.css') }}
@stop

@section('content')
<div class="page-content">
	<h3 class="page-title">
		Review Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/reviews')}}">Review Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Review Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-star"></span> Review Information Management
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
							<th style="width:1%">#</th>
							<th style="width:10%">User Name</th>
							<th style="width:20%">Product Name</th>
							<th style="width:10%">Rating</th>
							<th style="width:40%">Review</th>
							<th style="width:5%">Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($reviews as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<?php $user = Common::query_single_data('users','id',$row->user_id,'username'); ?>
								<td>{{ $user->username }}</td>
								<?php $product = Common::query_single_data('products','id',$row->product_id,'product_name'); ?>
								<td>{{ $product->product_name }}</td>
								<td><div class="rateit rated" data-score="{{ $row->rating }}"></div></td>
								<td>{{ $row->review }}</td>
								<td>
									@if(User::hasPermTo(MODULE,'delete'))
										{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.reviews.destroy', $row->id), 'style'=>'display: inline')) }}
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

@section('scripts')

{{ HTML::script('frontend/plugins/raty/jquery.raty.js') }}

<script type="text/javascript">
    $('.rated').raty({
          score: function() {
              return $(this).attr('data-score'); // set default value from data-score attr
          },
          click: function(score, evt) {
              $('input[name="rating"]').val(score); // set value to hidden input
          },
          path: '{{ URL::to("frontend/plugins/raty/images/") }}',
          precision  : true,
          readOnly: true
    });
</script>

@stop