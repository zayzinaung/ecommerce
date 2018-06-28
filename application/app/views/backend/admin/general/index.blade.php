@extends('backend.template.template')

@section('style')
{{ HTML::style('backend/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}
<style type="text/css" media="screen">
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
	border-top: 3px solid #f3565d;
}
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
.edit_info,.edit_invoice{
	float: left;
	margin-bottom: 15px;
}
</style>
@stop

@section('content')

<div class="page-content">
	<h3 class="page-title">
		Settings
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/general')}}">System</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Settings
			</li>
		</ul>
	</div>
	<!-- BEGIN SAMPLE TABLE PORTLET -->
	<ul class="nav nav-tabs">
		<li class="tab_5_1 active tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="General Setting">
			<a href="#tab_5_1" data-toggle="tab"><span aria-hidden="true" class="icon-wrench"></span></a>
		</li>
		<li class="tab_5_2 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Timezone Setting">
			<a href="#tab_5_2" data-toggle="tab"><span aria-hidden="true" class="icon-clock"></span></a>
		</li>
		<li class="tab_5_3 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Date Format Setting">
			<a href="#tab_5_3" data-toggle="tab"><span aria-hidden="true" class="icon-calendar"></span></a>
		</li>
		<li class="tab_5_4 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Prefix Setting">
			<a href="#tab_5_4" data-toggle="tab"><span aria-hidden="true" class="icon-pin"></span></a>
		</li>
		<li class="tab_5_5 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Email Setting">
			<a href="#tab_5_5" data-toggle="tab"><span aria-hidden="true" class="icon-envelope"></span></a>
		</li>
		<li class="tab_5_6 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Company Info Setting">
			<a href="#tab_5_6" data-toggle="tab"><span aria-hidden="true" class="icon-globe"></span></a>
		</li>
		<li class="tab_5_7 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Login Freeze Setting">
			<a href="#tab_5_7" data-toggle="tab"><span aria-hidden="true" class="icon-login"></span></a>
		</li>
		<li class="tab_5_8 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Currency Symbol Setting">
			<a href="#tab_5_8" data-toggle="tab"><span aria-hidden="true" class="icon-tag"></span></a>
		</li>
		<li class="tab_5_9 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Invoice Information Setting">
			<a href="#tab_5_9" data-toggle="tab"><span aria-hidden="true" class="icon-screen-tablet"></span></a>
		</li>
		<li class="tab_5_10 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Receipt Information Setting">
			<a href="#tab_5_10" data-toggle="tab"><span aria-hidden="true" class="icon-notebook"></span></a>
		</li>
		<li class="tab_5_11 tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="CPF Setting">
			<a href="#tab_5_11" data-toggle="tab"><span aria-hidden="true" class="icon-puzzle"></span></a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab_5_1">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-wrench"></span> General setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>

			<div class="portlet-body form">
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
			<!-- BEGIN FORM-->
			{{ Form::model($theme, array('method' => 'POST', 'url'=> array('admin/general/save', $theme->id),  'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group ">
					<label class="control-label col-md-3">Select Theme</label>
					<div class="col-md-3">
						<select class="form-control" name="theme" data-show-subtext="true">
							<option  style="background-color:#3d3d3d;color:#fff;" {{ ($theme->format == 'default')?'selected':'' }}  value="default" data-content="<span class='label lable-sm label-danger'>Default </span>">Default</option>
							<option  style="background-color:#4276A4;color:#fff;" {{ ($theme->format == 'blue')?'selected':'' }}  value="blue" data-content="<span class='label lable-sm label-info'>Blue </span>">Blue</option>
							<option  style="background-color:#364150;color:#fff;" {{ ($theme->format == 'darkblue')?'selected':'' }}  value="darkblue" data-content="<span class='label lable-sm label-success'>Darl Blue </span>">Dark Blue</option>
							<option  style="background-color:#707b88;color:#fff;" {{ ($theme->format == 'grey')?'selected':'' }}  value="grey" data-content="<span class='label lable-sm bg-grey-cascade'>Grey </span>">Grey</option>
							<option  style="background-color:#FFFFFF;color:#000;" {{ ($theme->format == 'light')?'selected':'' }}  value="light" data-content="<span class='label lable-sm label-default'>Light </span>">Light</option>
							<option  style="background-color:#F6F6F6;color:#000;" {{ ($theme->format == 'light1')?'selected':'' }}  value="light1" data-content="<span class='label lable-sm bg-grey-steel'>Light 1</span>">Light 1</option>
						</select>
					</div>
					@foreach($errors->get('theme') as $error)
						<span class="help-inline"> {{ $error }}</span>
					@endforeach
				</div>
			</div>

			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_2">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-clock"></span> Timezone Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/change_timezone', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group ">
					<?php 
						$config = Config::get('timezone');
						$active = General_setting::where('type','=','timezone')->first();
					?>
					<label class="control-label col-md-3">Select Timezone</label>
					<div class="col-md-3">
						{{ Form::select('timezone', $config, $active->format, array('id'=>'timezone','class'=>'form-control')) }}
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_3">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-calendar"></span> Date Format Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/date_format', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group ">
					<label class="control-label col-md-3">Date Format</label>
					<div class="col-md-3">
						{{ Form::text('date_format',$get_format->format, array('class'=>'form-control','placeholder'=>'Format'))}}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<div class="note note-info mar0">
							<p><strong class="text-muted">Note:</strong></p>
							<p>{dd} - Day of the month, 2 digits with leading zeros ( 01 to 31 )</p>
							<p>{DD} - A textual representation of a day, three letters ( Mon through Sun )</p>
							<p>{mm} - Numeric representation of a month, with leading zeros ( 01 through 12 )</p>
							<p>{MM} - A short textual representation of a month, three letters ( Jan through Dec )<p>
							<p>{yy} - A two digit representation of a year ( 99 or 03 )</p>
							<p>{YY} - A full numeric representation of a year, 4 digits ( 1999 or 2003 )</p>
							<p>{jS} - j means Day of the month without leading zeros and S means English ordinal suffix for the day of the month, 2 characters ( 1 to 31 ) and ( st, nd, rd or th )</p>
							<p>{ll} - A full textual representation of the day of the week ( Sunday through Saturday )</p>
							<p>{FF} - A full textual representation of a month, such as January or March ( January through December )</p>
							<br/>
							<p><strong class="text-muted">Example:</strong></p>
							<p>{dd}/{mm}/{YY} => 07/11/1990</p>
							<p>{MM} {jS} {yy} => Oct 1st 90</p>
							<p>{dd}-{MM}-{YY} => 09-Dec-1990</p>
							<p>{YY}/{FF}/{dd} => 1990/December/07</p>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_4">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-pin"></span> Prefix Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/change_prefix', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group ">
					<?php 
						$active = General_setting::where('type','=','prefix')->first();
					?>
					<label class="control-label col-md-3">Prefix Name</label>
					<div class="col-md-3">
						{{ Form::text('prefix', $active->format, array('class'=>'form-control')) }}
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_5">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-envelope"></span> Email Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/change_email', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group ">
					<?php
						$active = General_setting::where('type','=','from_email')->first();
					?>
					<label class="control-label col-md-3">From Email</label>
					<div class="col-md-3">
						{{ Form::text('from_email', $active->format, array('class'=>'form-control')) }}
					</div>
				</div>
				<div class="form-group ">
					<?php
						$active = General_setting::where('type','=','to_email')->first();
					?>
					<label class="control-label col-md-3">To Email</label>
					<div class="col-md-3">
						{{ Form::text('to_email', $active->format, array('class'=>'form-control')) }}
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>			
		</div>
		<div class="tab-pane" id="tab_5_6">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-globe"></span> Company Info Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/change_information', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				@if( Session::get('success') )
				<div class="alert alert-success">
					{{ Session::get('success') }}
				</div>
				@endif
				@if ($errors->has('phone') || $errors->has('email') || $errors->has('address')) 
				<div class="alert alert-danger">
					You have some form errors. Please check below.
				</div>
				@endif
				<?php
					$company_info = General_setting::where('type','=','company_info')->first();
					$data = unserialize($company_info->format);
				?>
				<div class="form-group @if ($errors->has('phone')) has-error @endif">
					<label class="control-label col-md-3">Company Phone <span class="required">*</label>
					<div class="col-md-3">
						{{ Form::text('phone', $data['phone'], array('class'=>'form-control')) }}
						@foreach($errors->get('phone') as $error)
							<span class="help-inline"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group @if ($errors->has('email')) has-error @endif">
					<label class="control-label col-md-3">Company Email <span class="required">*</label>
					<div class="col-md-3">
						{{ Form::text('email', $data['email'], array('class'=>'form-control')) }}
						@foreach($errors->get('email') as $error)
							<span class="help-inline"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group @if ($errors->has('address')) has-error @endif">
					<label class="control-label col-md-3">Company Address <span class="required">*</label>
					<div class="col-md-3">
						{{ Form::textarea('address', $data['address'], array('class'=>'form-control','rows'=>'4')) }}
						@foreach($errors->get('address') as $error)
							<span class="help-inline"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group ">
					<label class="control-label col-md-3">Company Fax</label>
					<div class="col-md-3">
						{{ Form::text('fax', $data['fax'], array('class'=>'form-control')) }}
					</div>
				</div>
				<div class="form-group ">
					<label class="control-label col-md-3">Company Landline</label>
					<div class="col-md-3">
						{{ Form::text('landline', $data['landline'], array('class'=>'form-control')) }}
					</div>
				</div>
			</div>
			{{ Form::hidden('tab','tab_5_6') }}
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_7">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-login"></span> Login Freeze
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/change_login_attempt', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3">Select Attempt</label>
					<div class="col-md-3">
						<select name="attempt" class="form-control">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Select Freeze Time</label>
					<div class="col-md-3">
						<select name="freeze" class="form-control">
							<option value="5">5 minutes</option>
							<option value="10">10 minutes</option>
							<option value="15">15 minutes</option>
							<option value="20">20 minutes</option>
							<option value="25">25 minutes</option>
							<option value="30">30 minutes</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_8">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-tag"></span> Currency Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::open(array('url'=>'admin/setting/change_currency', 'class'=>'form-horizontal form-row-seperated')) }}
			<div class="form-body">
				<div class="form-group">
					<?php
						$config = Config::get('currency_symbol');
						$active = General_setting::where('type','=','currency')->first();
					?>
					<label class="control-label col-md-3">Select Currency Symbol</label>
					<div class="col-md-3">
						{{ Form::select('currency', $config, $active->format, array('id'=>'timezone','class'=>'form-control')) }}
					</div>
				</div>
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_9">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-screen-tablet"></span> Invoice Information Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body">

			<span class="hide" id="invoice">
				<div class="row">
				<div class="form-horizontal col-md-12">
				{{ Form::model($invoice, array('method' => 'PUT', 'route'=> array('admin.setting.update_info', $invoice->id),  'class'=>'form-horizontal', 'id'=>'invoice_form',  'files'=>true)) }}
					<div class="form-group">
						<label class="col-md-3 control-label">Address <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::textarea('address', $invoice->address, array('class'=>'form-control','rows'=>'4')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Phone <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::text('phone', $invoice->phone, array('class'=>'form-control')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Description <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::textarea('description', $invoice->description, array('class'=>'form-control','rows'=>'3')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Position <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::text('position', $invoice->position, array('class'=>'form-control')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Name <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::text('name', $invoice->name, array('class'=>'form-control')) }}
						</div>
					</div>
					<div class="form-group">
                                			<label class="control-label col-md-3">Sign <span class="required">* </span></label>
                                			<ul class="col-md-6" style="list-style:none;">
                                    			@if ( $invoice->sign != null )
                                    				<div class="row-fluid product_image">
	                                        				<div class="row-fluid">
	                                            				<span>
	                                                					<li class="thumbnail col-md-3">
	                                                    					<img src="{{ URL::to('/uploads/sign/'.$invoice->sign) }}">
	                                                					</li>
	                                            				</span>
	                                        				</div>
	                                        				<div class="row-fluid" style="clear:both">
	                                        					<li>
	                                                					{{ Form::file('signfile[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
	                                                				</li>
	                                                			</div>
	                                    			</div>
	                                    		@else
	                                    			<div class="row-fluid">
	                                    				<span>
	                                            				<li>
	                                                					{{ Form::file('signfile[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
	                                            				</li>
	                                    				</span>
                                    				</div>
                                    			@endif
                                			</ul>
                            			</div>

					{{ Form::hidden('id', $invoice->id) }}

				{{ Form::close() }}
				</div>
				</div>
	                	</span>
	                	
			<button type="button" class="btn red edit_invoice">Edit Invoice Information <span aria-hidden="true" class="icon-note"></span></button>
			
			<img src="{{ URL::to('/frontend/img/logo.png') }}" class="logo_recepit">

			<div class="address">
				<span>Address : {{ $invoice->address }}</span><br/>
				<span>Phone : {{ $invoice->phone }}</span>
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
				    		<tr>
				          			<td class="vertical">1</td>
				          			<td class="vertical"><img src="{{ URL::to('/uploads/default.jpg') }}" width="50"></td>
				          			<td class="vertical">xxxxx</td>
				          			<td class="vertical">xxxxx</td>
				          			<td class="vertical">xx</td>
				          			<td class="vertical">xx.xx</td>
				          			<td class="vertical">xxx</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;">Buying Total</td>
				    			<td></td>
				    			<td style="font-size:17px">xx.xx</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">Discount</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">xx%</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">GST</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">xx%</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;">Overall Total</td>
				    			<td></td>
				    			<td style="font-weight:bold;font-size:18px;color:#35aa47;">
				    				xx.xx
				    			</td>
				    		</tr>
					</tbody>
				</table>
			</div>
			<span style="color:red;float:left;width:100%;margin-bottom:15px;">** If you're choosing charges shipping, you need to pay the shipping costs xx.xx **</span><br/>

			<p style="font-size:15px">{{ $invoice->description }}</p>
			<p style="font-size:15px">{{ $invoice->position }}</p>
			<p style="font-size:15px">{{ $invoice->name }}</p>

			@if ( $invoice->sign != null )
				<p><img src="{{ URL::to('/uploads/sign/'.$invoice->sign) }}"></p>
			@endif

			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_10">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-notebook"></span> Receipt Information Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body">

			<span class="hide" id="info">
				<div class="row">
				<div class="form-horizontal col-md-12">
				{{ Form::model($receipt, array('method' => 'PUT', 'route'=> array('admin.setting.update_info', $receipt->id),  'class'=>'form-horizontal', 'id'=>'receipt_form',  'files'=>true)) }}
					<div class="form-group">
						<label class="col-md-3 control-label">Address <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::textarea('address', $receipt->address, array('class'=>'form-control','rows'=>'4')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Phone <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::text('phone', $receipt->phone, array('class'=>'form-control')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Description <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::textarea('description', $receipt->description, array('class'=>'form-control','rows'=>'3')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Position <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::text('position', $receipt->position, array('class'=>'form-control')) }}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Name <span class="required">* </span></label>
						<div class="col-md-7">
							{{ Form::text('name', $receipt->name, array('class'=>'form-control')) }}
						</div>
					</div>
					<div class="form-group">
                                			<label class="control-label col-md-3">Sign <span class="required">* </span></label>
                                			<ul class="col-md-6" style="list-style:none;">
                                    			@if ( $receipt->sign != null )
                                    				<div class="row-fluid product_image">
	                                        				<div class="row-fluid">
	                                            				<span>
	                                                					<li class="thumbnail col-md-3">
	                                                    					<img src="{{ URL::to('/uploads/sign/'.$receipt->sign) }}">
	                                                					</li>
	                                            				</span>
	                                        				</div>
	                                        				<div class="row-fluid" style="clear:both">
	                                        					<li>
	                                                					{{ Form::file('signfile[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
	                                                				</li>
	                                                			</div>
	                                    			</div>
	                                    		@else
	                                    			<div class="row-fluid">
	                                    				<span>
	                                            				<li>
	                                                					{{ Form::file('signfile[]', ['class' => 'multi max-0 accept-gif|jpg|jpeg|png', 'id'=>'T8A']) }}
	                                            				</li>
	                                    				</span>
                                    				</div>
                                    			@endif
                                			</ul>
                            			</div>

					{{ Form::hidden('id', $receipt->id) }}

				{{ Form::close() }}
				</div>
				</div>
	                	</span>
	                	
			<button type="button" class="btn red edit_info">Edit Receipt Information <span aria-hidden="true" class="icon-note"></span></button>
			
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
				    		<tr>
				          			<td class="vertical">1</td>
				          			<td class="vertical"><img src="{{ URL::to('/uploads/default.jpg') }}" width="50"></td>
				          			<td class="vertical">xxxxx</td>
				          			<td class="vertical">xxxxx</td>
				          			<td class="vertical">xx</td>
				          			<td class="vertical">xx.xx</td>
				          			<td class="vertical">xxx</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;">Buying Total</td>
				    			<td></td>
				    			<td style="font-size:17px">xx.xx</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">Discount</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">xx%</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">GST</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">xx%</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;border-top:0px;">Shipping Cost</td>
				    			<td style="border-top:0px"></td>
				    			<td style="font-size:17px;border-top:0px;">
				    				xx.xx
							</td>
				    		</tr>
				    		<tr>
				    			<td colspan="5" style="font-weight:bold;text-align:right;">Overall Total</td>
				    			<td></td>
				    			<td style="font-weight:bold;font-size:18px;color:#35aa47;">
				    				xx.xx
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

			</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_5_11">
			<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-puzzle"></span> CPF Setting
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if( Session::get('success') ){ ?>
					<div class="alert alert-success">
						<?php echo Session::get('success'); ?>
					</div>
				<?php } ?>
				<div class="alert alert-info">
					Before edit this CPF percentage value, please make sure to know about <a href="http://mycpf.cpf.gov.sg" target="_blank" >Singapore's CPF</a>.
				</div>
				<div class="form-body table-responsive">

					<table class="table table-striped table-bordered table-hover table-full-width">
						<tr>
							<th>Employee's Ages (Years)</th>
							<th>For Employer(%)</th>
							<th>For Employee(%)</th>
						</tr>


						<?php
							$is_750 = 1;$is_500= 1;
							foreach($cpf as $cpf) {
							if($cpf->salary < 5000){
							if($cpf->salary < 750){
							if($is_500){
						?>
						<tr>
							<th style="text-align: center;" colspan="4">Salary Equal 500 or between 500 to 750</th>
						</tr>
						<tr>
							<?php $is_500=0; } ?>
							<th>
								Age <?php echo($cpf->condition1)?'over '.$cpf->condition1:''; ?>
								<?php echo($cpf->condition1 && $cpf->condition2)?'and':''; ?>
								<?php echo($cpf->condition2)?' under/equal '.$cpf->condition2.'':''; ?>
							</th>
							<th><a href="#" class="update_info" data-pk="<?php echo $cpf->id; ?>" data-name="employer" data-title="Enter Percentage For Employer" ><?php echo $cpf->employer; ?></a> (Also have to pay under 500)</th>
							<th><a href="#" class="update_info" data-pk="<?php echo $cpf->id; ?>" data-name="employee" data-title="Enter Percentage For Employee" ><?php echo $cpf->employee; ?></a></th>
						</tr>
									                          
						<?php }else{
						if($is_750){ ?>
						<tr>
							<th style="text-align: center;" colspan="4">Salary Equal/Above 750</th>
						</tr>
						<?php $is_750=0; } ?>
						<tr>
							<th>
								Age <?php echo($cpf->condition1)?'over '.$cpf->condition1:''; ?>
								<?php echo($cpf->condition1 && $cpf->condition2)?'and':''; ?>
								<?php echo($cpf->condition2)?' under/equal '.$cpf->condition2.'':''; ?>
							</th>
							<th><a href="#" class="update_info" data-pk="<?php echo $cpf->id; ?>" data-name="employer" data-title="Enter Percentage For Employer" ><?php echo $cpf->employer; ?></a></th>
							<th><a href="#" class="update_info" data-pk="<?php echo $cpf->id; ?>" data-name="employee" data-title="Enter Percentage For Employee" ><?php echo $cpf->employee; ?></a></th>
						</tr>

						<?php } }else{ ?>
						<tr>
							<th style="text-align: center;" colspan="4">Salary Equal/Above 5000</th>
						</tr>
						<tr>
							<th>Salary Equal/Above 5000</th>
							<th><a href="#" class="update_info" data-pk="<?php echo $cpf->id; ?>" data-name="employer" data-title="Enter Percentage For Employer" ><?php echo $cpf->employer; ?></a></th>
							<th><a href="#" class="update_info" data-pk="<?php echo $cpf->id; ?>" data-name="employee" data-title="Enter Percentage For Employee" ><?php echo $cpf->employee; ?></a></th>
						</tr>
						<?php } } ?>

					</table>
					<input type="hidden" name="active_tab" value="cpf">
					<div class="form-actions">
						<div class="row">
												
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')

{{HTML::script('backend/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js')}}

<script type="text/javascript" >
  jQuery(document).ready(function() { 

        $.fn.editable.defaults.mode = 'default';
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '{{ URL::to("admin/setting/update_cpf_setting") }}';
        $.fn.editableform.buttons = '<button type="submit" class="btn blue editable-submit"><i class="fa fa-check"></i></button>';
        $.fn.editableform.buttons += '<button type="button" class="btn editable-cancel"><i class="fa fa-remove"></i></button>';

        //editables element samples 
        $('.update_info').editable({
            type: 'text',
             validate: function (value) {
              var value = $.trim(value);
              var regex = new RegExp(/^\+?[0-9(),.-]+$/);
                if(value == '') return 'This field is required.';
                if(parseFloat(value) <= 0) return 'This field must be greater than 0.';
                if(!value.match(regex)) return 'This field must be numeric.';
            }
        });
 });
</script>

<script type="text/javascript">
$('.edit_info').click(function(){
   	var currentForm = $(this).closest("form");
          bootbox.confirm({
                    title: 'Edit Information',
                    message: $('#info').html(),
                    buttons: {
                               'cancel': {
                		          label: '<i class="fa fa-times"></i> Cancel',
                		          className: 'btn red col-md-4 pull-left'
                               },
                               'confirm': {
                		          label: '<i class="fa fa-save"></i> Save',
                		          className: 'btn green col-md-4 pull-right'
                               }
                    },
                    callback: function(result) {
                		if (result) {
                		          $('#receipt_form').submit();
                		}
                    }
          });
});
</script>

<script type="text/javascript">
$('.edit_invoice').click(function(){
   	var currentForm = $(this).closest("form");
          bootbox.confirm({
                    title: 'Edit Information',
                    message: $('#invoice').html(),
                    buttons: {
                               'cancel': {
                		          label: '<i class="fa fa-times"></i> Cancel',
                		          className: 'btn red col-md-4 pull-left'
                               },
                               'confirm': {
                		          label: '<i class="fa fa-save"></i> Save',
                		          className: 'btn green col-md-4 pull-right'
                               }
                    },
                    callback: function(result) {
                		if (result) {
                		          $('#invoice_form').submit();
                		}
                    }
          });
});
</script>

@stop