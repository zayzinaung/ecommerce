@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
.hide_change_tax {
  display:none;
}
</style>
@stop

@section('content')
<div class="page-content">
	<h3 class="page-title">
		Goods and Services Tax <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/gst')}}">Goods and Services Tax Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Goods and Services Tax
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-paper-clip"></span> Goods and Services Tax Information Management
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
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Tax</th>
							<th>Is Apply</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach ($gst as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td><span class="tax {{ $row->id }}tax">{{ $row->tax }} %<span></td>
								<td>
									@if(User::hasPermTo(MODULE,'edit'))
									{{ Form::open(array('url'=>'admin/gst/is_apply', 'class'=>'form-horizontal')) }}
									{{ Form::hidden('id', $row->id)}}
									{{ Form::hidden('apply', $row->is_apply)}}
							            	@if($row->is_apply==1)
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
										<div class="hide_tax_div">
									          	<button type="button" class="btn tooltips blue-hoki change_tax hide{{ $row->id }}" value="x" data-placement="bottom" data-original-title="Change Tax" style="float:left" data-id="{{ $row->id }}"><span aria-hidden="true" class="icon-note"></span> Edit</button>

									          <div class="hide_change_tax hidden_div{{ $row->id }}">
									          		<div class="tax_inner_change">
									                    	<button type="button" class="btn tooltips blue-hoki change_tax_ajax" value="x" data-placement="bottom" data-original-title="Save Tax" style="float:left" data-id="{{ $row->id }}"><i class="fa fa-save"></i> Save</button>
									                    	<input type="text" class="text col-sm-5" name="{{ $row->id }}tax_ajax" value="{{ $row->tax }}" style="float:left;padding:4px;">
									                    	</div>
									          </div>
										</div>
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

<script type="text/javascript">
$('.change_tax').click(function(){
        $(this).parent('.hide_tax_div').find('.hide_change_tax').slideToggle();
        $(this).hide();
});
</script>

<script type="text/javascript">
$('.change_tax_ajax').click(function(){

	var ele = $(this);
    	ele.html("<img src='{{ URL::to('frontend/img/load3.gif') }}' width='20'>");

    	var gst_id = ele.attr('data-id');
    	var value = $('input[name='+gst_id+'tax_ajax]').val();

    	var param = {
        		id: gst_id,
        		tax: value,
    	};

    	$.post('{{ URL::to("admin/gst/update_gst_ajax") }}', param, function (data){
    	if (data.status == 'success') {
    		ele.html('<i class="fa fa-save"></i> Save');
        		$('.'+gst_id+'tax').text(value+' %');
        		$('.hidden_div'+gst_id).hide();
        		$('.hide'+gst_id).show();
    	} else {
    		ele.html('<i class="fa fa-save"></i> Save');
    		$('.hidden_div'+gst_id).hide();
        		$('.hide'+gst_id).show();
    	}

    	}, 'JSON');

});
</script>

@stop