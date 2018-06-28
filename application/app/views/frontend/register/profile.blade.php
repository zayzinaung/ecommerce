@extends('frontend.template.template')

@section('title')
Global Ecommerce | Profile
@stop

@section('style')
<style type="text/css" media="screen">
#password_group{
  display:none;
}
</style>
@stop

@section('content')

<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('') }}">Home</a></li>
            <li>Member</li>
            <li class="active">Profile</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/logout') }}"><i class="fa fa-angle-right"></i> Log Out</a></li>
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/order_history') }}"><i class="fa fa-angle-right"></i> Order History</a></li>
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/wishlist') }}"><i class="fa fa-angle-right"></i> Wish list</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
           
            <h1>Your Profile</h1>
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

                @if ($errors->has('username') || $errors->has('phone') || $errors->has('address') || $errors->has('recaptcha_response_field')) 
                    <div class="alert alert-danger" style="margin:5px 0 0 0">
                        You have some form errors. Please check below.
                    </div>
                @endif
                <div class="col-md-7 col-sm-7">

                    {{ Form::model($user, array('method' => 'PUT', 'route'=> array('member.edit_profile', $user->id), 'class'=>'form-horizontal')) }}
                    <fieldset>
                    <legend>
                    </legend>
                    <div class="form-group @if ($errors->has('username')) has-error @endif">
                        <label for="username" class="col-lg-4 control-label">Name <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::text('username',$user->username,array('class'=>'form-control','autocomplete'=>'off')) }}
                          @foreach($errors->get('username') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                          @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::text('email',$user->email,array('class'=>'form-control','disabled'=>'disabled')) }}
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-4">Gender Neutral <span class="required">* </span></label>
                      <div class="col-md-8" style="padding-top:7px">
                        {{ Form::radio('neutral', 'Mr', $user->neutral == 'Mr') }} Mr&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::radio('neutral', 'Mrs', $user->neutral == 'Mrs') }} Mrs
                      </div>
                    </div>

                    <div class="form-group @if ($errors->has('phone')) has-error @endif">
                        <label for="phone" class="col-lg-4 control-label">Phone <span class="require">*</span></label>
                        <div class="col-lg-8">
                          {{ Form::text('phone',$user->phone,array('class'=>'form-control','autocomplete'=>'off')) }}
                          @foreach($errors->get('phone') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                          @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-4">Landline</label>
                      <div class="col-md-8">
                        {{ Form::text('landline',$user->landline,array('class'=>'form-control','autocomplete'=>'off')) }}
                      </div>
                    </div>

                    <div class="form-group  @if ($errors->has('address')) has-error @endif">
                      <label class="control-label col-md-4">Address<span class="required">* </span></label>
                      <div class="col-md-8">
                        <textarea class="form-control" name="address" rows="3">{{ $user->address }}</textarea>
                        @foreach($errors->get('address') as $error)
                                    <span class="help-block"> {{ $error }}</span>
                                @endforeach
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-4">Change Password ?</label>
                      <div class="col-md-8" style="padding-top:7px">
                        <input type="checkbox" name="change_password"/>
                      </div>
                    </div>

                    <div id="password_group">
                    <div class="form-group @if ($errors->has('old_password')) has-error @endif">
                      <label class="control-label col-md-4">Old Password</label>
                      <div class="col-md-8">
                        <input type="password" name="old_password" class="form-control" />
                        @foreach($errors->get('old_password') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                        @endforeach
                      </div>
                    </div>
                    
                    <div class="form-group @if ($errors->has('new_password')) has-error @endif">
                      <label class="control-label col-md-4">New Password</label>
                      <div class="col-md-8">
                        <input type="password" name="new_password" class="form-control" />
                        @foreach($errors->get('new_password') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                        @endforeach
                      </div>
                    </div>
                    
                    <div class="form-group @if ($errors->has('confirm_password')) has-error @endif">
                      <label class="control-label col-md-4">Confirm Password</label>
                      <div class="col-md-8">
                        <input type="password" name="confirm_password" class="form-control" />
                        @foreach($errors->get('confirm_password') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                        @endforeach
                      </div>
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
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                      </div>
                    </div>
                    {{ Form::close() }}

                </div>
                <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
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

@section('scripts')
<script type="text/javascript"> 
$(document).ready(function(){

  $('input[type="checkbox"]').click(function(){

    var ele = $(this);

    if($(this).prop("checked") == true){

      $('#password_group').show();
                        
    } else if($(this).prop("checked") == false){
                        
      $('#password_group').hide();
    }
  });

});
</script>
@stop