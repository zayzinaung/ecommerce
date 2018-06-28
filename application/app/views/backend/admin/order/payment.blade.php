@extends('backend.template.template')

@section('style')
<style>
.checker {
float:left;
margin:3px 5px 0 0!important;
}
.control-group {
margin: 8px 0;
}
</style>
@stop

@section('content')
<div class="page-content">
	<h3 class="page-title">
		Order Payment<small> management</small>
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
				Order Payment
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
				<span aria-hidden="true" class="icon-basket-loaded"></span> Update Order - {{ $prefix }}-{{ $date }}-{{ $order->bill_no }}
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/order/add_payment/'.strtolower($order->bill_no), 'class'=>'form-horizontal form-bordered')) }}
			<div class="form-body">

				@if ($errors->has('account_no') || $errors->has('account_name') || $errors->has('bank_name') || $errors->has('bank_branch') || $errors->has('cheque_issue_date') || $errors->has('transaction_id') || $errors->has('description')) 
					<div class="alert alert-danger">
						You have some form errors. Please check below.
					</div>
				@endif

				@if ($errors->has('account_no') || $errors->has('account_name') || $errors->has('bank_name') || $errors->has('bank_branch') || $errors->has('cheque_issue_date'))
					{{ Form::hidden('mode','2',array('id'=>"mode")) }}
				@elseif ( $errors->has('transaction_id') )
					{{ Form::hidden('mode','3',array('id'=>"mode")) }}
				@elseif ( $errors->has('description') )
					{{ Form::hidden('mode','4',array('id'=>"mode")) }}
				@else
					{{ Form::hidden('mode','1',array('id'=>"mode")) }}
				@endif 

				<div class="form-group">
					<label class="control-label col-md-2">Consignment No</label>
					<div class="col-md-5">
						<input type="text" value="{{ $date }}-{{ $order->bill_no }}" class="form-control" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">MOP</label>
					<div class="col-md-5">
						<input type="text" value="{{ ucfirst($order->payment_method) }}" class="form-control" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Total Amount</label>
					<div class="col-md-5">
						<input type="text" value="{{ $currency }} {{ $overall_total }}" class="form-control" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">MOP</label>
					<div class="col-md-5">
					<div class="tabbable-custom" id="payment_tabs">
						<ul id="tabExample1" class="nav nav-tabs">
				                            <li id="pay1" data-id="1"><a href="#cash" data-toggle="tab">Cash</a></li>
				                            <li id="pay2" data-id="2"><a href="#cheque" data-toggle="tab">Cheque</a></li>
				                            <li id="pay3" data-id="3"><a href="#enet" data-toggle="tab">Enet</a></li>
				                            <li id="pay4" data-id="4"><a href="#other" data-toggle="tab">Other</a></li>
				                    </ul>
				                    <div class="tab-content">
				                            <div class="tab-pane fade in pay_content1" id="cash">
				                              <p>The payment has been made by Cash...</p>
				                            </div><!-- end of tab-pane -->
				                            <div class="tab-pane fade in pay_content2" id="cheque">
				                            	<label for="checque"><input type="checkbox" name="cheque" value="1" class="enable" id="check2"><span style="float:left;margin-top:5px;font-size:13px;">You will need following information to pay via Cheque</span></label>
				                              	<div class="control-group @if ($errors->has('account_no')) has-error @endif">
				                                	<input type="text" class="form-control" placeholder="Account No" name="account_no" value="{{ Input::old('account_no') }}">
				                                	@foreach($errors->get('account_no') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                              	<div class="control-group @if ($errors->has('account_name')) has-error @endif">
				                                	<input type="text" class="form-control" placeholder="Account Name" name="account_name" value="{{ Input::old('account_name') }}">
				                                	@foreach($errors->get('account_name') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                              	<div class="control-group @if ($errors->has('bank_name')) has-error @endif">
				                                	<input type="text" class="form-control" placeholder="Bank Name" name="bank_name" value="{{ Input::old('bank_name') }}">
				                                	@foreach($errors->get('bank_name') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                              	<div class="control-group @if ($errors->has('bank_branch')) has-error @endif">
				                                	<input type="text" class="form-control" placeholder="Branch Name" name="bank_branch" value="{{ Input::old('bank_branch') }}">
				                                	@foreach($errors->get('bank_branch') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                              	<div class="control-group @if ($errors->has('cheque_issue_date')) has-error @endif">
				                                	<input type="text" placeholder="Cheque Issue Date" class="form-control datepicker"  name="cheque_issue_date" value="{{ Input::old('cheque_issue_date') }}">
				                                	@foreach($errors->get('cheque_issue_date') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                            </div><!-- end of tab-pane -->
				                            <div class="tab-pane fade in pay_content3" id="enet">
				                            	<label for="checque"><input type="checkbox" name="cheque" value="1" class="enable" id="check3"><span style="float:left;margin-top:5px;font-size:13px;">Click to fill information</span></label>
				                              	<div class="control-group @if ($errors->has('transaction_id')) has-error @endif">
				                                	<input type="text" class="form-control" name="transaction_id" placeholder="Transaction ID" value="">
				                                	@foreach($errors->get('transaction_id') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                            </div><!-- end of tab-pane -->
				                             <div class="tab-pane fade in pay_content4" id="other">
				                             	<label for="checque"><input type="checkbox" name="cheque" value="1" class="enable" id="check4"><span style="float:left;margin-top:5px;font-size:13px;">Click to fill information</span></label>
				                              	<div class="control-group @if ($errors->has('description')) has-error @endif">
				                                	<textarea id="description" class="form-control" name="description" rows="5"></textarea>
				                                	@foreach($errors->get('description') as $error)
									<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
								@endforeach
				                              	</div>
				                            </div><!-- end of tab-pane -->
				                    </div>
				          </div>
					</div>
				</div>
			</div>

			<div class="form-actions">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-offset-2 col-md-5">
								<button type="submit" class="btn green"><i class="fa fa-check"></i> Paid Now</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

	var value = $('#mode').val();
	$('#pay'+value).addClass('active');
	$('.pay_content'+value).addClass('active');
	$('#check'+value).attr('checked','checked');

	$("ul.nav-tabs li").click(function(){
		var ele = $(this);
		var ref_this = ele.attr('data-id');
		if ( ref_this != 1 )
		{
			$(".enable").closest('.tab-pane').find('input[type=text],textarea').attr('disabled','disabled');
		}
		$('#mode').val(ref_this);
	});
});
</script>

<script type="text/javascript">
$(function(){
    	$(".enable").click(function(){
      		if($(this).is(':checked'))
      		{
        			$(this).closest('.tab-pane').find('input[type=text],textarea').removeAttr('disabled');  
		} else {
        			$(this).removeAttr('checked');
        			$(this).closest('.tab-pane').find('input[type=text],textarea').attr('disabled','disabled');  
      		}
    	});
});
</script>

@stop