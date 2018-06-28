@extends('backend.template.template')

@section('style')
{{ HTML::style('backend/nestable/sximo.css') }}
@stop

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
				<a href="{{URL::to('admin/footer/menu')}}">Footer Menu List</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Reordering
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-compass"></span> Reordering Footer Menu Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">

		<div id="list2" class="dd" style="min-height:350px;">
              	<ol class="dd-list">
		@foreach ($footer_menu as $menu)
			<?php $page = Page::find($menu->id); ?>
			<li data-id="{{ $menu->id }}" class="dd-item dd3-item">
				<div class="dd-handle dd3-handle"></div>
				<div class="dd3-content">{{ $page->title }}</div>
			</li>
		@endforeach			  
              	</ol>
            	</div>

            	{{ Form::open(array('url'=>'admin/footer/save_menu', 'class'=>'form-horizontal','files' => true)) }}	
		<input type="hidden" name="reorder" id="reorder" value="" />		
		<button type="submit" class="btn btn-primary ">Reorder Menu</button>	
		{{ Form::close() }}	

		</div>
	</div>
</div>
@stop

@section('scripts')
{{ HTML::script('backend/nestable/jquery.nestable.js') }}
<script>
$(document).ready(function(){
	$('.dd').nestable();
    update_out('#list2',"#reorder");
    
    $('#list2').on('change', function() {
		var out = $('#list2').nestable('serialize');
		$('#reorder').val(JSON.stringify(out));	  

    });
		$('.ext-link').hide(); 
		
});	

function mType(val) {
	if(val == 'external') {
		$('.ext-link').show(); 
		$('.int-link').hide();
	} else {
		$('.ext-link').hide(); 
		$('.int-link').show();
	}
}


function update_out(selector, sel2){
	
	var out = $(selector).nestable('serialize');
	$(sel2).val(JSON.stringify(out));

}
</script>	
@stop