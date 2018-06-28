@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">

</style>
@stop

@section('title')
Global Ecommerce | Contact
@stop

@section('content')

  <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="active">{{ $contact->title }}</li>
        </ul>
        
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              @if ( Session::get('username') )
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/profile') }}"><i class="fa fa-angle-right"></i> Profile</a></li>
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/order_history') }}"><i class="fa fa-angle-right"></i> Order History</a></li>
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/wishlist') }}"><i class="fa fa-angle-right"></i> Wishlist</a></li>
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/logout') }}"><i class="fa fa-angle-right"></i> Log Out</a></li>
              @else
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/login') }}"><i class="fa fa-angle-right"></i> Login</a></li>
              <li class="list-group-item clearfix"><a href="{{ URL::to('member/register') }}"><i class="fa fa-angle-right"></i> Register</a></li>
              @endif
            </ul>
            
            <h2>{{ $contact_data->title }}</h2>
            <address>
              {{ $contact_data->text }}<br>
              <abbr title="Phone">Phone:</abbr> {{ $contact_data->phone }}<br>
              <abbr title="Email">Email:</abbr> {{ $contact_data->email }}<br>
              @if ( $contact_data->fax != '' )
              <abbr title="Fax">Fax:</abbr> {{ $contact_data->fax }}<br>
              @endif
            </address>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>{{ $contact->title }}</h1>
            <div class="content-page">
              <?php if( Session::get('fail') ){ ?>
                    <div class="alert alert-danger" style="margin:0 0 15px 0;">
                          <?php echo Session::get('fail'); ?>
                    </div>
              <?php } ?>

              <?php if( Session::get('success') ){ ?>
                    <div class="alert alert-success" style="margin:0 0 15px 0;">
                          <?php echo Session::get('success'); ?>
                    </div>
              <?php } ?>

              <div id="map" class="gmaps margin-bottom-40" style="min-height:400px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8192827133153!2d103.84866901478313!3d1.2822155990648005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da190e81029a3b%3A0x88af1d48e5dc27d7!2sFar+East+Finance+Building!5e0!3m2!1sen!2smm!4v1445229964207" frameborder="0" style="width:100%; min-height:400px;" ></iframe>
              </div>

              <h2>Contact Form</h2>
              <p>{{ $contact->description }}</p>
              
              <!-- BEGIN FORM-->
              {{ Form::open(array('url'=>'contact_send', 'class'=>'default-form', 'role'=>'form')) }}
              <div class="form-group @if ($errors->has('name')) has-error @endif">
                    <label for="name">Name <span class="require">*</span></label>
                    {{ Form::text('name','',array('class'=>'form-control','id'=>'name')) }}
                    @foreach($errors->get('name') as $error)
                        <span class="help-inline">{{ $error }}</span>
                    @endforeach
              </div>
              <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <label for="email">Email <span class="require">*</span></label>
                    {{ Form::text('email','',array('class'=>'form-control','id'=>'email')) }}
                    @foreach($errors->get('email') as $error)
                        <span class="help-inline">{{ $error }}</span>
                    @endforeach
              </div>
              <div class="form-group @if ($errors->has('message')) has-error @endif">
                    <label for="message">Message <span class="require">*</span></label>
                    {{ Form::textarea('message','',array('class'=>'form-control','id'=>'message','rows'=>'5'))}}
                    @foreach($errors->get('message') as $error)
                        <span class="help-inline">{{ $error }}</span>
                    @endforeach
              </div>
              <div class="padding-top-20">                  
                    <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              {{ Form::close() }}

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

</script>

@stop