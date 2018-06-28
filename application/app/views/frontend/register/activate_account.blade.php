@extends('frontend.template.template')

@section('title')
Global Ecommerce | Activate Account
@stop

@section('content')

<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="active">Activate Account</li>
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
            <h1>ACTIVATE ACCOUNT</h1>
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
                <div class="col-md-7 col-sm-7">
                  <legend>
                  </legend>
                  {{ Form::open(array('url'=>'register/member_activate/'.$id, 'class'=>'form-horizontal', 'role'=>'form')) }}
                  <div class="form-group margin-top @if ($errors->has('activation_code')) has-error @endif">
                  <label class="col-sm-2 animated fadeInLeft control-label" for="activation_code">Code</label>
                  <div class="col-sm-8">
                    {{ Form::text('activation_code','',array('class'=>'form-control','placeholder'=>'Enter Activation Code','autocomplete'=>'off')) }}
                    @foreach($errors->get('activation_code') as $error)
                          <span class="help-inline"> {{ $error }}</span>
                    @endforeach
                  </div>
                  </div>

                  <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8" style="padding-left:0px">
                    <button type="submit" class="btn btn-primary">Activate</button>
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