<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Ecommerce description" name="description">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

  <!-- Global styles START -->
  {{ HTML::style('backend/plugins/font-awesome/css/font-awesome.min.css') }}
  {{ HTML::style('frontend/plugins/bootstrap/css/bootstrap.min.css') }}
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
   {{ HTML::style('backend/plugins/fancybox/source/jquery.fancybox.css') }}
   {{ HTML::style('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css') }}
   {{ HTML::style('backend/plugins/slider-layer-slider/css/layerslider.css') }}
  <!-- Page level plugin styles END -->

  {{ HTML::style('backend/plugins/bootstrap-toastr/toastr.min.css') }}

  <!-- Theme styles START -->
  {{ HTML::style('backend/css/components.css') }}
  {{ HTML::style('backend/plugins/simple-line-icons/simple-line-icons.min.css') }}
  {{ HTML::style('frontend/layout/css/style.css') }}
  {{ HTML::style('frontend/pages/css/style-shop.css') }}
  {{ HTML::style('frontend/pages/css/style-layer-slider.css') }}
  {{ HTML::style('frontend/layout/css/style-responsive.css') }}
  {{ HTML::style('frontend/layout/css/themes/red.css') }}
  {{ HTML::style('frontend/layout/css/custom.css') }}
  <!-- Theme styles END -->

  <style type="text/css" media="screen">
    .dd .ddTitle .ddTitleText {
      padding: 2px 20px 4px 5px!important;
    }

    .has-error .form-control {
      border-color: #a94442!important;
    }

    .theme-success {
      margin:0 0 2px 0;
      padding:5px 15px;
      background-color: #e45000;
      color: #fff;
      font-weight: bold;
    }

    .currency_val {
      cursor: pointer;
    }

    .pre-footer p{
      margin-bottom: 2px!important;
    }
  </style>

  @yield('style')

  <script type="text/javascript">
  $(document).ready(function() {
          $( "#tracking" ).keypress(function(e) {
              if(e.which == 13){
                    var shipment_no = $('#tracking').val();
                    $.ajax({
                          url: '{{ URL::to("shipment_tracking") }}',
                          data: 'shipment_no='+ shipment_no,
                          type: "POST",
                          success: function(result) {
                              alert(result);
                          }
                    });
              }
          });   
  });
  </script>

