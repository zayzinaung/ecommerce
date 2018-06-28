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
		Offline Sale<small> management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/offline_sale')}}">Offline Sale Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Create Offline Sale
			</li>
		</ul>
	</div>

	<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-basket-loaded"></span> Add New Offline Sale
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/offline_sale', 'class'=>'form-horizontal')) }}
			<div class="form-body">

				<h3 class="form-section">Offline Sale Informations</h3>

				@if ( $errors->has('customer_name') || $errors->has('customer_email') || $errors->has('customer_phone') || $errors->has('customer_address') || $errors->has('selling_date') ) 
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
					<label class="control-label col-md-2">Member Name<span class="required">* </span></label>
					<div class="col-md-5">
						<select class="form-control" name="member" id="member_select">
							<option value="0">Add Other Member</option>
							@if ( $members )
								@foreach($members as $member)
									<option value="{{ $member->id }}">{{ $member->username }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="form-group @if ($errors->has('customer_name')) has-error @endif">
					<label class="control-label col-md-2"></label>
					<div class="col-md-5">
						{{ Form::text('customer_name', Input::old('customer_name'),array('class'=>'form-control member_data')) }}
						@foreach($errors->get('customer_name') as $error)
							<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group @if ($errors->has('customer_email')) has-error @endif">
					<label class="control-label col-md-2">Member Email<span class="required">* </span></label>
					<div class="col-md-5">
						{{ Form::text('customer_email', Input::old('customer_email'),array('class'=>'form-control member_data')) }}
						@foreach($errors->get('customer_email') as $error)
							<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group @if ($errors->has('customer_phone')) has-error @endif">
					<label class="control-label col-md-2">Member Phone No.<span class="required">* </span></label>
					<div class="col-md-5">
						{{ Form::text('customer_phone', Input::old('customer_phone'),array('class'=>'form-control member_data')) }}
						@foreach($errors->get('customer_phone') as $error)
							<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group @if ($errors->has('customer_address')) has-error @endif">
					<label class="control-label col-md-2">Member Address<span class="required">* </span></label>
					<div class="col-md-5">
						{{ Form::textarea('customer_address', Input::old('customer_address'),array('class'=>'form-control member_data','rows'=>'5')) }}
						@foreach($errors->get('customer_address') as $error)
							<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Select Subcategory<span class="required">* </span></label>
					<div class="col-md-5">
						<select name="subcategory" id="subcategory" class="form-control" onChange="change_subcatelist(this.value)">
							<option value="0">-</option>
							@if ( $subcategory )
								@foreach($subcategory as $subcate )
									<option value="{{ $subcate->id }}">{{ $subcate->subcategory_name }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Select Product<span class="required">* </span></label>
					<div class="col-md-5" id="product_region">
						<select id="product_name" class="form-control" disabled>
							<option value="0">-</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Select Product Quantity<span class="required">* </span></label>
					<div class="col-md-5" id="product_quantity_region">
						<select id="product_quantity" class="form-control" disabled>
							<option value="0">-</option>
						</select>
					</div>
				</div>

				<div class="form-group @if ($errors->has('product_price')) has-error @endif">
					<label class="control-label col-md-2">Product Price<span class="required">* </span></label>
					<div class="col-md-5">
						{{ Form::text('product_price','',array('class'=>'form-control','readonly'=>'readonly')) }}
					</div>
				</div>

				<div class="form-group @if ($errors->has('total_amount')) has-error @endif">
					<label class="control-label col-md-2">Total Amount<span class="required">* </span></label>
					<div class="col-md-5">
						{{ Form::text('total_amount','',array('class'=>'form-control', 'id'=>'total_amount', 'readonly'=>'readonly')) }}
						@foreach($errors->get('total_amount') as $error)
							<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
						@endforeach
					</div>
				</div>

				<div class="form-group @if ($errors->has('selling_date')) has-error @endif">
					<label class="control-label col-md-2">Selling Date<span class="required">* </span></label>
					<div class="col-md-5">
						{{ Form::text('selling_date', Input::old('selling_date'),array('class'=>'form-control datepicker')) }}
						@foreach($errors->get('selling_date') as $error)
							<span class="help-inline" style="color:#B94A48;"> {{ $error }}</span>
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Mode of Payment<span class="required">* </span></label>
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
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-offset-2 col-md-5">
								<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
								<button type="reset" class="btn grey-cascade" id="back">Cancel</button>
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

{{ HTML::style('backend/ddselect/dd.css') }}
{{ HTML::style('backend/ddselect/skin2.css') }}
{{ HTML::script('backend/ddselect/jquery.dd.min.js') }}

<script type="text/javascript">
$(document).ready(function() {
          $("#member_select").msDropdown({roundedCorner:false});
          $("#subcategory").msDropdown({roundedCorner:false});
          $("#product").msDropdown({roundedCorner:false});
          $("#product_name").msDropdown({roundedCorner:false});
          $("#product_quantity").msDropdown({roundedCorner:false});
});

function change_subcatelist(val)
{
          $.post("{{URL::to('admin/offline_sale/get_product') }}",{id: ""+ val +""}, function(data) 
          {
                    $('#product_region').html(data.result);
                    $('#product_name').hide();
                    $("#product").msDropdown({roundedCorner:false});

                    $('#product_quantity_region').html(data.qty_result);
                    $('#product_quantity').hide();
                    $("#quantity").msDropdown({roundedCorner:false});

                    if ( data.count == 0 )
                    {
                    		var amount = $('input[name=product_price]').val('');
  			$('#total_amount').val('');
                    }

                    	$('input[name=product_price]').val(data.price);
  		$('#total_amount').val(data.price);

  		$('#quantity').change(function(){
                    		var ele = $(this);
			var value = ele.val();

			var amount = $('input[name=product_price]').val();
  			var total = parseFloat(parseFloat(amount)*parseFloat(value)).toFixed(2);
  			$('#total_amount').val(total);
		});

          }, 'JSON');
}

function change_productlist(val)
{
          $.post("{{URL::to('admin/offline_sale/get_product_qty') }}",{id: ""+ val +""}, function(data) 
          {
                    $('#product_quantity_region').html(data.qty_result);
                    $('#product_quantity').hide();
                    $("#quantity").msDropdown({roundedCorner:false});

                    $('input[name=product_price]').val(data.price);
                    $('#total_amount').val(data.price);

                    $('#quantity').change(function(){
                    		var ele = $(this);
			var value = ele.val();

			var amount = $('input[name=product_price]').val();
  			var total = parseFloat(parseFloat(amount)*parseFloat(value)).toFixed(2);
  			$('#total_amount').val(total);
		});

          }, 'JSON');
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#member_select').change(function(){
		var ele = $(this);
		var value = ele.val();

		var param = {
		        	id: value
		};
		  
		$.post("{{ URL::to('admin/offline_sale/get_member') }}", param, function (data) {
		      	if (data.status == 'success') {

		      		if ( data.member != '' )
		      		{
		      			$('input[name=customer_name]').val(data['member']['name']);
			      		$('input[name=customer_email]').val(data['member']['email']);
			      		$('input[name=customer_phone]').val(data['member']['phone']);
			      		$('textarea[name=customer_address]').text(data['member']['address']);
			          		$(".member_data").attr("readonly", "readonly");
			          	} else {
			          		$('input[name=customer_name]').val('');
			      		$('input[name=customer_email]').val('');
			      		$('input[name=customer_phone]').val('');
			      		$('textarea[name=customer_address]').text('');
			          		$(".member_data").removeAttr("readonly");
			          	}

		      	} else {
		          		console.log('fail');
		     	}
		}, 'JSON');
	});
});
</script>

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