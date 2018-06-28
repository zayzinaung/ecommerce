@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
.checker {
	margin: 0 5px 0 0!important;
}
</style>
@stop

@section('content')
<script type="text/javascript">
  $(function(){
      
      $(".enable").toggle(
        function() {
            $(this).attr('checked','checked');
            mode = $(this).val();
            $("#mode").val(mode);
            $(this).closest('.tab-pane').find('input[type=text]').removeAttr('disabled');  
        },
        function() {
            $(this).removeAttr('checked');
            $("#mode").val('');
            $(this).closest('.tab-pane').find('input[type=text]').attr('disabled','disabled');  
    });     

      $('.calculate').keyup(function(e){
        var grossSalary = parseFloat($('#salary').val()) || 0;
        var comission =parseFloat($('#comission').val()) || 0;
        var overtime =parseFloat($('#overtime').val()) || 0;
        var salaryAdvance =parseFloat($('#salary_advance').val()) || 0;
        var conByEmp =parseFloat($('#conByEmp').val()) || 0;
        var totalSalary = grossSalary + comission + overtime - salaryAdvance - conByEmp;

        if (totalSalary > 0 ) {
          $('#amount').val(totalSalary);

        }else{
	$('#amount').parent('div').addClass('has-error');
	$('#amount').val(totalSalary);
        }
        
      });

  });
