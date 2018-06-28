@extends('frontend.template.template')

@section('style')

{{ HTML::style('frontend/plugins/raty/jquery.raty.css') }}

<style type="text/css" media="screen">
.discount {
  float:left;
}
.discount h3{
  float:left;
  margin-right: 20px;
}
.discount h4{
  float: left;
  margin-top: 5px;
}
#color_select .dd .ddChild li img { height: 15px!important; }
#color_select .dd .ddTitle .ddTitleText img { height: 17px!important; }
</style>
@stop

@section('title')
Global Ecommerce | {{ $product->product_name }}
@stop

@section('content')

  <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="">Products</a></li>
            <li class="active">{{ $product->product_name }}</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              @foreach($categories as $cate)
                    <?php $subcategories = Category::find($cate->id)->subcategories; ?>
                    <li class="list-group-item clearfix dropdown">
                          <a style="cursor:pointer" href="javascript:void(0);" class="collapsed">
                              <i class="fa fa-angle-right"></i>{{ $cate->category_name }}
                          </a>
                          <ul class="dropdown-menu" style="display:block;">
                              @foreach($subcategories as $subcate)
                                    <li class="list-group-item dropdown clearfix">
                                        <a href="{{ URL::to('products?category='.$cate->slug.'&subcategory='.$subcate->slug) }}"><i class="fa fa-angle-right"></i>{{ $subcate->subcategory_name }}</a>
                                    </li>
                              @endforeach
                          </ul>
                    </li>
              @endforeach
            </ul>

            <div class="sidebar-products clearfix">
              <h2>Bestsellers</h2>
              <div class="item">
                <a href="shop-item.html"><img src="{{ URL::to('frontend/pages/img/k2.jpg') }}" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$31.00</div>
              </div>
              <div class="item">
                <a href="shop-item.html"><img src="{{ URL::to('frontend/pages/img/k3.jpg') }}" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$23.00</div>
              </div>
              <div class="item">
                <a href="shop-item.html"><img src="{{ URL::to('frontend/pages/img/k4.jpg') }}" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$86.00</div>
              </div>
            </div>
          </div>
          <!-- END SIDEBAR -->
          
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="product-main-image">
                    @if ( $detail_image != null )
                    <img src="{{ URL::to('/uploads/products/'.$detail_image->image) }}" alt="{{ $product->product_name }}" class="img-responsive" data-BigImgsrc="{{ URL::to('/uploads/products/'.$detail_image->image) }}">
                    @else
                    <img src="{{ URL::to('/uploads/no_icon.png') }}" width="509">
                    @endif
                  </div>
                  
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1>{{ $product->product_name }}</h1>

                  <div class="review" style="float:left;width:100%;">
                    @if ( $review != '' )
                          <div class="rated" data-score="{{ $rating_total }}"  style="float:left"></div>
                    @else
                          <div class="rated" data-score="0" style="float:left"></div>
                    @endif
                  </div>

                  <div class="price-availability-block clearfix">
                    <?php $currency_val = Common::convert_currency(); ?>
                    @if ( $product->discount != 0 )
                    <div class="discount">
                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <h3><strike><span style="font-size:17px">{{ Session::get('currency_symbol') }} </span>{{ number_format(round($product->price * $currency_val)) }}</strike></h3>
                          @else
                              <h3><strike><span style="font-size:17px">{{ Session::get('currency_symbol') }} </span>{{ number_format((float)($product->price * $currency_val), 2, '.', '') }}</strike></h3>
                          @endif
                      @else
                          <h3><strike><span style="font-size:17px">{{ $currency_symbol }} </span>{{ $product->price * $currency_val }}</strike></h3>
                      @endif
                      
                      <h4>{{ $product->discount }}% Discount</h4>
                    </div>
                    @endif
                    <div class="availability">
                      @if ( $product->quantity - $product->quantity_use == 0 )
                        Availability: <strong style="color:red;font-size:17px;">Out of Stock</strong>
                      @else
                        Availability: <strong style="font-size:17px">In Stock</strong>
                      @endif
                    </div>
                    <div class="price" style="clear:both">

                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format(round($sale_price * $currency_val)) }}</strong>
                          @else
                              <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format((float)($sale_price * $currency_val), 2, '.', '') }}</strong>
                          @endif
                      @else
                          <strong><span>{{ $currency_symbol }} </span>{{ $sale_price * $currency_val }}</strong>
                      @endif
                      
                    </div>
                  </div>
                  
                </div>

                <div class="product-page-content">
                <h2 style="border-bottom: solid 1px #eee; padding-bottom: 10px; margin-bottom: 20px;">Reviews</h2>
                @if ( $review != null )
                    @foreach ( $review as $r )
                          <div class="review-item clearfix">
                            <div class="review-item-submitted">
                              <?php $user = User::find($r->user_id); ?>
                              <strong>{{ $user->username }}</strong>
                              <em>{{ date($date_format.' - H:i', strtotime($r->created_at)) }}</em>
                              <div class="rateit rated" data-score="{{ $r->rating }}"></div>
                            </div>                                     
                            <div class="review-item-content">
                              <p>{{ $r->review }}</p>
                            </div>
                          </div>
                    @endforeach

                    {{ $review->links() }}
                @endif
                </div>

                <div class="sticker sticker-sale"></div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>Most popular products</h2>
            <div class="owl-carousel owl-carousel4">
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{ URL::to('/frontend/pages/img/products/k1.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k1.jpg') }}" class="btn btn-default fancybox-button">Zoom</a>
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
                    <img src="{{ URL::to('/frontend/pages/img/products/k2.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k2.jpg') }}" class="btn btn-default fancybox-button">Zoom</a>
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
                    <img src="{{ URL::to('/frontend/pages/img/products/k3.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k3.jpg') }}" class="btn btn-default fancybox-button">Zoom</a>
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
                    <img src="{{ URL::to('/frontend/pages/img/products/k4.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k4.jpg') }}" class="btn btn-default fancybox-button">Zoom</a>
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
                    <img src="{{ URL::to('/frontend/pages/img/products/k1.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k1.jpg') }}" class="btn btn-default fancybox-button">Zoom</a>
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
                    <img src="{{ URL::to('/frontend/pages/img/products/k2.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{ URL::to('/frontend/pages/img/products/k2.jpg') }}" class="btn btn-default fancybox-button">Zoom</a>
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
        </div>
        <!-- END SIMILAR PRODUCTS -->
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