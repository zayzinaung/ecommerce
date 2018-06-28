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
				New
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue-madison">
				<div class="portlet-title">
					<div class="caption">
						<span aria-hidden="true" class="icon-calculator"></span> Expenses Information Management
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{ Form::open(array('url'=>'admin/expense', 'class'=>'form-horizontal')) }}
						<div class="form-body">

							<h3 class="form-section">Expenses Information</h3>
							
							@if ($errors->has('name') || $errors->has('amount') || $errors->has('payment_date') ) 
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
								<label class="control-label col-md-3">Expense Name<span class="required">* </span></label>
								<div class="col-md-6">
									<select class="form-control" name="expense_name" id="expense_select">
										<option value="0">Add Other Expense</option>
										@if ( $expenses )
											@foreach($expenses as $expense)
												<option value="{{ $expense->id }}">{{ $expense->expense_name }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="form-group @if ($errors->has('name')) has-error @endif">
								<label class="control-label col-md-3"></label>
								<div class="col-md-6">
									{{ Form::text('name', Input::old('name'),array('class'=>'form-control expense_data')) }}
									@foreach($errors->get('name') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('amount')) has-error @endif">
								<label class="control-label col-md-3">Expense Amount<span class="required">* </span></label>
								<div class="col-md-6">
									{{ Form::text('amount', Input::old('amount'),array('class'=>'form-control')) }}
									<div class="note note-info mar0">
										<p><strong class="text-muted">Note:</strong> Amount should be decimal value like 1.00</p>
									</div>
									@foreach($errors->get('amount') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group @if ($errors->has('payment_date')) has-error @endif">
								<label class="control-label col-md-3">Payment Date<span class="required">* </span></label>
								<div class="col-md-6">
									{{ Form::text('payment_date', Input::old('payment_date'),array('class'=>'form-control datepicker')) }}
									@foreach($errors->get('payment_date') as $error)
									    <span class="help-inline"> {{ $error }}</span>
									@endforeach
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Mode of Payment<span class="required">* </span></label>
								<div class="col-md-6">
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
							                            	<label for="checque">
							                            		{{ Form::checkbox('cheque', 1, false, array('id'=>'check2','class'=>'enable')) }}
							                            		<span style="float:left;margin-top:5px;font-size:13px;">You will need following information to pay via Cheque</span>
							                            	</label>
							                              	<div class="control-group @if ($errors->has('account_no')) has-error @endif">
							                                	{{ Form::text('account_no', Input::old('account_no'), array('class'=>'form-control','placeholder'=>'Account No')) }}
							                                	@foreach($errors->get('account_no') as $error)
												<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
											@endforeach
							                              	</div>
							                              	<div class="control-group @if ($errors->has('account_name')) has-error @endif">
							                                	{{ Form::text('account_name', Input::old('account_name'), array('class'=>'form-control','placeholder'=>'Account Name')) }}
							                                	@foreach($errors->get('account_name') as $error)
												<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
											@endforeach
							                              	</div>
							                              	<div class="control-group @if ($errors->has('bank_name')) has-error @endif">
							                                	{{ Form::text('bank_name', Input::old('bank_name'), array('class'=>'form-control','placeholder'=>'Bank Name')) }}
							                                	@foreach($errors->get('bank_name') as $error)
												<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
											@endforeach
							                              	</div>
							                              	<div class="control-group @if ($errors->has('bank_branch')) has-error @endif">
							                                	{{ Form::text('bank_branch', Input::old('bank_branch'), array('class'=>'form-control','placeholder'=>'Bank Branch')) }}
							                                	@foreach($errors->get('bank_branch') as $error)
												<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
											@endforeach
							                              	</div>
							                              	<div class="control-group @if ($errors->has('cheque_issue_date')) has-error @endif">
							                                	{{ Form::text('cheque_issue_date', Input::old('cheque_issue_date'), array('class'=>'form-control datepicker','placeholder'=>'Cheque Issue Date')) }}
							                                	@foreach($errors->get('cheque_issue_date') as $error)
												<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
											@endforeach
							                              	</div>
							                            </div><!-- end of tab-pane -->
							                            <div class="tab-pane fade in pay_content3" id="enet">
							                            	<label for="checque">
							                            		{{ Form::checkbox('cheque', 1, false, array('id'=>'check3','class'=>'enable')) }}
							                            		<span style="float:left;margin-top:5px;font-size:13px;">Click to fill information</span>
							                            	</label>
							                              	<div class="control-group @if ($errors->has('transaction_id')) has-error @endif">
							                                	{{ Form::text('transaction_id','', array('class'=>'form-control','placeholder'=>'Transaction ID')) }}
							                                	@foreach($errors->get('transaction_id') as $error)
												<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
											@endforeach
							                              	</div>
							                            </div><!-- end of tab-pane -->
							                             <div class="tab-pane fade in pay_content4" id="other">
							                             	<label for="checque">
							                             		{{ Form::checkbox('cheque', 1, false, array('id'=>'check4','class'=>'enable')) }}
							                             		<span style="float:left;margin-top:5px;font-size:13px;">Click to fill information</span>
							                             	</label>
							                              	<div class="control-group @if ($errors->has('description')) has-error @endif">
							                                	{{ Form::textarea('description','', ['class' => 'form-control','id'=>'description','rows'=>'5']) }}
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
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
									<button type="button" class="btn grey-cascade" id="back">Cancel</button>
								</div>
							</div>
						</div>
								
					{{Form::close()}}
					<!-- END FORM-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
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

<script type="text/javascript">
$(document).ready(function(){
	$('#expense_select').change(function(){
		var ele = $(this);
		var value = ele.val();

		var param = {
		        	id: value
		};
		  
		$.post("{{ URL::to('admin/expense/get_expense') }}", param, function (data) {
		      	if (data.status == 'success') {

		      		if ( data.expense != '' )
		      		{
		      			$('input[name=name]').val(data.expense);
			          		$(".expense_data").attr("readonly", "readonly");
			          	} else {
			          		$('input[name=name]').val('');
			          		$(".expense_data").removeAttr("readonly");
			          	}

		      	} else {
		          		console.log('fail');
		     	}
		}, 'JSON');
	});
});
</script>

@stop