</script>
	<div class="page-content">
		<h3 class="page-title">
			Salary Payment <small>management</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="{{URL::to('admin/')}}">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="{{URL::to('admin/staff/payroll')}}">Salary Payment</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Salary Payment Details
				</li>
			</ul>
		</div>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-dollar"></i>Salary Payment For {{ date('F\' Y',strtotime('1-'.$month)) }} - <?php echo $staff->name; ?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
				</div>
			</div>
			<div class="portlet-body">

				@if( Session::get('success') )
					<div class="alert alert-success">
						{{ Session::get('success') }}
					</div>
				@endif
				@if( Session::get('error') )
					<div class="alert alert-danger">
						{{ Session::get('error') }}
					</div>
				@endif
				
				<div class="table-responsive">

				{{ Form::open(array('url'=>'admin/staff/save_payment/'.$staff->id.'/'.$month, 'class'=>'form-horizontal')) }} 

			                <div class="alert alert-block alert-info fade in">
			                  <button type="button" class="close" data-dismiss="alert">&times;</button>
			                  The salary payment for the staff , <a href="<?= URL::to('staff/'.$staff->id) ?>"><strong> <?= ucfirst($staff->salutation); ?> <?= $staff->name; ?> </strong></a> for the month of <strong><span><?= date('F Y',strtotime('1-'.$month)); ?></span></strong>
			                </div>     

			                <input type="hidden" name="month" value="{{ $month }}">
					<table class="table table-striped table-bordered table-hover">
						<?php $i=0; ?>
						<tr>
							<th>#</th>
							<th width="25%">Title </th>
							<th>Description</th>
						</tr>
						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%">Staff Name</th>
							<td>{{ $staff->name  }}</td>
						</tr>
						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%">Gross Salary (before CPF deduction)</th>
							<td>
								<div class="col-md-4 has-success">
								<div class="input-icon">
									<i class="fa fa-dollar">S</i>
									<input type="text" name="salary" id="salary" placeholder="" class="form-control" readonly="true" value="{{ $staff->salary }}" />
								</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%">Comission (excluding CPF)</th>
							<td>
								<div class="col-md-4 has-success">
								<div class="input-icon">
									<i class="fa fa-dollar">S</i>
									<input type="text" name="comission" id="comission" placeholder="Amount" class="form-control calculate" value="" />
								</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%">Overtime pay (excluding CPF)</th>
							<td>
								<div class="col-md-4 has-success">
								<div class="input-icon">
									<i class="fa fa-dollar">S</i>
									<input type="text" name="overtime" id="overtime" placeholder="Amount" class="form-control calculate" value="" />
								</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%"> Salary advance</th>
							<td>
								<div class="col-md-4 has-error">
								<div class="input-icon">
									<i class="fa fa-dollar">S</i>
									<input type="text" name="salary_advance" id="salary_advance" placeholder="Amount" class="form-control calculate" value="" />
								</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%"> Employee Contribution (Computed based on Gross Salary)</th>
							<td>
								<div class="col-md-4 has-error">
								<div class="input-icon">
									<i class="fa fa-dollar">S</i>
									<input type="text" name="conByEmp" id="conByEmp" placeholder="Amount" class="form-control calculate" readonly="true" value="{{ $conByEmp }}" />
								</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%"> Total Amount Payable</th>
							<td>
								<div class="col-md-4 has-success">
								<div class="input-icon">
									<i class="fa fa-dollar">S</i>
									<input type="text" name="amount" id="amount" placeholder="Amount" class="form-control" readonly="true" value="{{ $staff->salary - $conByEmp }}" />
								</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%">Payment Date</th>
							<td>
								<div class="col-md-4 @if ($errors->has('payment_date'))has-error @endif">
									<input type="text" name="payment_date" id="payment_date" placeholder="Date" class="form-control datepicker" value="" />
									<span class="help-inline"> {{ $errors->first('payment_date') }}</span>
								</div>
							</td>
						</tr>
						<tr>
							<td>{{ ++$i }}</td>
							<th width="25%">Payment Mode</th>
							<td>
								<div class="col-md-8">
								     <div class="controls">
						                              <ul class="nav nav-tabs">
						                              <li class="@if (!Input::old('mode')) active @endif"><a href="#cash" data-toggle="tab">Cash</a></li>                      
						                              <li class="@if (Input::old('mode') == 1) active @endif"><a href="#cheque" data-toggle="tab">Cheque</a></li>
						                              <li class="@if (Input::old('mode') == 2) active @endif"><a href="#other" data-toggle="tab">Bank Transfers</a></li>                                               
						                              </ul>
						                              <div class="tab-content">
						                                  <div class="tab-pane fade in @if (!Input::old('mode')) active @endif" id="cash">
						                                    <p>The payment has been made by Cash...</p>
						                                  </div>

						                                  <div class="tab-pane fade in @if (Input::old('mode') ==1 ) active @endif" id="cheque">
						                                      <input type="checkbox" name="cheque" class="enable" value="1" {{ (Input::old('mode') ==1 )?'checked':'' }} > <label for="chk-checque"> Click to fill information </label>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Bank Name" name="bank_name"  {{ (Input::old('mode') ==1 )?'':'disabled="disabled"' }} >
						                                      	@foreach($errors->get('bank_name') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Branch Name" name="branch_name" {{ (Input::old('mode') ==1 )?'':'disabled="disabled"' }} >
						                                      	@foreach($errors->get('branch_name') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control datepicker" placeholder="Cheque/DD Date" name="cheque_date" {{ (Input::old('mode') ==1 )?'':'disabled="disabled"' }} >
						                                        @foreach($errors->get('cheque_date') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Cheque/DD No." name="cheque_no" {{ (Input::old('mode') ==1 )?'':'disabled="disabled"' }} >
						                                        @foreach($errors->get('cheque_no') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control datepicker" placeholder="Cheque Issue Date"  name="cheque_issue_date" {{ (Input::old('mode') ==1 )?'':'disabled="disabled"' }}>
						                                        @foreach($errors->get('cheque_issue_date') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                  </div>

						                                  <div class="tab-pane fade in @if (Input::old('mode') == 2)active @endif" id="other">
						                                      <input type="checkbox" name="transfer" class="enable" value="2" {{ (Input::old('mode') ==2 )?'checked':'' }}> <label for="chk-transfer"> Click to fill information </label>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Bank Name" name="bank_name" {{ (Input::old('mode') ==2 )?'':'disabled="disabled"' }} >
						                                        @foreach($errors->get('bank_name') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Account Type" name="acc_type" {{ (Input::old('mode') ==2 )?'':'disabled="disabled"' }} >
						                                        @foreach($errors->get('acc_type') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Account No" name="acc_no" {{ (Input::old('mode') ==2 )?'':'disabled="disabled"' }} >
						                                        @foreach($errors->get('acc_no') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>
						                                      <p>
						                                      	<input type="text"  class="form-control" placeholder="Transcation Receipt No" name="receipt_no" {{ (Input::old('mode') ==2 )?'':'disabled="disabled"' }} >
						                                        @foreach($errors->get('receipt_no') as $error)
														            	<span class="help-inline"> {{ $error }}</span>
														        @endforeach
						                                      </p>                          
						                                  </div>                                              
						                               </div>
						                            </div>
							</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" ></td>
							<th>
								<div class="row">
										<div class="col-md-9">
											<button type="submit" class="btn blue-madison"><i class="fa fa-check"></i> Pay Now !</button>
										</div>
								</div>
							</td>
						</tr>
						
					</table>
							{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
@stop