@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Expenses Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/expense')}}">Expenses Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Expenses Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-calculator"></span> Expenses Information - {{ $expense->expense_name }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i=0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Expense Name</th>
						<td>{{ $expense->expense_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Expense Amount</th>
						<td>{{ $currency }} {{ $expense->expense_amount }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Payment Date</th>
						<td>{{ date($date_format, $expense->payment_date) }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>MOP</th>
						<td>
							@if ( $expense->cash == 1 )
								<p style="font-weight:bold;font-size:14px;">Cash</p>
							@elseif ( $expense->cheque != null )
								<?php $cheque = unserialize($expense->cheque); ?>
								<p style="font-weight:bold;font-size:14px;">Cheque</p>
								<p>Account Number : {{ $cheque['account_no'] }}</p>
								<p>Account Name : {{ $cheque['account_name'] }}</p>
								<p>Bank Name : {{ $cheque['bank_name'] }}</p>
								<p>Bank Branch : {{ $cheque['bank_branch'] }}</p>
								<p>Cheque Issue Date : {{ $cheque['cheque_issue_date'] }}</p>
							@elseif ( $expense->enet != null )
								<p style="font-weight:bold;font-size:14px;">Enet</p>
								<p>{{ $expense->enet }}</p>
							@elseif ( $expense->other != null )
								<p style="font-weight:bold;font-size:14px;">Other</p>
								<p>{{ $expense->other }}</p>
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop