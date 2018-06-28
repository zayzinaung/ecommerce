@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Order <small>management</small>
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
				Order Detail
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<?php
					$time = strtotime($order->order_date); 
					$date = date($date_format,$time);
				?>
				<span aria-hidden="true" class="icon-basket-loaded"></span> Consignment Number : {{ $prefix }}-{{ $date }}-{{ $order->bill_no }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				
			</div>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Order Date</th>
							<th>Discount</th>
							<th>GST</th>
							<th>Shipping Cost</th>
							<th>Total</th>

							@if ( $user != '' )
							<th>Member</th>
							<th>Contact</th>
							<th>Landline</th>
							<th>Address</th>
							@else
							<th>Guest</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Address</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $date }}</td>
							<td>{{ $order->discount }}%</td>
							<td>{{ $order->gst }}%</td>
							<td>
								@if ( $order->shipment_level == 0 )
									{{ $currency }} {{ $amount }}
									{{ Form::hidden('amount',$amount,array('id'=>'amount')) }}
								@else
									-
									{{ Form::hidden('amount',0.00,array('id'=>'amount')) }}
								@endif
							</td>
							<td>
								{{ $currency}} <span class="total">{{ number_format((float)$overall_total, 2, '.', '') }}</span>
								{{ Form::hidden('total',$overall_total,array('id'=>'total')) }}
							</td>

							@if ( $user != '' )
							<td>@if ( $user->neutral == 'Mr' ) Mr. @else Mrs. @endif {{ $user->username }}</td>
							<td>{{ $user->phone }}</td>
							<td>@if ( $user->landline == 0 ) - @else {{ $user->landline }} @endif</td>
							<td>{{ $user->address }}</td>
							@else
							<td>{{ $guest_name }}</td>
							<td>{{ $guest_email }}</td>
							<td>{{ $guest_phone }}</td>
							<td>{{ $guest_address }}</td>
							@endif
						</tr>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>
							<th>Image</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; $total=0.00; ?>
						@foreach ($orders as $row)
							<tr>
								<td>{{ ++$i }}</td>
								<td><img src="{{ URL::to('/uploads/products/'.$row->image) }}" width="50"></td>
								<td>{{ $row->product_name }}</td>
								<td>{{ $row->order_quantity }}</td>
								<td>{{ $currency }} {{ $row->original_price }}</td>
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
$(document).ready(function(){
	var amount = parseFloat($('#amount').val()).toFixed(2);
  	var total = parseFloat($('#total').val()).toFixed(2);
  	var overall = parseFloat(parseFloat(amount)+parseFloat(total)).toFixed(2);
  	$('.total').text(overall);
});
</script>
@stop