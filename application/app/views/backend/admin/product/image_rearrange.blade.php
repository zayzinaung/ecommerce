@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Product Images <small>Arrange</small>
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
				Image Rearrange
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-list"></span> Arrange Images For Product - {{ $product->product_name }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body form">
			{{ Form::open(array('url' => route('product.image_rearrange.update', $product->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'files'=>true)) }}

                        	{{ Form::hidden('productid', $product->id) }}

                        	@if(count($images) > 0)
			<div class="form-body">
				<h3 class="form-section">Product Images</h3>
				<p style="color:red">*You can arrange the images as you like by giving the number input.*</p>
				@foreach($images as $image)
				<div class="form-group">
					<label class="control-label col-md-2"><img src="{{ URL::to('/uploads/products/'.$image->image) }}" width="30%"></label>
					<div class="col-md-2" style="padding-top:7px">
					          <input type="text" class="form-control" name="img{{ $image->id }}" value="{{ $image->image_order }}">
					</div>
				</div>
				@endforeach
			</div>

			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Update</button>
						<button id="black" type="reset" class="btn default">Cancel</button>
					</div>
				</div>
			</div>
			@else
			<div class="form-body">
				<div style='color:red;font-size:16px;font-weight:bold;'>There is no image.</div>
			</div>
			@endif
		
                      	{{ Form::close() }}
		</div>
	</div>
</div>
@stop