@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Product Information <small>information</small>
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
				Product List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-list"></span> Product - {{ $product->product_name }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th></th>
					</tr>
					<?php $i = 0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Meta Title</th>
						<td>{{ $product->meta_title }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Meta Keywords</th>
						<td>{{ $product->meta_keywords }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Meta Description</th>
						<td>{{ $product->meta_description }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product Name</th>
						<td>{{ $product->product_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Total Quantity</th>
						<td>{{ $product->quantity }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Sold</th>
						<td>{{ $product->quantity_use }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Quantity Left</th>
						<td>{{ $product->quantity - $product->quantity_use }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product No.</th>
						<td>{{ $product->product_no }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Description</th>
						<td>{{ $product->description }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Price</th>
						<td>{{ $currency }} {{ $product->price }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Category Name</th>
						<td>{{ $category->category_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Subcategory Name</th>
						<td>{{ $subcategory->subcategory_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Brand Name</th>
						<td>
							<img src="{{ URL::to('/uploads/brand_icons/'.$brand->brand_icon) }}" width="25" style="float:left">
							<span style="float:left;margin:7px 0 0 15px;">{{ $brand->brand_name }}</span>
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product Color</th>
						<td>
							@if ( $color != null )
								<img src="{{ URL::to('/uploads/color_images/'.$color->color_image) }}" width="30"  height="20" style="float:left">
								<span style="float:left;margin:0px 0 0 15px;">{{ $color->color_name }}</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product Size</th>
						<td>
							@if ( $size != null )
								{{ $size->size_name }}
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product Length</th>
						<td>
							@if ( $length != null )
								{{ $length->length_name }}
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product Weight</th>
						<td>
							@if ( $weight != null )
								{{ $weight->weight_name }}
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Product Fuel</th>
						<td>
							@if ( $fuel != null )
								{{ $fuel->fuel_name }}
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Country</th>
						<td>
							@if ( $country != null )
								<img src="{{ URL::to('/uploads/flags/'.$country->flag) }}" width="25" style="float:left">
								<span style="float:left;margin:0px 0 0 15px;">{{ $country->country_name }}</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Created Date</th>
						<td>{{ Date($date_format, strtotime($product->created_at)) }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Updated Date</th>
						<td>{{ Date($date_format, strtotime($product->updated_at)) }}</td>
					</tr>
					<tr>
						<th>{{ $i++ }}</th>
						<th>Product Images</th>
						<th>
						          <div class="controls span12">
						          <?php $count =0; ?>
						          <div class="row-fluid product_image">
						          	@if(count($product_images) > 0)
						                    	<a href="{{ URL::to('admin/product/image_rearrange/'.$product->id) }}">Images Rearrange</a>
						          @endif
						          @foreach ($product_images as $image) <?php ++$count; ?>
						                    <div>
						                         	<div class="thumbnail pull-left" style="margin:10px; width:200px; height: 150px;">
						                         	<input type="hidden" name="img{{ $image->id }}">
						                            	<img src="{{ URL::to('/uploads/products/'.$image->image) }}" style="width:auto; height: 100%;">
						                           	</div>
						                    </div>
						          @endforeach
						          </div>
						          </div>
						</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop