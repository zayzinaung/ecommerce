@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
.logo_recepit {
	clear: both;
	float: left;
	width: 200px;
	margin: 10px 20px 20px 0;
}
.address {
	float: right;
	margin: 15px 0 0 0;
}
.address span {
	float: left;
	font-size: 15px;
	margin-bottom: 10px;
}
.white {
	color: #fff;
}
.white:hover {
	color: #fff;
}
.edit_info {
	float: left;
	margin-bottom: 15px;
}
</style>
@stop

@section('content')
<div class="page-content">
	<h3 class="page-title">
		Order Receipt <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/order')}}">Order Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Order Receipt
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<?php $time = strtotime($order->order_date); $date = date($date_format,$time); ?>
				<span aria-hidden="true" class="icon-basket-loaded"></span> Consignment Number : {{ $prefix }}-{{ $date }}-{{ $order->bill_no }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">

			<img src="{{ URL::to('/frontend/img/logo.png') }}" class="logo_recepit">

			<div class="address">
				<span>Address : {{ $receipt->address }}</span><br/>
				<span>Phone : {{ $receipt->phone }}</span>
			</div>

			<div class="table-scrollable">
				<table class="table table-hover">
					<thead>
						<th>#</th>
				              	<th>Image</th>
				              	<th>Title</th>
				              	<th>Product No</th>
				              	<th>Quantity</th>
				              	<th>Unit price</th>
				              	<th>Total</th>
					</thead>
					<tbody>
						<?php $i = 0; $total_amount = 0.00; ?>
				    		@foreach ( $orders as $order )
				    		<tr>
				          			<?php $i++; ?>
				          			<td class="vertical">{{ $i }}</td>
				          			<td class="vertical"><img src="{{ URL::to('/uploads/products/'.$order->image) }}" width="50"></td>
				          			<td class="vertical">{{ $order->product_name }}</td>
				          			<td class="vertical">{{ $order->product_no }}</td>
				          			<td class="vertical">{{ $order->order_quantity }}</td>
				          			<td class="vertical">{{ $currency }} {{ $order->original_price }}</td>
				          			<td class="vertical">{{ $currency }} {{ number_format((float)$order->order_quantity * $order->original_price, 2, '.', '') }}</td>
				    		</tr>
				    		<?php $total_amount+=$order->original_price; ?>
				    		@endforeach
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;">Buying Total</td>
				    			<td></td>
				    			<td style="font-size:17px">{{ $currency }} {{ number_format((float)$total_amount, 2, '.', ''); }}</td>
				    		</tr>
				    		@if ( $order->discount != 0 )
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">Discount</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">{{ $order->discount }}%</td>
				    		</tr>
				    		@endif
				    		@if ( $order->gst != 0 )
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">GST</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">{{ $order->gst }}%</td>
				    		</tr>
				    		@endif
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">Shipping Cost</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">
				    				{{ $currency }} {{ number_format((float)$amount, 2, '.', '') }}
							</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;">Overall Total</td>
				    			<td></td>
				    			<td style="font-weight:bold;font-size:18px;color:#35aa47;">
				    				{{ $currency }} {{ number_format((float)$shipping_cost, 2, '.', ''); }}
				    			</td>
				    		</tr>
					</tbody>
				</table>
			</div>

			<p style="font-size:15px">{{ $receipt->description }}</p>
			<p style="font-size:15px">{{ $receipt->position }}</p>
			<p style="font-size:15px">{{ $receipt->name }}</p>

			@if ( $receipt->sign != null )
				<p><img src="{{ URL::to('/uploads/sign/'.$receipt->sign) }}"></p>
			@endif

			<button type="button" class="btn blue-madison" style="margin:20px 0 10px 0"><a href="{{ URL::to('admin/order/export_receipt/'.strtolower($order->bill_no)) }}" class="white" target="_blank"><i class="fa fa-file-pdf-o"> Export PDF</i></a></button>

			@if ( $order->receipt == 0 )
				{{ Form::open(array('url'=>'admin/order/send_receipt/'.$order->bill_no, 'class'=>'form-horizontal','style'=>'display: inline')) }}
				<button type="submit" class="btn green-meadow" style="margin:20px 0 10px 0"><i class="fa fa-envelope-o"> Send Receipt</i></button>
				{{ Form::close() }}
			@endif
		</div>
	</div>
</div>
@stop