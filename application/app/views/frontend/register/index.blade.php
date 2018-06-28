@extends('frontend.template.template')

@section('title')
Global Ecommerce | Register
@stop


@section('content')

<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="active">Create new account</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Login/Register</a></li>
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Restore Password</a></li>
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> My account</a></li>
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Address book</a></li>
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Wish list</a></li>
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Returns</a></li>
              <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Newsletter</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>Create an account</h1>
            <div class="content-form-page">
              <div class="row">
              <?php if( Session::get('fail') ){ ?>
                    <div class="alert alert-danger" style="margin:5px 0 0 0;">
                          <?php echo Session::get('fail'); ?>
                    </div>
              <?php } ?>

              <?php if( Session::get('success') ){ ?>
                    <div class="alert alert-success" style="margin:5px 0 0 0;">
                          <?php echo Session::get('success'); ?>
                    </div>
              <?php } ?>

                @if ($errors->has('username') || $errors->has('email') || $errors->has('phone') || $errors->has('address') || $errors->has('recaptcha_response_field')) 
                    <div class="alert alert-danger" style="margin:5px 0 0 0;">
                      You have some form errors. Please check below.
                    </div>
                @endif
                <div class="col-md-7 col-sm-7">
                  {{ Form::open(array('url'=>'register/create_member', 'class'=>'form-horizontal', 'role'=>'form')) }}
                    <fieldset>
                      <legend>
                      </legend>
                      <div class="form-group @if ($errors->has('username')) has-error @endif">
                        <label for="username" class="col-lg-4 control-label">Name <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::text('username','',array('class'=>'form-control','autocomplete'=>'off')) }}
                          @foreach($errors->get('username') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::text('email','',array('class'=>'form-control','autocomplete'=>'off')) }}
                          @foreach($errors->get('email') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="neutral" class="col-lg-4 control-label">Gender Neutral <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <input type="radio" name="neutral" value="Ms" checked style="float:left"><span style="float:left;margin-right:20px;">Ms.</span>
                          <input type="radio" name="neutral" value="Mrs" style="float:left"><span style="float:left">Mrs.</span>
                        </div>
                      </div>
                      <div class="form-group @if ($errors->has('phone')) has-error @endif">
                        <label for="phone" class="col-lg-4 control-label">Phone <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::text('phone','',array('class'=>'form-control','autocomplete'=>'off')) }}
                          <small style="font-weight:bold;font-size:11px;">Use only a valid Mobile Number eg. 81234567/ 91234567.</small>
                          @foreach($errors->get('phone') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="landline" class="col-lg-4 control-label">Landline</label>
                        <div class="col-lg-8">
                          {{ Form::text('landline','',array('class'=>'form-control','autocomplete'=>'off')) }}
                        </div>
                      </div>
                      <div class="form-group @if ($errors->has('address')) has-error @endif">
                        <label for="address" class="col-lg-4 control-label">Address <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::textarea('address','', array('class'=>'form-control','rows'=>2)) }}
                          @foreach($errors->get('address') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                          @endforeach
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="countries" class="col-lg-4 control-label">Country <span class="require">*</span></label>
                        <div class="col-lg-8">
                          <select class="form-control tech" name="country" id="country">
                            <?php foreach ( $countries as $country ) { $a = '' ?>
                            <?php if ( $country->country_name == 'Singapore' ) { $a = 'selected'; } ?>
                            <option value="{{ $country->id }}" data-image="{{ URL::to('/uploads/flags/'.$country->flag) }}" {{ $a }}>{{ $country->country_name }}</option>
                            <?php } ?>
                        </select>
                        </div>
                      </div>
                      
                      <div class="form-group @if ($errors->has('recaptcha_response_field')) has-error @endif">
                        <label for="countries" class="col-lg-4 control-label">Are you a human? <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::captcha(array('theme' => 'white','tabindex' => 2)) }}
                          @foreach($errors->get('recaptcha_response_field') as $error)
                            <span class="help-inline" style="font-weight:bold"> {{ $error }}</span>
                          @endforeach
                        </div>
                      </div>

                    </fieldset>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                        <button type="submit" class="btn btn-primary">Create an account</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                      </div>
                    </div>
                  {{ Form::close() }}
                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo quat.</p>

                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

                    <button type="button" class="btn btn-default">More details</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

@stop