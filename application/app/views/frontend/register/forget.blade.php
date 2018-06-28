@extends('frontend.template.template')

@section('title')
Global Ecommerce | Forget Password
@stop


@section('content')

<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('') }}">Home</a></li>
            <li class="active">Forgot Your Password?</li>
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
            <h1>Forgot Your Password ?</h1>
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
                @if ($errors->has('email')) 
                    <div class="alert alert-danger" style="margin:5px 0 0 0">
                        You have some form errors. Please check below.
                    </div>
                @endif
                <div class="col-md-7 col-sm-7">
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                        <p>Enter your e-mail address to reset your password.</p>
                      </div>
                    </div>
                    {{ Form::open(array('url'=>'member/recover_password', 'class'=>'form-horizontal', 'role'=>'form')) }}
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                      <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                      <div class="col-lg-8">
                        <div class="input-icon">
                          <i class="fa fa-envelope"></i>
                          {{ Form::text('email','',array('class'=>'form-control','id'=>'email','autocomplete'=>'off')) }}
                        </div>
                        @foreach($errors->get('email') as $error)
                            <span class="help-inline"> {{ $error }}</span>
                        @endforeach
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                        <a href="{{ URL::to('login') }}"><button type="button" class="btn">
                        <span aria-hidden="true" class="icon-action-undo"></span> Back</button></a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Send</button>
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