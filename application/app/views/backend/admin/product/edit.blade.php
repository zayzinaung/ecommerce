@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
#color_select .dd .ddChild li img	{ height: 15px!important; }
#color_select .dd .ddTitle .ddTitleText img { height: 15px!important; }
</style>
@stop

@section('content')
<div class="page-content">
	<h3 class="page-title">
		Products<small> management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/product')}}">Products</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Edit
			</li>
		</ul>
	</div>

	<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue-madison" id="form_wizard_1">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-list"></span> Product Management - <span class="step-title">
					Step 1 of 3 </span>
				</div>
				<div class="tools hidden-xs">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
			{{ Form::model($product, array('method' => 'PUT', 'route'=> array('admin.product.update', $product->id), 'id'=>'submit_form', 'class'=>'form-horizontal',  'files'=>true)) }}
				<div class="form-wizard">
					<div class="form-body">
					<ul class="nav nav-pills nav-justified steps">
						<li>
							<a href="#tab1" data-toggle="tab" class="step">
								<span class="number">1 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Basic Information </span>
							</a>
						</li>
						<li>
							<a href="#tab2" data-toggle="tab" class="step">
								<span class="number">2 </span>
								<span class="desc">
								<i class="fa fa-check"></i> More Information </span>
							</a>
						</li>
						<li>
							<a href="#tab3" data-toggle="tab" class="step">
								<span class="number">3 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Check Information </span>
							</a>
						</li>					
					</ul>
					<div id="bar" class="progress progress-striped" role="progressbar">
						<div class="progress-bar progress-bar-success">
						</div>
					</div>
					<div class="tab-content">
						<div class="alert alert-danger display-none">
							<button class="close" data-dismiss="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-none">
							<button class="close" data-dismiss="alert"></button>
							Your form validation is successful!
						</div>
						<div class="tab-pane active" id="tab1">
							<h3 class="block">Basic Information for Product</h3>

							<div class="form-group">
								<label class="control-label col-md-2">Product Active / Inactive</label>
								<div class="col-md-4" id="name-group">
								@if ( $product->is_active == '1' )
									<input type="checkbox" name="active" class="make-switch" data-on-text="&nbsp;Active&nbsp;" data-off-text="&nbsp;&nbsp;Inactive&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-on-color="primary" data-off-color="info" checked>
								@else
									<input type="checkbox" name="active" class="make-switch" data-on-text="&nbsp;Active&nbsp;" data-off-text="&nbsp;&nbsp;Inactive&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-on-color="primary" data-off-color="info">
								@endif
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Name <span class="required">* </span>
								</label>
								<div class="col-md-4" id="name-group">
									{{ Form::text('name', $product->product_name ,array('class'=>'form-control')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Product No. <span class="required">* </span>
								</label>
								<div class="col-md-4" id="productno-group">
									{{ Form::text('product_no', $product->product_no ,array('class'=>'form-control')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Quantity <span class="required">* </span>
								</label>
								<div class="col-md-4" id="quantity-group">
									{{ Form::text('quantity', $product->quantity ,array('class'=>'form-control')) }}
									<div class="note note-info mar0">
										<p><strong class="text-muted">Note:</strong> Quantity should be digit like 1, 2, etc.</p>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Price ( {{ $currency }} )<span class="required">* </span>
								</label>
								<div class="col-md-4" id="price-group">
									{{ Form::text('price', $product->price ,array('class'=>'form-control')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Category
								</label>
								<div class="col-md-4">
									{{ Form::select('category', $result, $product->category_id, array('id'=>'category','class'=>'form-control','onChange'=>'change_catelist(this.value)')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Subcategory
								</label>
								<div class="col-md-4">
									{{ Form::select('subcategory', $sub_result, $product->subcategory_id, array('id'=>'subcategory','class'=>'form-control')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Description <span class="required">* </span>
								</label>
								<div class="col-md-9" id="desc-group">
									{{ Form::textarea('description', $product->description, array('id'=>'editor1','class'=>'ckeditor')) }}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Brand
								</label>
								<div class="col-md-4">
									<select style="width:350px" class="tech" name="brand" id="brand">
										<?php if ( $brand ) { ?>
										<?php foreach ( $brand as $b ) { $default = '' ?>
								                            <?php if ( $product->brand == $b->id ) { $default = 'selected'; } ?>
								                            <option value="{{ $b->id }}" data-image="{{ URL::to('/uploads/brand_icons/'.$b->brand_icon) }}" {{ $default }}>{{ $b->brand_name }}</option>
								                     <?php } ?>
								                     <?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Images
								</label>
								<div class="col-md-9" id="name-group">
									<ul class="col-md-12" style="list-style:none;">
	                                    					<?php $count = 0; ?>
	                                    					<?php foreach ($images as $image) { ++$count; ?>
		                                    				<div class="row-fluid product_image" style="float:left;width:20%;margin:5px;">
		                                        					<span class="delete-product-image" rel="{{ URL::to('admin/product/delete_image/'.$image->id) }}" style="cursor:pointer;margin-right:5px;"><i class="fa fa-trash"></i> Remove</span> 
		                                        					<div class="row-fluid">
		                                            				<span>
		                                                				<li class="thumbnail col-md-3">
		                                                    				<img src="{{ URL::to('/uploads/products/'.$image->image) }}">
		                                               				 </li>
		                                            				</span>
		                                        					</div>
		                                    				</div>
		                                				<?php } ?>
	                                    					<div class="row-fluid" style="float:left;width:100%;">
	                                    					<span>
	                                            				<li>
	                                                					<input type="file" name="images[]" class="multi max accept-gif|jpg|jpeg|png" id="T8A"/>
	                                            				</li>
	                                    					</span>
	                                    					</div>
	                                					</ul>
								</div>
							</div>

						</div>

						<div class="tab-pane" id="tab2">
							<h3 class="block">More Information for Product</h3>
							<div class="form-group">
								<label class="control-label col-md-2">Color
								</label>
								<div class="col-md-4">
									@if ( $choose_color == null )
									<input type="checkbox" name="color_check" data-name="color" id="color_check" style="float:left;"/>
									<div id="color_select" style="display:none;float:left;">
									@else
									<input type="checkbox" name="color_check" data-name="color" id="color_check" style="float:left;" checked="checked"/>
									<div id="color_select" style="float:left;">
									@endif
									<select style="width:350px" class="tech" name="color" id="color">
									@if ( $choose_color != null )
										<?php foreach ( $color as $c ) { $default = '' ?>
									                     <?php if ( $choose_color->id == $c->id ) { $default = 'selected'; } ?>
									                     <option value="{{ $c->id }}" data-image="{{ URL::to('/uploads/color_images/'.$c->color_image) }}" {{ $default }}>{{ $c->color_name }}</option>
									          <?php } ?>
									@else
										<option value="NULL">Choose Color</option>
										@foreach($color as $c)
											<option value="{{ $c->id }}" data-image="{{ URL::to('/uploads/color_images/'.$c->color_image) }}">{{ $c->color_name }}</option>
										@endforeach
									@endif
									</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Size
								</label>
								<div class="col-md-4">
									@if ( $choose_size == null )
									<input type="checkbox" name="size_check" data-name="size" id="size_check" style="float:left;"/>
									<div id="size_select" style="display:none;float:left;">
									@else
									<input type="checkbox" name="size_check" data-name="size" id="size_check" style="float:left;" checked="checked"/>
									<div id="size_select" style="float:left;">
									@endif
									<select style="width:350px" class="tech" name="size" id="size">
									@if ( $choose_size != null )
										<?php foreach ( $size as $s ) { $default = '' ?>
									                     <?php if ( $choose_size->id == $s->id ) { $default = 'selected'; } ?>
									                     <option value="{{ $s->id }}" {{ $default }}>{{ $s->size_name }}</option>
									          <?php } ?>
									@else
										<option value="NULL">-</option>
										@foreach($size as $s )
											<option value="{{ $s->id }}">{{ $s->size_name }}</option>
										@endforeach
									@endif
									</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Length
								</label>
								<div class="col-md-4">
									@if ( $choose_length == null )
									<input type="checkbox" name="length_check" data-name="length" id="length_check" style="float:left;"/>
									<div id="length_select" style="display:none;float:left;">
									@else
									<input type="checkbox" name="length_check" data-name="length" id="length_check" style="float:left;" checked="checked"/>
									<div id="length_select" style="float:left;">
									@endif
									<select style="width:350px" class="tech" name="length" id="length">
									@if ( $choose_length != null )
										<?php foreach ( $length as $l ) { $default = '' ?>
									                     <?php if ( $choose_length->id == $l->id ) { $default = 'selected'; } ?>
									                     <option value="{{ $l->id }}" {{ $default }}>{{ $l->length_name }}</option>
									          <?php } ?>
									@else
										<option value="NULL">-</option>
										@foreach($length as $l )
											<option value="{{ $l->id }}">{{ $l->length_name }}</option>
										@endforeach
									@endif
									</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Weight
								</label>
								<div class="col-md-4">
									@if ( $choose_weight == null )
									<input type="checkbox" name="weight_check" data-name="weight" id="weight_check" style="float:left;"/>
									<div id="weight_select" style="display:none;float:left;">
									@else
									<input type="checkbox" name="weight_check" data-name="weight" id="weight_check" style="float:left;" checked="checked"/>
									<div id="weight_select" style="float:left;">
									@endif
									<select style="width:350px" class="tech" name="weight" id="weight">
									@if ( $choose_weight != null )
										<?php foreach ( $weight as $w ) { $default = '' ?>
									                     <?php if ( $choose_weight->id == $w->id ) { $default = 'selected'; } ?>
									                     <option value="{{ $w->id }}" {{ $default }}>{{ $w->weight_name }}</option>
									          <?php } ?>
									@else
										<option value="NULL">-</option>
										@foreach($weight as $w )
											<option value="{{ $w->id }}">{{ $w->weight_name }}</option>
										@endforeach
									@endif
									</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Fuel
								</label>
								<div class="col-md-4">
									@if ( $choose_fuel == null )
									<input type="checkbox" name="fuel_check" data-name="fuel" id="fuel_check" style="float:left;"/>
									<div id="fuel_select" style="display:none;float:left;">
									@else
									<input type="checkbox" name="fuel_check" data-name="fuel" id="fuel_check" style="float:left;" checked="checked"/>
									<div id="fuel_select" style="float:left;">
									@endif
									<select style="width:350px" class="tech" name="fuel" id="fuel">
									@if ( $choose_fuel != null )
										<?php foreach ( $fuel as $f ) { $default = '' ?>
									                     <?php if ( $choose_fuel->id == $f->id ) { $default = 'selected'; } ?>
									                     <option value="{{ $f->id }}" {{ $default }}>{{ $f->fuel_name }}</option>
									          <?php } ?>
									@else
										<option value="NULL">-</option>
										@foreach($fuel as $f )
											<option value="{{ $f->id }}">{{ $f->fuel_name }}</option>
										@endforeach
									@endif	
									</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">Country
								</label>
								<div class="col-md-4">
									<select style="width:350px" class="tech" name="country" id="country">
										@if ( $choose_country != null )
											<?php foreach ( $country as $c ) { $default = '' ?>
						                            				<?php if ( $choose_country->id == $c->id ) { $default = 'selected'; } ?>
						                            				<option value="{{ $c->id }}" data-image="{{ URL::to('/uploads/flags/'.$c->flag) }}" {{ $default }}>{{ $c->country_name }}</option>
						                            			<?php } ?>
						                            		@else
						                            			<?php foreach ( $country as $c ) { $default = '' ?>
									                            <?php if ( $c->country_name == 'Singapore' ) { $default = 'selected'; } ?>
									                            <option value="{{ $c->id }}" data-image="{{ URL::to('/uploads/flags/'.$c->flag) }}" {{ $default }}>{{ $c->country_name }}</option>
									                     <?php } ?>
										@endif
									</select>
								</div>
							</div>

							@if ( $product_info )
							<h4 class="form-section">Product Information</h4>
							@foreach ( $product_info as $pf )
								<?php 
									$get = Product_info_data::where('product_info_id','=',$pf->id)->where('product_id','=',$product->id)->first(); 
									if ( $get )
									{
										$checked = 'checked';
										$data = $get->data;
										$text = '';
									} else {
										$checked = '';
										$data = '';
										$text = 'display:none';
									}
								?>
								<div class="form-group">
								<label class="control-label col-md-2">{{ $pf->product_label }}</label>
								<div class="col-md-9">
									<input type="checkbox" name="{{ strtolower($pf->id) }}_check" data-name="{{ strtolower($pf->id) }}" id="{{ strtolower($pf->id) }}_check" style="float:left;" {{ $checked }}/>
									<div id="{{ strtolower($pf->id) }}_select" style="float:left;{{$text}}">
										@if ( $pf->input_type == 'textarea' )
											<textarea name="{{ strtolower($pf->id) }}" id="editor1" class="ckeditor new_textarea">{{ $data }}</textarea>
										@else
											<input type="text" name="{{ strtolower($pf->id) }}" class="form-control" value="{{ $data }}" />
										@endif
									</div>
								</div>
								</div>
							@endforeach
							@endif
							
							<br/><hr/>
							<h3 class="block">Meta Informations</h3>
							<div class="form-group">
								<label class="control-label col-md-2">Meta Title <span class="required">* </span>
								</label>
								<div class="col-md-5" id="desc-group">
									{{ Form::textarea('meta_title', $product->meta_title, array('class'=>'form-control','rows'=>'3')) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Meta Keywords <span class="required">* </span>
								</label>
								<div class="col-md-5" id="desc-group">
									{{ Form::textarea('meta_keywords', $product->meta_keywords, array('class'=>'form-control','rows'=>'3')) }}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Meta Description <span class="required">* </span>
								</label>
								<div class="col-md-5" id="desc-group">
									{{ Form::textarea('meta_description', $product->meta_description, array('class'=>'form-control','rows'=>'3')) }}
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab3">
							<h4 class="form-section">Product Basic Information</h4>
							<div class="form-group">
								<label class="control-label col-md-3">Name :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="name">
								</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Product No :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="product_no">
								</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Quantity :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="quantity">
								</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Price :</label>
								<div class="col-md-4">
								{{ $currency }} <p class="form-control-static" data-display="price">
								</p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3">Country :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="country">
								</p>
								</div>
							</div>

							<h4 class="form-section">Product Meta Information</h4>
							<div class="form-group">
								<label class="control-label col-md-3">Meta Title :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="meta_title">
								</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Meta Keywords :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="meta_keywords">
								</p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Meta Description :</label>
								<div class="col-md-4">
								<p class="form-control-static" data-display="meta_description">
								</p>
								</div>
							</div>
						</div>
					</div>
					</div>

					<div class="form-actions">
						<div class="row">
						<div class="col-md-offset-2 col-md-9">
							<a href="javascript:;" class="btn grey-cascade button-previous">
								<i class="m-icon-swapleft m-icon-white"></i> Back </a>
							<a href="javascript:;" class="btn green-meadow button-next">
								Continue <i class="m-icon-swapright m-icon-white"></i>
							</a>
							<button type="submit" class="btn blue-madison button-submit" style="display:none"><i class="fa fa-save"></i> Update</button>
						</div>
						</div>
					</div>
				</div>
			{{Form::close()}}
			</div>
		</div>
	</div>

	</div>

</div>
@stop


@section('scripts')

{{ HTML::style('backend/ddselect/dd.css') }}
{{ HTML::style('backend/ddselect/skin2.css') }}
{{ HTML::script('backend/ddselect/jquery.dd.min.js') }}

{{ HTML::script('backend/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}
{{ HTML::script('backend/scripts/form-wizard.js')}}

<script type="text/javascript">
function change_catelist(val)
{
          $.post("{{URL::to('admin/category/get_subcategory') }}",{id: ""+ val +""}, function(data) 
          {
                    $('#subcategory').html(data);
          });
}
</script>

<script type="text/javascript">
$(document).ready(function(e) {
          $("#brand").msDropdown({roundedCorner:false});
          $("#color").msDropdown({roundedCorner:false});
          $("#country").msDropdown({roundedCorner:false});
          $("#size").msDropdown({roundedCorner:false});
          $("#length").msDropdown({roundedCorner:false});
          $("#weight").msDropdown({roundedCorner:false});
          $("#fuel").msDropdown({roundedCorner:false});
});
</script>

<script type="text/javascript"> 
$(document).ready(function(){

          $('input[type="checkbox"]').click(function(){

                    var ele = $(this);
                    var name = ele.attr('data-name');

                    if($(this).prop("checked") == true){

                        $('#'+name+'_select').show();
                        
                    } else if($(this).prop("checked") == false){
                        
                        $('#'+name+'_select').hide();

                    }
          });

});
</script>

<script type="text/javascript">
$(document ).ready(function(){

          var form = $('#submit_form');
          var error = $('.alert-danger', form);
          var success = $('.alert-success', form);

          form.validate({
          		doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                	errorElement: 'span', //default input error message container
                	errorClass: 'help-block help-block-error', // default input error message class
                	focusInvalid: false, // do not focus the last invalid input
                	rules: {
                    		//account
                    		name: {
                        		required: true
                    		},
	                    product_no: {
	                        	required: true
	                    },
	                    quantity: {
	                        	required: true,
	                        	digits: true
	                    },
	                    price: {
	                        	required: true
	                    },
	                    description: {
	                        	minlength: 10,
	                        	required: true
	                    },
                	},
                	errorPlacement: function (error, element) { // render error placement for each input type
                    		if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        		error.insertAfter("#form_gender_error");
                    		} else if (element.attr("name") == "payment[]") { // for uniform radio buttons, insert the after the given container
                        		error.insertAfter("#form_payment_error");
                    		} else {
                        		error.insertAfter(element); // for other inputs, just perform default behavior
                    		}
                	},

                	invalidHandler: function (event, validator) { //display error alert on form submit   
                    		success.hide();
                    		error.show();
                    		Metronic.scrollTo(error, -200);
                	},

                	highlight: function (element) { // hightlight error inputs
                    		$(element)
                        	.closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                	},

                	unhighlight: function (element) { // revert the change done by hightlight
                    		$(element)
                        	.closest('.form-group').removeClass('has-error'); // set error class to the control group
                	},

                	success: function (label) {
                    		if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        		label
                            		.closest('.form-group').removeClass('has-error').addClass('has-success');
                        		label.remove(); // remove error label here
                    		} else { // display success icon for other inputs
                        		label
                            		.addClass('valid') // mark the current input as valid and display OK icon
                            		.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    		}
                	}

	          /*submitHandler: function (form) {
	          		success.show();
	                    error.hide();
	                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
	          }*/

          });
                
          var displayConfirm = function() {
          		$('#tab3 .form-control-static', form).each(function(){
                        	var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                        	if (input.is(":radio")) {
                            		input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                        	}
                        	if (input.is(":text") || input.is("textarea") ) {
                            		$(this).html(input.val());
                        	} else if (input.is("select")) {
                            		$(this).html(input.find('option:selected').text());
                        	} else if (input.is(":radio") && input.is(":checked")) {
                            		$(this).html(input.attr("data-title"));
                        	} else if ($(this).attr("data-display") == 'payment') {
                            		var payment = [];
                            		$('[name="payment[]"]:checked').each(function(){
                                		payment.push($(this).attr('data-title'));
                            		});
                            		$(this).html(payment.join("<br>"));
                        	}
                    });
          }
                
          var handleTitle = function(tab, navigation, index) {
          		var total = navigation.find('li').length;
                    	var current = index + 1;
                    	// set wizard title
                    	$('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                    		// set done steps
                    		jQuery('li', $('#form_wizard_1')).removeClass("done");
                    		var li_list = navigation.find('li');
                    		for (var i = 0; i < index; i++) {
                        		jQuery(li_list[i]).addClass("done");
                    		}

                    	if (current == 1) {
                        	$('#form_wizard_1').find('.button-previous').hide();
                    	} else {
                        	$('#form_wizard_1').find('.button-previous').show();
                    }

                    	if (current >= total) {
                        	$('#form_wizard_1').find('.button-next').hide();
                        	$('#form_wizard_1').find('.button-submit').show();
                        	displayConfirm();
                    	} else {
                        	$('#form_wizard_1').find('.button-next').show();
                        	$('#form_wizard_1').find('.button-submit').hide();
                    }
                    	Metronic.scrollTo($('.page-title'));
          }

          $('#form_wizard_1').bootstrapWizard({
          		'nextSelector': '.button-next',
                    	'previousSelector': '.button-previous',
                    	onTabClick: function (tab, navigation, index, clickedIndex) {
                    		//alert("click " + clickedIndex);
                        	//return false;
                        
                        	success.hide();
                        	error.hide();
                        	if (form.valid() == false) {
                            		return false;
                        	}
                        	handleTitle(tab, navigation, clickedIndex); 
                    },
                    onNext: function (tab, navigation, index) {
                        	success.hide();
                        	error.hide();

                       	if (form.valid() == false) {
                            		return false;
                        	}

                        	handleTitle(tab, navigation, index);
                    },
                    onPrevious: function (tab, navigation, index) {
                        	success.hide();
                        	error.hide();

                        	handleTitle(tab, navigation, index);
                    },
                    onTabShow: function (tab, navigation, index) {
                        	var total = navigation.find('li').length;
                        	var current = index + 1;
                        	var $percent = (current / total) * 100;
                        	$('#form_wizard_1').find('.progress-bar').css({
                            		width: $percent + '%'
                        	});
                    }

          });
                
          $('#form_wizard_1').find('.button-previous').hide();

});
</script>

@stop
