@extends('frontend.template.template')

@section('title')
Global Ecommerce | Log In
@stop

@section('content')

<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('') }}">Home</a></li>
            <li class="active">Login</li>
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
            @if ( Session::has('username') )
            <h1>You are already logged in</h1>
            <h2> Thank You :)</h2>
            @else
            <h1>Login</h1>
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

                @if ($errors->has('email') || $errors->has('password') ) 
                    <div class="alert alert-danger" style="margin:5px 0 0 0">
                        You have some form errors. Please check below.
                    </div>
                @endif
                
               
                
                <div class="col-md-7 col-sm-7">
                    <?php
                    $freeze_time = '';
                    if ( Session::get('attempt') != null )
                    {
                      if ( Session::get('attempt') > 3 )
                      {
                        $freeze_time = Session::get('current') + 180;
                      } else {
                        $freeze_time = '';
                      }
                    }
                    ?>

                    @if ( $freeze_time != '' )
                          @if ( $freeze_time > time() )
                              <?php $disabled = 'disabled'; ?>
                              <div class="alert alert-danger" style="margin:5px 0 0 0;">
                                 Blocking access for three minutes to login after three unsuccessful login attempts.
                              </div>
                          @else
                              <?php $disabled = ''; ?>
                          @endif
                    @else
                          <?php $disabled = ''; ?>
                    @endif

                    {{ Form::open(array('url'=>'register/member_login', 'class'=>'form-horizontal form-without-legend', 'role'=>'form')) }}

                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                      <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="text" name="email" value="{{ Input::old('email') }}" class="form-control" id="email" autocomplete="off" {{ $disabled }} >
                        @foreach($errors->get('email') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                        @endforeach
                      </div>
                    </div>

                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                      <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <input type="password" name="password" class="form-control" id="password" {{ $disabled }} >
                        @foreach($errors->get('password') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                        @endforeach
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0">
                        <a href="{{ URL::to('member/forget_password') }}">Forget Password?</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                        <button type="submit" class="btn btn-primary" {{ $disabled }}>Login</button>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-10 padding-right-30">
                        <hr>
                        <div class="login-socio">
                            <p class="text-muted">or login using:</p>

                            <div class="row">
                              <div class="col-lg-12">
                                 <a href="{{ $fbLoginUrl }}"><img src="{{ URL::to('frontend/img/facebook.png') }}" class="img-responsive"></a>
                              </div>
                            </div>
                           
                        </div>
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
            @endif
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
</div>

@stop