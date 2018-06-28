@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Profit and Loss Information <small>information</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/profitandloss')}}">Profit and Loss Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Profit and Loss Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<?php
					$get_from = Date($date_format,strtotime($from));
					$get_to = Date($date_format,strtotime($to));
				?>
				<span aria-hidden="true" class="icon-wallet"></span> Profit &amp; Loss Statement from {{ $get_from }} to {{ $get_to }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">

		<?php
			$gst = 0;
			if ( count($get_gst) != 0 )
			{
				foreach ( $get_gst as $g )
				{
					$gst += $g->gst;
				}
			}
		?>

		<div class="table-scrollable">
		<table class="table table-bordered table-hover">
			<tr>
				<td colspan="5"><h4 style="color:blue; font-weight:bold;">INCOME</h4></td>
			</tr>
			<?php 
				$online_income  = 0;
                			$offline_income = 0;
                			$other_income   = 0;
                			$total_income   = 0;
                		?>
                		<tr>
				<td colspan="5"><strong><u>ONLINE SOLD</u></strong></td>
			</tr>
			@if(count($online_sold) != 0)
			<tr>
				<td><strong>Order Date</strong></td>
				<td><strong>Product Name</strong></td>
				<td><strong>Quantity</strong></td>
				<td><strong>Unit Price</strong></td>
				<td><strong>Total Amount</strong></td>
			</tr>
					            
			@foreach ($online_sold as $row)
			<tr>
				<?php $sold_amount = ($row->original_price) * ($row->order_quantity); ?>

				<td>{{ date($date_format,strtotime($row->order_date)) }}</td>
				<td>{{ $row->product_name }}</td>
				<td>{{ $row->order_quantity }}</td>
				<td>{{ $currency }} {{ $row->original_price }}</td>
				<td>{{ $currency }} {{ number_format($sold_amount, 2, '.', '') }}</td>
				<?php $online_income += $sold_amount; ?>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"><b>Online Sold</b></td>
				<td><u><b>{{ $currency }} {{ number_format($online_income, 2, '.', '') }}</b></u></td>
			</tr>   
			@else
			<tr>
				<td colspan="4"><b>Online Sold</b></td>
				<td><u><b>{{ $currency }} {{ number_format($online_income, 2, '.', '') }}</b></u></td>
			</tr>
			@endif
			<!-- End of Online Sold -->

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<!-- Start of Offline Sold -->
                		<tr>
				<td colspan="5"><strong><u>OFFLINE SOLD</u></strong></td>
			</tr>
			@if(count($offline_sold) != 0)
			<tr>
				<td><strong>Order Date</strong></td>
				<td><strong>Product Name</strong></td>
				<td><strong>Quantity</strong></td>
				<td><strong>Unit Price</strong></td>
				<td><strong>Total Amount</strong></td>
			</tr>
					            
			@foreach ($offline_sold as $row)
			<tr>
				<?php $offline_sold_amount = ($row->per_price) * ($row->order_quantity); ?>

				<td>{{ date($date_format, $row->selling_date) }}</td>
				<td>{{ $row->product_name }}</td>
				<td>{{ $row->order_quantity }}</td>
				<td>{{ $currency }} {{ $row->per_price }}</td>
				<td>{{ $currency }} {{ number_format($offline_sold_amount, 2, '.', '') }}</td>
				<?php $offline_income += $offline_sold_amount; ?>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"><b>Offline Sold</b></td>
				<td><u><b>{{ $currency }} {{ number_format($offline_income, 2, '.', '') }}</b></u></td>
			</tr>   
			@else
			<tr>
				<td colspan="4"><b>Offline Sold</b></td>
				<td><u><b>{{ $currency }} {{ number_format($offline_income, 2, '.', '') }}</b></u></td>
			</tr>
			@endif
			<!-- End of Offline Sold -->

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<!-- Start of Other Incomes -->
			<tr>
				<td colspan="5"><strong><u>OTHER INCOMES</u></strong></td>
			</tr>
                            	@if(count($other_incomes) != 0)
			<tr>
				<td><strong>Received Date</strong></td>
				<td colspan="3"><strong>Other Incomes</strong></td>
				<td><strong>Amount</strong></td>
			</tr>
					                    
			@foreach ($other_incomes as $row)
			<tr>
				<td>{{ date($date_format,$row->received_date) }}</td>
				<td colspan="3">{{ $row->income_name }}</td>
				<td>{{ $currency }} {{ number_format($row->income_amount, 2, '.', '') }}</td>
				<?php $other_income += $row->income_amount ?>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"><b>Other Incomes</b></td>
				<td><u><b>{{ $currency }} {{ number_format($other_income, 2, '.', '') }}</b></u></td>
			</tr>
			@else
			<tr>
				<td colspan="4"><b>Other Incomes</b></td>
				<td><u><b>{{ $currency }} {{ number_format($other_income, 2, '.', '') }}</b></u></td>
			</tr>
			@endif
			<!-- End of Other Incomes -->
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<?php $total = $online_income + $offline_income + $other_income; ?>
				<?php $gst_amount = number_format((float)( $total * $gst ) / 100, 2, '.', ''); ?>
				<td colspan="4"><b>Total GST</b></td>
				<td><b>+ {{ $currency }} {{ $gst_amount }}</b></td>
			</tr>
			<!-- Start of Total Incomes -->
			<tr class="info">
				<td colspan='4'><strong style="color:blue;">TOTAL INCOME =></strong></td>
				<?php $total_income = Common::gst($total, $gst); ?>
				<td>
					<strong style="color:blue;">{{ $currency }} {{ number_format($total_income, 2, '.', '') }}</strong>
				</td>
			</tr>
            		<!-- End of Total Incomes -->

            		<tr>
				<td colspan="5"><h4 style="color:red; font-weight:bold;">EXPENSES</h4></td>
			</tr>
			<?php 
				$stock_outcome = 0;
                			$expense_outcome = 0;
                			$total_outcome = 0;
                			$salary = 0;
                			$cpf_expenses = 0;
                		?>
                		<!-- Start of Stock Expense -->
                		<tr>
				<td colspan="5"><strong><u>PURCHASE STOCKS</u></strong></td>
			</tr>
                            	@if(count($stock) != 0)
			<tr>
				<td><strong>Buying Date</strong></td>
				<td><strong>Stock Name</strong></td>
				<td colspan="2"><strong>Quantity</strong></td>
				<td><strong>Buying Amount</strong></td>
			</tr>
					                    
			@foreach ($stock as $row)
			<tr>
				<td>{{ date($date_format, strtotime($row->created_at)) }}</td>
				<td>{{ $row->stock_name }}</td>
				<td colspan="2">{{ $row->quantity }}</td>
				<td>{{ $currency }} {{ number_format($row->amount, 2, '.', '') }}</td>
				<?php $stock_outcome += $row->amount; ?>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"><b>Purchase Stocks</b></td>
				<td><u><b>{{ $currency }} {{ number_format($stock_outcome, 2, '.', '') }}</b></u></td>
			</tr>
			@else
			<tr>
				<td colspan="4"><b>Purchase Stocks</b></td>
				<td><u><b>{{ $currency }} {{ number_format($stock_outcome, 2, '.', '') }}</b></u></td>
			</tr>
			@endif
			<!-- End of Stock Expense -->
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<!-- Start of Expenses -->
			<tr>
				<td colspan="5"><strong><u>OTHER EXPENSES</u></strong></td>
			</tr>
			@if(count($expenses) != 0)
			<tr>
				<td><strong>Payment Date</strong></td>
				<td colspan="3"><strong>Expense Name</strong></td>
				<td><strong>Paid Amount</strong></td>
			</tr>	                    
			@foreach ($expenses as $row)
			<tr>
				<td>{{ date($date_format,$row->payment_date) }}</td>
				<td colspan="3">{{ $row->expense_name }}</td>
				<td>{{ $currency }} {{ number_format($row->expense_amount, 2, '.', '') }}</td>
				<?php $expense_outcome += $row->expense_amount ?>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"><b>Other Expenses</b></td>
				<td><u><b>{{ $currency }} {{ number_format($expense_outcome, 2, '.', '') }}</b></u></td>
			</tr>
			@else
			<tr>
				<td colspan="4"><b>Other Expenses</b></td>
				<td><u><b>{{ $currency }} {{ number_format($expense_outcome, 2, '.', '') }}</b></u></td>
			</tr>
			@endif
			<!-- End of Expenses -->

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<!-- Start of Total Outcome -->
			<tr class="danger">
				<td colspan='4'><strong style="color:red;">TOTAL OUTCOME =></strong></td>
					<?php $total_outcome = $stock_outcome + $expense_outcome; ?>
				<td>
					<strong style="color:red;">{{ $currency }} {{ number_format($total_outcome, 2, '.', '') }}</strong>
				</td>
			</tr>
            		<!-- End of Total Outcome -->

            		<!-- Start of Overall Total -->
            		<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<?php $overall_total = 0 ?>
			<?php $overall_total = $total_income - $total_outcome ?>
			
			<tr>
				<td colspan="4"><b>Total GST</b></td>
				<td><b>- {{ $currency }} {{ $gst_amount }}</b></td>
			</tr>

			<tr class="success" style="font-weight:bold;">
				<td colspan="4"><h4 style="color:green; font-weight:bold;">OVERALL TOTAL =></h4></td>
				<td>
					<h4 style="color:green; font-weight:bold;">{{ $currency }} {{ number_format($overall_total - $gst_amount, 2, '.', '') }}</h4>
				</td>
			</tr>
			<!-- End of Overall Total -->
		
		</table>

		</div><!-- end of table-scrollable -->
		
		{{ Form::open(array('url'=>'admin/profitandloss', 'class'=>'form-horizontal')) }}
			{{ Form::hidden('from_date', $from) }}
			{{ Form::hidden('to_date', $to) }}
			<div>
                            		<button type="submit" class="btn blue-madison button-submit"><i class="fa fa-save"></i> Save Profit &amp; Loss</button>
                           	</div>
		{{ Form::close() }}
                	
		</div><!-- end of portlet-body -->
	</div>
</div>
@stop