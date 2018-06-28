@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Other Incomes Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/income')}}">Other Incomes Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Other Incomes Information List
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-calculator"></span> Other Incomes Information - {{ $income->income_name }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<?php $i = 0; ?>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Other Incomes Name</th>
						<td>{{ $income->income_name }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Other Incomes Amount</th>
						<td>{{ $currency }} {{ $income->income_amount }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>Received Date</th>
						<td>{{ date($date_format, $income->received_date) }}</td>
					</tr>
					<tr>
						<td>{{ ++$i }}</td>
						<th>MOP</th>
						<td>
							@if ( $income->cash == 1 )
								<p style="font-weight:bold;font-size:14px;">Cash</p>
							@elseif ( $income->cheque != null )
								<?php $cheque = unserialize($income->cheque); ?>
								<p style="font-weight:bold;font-size:14px;">Cheque</p>
								<p>Account Number : {{ $cheque['account_no'] }}</p>
								<p>Account Name : {{ $cheque['account_name'] }}</p>
								<p>Bank Name : {{ $cheque['bank_name'] }}</p>
								<p>Bank Branch : {{ $cheque['bank_branch'] }}</p>
								<p>Cheque Issue Date : {{ $cheque['cheque_issue_date'] }}</p>
							@elseif ( $income->enet != null )
								<p style="font-weight:bold;font-size:14px;">Enet</p>
								<p>{{ $income->enet }}</p>
							@elseif ( $income->other != null )
								<p style="font-weight:bold;font-size:14px;">Other</p>
								<p>{{ $income->other }}</p>
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop