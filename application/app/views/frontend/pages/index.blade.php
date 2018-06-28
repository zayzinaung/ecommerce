@extends('frontend.template.template')

@section('title')
Global Ecommerce | Home
@stop

@section('content')

<!-- BEGIN SLIDER -->
<div class="page-slider margin-bottom-35">
      <!-- LayerSlider start -->
      <div id="layerslider" style="width: 100%; height: 494px; margin: 0 auto;">

        @if ( $sliders )
        @foreach ( $sliders as $slider )
        <!-- slide two start -->
        <div class="ls-slide ls-slide2" data-ls="offsetxin: right; slidedelay: 7000; transition2d: 110,111,112,113;">

          <img src="{{ URL::to('/uploads/sliders/'.$slider->slider_image) }}" class="ls-bg" alt="Slide background">
          
          <div class="ls-l ls-title" style="top: 40%; left: 21%; white-space: nowrap;" data-ls="
          fade: true; 
          fadeout: true;  
          durationin: 750; durationout: 109750; 
          easingin: easeOutQuint; 
          easingout: easeInOutQuint; 
          delayin: 0; 
          delayout: 0; 
          rotatein: 90; 
          rotateout: -90; 
          scalein: .5; 
          scaleout: .5; 
          showuntil: 4000;
          ">{{ $slider->description }}
          </div>
        </div>
        <!-- slide two end -->
        @endforeach
        @endif

      </div>
      <!-- LayerSlider end -->
</div>
<!-- END SLIDER -->

<div class="main">
      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SALE PRODUCT -->

          <div class="col-md-12" style="float:left;margin-bottom:20px;">
          <?php if( Session::get('error') ){ ?>
                <div class="alert alert-danger" style="margin:0 0 2px 0;padding:5px 15px;">
                     <i class="fa fa-exclamation-triangle"></i> <?php echo Session::get('fail'); ?>
                </div>
          <?php } ?>
          <?php if( Session::get('success') ){ ?>
                <div class="theme-success">
                     <i class="fa fa-info-circle"></i> <?php echo Session::get('success'); ?>
                </div>
           <?php } ?>
         </div>
         
	     <div class="col-md-12 sale-product">
          		<h2>New Arrivals</h2>
            	<div class="owl-carousel owl-carousel5">
            	@if ( $products )
            	@foreach ( $products as $product )
              	<div>
                          {{ Form::open(array('url'=>'cart/add', 'class'=>'form-horizontal')) }}
                		<div class="product-item">
	                  		<div class="pi-img-wrapper">
	                    			<img src="{{ URL::to('/uploads/products/'.$product->image) }}" alt="{{ $product->product_name }}" width="195" height="195">
	                    			<div>
	                      		<a href="{{ URL::to('/uploads/products/'.$product->image) }}" class="btn btn-default fancybox-button">Zoom</a>
	                      		<!--a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a-->
                                    @if ( Session::has('user_id') )
                                        @if ( $products_id != '' )
                                            <?php
                                              $convert_array = explode(' ', $product->pid);
                                              $find_pid = array_intersect($products_id,$convert_array);
                                              $string_id = implode(' ', $find_pid);
                                            ?>
                                            @if ( $string_id == $product->pid )
                                              <a class="btn btn-default" style="margin-top:2px"><i class="fa fa-heart fa-lg" style="color:#fff"></i> Already in wishlist</a>
                                            @else
                                              <a class="btn btn-default wishlist_btn" id="wishlist-{{ $product->pid }}" data-id="{{ $product->pid }}" data-uid="{{ Session::get('user_id') }}" style="margin-top:2px"><i class="fa fa-heart-o fa-lg" style="color:#fff"></i> Add to wishlist</a>
                                            @endif
                                        @else
                                          <a class="btn btn-default wishlist_btn" id="wishlist-{{ $product->pid }}" data-id="{{ $product->pid }}" data-uid="{{ Session::get('user_id') }}" style="margin-top:2px"><i class="fa fa-heart-o fa-lg" style="color:#fff"></i> Add to wishlist</a>
                                        @endif
                                    @endif
	                    			</div>
	                  		</div>
                              
                               <?php $title = substr( $product->product_name, 0, 23); ?>
	                  		<h3><a href="{{ URL::to('product/detail/'.$product->slug) }}" data-toggle="tooltip" data-placement="top" title="{{ $product->product_name }}">{{ $title }}</a></h3>

                               <?php
                                    $discount = number_format((float)( $product->price * $product->discount ) / 100, 2, '.', '');
                                    $sale_price = number_format((float)$product->price - $discount, 2, '.', '');
                                    $currency_val = Common::convert_currency();
                               ?>
                               @if ( $discount != 0.00 )

                                    @if ( Session::has('currency_type') )
                                        @if ( Session::get('currency_type') == 'MMK' )
                                              <div class="pi-price" data-toggle="tooltip" data-placement="top" title="{{ $product->discount }}% Discount">{{ Session::get('currency_symbol') }} {{ number_format(round($sale_price * $currency_val)) }}</div>
                                        @else
                                              <div class="pi-price" data-toggle="tooltip" data-placement="top" title="{{ $product->discount }}% Discount">{{ Session::get('currency_symbol') }} {{ number_format((float)($sale_price * $currency_val), 2, '.', '') }}</div>
                                        @endif
                                    @else
                                        <div class="pi-price" data-toggle="tooltip" data-placement="top" title="{{ $product->discount }}% Discount">{{ $currency_symbol }} {{ $sale_price * $currency_val }}</div>
                                    @endif
                                
                               @else

                                    @if ( Session::has('currency_type') )
                                        @if ( Session::get('currency_type') == 'MMK' )
                                              <div class="pi-price">{{ Session::get('currency_symbol') }} {{ number_format(round($product->price * $currency_val)) }}</div>
                                        @else
                                              <div class="pi-price">{{ Session::get('currency_symbol') }} {{ number_format((float)($product->price * $currency_val), 2, '.', '') }}</div>
                                        @endif
                                    @else
                                        <div class="pi-price">{{ $currency_symbol }} {{ $product->price * $currency_val }}</div>
                                    @endif

                               @endif
	                  		
	                  		<!--a href="#"class="btn btn-default add2cart">Add to cart</a-->
                              @if ( $product->quantity - $product->quantity_use == 0 )
                              <p style="float:right;color:red;border:1px #ededed solid;padding:3px 6px;text-transform:uppercase;font-size:14px;margin-bottom:0px;">Out of stock</p>
                              @else
                              <button type="submit" class="btn btn-default add2cart">Add to cart</button>
                              @endif
	                  		<div class="sticker sticker-sale"></div>
                		</div>
                          {{ Form::hidden('pid', $product->pid) }}
                          {{ Form::hidden('quantity', '1') }}
                          {{ Form::close() }}
              	</div>
              	@endforeach
              	@endif

            	</div>
          </div>
          <!-- END SALE PRODUCT -->

          <!-- BEGIN fast view of a product -->
          <div id="product-pop-up" style="display: none; width: 700px;">
                  <div class="product-page product-pop-up">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-3">
                        <div class="product-main-image">
                          <img src="{{ URL::to('/frontend/pages/img/products/model7.jpg') }}" alt="Cool green dress with red bell" class="img-responsive">
                        </div>
                        <div class="product-other-images">
                          <a href="#" class="active"><img alt="Berry Lace Dress" src="{{ URL::to('/frontend/pages/img/products/model3.jpg') }}"></a>
                          <a href="#"><img alt="Berry Lace Dress" src="{{ URL::to('/frontend/pages/img/products/model4.jpg') }}"></a>
                          <a href="#"><img alt="Berry Lace Dress" src="{{ URL::to('/frontend/pages/img/products/model5.jpg') }}"></a>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <h2>Cool green dress with red bell</h2>
                        <div class="price-availability-block clearfix">
                          <div class="price">
                            <strong><span>$</span>47.00</strong>
                            <em>$<span>62.00</span></em>
                          </div>
                          <div class="availability">
                            Availability: <strong>In Stock</strong>
                          </div>
                        </div>
                        <div class="description">
                          <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>
                        </div>
                        <div class="product-page-options">
                          <div class="pull-left">
                            <label class="control-label">Size:</label>
                            <select class="form-control input-sm">
                              <option>L</option>
                              <option>M</option>
                              <option>XL</option>
                            </select>
                          </div>
                          <div class="pull-left">
                            <label class="control-label">Color:</label>
                            <select class="form-control input-sm">
                              <option>Red</option>
                              <option>Blue</option>
                              <option>Black</option>
                            </select>
                          </div>
                        </div>
                        <div class="product-page-cart">
                          <div class="product-quantity">
                              <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
                          </div>
                          <button class="btn btn-primary" type="submit">Add to cart</button>
                          <a href="shop-item.html" class="btn btn-default">More details</a>
                        </div>
                      </div>

                      <div class="sticker sticker-sale"></div>
                    </div>
                  </div>
          </div>
          <!-- END fast view of a product -->

        	</div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-4">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Ladies</a></li>
              <li class="list-group-item clearfix dropdown">
                <a href="shop-product-list.html">
                  <i class="fa fa-angle-right"></i>
                  Mens
                  
                </a>
                <ul class="dropdown-menu">
                  <li class="list-group-item dropdown clearfix">
                    <a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Shoes </a>
                      <ul class="dropdown-menu">
                        <li class="list-group-item dropdown clearfix">
                          <a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Classic </a>
                          <ul class="dropdown-menu">
                            <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Classic 1</a></li>
                            <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Classic 2</a></li>
                          </ul>
                        </li>
                        <li class="list-group-item dropdown clearfix">
                          <a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sport  </a>
                          <ul class="dropdown-menu">
                            <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sport 1</a></li>
                            <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sport 2</a></li>
                          </ul>
                        </li>
                      </ul>
                  </li>
                  <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Trainers</a></li>
                  <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Jeans</a></li>
                  <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Chinos</a></li>
                  <li><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> T-Shirts</a></li>
                </ul>
              </li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Kids</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Accessories</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Sports</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Brands</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Electronics</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Home & Garden</a></li>
              <li class="list-group-item clearfix"><a href="shop-product-list.html"><i class="fa fa-angle-right"></i> Custom Link</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-8">
            <h2>Three items</h2>
            <div class="owl-carousel owl-carousel3">
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/k1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/k1.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                  <div class="sticker sticker-new"></div>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/k2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/k2.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress2</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/k3.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/k3.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress3</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k4.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k4.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress4</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                  <div class="sticker sticker-sale"></div>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k1.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress5</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k2.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress6</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN TWO PRODUCTS & PROMO -->
        <div class="row margin-bottom-35 ">
          <!-- BEGIN TWO PRODUCTS -->
          <div class="col-md-6 two-items-bottom-items">
            <h2>Two items</h2>
            <div class="owl-carousel owl-carousel2">
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/k4.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/k4.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/k2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/k2.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k3.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k3.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k1.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k4.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k4.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k3.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k3.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="#" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
          <!-- END TWO PRODUCTS -->
          <!-- BEGIN PROMO -->
          <div class="col-md-6 shop-index-carousel">
            <div class="content-slider">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ URL::to('/frontend/pages/img/index-sliders/slide1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  </div>
                  <div class="item">
                    <img src="{{ URL::to('/frontend/pages/img/index-sliders/slide2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  </div>
                  <div class="item">
                    <img src="{{ URL::to('/frontend/pages/img/index-sliders/slide3.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END PROMO -->
        </div>        
        <!-- END TWO PRODUCTS & PROMO -->
      </div>
</div>

@stop