</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce"> 

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=815084708608487";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
        <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-5 col-sm-5 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <?php $fourth_column = Footer::where('name','=','fourth_column')->first(); ?>
                        <li><i class="fa fa-mobile"></i><span>{{ $fourth_column->phone }}</span></li>
                        <li class="shop-currencies">
                            @if ( Session::has('currency_type') )
                                    @if ( Session::get('currency_type') == 'MMK' )
                                        <?php $mmk = 'current'; $gbp = ''; $eur = ''; $myr = ''; $sgd = ''; $thb = ''; $usd = ''; ?>
                                    @elseif ( Session::get('currency_type') == 'GBP' )
                                        <?php $mmk = ''; $gbp = 'current'; $eur = ''; $myr = ''; $sgd = ''; $thb = ''; $usd = ''; ?>
                                    @elseif ( Session::get('currency_type') == 'EUR' )
                                        <?php $mmk = ''; $gbp = ''; $eur = 'current'; $myr = ''; $sgd = ''; $thb = ''; $usd = ''; ?>
                                    @elseif ( Session::get('currency_type') == 'MYR' )
                                        <?php $mmk = ''; $gbp = ''; $eur = ''; $myr = 'current'; $sgd = ''; $thb = ''; $usd = ''; ?>
                                    @elseif ( Session::get('currency_type') == 'SGD' )
                                        <?php $mmk = ''; $gbp = ''; $eur = ''; $myr = ''; $sgd = 'current'; $thb = ''; $usd = ''; ?>
                                    @elseif ( Session::get('currency_type') == 'THB' )
                                        <?php $mmk = ''; $gbp = ''; $eur = ''; $myr = ''; $sgd = ''; $thb = 'current'; $usd = ''; ?>
                                    @else
                                        <?php $mmk = ''; $gbp = ''; $eur = ''; $myr = ''; $sgd = ''; $thb = ''; $usd = 'current'; ?>
                                    @endif
                            @else
                                    <?php $mmk = ''; $gbp = ''; $eur = ''; $myr = ''; $sgd = ''; $thb = ''; $usd = ''; ?>
                            @endif
                            <a class="currency_val {{ $gbp }}" data-val="GBP">£</a>
                            <a class="currency_val {{ $eur }}" data-val="EUR">€</a>
                            <a class="currency_val {{ $myr }}" data-val="MYR">RM</a>
                            <a class="currency_val {{ $mmk }}" data-val="MMK">Ks</a>
                            <a class="currency_val {{ $sgd }}" data-val="SGD">S$</a>
                            <a class="currency_val {{ $thb }}" data-val="THB">฿</a>
                            <a class="currency_val {{ $usd }}" data-val="USD">$</a>
                        </li>
                        <li>
                        <div id="google_translate_element" class="langSwitch"></div>
                        <script>
                        function googleTranslateElementInit() {
                          new google.translate.TranslateElement({
                            pageLanguage: 'en',
                            includedLanguages: 'af,sq,ar,hy,az,eu,be,bg,ca,zh-CN,zh-TW,hr,cs,da,nl,en,et,tl,fi,fr,gl,ka,de,el,ht,iw,hi,hu,is,id,ga,it,ja,ko,la,lv,lt,mk,ms,mt,no,fa,pl,pt,ro,ru,sr,sk,sl,es,sw,sv,th,tr,uk,ur,vi,cy,yi',
                            gaTrack: true,
                            gaId: 'UA-2585500-1',
                            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                          }, 'google_translate_element');
                        }
                        </script>
                        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->

                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-7 col-sm-7 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        @if ( Session::get('username') != '' && Session::get('facebook_id') == '' )
                          <li>Welcome <span style="color:#c13726">{{ Session::get('username') }}</span></li>
                          <li><a href="{{ URL::to('member/profile') }}">Profile</a></li>
                          <li><a href="{{ URL::to('member/order_history') }}">Order History</a></li>
                          <li><a href="{{ URL::to('member/wishlist') }}">Wishlist</a></li>
                          <li><a href="{{ URL::to('member/logout') }}">Log Out</a></li>
                        @elseif ( Session::get('username') != '' && Session::get('facebook_id') != '' )
                          <li><img src="https://graph.facebook.com/{{ Session::get('facebook_id') }}./picture?width=20&amp;height=20" style="margin-right:5px"><a>{{ Session::get('username') }}<a/></li>
                          <li><a href="{{ URL::to('member/wishlist') }}">Wishlist</a></li>
                          <li><a href="{{ URL::to('member/logout') }}">Log Out</a></li>
                        @else
                          <li><a href="{{ URL::to('login') }}">Log In</a></li>
                          <li><a href="{{ URL::to('register') }}">Registration</a></li>
                        @endif
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
        </div>

        </div>        
    </div>
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="{{ URL::to('/') }}"><img src="{{ URL::to('/frontend/img/logo.png') }}" alt="Metronic Shop UI" width="190"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN CART -->
        <div class="top-cart-block">
          <div class="top-cart-info">
            <?php 
                $currency_val = Common::convert_currency();
                $currency_symbol = Common::get_currency_format();
            ?>
            <a href="javascript:void(0);" class="top-cart-info-count"><span class="header_total_qty">{{ Cart::count() }}</span> items</a>
            @if ( Session::has('currency_type') )
                @if ( Session::get('currency_type') == 'MMK' )
                    <a href="javascript:void(0);" class="top-cart-info-value">{{ Session::get('currency_symbol') }} <span class="header_total">{{ number_format(round(Cart::total() * $currency_val )) }}</span></a>
                @else
                    <a href="javascript:void(0);" class="top-cart-info-value">{{ Session::get('currency_symbol') }} <span class="header_total">{{ number_format((float)Cart::total() * $currency_val, 2, '.', '') }}</span></a>
                @endif
           @else
                <a href="javascript:void(0);" class="top-cart-info-value">{{ $currency_symbol }} <span class="header_total">{{ Cart::total() * $currency_val }}</span></a>
            @endif
          </div>
          <i class="fa fa-shopping-cart"></i>
          @if ( Cart::count() != 0 )
          <div class="top-cart-content-wrapper">
            <div class="top-cart-content">
              <ul class="scroller" style="height: 250px;">
                @foreach ( Cart::content() as $c )
                <li>
                  <a href="{{ URL::to('product/detail/'.$c->options->slug) }}"><img src="{{ URL::to('/uploads/products/'.$c->options->image->image) }}" alt="{{ $c->name }}" width="37" height="34"></a>
                  <span class="cart-content-count header_qty">x {{ $c->qty }}</span>
                  <strong><a href="{{ URL::to('product/detail/'.$c->options->slug) }}">{{ $c->name }}</a></strong>

                  @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <em id="stotal{{ $c->rowid }}">{{ Session::get('currency_symbol') }} {{ number_format(round(($c->qty * $c->price) * $currency_val )) }}</em>
                          @else
                              <em id="stotal{{ $c->rowid }}">{{ Session::get('currency_symbol') }} {{ number_format((float)(($c->qty * $c->price) * $currency_val ), 2, '.', '') }}</em>
                          @endif
                  @else
                          <em id="stotal{{ $c->rowid }}">{{ $currency_symbol }} {{ ($c->qty * $c->price) * $currency_val }}</em>
                  @endif

                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                @endforeach
              </ul>
              <div class="text-right">
                <a href="{{ URL::to('cart') }}" class="btn btn-default">View Cart</a>
              </div>
            </div>
          </div>  
          @endif          
        </div>
        <!--END CART -->

        <?php $active = Request::segment(1); ?>
        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation">

          <?php $data = Common::get_menu(); ?>
          <ul>
              @foreach ( $data as $menu )

              @if(count($menu['childs']) > 0)
              <li class="dropdown">
                    @if ( $menu['menu_slug'] == 'contact' )
                          <a class="dropdown-toggle" data-toggle="dropdown" data-target="{{ URL::to('contact') }}" href="{{ URL::to('contact') }}">{{ $menu['menu_name'] }}</a>
                    @elseif ( $menu['menu_slug'] == 'products' )
                          <a class="dropdown-toggle" data-toggle="dropdown" data-target="{{ URL::to('products') }}" href="{{ URL::to('products') }}">{{ $menu['menu_name'] }}</a>
                    @elseif ( $menu['menu_slug'] == 'gallery' )
                          <a class="dropdown-toggle" data-toggle="dropdown" data-target="{{ URL::to('gallery') }}" href="{{ URL::to('gallery') }}">{{ $menu['menu_name'] }}</a>
                    @else
                          <a class="dropdown-toggle" data-toggle="dropdown" data-target="{{ URL::to('home/'.$menu['menu_slug']) }}" href="{{ URL::to('home/'.$menu['menu_slug']) }}">{{ $menu['menu_name'] }}</a>
                    @endif
              @else
              <li>
                    @if ( $menu['menu_slug'] == 'contact' )
                          <a href="{{ URL::to('contact') }}">{{ $menu['menu_name'] }}</a>
                    @elseif ( $menu['menu_slug'] == 'products' )
                          <a href="{{ URL::to('products') }}">{{ $menu['menu_name'] }}</a>
                    @elseif ( $menu['menu_slug'] == 'gallery' )
                          <a href="{{ URL::to('gallery') }}">{{ $menu['menu_name'] }}</a>
                    @else
                          <a href="{{ URL::to('home/'.$menu['menu_slug']) }}">{{ $menu['menu_name'] }}</a>
                    @endif
              @endif
              
              @if(count($menu['childs']) > 0)
              <ul class="dropdown-menu">
                    @foreach ($menu['childs'] as $menu2)
                    <li class="dropdown-submenu">

                          @if(count($menu2['childs']) > 0)

                              @if ( $menu2['menu_slug'] == 'contact' )
                                  <a href="{{ URL::to('contact') }}">{{ $menu2['menu_name'] }} <i class="fa fa-angle-right"></i></a>
                              @elseif ( $menu2['menu_slug'] == 'products' )
                                  <a href="{{ URL::to('products') }}">{{ $menu2['menu_name'] }} <i class="fa fa-angle-right"></i></a>
                              @elseif ( $menu2['menu_slug'] == 'gallery' )
                                  <a href="{{ URL::to('gallery') }}">{{ $menu2['menu_name'] }} <i class="fa fa-angle-right"></i></a>
                              @else
                                  <a href="{{ URL::to('home/'.$menu2['menu_slug']) }}">{{ $menu2['menu_name'] }} <i class="fa fa-angle-right"></i></a>
                              @endif
                          
                          @else
                              
                              @if ( $menu2['menu_slug'] == 'contact' )
                                  <a href="{{ URL::to('contact') }}">{{ $menu2['menu_name'] }}</a>
                              @elseif ( $menu2['menu_slug'] == 'products' )
                                  <a href="{{ URL::to('products') }}">{{ $menu2['menu_name'] }}</a>
                              @elseif ( $menu2['menu_slug'] == 'gallery' )
                                  <a href="{{ URL::to('gallery') }}">{{ $menu2['menu_name'] }}</a>
                              @else
                                  <a href="{{ URL::to('home/'.$menu2['menu_slug']) }}">{{ $menu2['menu_name'] }}</a>
                              @endif

                          @endif

                          @if(count($menu2['childs']) > 0)
                          <ul class="dropdown-menu" role="menu">
                              @foreach ( $menu2['childs'] as $menu3 )
                              <li>

                                    @if ( $menu3['menu_slug'] == 'contact' )
                                        <a href="{{ URL::to('contact') }}">{{ $menu3['menu_name'] }}</a>
                                    @elseif ( $menu3['menu_slug'] == 'products' )
                                        <a href="{{ URL::to('products') }}">{{ $menu3['menu_name'] }}</a>
                                    @elseif ( $menu3['menu_slug'] == 'gallery' )
                                        <a href="{{ URL::to('gallery') }}">{{ $menu3['menu_name'] }}</a>
                                    @else
                                        <a href="{{ URL::to('home/'.$menu3['menu_slug']) }}">{{ $menu3['menu_name'] }}</a>
                                    @endif

                              </li>
                              @endforeach
                          </ul>
                          @endif
                    </li>
                    @endforeach
              </ul>
              @endif
              </li>

              @endforeach
              
              <li class="menu-search">
                    <span class="sep"></span>
                    <i class="fa fa-search search-btn"></i>
                    <div class="search-box">
                    <div class="input-group">
                    <input type="text" class="form-control search" placeholder="SHIPMENT" name="shipment_no" id="tracking">
                    <span class="input-group-btn">
                          <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                    </div>
                    </div> 
              </li>
              
          </ul>
          
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->

    @yield('content')

    <!-- BEGIN BRANDS -->
    <div class="brands">
      <div class="container">
            <div class="owl-carousel owl-carousel6-brands">
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/canon.jpg') }}" alt="canon" title="canon"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/esprit.jpg') }}" alt="esprit" title="esprit"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/gap.jpg') }}" alt="gap" title="gap"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/next.jpg') }}" alt="next" title="next"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/puma.jpg') }}" alt="puma" title="puma"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/zara.jpg') }}" alt="zara" title="zara"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/canon.jpg') }}" alt="canon" title="canon"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/esprit.jpg') }}" alt="esprit" title="esprit"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/gap.jpg') }}" alt="gap" title="gap"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/next.jpg') }}" alt="next" title="next"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/puma.jpg') }}" alt="puma" title="puma"></a>
              <a href="#"><img src="{{ URL::to('/frontend/pages/img/brands/zara.jpg') }}" alt="zara" title="zara"></a>
            </div>
        </div>
    </div>
    <!-- END BRANDS -->

    <!-- BEGIN STEPS -->
    <div class="steps-block steps-block-red">
      <div class="container">
        <div class="row">
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-truck"></i>
            <div>
              <h2>Free shipping</h2>
              <em>Express delivery withing 3 days</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-gift"></i>
            <div>
              <h2>Daily Gifts</h2>
              <em>3 Gifts daily for lucky customers</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-phone"></i>
            <div>
              <h2>477 505 8877</h2>
              <em>24/7 customer care available</em>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END STEPS -->

    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer pre-footer-light">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <?php
              $first_column = Footer::where('name','=','first_column')->first();
              $third_column = Footer::where('name','=','third_column')->first();
              $fourth_column = Footer::where('name','=','fourth_column')->first();
              $second_column = Menu::where('footer_active','=',1)->orderBy('footer_ordering')->get();
          ?>
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>{{ $first_column->title }}</h2>
            <p>{{ $first_column->text }}</p>
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->
          <!-- BEGIN BOTTOM INFO BLOCK -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>Information</h2>
            <ul class="list-unstyled">
              @if ( count($second_column) != 0 )
                    @foreach ( $second_column as $s )
                    <?php $page = Page::find($s->page_id); ?>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ URL::to('home/'.$page->name) }}">{{ $page->title }}</a></li>
                    @endforeach
              @endif
            </ul>
          </div>
          <!-- END INFO BLOCK -->
          
          <!-- BEGIN TWITTER BLOCK -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
             <div class="fb-page" data-href="{{ $third_column->title }}" data-width="240" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
          </div>
          <!-- END TWITTER BLOCK -->

          <!-- BEGIN BOTTOM CONTACTS -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>{{ $fourth_column->title }}</h2>
            <address class="margin-bottom-40 footer_">
              {{ $fourth_column->text }}
              Phone: {{ $fourth_column->phone }}<br>
              Email: {{ $fourth_column->email }}<br>
              @if ( $fourth_column->fax != null )
              Fax: {{ $fourth_column->fax }}
              @endif
            </address>
          </div>
          <!-- END BOTTOM CONTACTS -->
        </div>
        <hr>
        <div class="row">
          <!-- BEGIN SOCIAL ICONS -->
          <div class="col-md-6 col-sm-6">
            <ul class="social-icons">
              <li><a class="facebook" data-original-title="facebook" href="#"><i class="icon-facebook"></i></a></li>
              <li><a class="twitter" data-original-title="twitter" href="#"></a></li>
            </ul>
          </div>
          <!-- END SOCIAL ICONS -->
          <!-- BEGIN NEWLETTER -->
          <div class="col-md-6 col-sm-6">
            <div class="pre-footer-subscribe-box pull-right">
              <h2>Newsletter</h2>
              <form action="#">
                <div class="input-group">
                  <input type="text" placeholder="youremail@mail.com" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                  </span>
                </div>
              </form>
            </div> 
          </div>
          <!-- END NEWLETTER -->
        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

    <!-- BEGIN FOOTER -->
    <div class="footer padding-top-15 footer-light">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-6 col-sm-6 padding-top-10">
            {{ date('Y') }} &copy; E-commerce. ALL Rights Reserved.
          </div>
          <!-- END COPYRIGHT -->
          <!-- BEGIN PAYMENTS -->
          <div class="col-md-6 col-sm-6">
            <ul class="list-unstyled list-inline pull-right">
              <li><img src="{{ URL::to('/frontend/layout/img/payments/PayPal.jpg') }}" alt="We accept PayPal" title="We accept PayPal"></li>
            </ul>
          </div>
          <!-- END PAYMENTS -->
        </div>
      </div>
    </div>
    <!-- END FOOTER -->
    
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="../../assets/global/plugins/respond.min.js"></script>  
    <![endif]-->
    {{ HTML::script('backend/plugins/jquery-1.11.0.min.js') }}
    {{ HTML::script('backend/plugins/jquery-migrate-1.2.1.min.js') }}
    {{ HTML::script('frontend/plugins/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('frontend/layout/scripts/back-to-top.js') }}
    {{ HTML::script('backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    {{ HTML::script('backend/plugins/fancybox/source/jquery.fancybox.pack.js') }}
    {{ HTML::script('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js') }}
    {{ HTML::script('backend/plugins/zoom/jquery.zoom.min.js') }}
    {{ HTML::script('backend/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}

    <!-- BEGIN LayerSlider -->
    {{ HTML::script('backend/plugins/slider-layer-slider/js/greensock.js') }}
    {{ HTML::script('backend/plugins/slider-layer-slider/js/layerslider.transitions.js') }}
    {{ HTML::script('backend/plugins/slider-layer-slider/js/layerslider.kreaturamedia.jquery.js') }}
    {{ HTML::script('frontend/pages/scripts/layerslider-init.js') }}
    <!-- END LayerSlider -->

    {{ HTML::style('backend/ddselect/dd.css') }}
    {{ HTML::style('backend/ddselect/skin2.css') }}
    {{ HTML::script('backend/ddselect/jquery.dd.min.js') }}

    {{ HTML::script('frontend/layout/scripts/layout.js') }}

    <script type="text/javascript">
    $(document).ready(function(e) {
          $("#brand").msDropdown({roundedCorner:false});
          $("#color").msDropdown({roundedCorner:false});
          $("#length").msDropdown({roundedCorner:false});
          $("#size").msDropdown({roundedCorner:false});
          $("#weight").msDropdown({roundedCorner:false});
          $("#fuel").msDropdown({roundedCorner:false});
          $("#country").msDropdown({roundedCorner:false});
    });
     </script>

    <script type="text/javascript">
        $(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            LayersliderInit.initLayerSlider();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
            
            Layout.initFixHeaderWithPreHeader();
            Layout.initNavScrolling();
        });
    </script>

    <script type="text/javascript">
      $('.wishlist_btn').click(function(){

        var ele = $(this);
        var pid = ele.attr('data-id');
          
        var param = {
            id: pid,
            user_id: ele.attr('data-uid')
        };
        
        $.post("{{ URL::to('member/add_wishlist') }}", param, function (data) {
          if (data.status == 'success') {
            //console.log(data);
            $('#wishlist-' + pid).html('<i class="fa fa-heart fa-lg" style="color:#fff"></i> Already in wishlist');
            $('#wishlist-' + pid).attr('id','showtoast');
          } else {
            console.log(data);
          }
        }, 'JSON');
      });
    </script>

    <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
    </script>
    
    <script type="text/javascript">
    $(document).ready(function() {
          $('.currency_val').click(function(){
              var ele = $(this);
              var param = {
                    value: ele.attr('data-val')
              };
              
              $.post("{{ URL::to('change_currency') }}", param, function (data) {
                    if (data.status == 'success') {
                         var url = $(location).attr('href');
                        window.location.href = url;
                    }
              }, 'JSON');
          });
    });
    </script>

    @yield('scripts')

    <!-- END PAGE LEVEL JAVASCRIPTS -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'keenthemes.com');
  ga('send', 'pageview');
</script>

</body>
<!-- END BODY -->
</html>