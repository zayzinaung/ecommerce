@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">

</style>
@stop

@section('title')
Global Ecommerce | {{ $page->title }}
@stop

@section('content')

  <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="active">{{ $page->title }}</li>
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
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>{{ $page->title }}</h1>
            <div class="content-page">
              <p>
                    @if ( $page->image != '' )
                    <img src="{{ URL::to('uploads/pages/'.$page->image) }}" alt="{{ $page->title }}" class="img-responsive">
                    @endif
              </p> 

              <p>{{ $page->description }}</p>

            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
  </div>

@stop

@section('scripts')

{{ HTML::script('frontend/plugins/raty/jquery.raty.js') }}

<script type="text/javascript">
$('.rate').raty({
    score: function() {
          return $(this).attr('data-score'); // set default value from data-score attr
    },
    click: function(score, evt) {
          console.log(score);
          $('input[name="rating"]').val(score); // set value to hidden input
    },
    path: '{{ URL::to("frontend/plugins/raty/images/") }}',
          precision  : false,
          readOnly: false
    });
    $('.rated').raty({
          score: function() {
              return $(this).attr('data-score'); // set default value from data-score attr
          },
          click: function(score, evt) {
              $('input[name="rating"]').val(score); // set value to hidden input
          },
          path: '{{ URL::to("frontend/plugins/raty/images/") }}',
          precision  : true,
          readOnly: true
    });
</script>

@stop