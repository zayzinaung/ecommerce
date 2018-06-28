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
.review_btn { color: #fff; text-decoration: none; }
.review_btn:hover { color: #fff; text-decoration: none; }
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

                  <div class="product-other-images">
                    @if ( $product_images)
                    @foreach ( $product_images as $product_image )
                    <a href="{{ URL::to('/uploads/products/'.$product_image->image) }}" class="fancybox-button" rel="photos-lib"><img src="{{ URL::to('/uploads/products/'.$product_image->image) }}"></a>
                    @endforeach
                    @endif
                  </div>

                  @if ( Session::has('user_id') )
                  <div>
                    @if ( $wishlist == null )
                      <button type="submit" class="btn btn-primary wishlist_btn" id="wishlist-{{ $product->id }}" data-id="{{ $product->id }}" data-uid="{{ Session::get('user_id') }}"><i class="fa fa-heart-o"></i> Add to wishlist</button>
                    @else
                      <button type="submit" class="btn btn-primary"><i class="fa fa-heart"></i> Already in wishlist</button>
                    @endif
                  </div>
                  @endif
                  
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1>{{ $product->product_name }}</h1>

                  <div class="review" style="float:left;width:100%;">
                    @if ( count($review) != 0 )
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
                  <div class="description">
                    <p>{{ $product->description }}</p>
                  </div>

                
              {{ Form::open(array('url'=>'product/search_other_product', 'class'=>'form-horizontal')) }}
                  <div class="product-page-options" style="float:left;width:100%;overflow:visible;">
                    @if ( $choose_size != null )
                    <div class="pull-left" style="margin: 0 20px 20px 0">
                      <label class="control-label">Size:</label>
                      <select style="width:100px" class="form-control input-sm" name="size" id="size">
                        @foreach($sizes as $result_s)
                          <?php $s = $result_s['sizes']; ?>
                          @if ( $choose_size->id == $s->id )
                            <option value="<?php echo $s->id; ?>" selected="selected">{{ $s->size_name }}</option>
                          @else
                            <option value="<?php echo $s->id; ?>">{{ $s->size_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    @endif

                    @if ( $choose_color != null )
                    <div class="pull-left" style="margin: 0 20px 20px 0" id="color_select">
                      <label class="control-label">Color:</label>
                      <select style="width:150px" class="tech form-control input-sm" name="color" id="color">
                        @foreach($colors as $result_c)
                          <?php $c = $result_c['colors']; ?>
                          @if ( $choose_color->id == $c->id )
                            <option value="<?php echo $c->id; ?>" data-image="../../uploads/color_images/<?php echo $c->color_image;?>" selected="selected">{{ $c->color_name }}</option>
                          @else
                            <option value="<?php echo $c->id; ?>" data-image="../../uploads/color_images/<?php echo $c->color_image;?>">{{ $c->color_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    @endif

                    @if ( $choose_length != null )
                    <div class="pull-left" style="margin: 0 20px 20px 0">
                      <label class="control-label">Length:</label>
                      <select style="width:100px" class="form-control input-sm" name="length" id="length">
                        @foreach($length as $result_l)
                          <?php $l = $result_l['length']; ?>
                          @if ( $choose_length->id == $l->id )
                            <option value="<?php echo $l->id; ?>" selected="selected">{{ $l->length_name }}</option>
                          @else
                            <option value="<?php echo $l->id; ?>">{{ $l->length_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    @endif

                    @if ( $choose_weight != null )
                    <div class="pull-left" style="margin: 0 20px 20px 0">
                      <label class="control-label">Weight:</label>
                      <option value="NULL">-</option>
                      <select style="width:100px" class="form-control input-sm" name="weight" id="weight">
                        @foreach($weight as $result_w)
                          <?php $w = $result_w['weight']; ?>
                          @if ( $choose_weight->id == $w->id )
                            <option value="<?php echo $w->id; ?>" selected="selected">{{ $w->weight_name }}</option>
                          @else
                            <option value="<?php echo $w->id; ?>">{{ $w->weight_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    @endif

                    @if ( $choose_fuel != null )
                    <div class="pull-left" style="margin: 0 20px 20px 0">
                      <label class="control-label">Fuel:</label>
                      <select style="width:100px" class="form-control input-sm" name="fuel" id="fuel">
                        @foreach($fuels as $result_f)
                          <?php $f = $result_f['fuels']; ?>
                          @if ( $choose_fuel->id == $f->id )
                            <option value="<?php echo $f->id; ?>" selected="selected">{{ $f->fuel_name }}</option>
                          @else
                            <option value="<?php echo $f->id; ?>">{{ $f->fuel_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    @endif

                    {{ Form::hidden('pid', $product->id) }}
                    {{ Form::hidden('name', $product->product_name) }}
                    <button type="submit" class="btn green button-submit" style="float:left;width:100%">Search</button>
                  </div>
              {{ Form::close() }}

              {{ Form::open(array('url'=>'cart/add', 'class'=>'form-horizontal')) }}
                  <div class="product-page-cart" style="float:left;width:100%;">
                    @if ( $product->quantity - $product->quantity_use == 0 )
                    <div class="empty-quantity" style="float:left;width:70px;margin-right:20px;position: relative;">
                        <input id="quantity" name="quantity" type="text" value="-" readonly class="form-control" disabled="disabled" style="height: 38px;border: none;background: #edeff1 !important;font: 300 23px 'Open Sans', sans-serif;text-align: center;">
                    </div>
                    <button class="btn btn-primary" type="submit" disabled>Add to cart</button>
                    @else
                    <div class="product-quantity"> 
                        <input id="product-quantity" name="quantity" type="text" value="1" data-value="{{ $product->quantity - $product->quantity_use }}" readonly class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit">Add to cart</button>
                    @endif
                  </div>
                  {{ Form::hidden('pid', $product->id) }}
              {{ Form::close() }}
                  
                </div>

                <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#Information" data-toggle="tab">Informations</a></li>
                    <li><a href="#Reviews" data-toggle="tab">
                          @if ( $count == 0 || $count == 1 )
                              Review
                          @else
                              Reviews ( {{ $count }} )
                          @endif
                    </a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="Description">
                      <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. </p>
                    </div>
                    <div class="tab-pane fade in active" id="Information">
                      <table class="datasheet">
                        <tr>
                          <th colspan="2">Additional Informations</th>
                        </tr>
                        @if ( count($product_info_data) != 0 )
                        @foreach ( $product_info_data as $pd )
                        <?php $info = Product_info::find($pd->product_info_id); ?>
                        <tr>
                          <td class="datasheet-features-type col-md-2">{{ $info->product_label }}</td>
                          <td>{{ $pd->data }}</td>
                        </tr>
                        @endforeach
                        @endif
                      </table>
                    </div>
                    <div class="tab-pane fade" id="Reviews">
                          @if ( $review != null )
                          @foreach ( $review as $r )
                          <div class="review-item clearfix">
                            <div class="review-item-submitted">
                              <?php $user = User::find($r->user_id); ?>
                              @if ( $user->neutral === 'Mrs' )
                                  <img src="{{ URL::to('frontend/img/girl.jpg') }}" width="35" style="float:left;margin-right:15px;">
                              @else
                                  <img src="{{ URL::to('frontend/img/boy.jpg') }}" width="35" style="float:left;margin-right:15px;">
                              @endif
                              <strong>{{ $user->username }}</strong>
                              <em>{{ date($date_format.' - H:i', strtotime($r->created_at)) }}</em>
                              <div class="rateit rated" data-score="{{ $r->rating }}"></div>
                            </div>                                     
                            <div class="review-item-content" style="width:100%">
                              <p>{{ $r->review }}</p>
                            </div>
                          </div>
                          @endforeach
                          @endif

                          @if ( count($review) > 1 )
                              <button type="button" class="btn btn-success" style="float:right"><a href="{{ URL::to('product/review/'.$product->slug) }}" class="review_btn" target="_blank">More Review >></a></button>
                          @endif

                          @if ( Session::has('user_id') )
                          {{ Form::open(array('url'=>'product/add_review', 'class'=>'reviews-form', 'style'=>'float:left;width:100%;')) }}
                          <h2>Write a review</h2>
                          <div class="form-group" style="float:left;width:100%;">
                            <label class="control-label" style="float:left;width:100%;">Rating <span class="required">* </span></label>
                            <div class="rate" data-score="0" data-readonly="false" style="float:left"></div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Review <span class="required">* </span></label>
                            {{ Form::textarea('review_text','', array('class'=>'form-control','rows'=>'5')) }}
                          </div>
                          <div class="padding-top-20">
                              <button type="submit" class="btn btn-primary">Save</button>
                          </div>

                          {{ Form::hidden('product_id', $product->id) }}
                          {{ Form::hidden('product_slug', $product->slug) }}
                          {{ Form::hidden('rating', 0) }}
                          {{ Form::close() }}
                          @endif

                    </div>
                  </div>
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