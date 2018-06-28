@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
.discount {
	float: left;
	margin: 7px 5px 0 0;
}
.hide_change_discount {
  display:none;
}
</style>
@stop

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
				Products List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-list"></span> Products Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				@if(User::hasPermTo(MODULE,'create'))
					<div class="btn-group">
						<a href="{{ URL::to('admin/product/create') }}" >
							<button id="sample_editable_1_new" class="btn blue-madison">
								<i class="fa fa-plus"></i> Add New
							</button>
						</a>
					</div>
				@endif
				
				<div class="btn-group">
					<a href="{{ URL::to('admin/products/recycle_bin') }}" >
						<button id="sample_editable_1_new" class="btn red-sunglo">
							<span aria-hidden="true" class="icon-trash"></span> Recycle Bin
						</button>
					</a>
				</div>
				
				<div class="btn-group" style="float:right">
					<a href="{{ URL::to('admin/products/report_pdf') }}" class="btn btn-sm grey-cascade" target="_blank" style="margin-right:10px">
						<i class="fa fa-file-pdf-o"></i> Save as PDF
					</a>
					<a href="{{ URL::to('admin/products/report_excel') }}" class="btn btn-sm grey-cascade" target="_blank">
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
					<h4>Are you sure you want to add this Product to Recycle Bin ?</h4>
	                			<h4>This action can't be undo. </h4>
                			</span>
                			<!-- End Delete confirrm text !-->

				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th style="width:1%">#</th>
							<th style="width:7%">Status</th>
							<th style="width:21%">Product Name</th>
							<th style="width:10%">Code</th>
							<th style="width:10%">Price</th>
							<th style="width:7%">Quantity</th>
							<th style="width:10%">Updated</th>
							<th style="width:15%">Discount Rate ( % )</th>
							<th style="width:14%">Option</th>
							<th style="width:6%">Clone</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($product as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td>
									@if ( $row->is_active == 1 )
										<span class="label label-success">Active</span>
									@else
										<span class="label label-danger">Inactive</span>
									@endif
								</td>
								<td>{{ $row->product_name }}</td>
								<td>{{ $row->product_no }}</td>
								<td>{{ $currency }} {{ $row->price }}</td>
								<td>{{ $row->quantity }}</td>
								<td>{{ date($date_format,strtotime($row->updated_at)) }}</td>
								<td>
									@if(User::hasPermTo(MODULE,'edit'))
									<div class="hide_discount_div">
									          	<div class="discount {{ $row->id }}discount">{{ $row->discount }} %</div>
									          	<button type="button" class="btn tooltips purple-plum change_discount hide{{ $row->id }}" value="x" data-placement="bottom" data-original-title="Change Discount" style="float:left" data-id="{{ $row->id }}"><span aria-hidden="true" class="icon-note"></span> Edit</button>

									          <div class="hide_change_discount hidden_div{{ $row->id }}">
									          		<div class="discount_inner_change">
									                    	<button type="button" class="btn tooltips purple-plum change_discount_ajax" value="x" data-placement="bottom" data-original-title="Save Discount" style="float:left" data-id="{{ $row->id }}"><i class="fa fa-save"></i> Save</button>
									                    	<input type="text" class="text col-sm-5" name="{{ $row->id }}discount_ajax" value="{{ $row->discount }}" style="float:left;padding:4px;width:25%;">
									                    	</div>
									          </div>
									</div>
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
										{{ Form::open(array('url'=>'admin/product/addto_recycle/'.$row->id, 'class'=>'form-horizontal','style'=>'display: inline')) }}
										<button type="button" class="btn red-sunglo tooltips delete" value="x" data-placement="bottom" data-original-title="Recycle Bin" ><span aria-hidden="true" class="icon-ban"></span></button>
										{{ Form::close() }}
									@endif
								</td>
								<td>
									{{ Form::open(array('url'=>'admin/product/clone_product/'.$row->id, 'class'=>'form-horizontal','style'=>'display: inline')) }}
										<button type="submit" class="btn yellow-crusta tooltips" value="x" data-placement="bottom" data-original-title="Clone Product" ><span aria-hidden="true" class="icon-docs"></span></button>
									{{ Form::close() }}
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

<script type="text/javascript">
$('.change_discount').click(function(){
        $(this).parent('.hide_discount_div').find('.hide_change_discount').slideToggle();
        $(this).hide();
});
</script>

<script type="text/javascript">
$('.change_discount_ajax').click(function(){

	var ele = $(this);
    	ele.html("<img src='{{ URL::to('frontend/img/load2.gif') }}' width='20'>");

    	var p_id = ele.attr('data-id');
    	var value = $('input[name='+p_id+'discount_ajax]').val();

    	var param = {
        		id: p_id,
        		discount: value,
    	};

    	$.post('{{ URL::to("admin/product/update_discount_ajax") }}', param, function (data){
    	if (data.status == 'success') {
    		ele.html('<i class="fa fa-save"></i> Save');
        		$('.'+p_id+'discount').text(value+' %');
        		$('.hidden_div'+p_id).hide();
        		$('.hide'+p_id).show();
    	} else {
    		ele.html('<i class="fa fa-save"></i> Save');
    		$('.hidden_div'+p_id).hide();
        		$('.hide'+p_id).show();
    	}

    	}, 'JSON');

});
</script>

@stop