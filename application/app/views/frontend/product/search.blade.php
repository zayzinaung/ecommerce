@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">
.title-wrapper {
  min-height: 75px!important;
  padding-top: 25px!important;
}
.container h1 {
  float: left;
  border-bottom: 0px!important;
  font-size: 22px!important;
}
.search_btn {
  padding: 4px 12px;
  font-size: 13px;
}
.search_btn a {
  background: none;
  color: white;
  padding: 0px;
  text-decoration: none;
}
.search_btn a:hover {
  text-decoration: none;
}
.pull-left {
  margin-right: 10px;
}
.pull-right {
  margin-left: 15px!important;
}
.pull-right label {
  padding-top: 0px!important;
}
.overall_search {
  float: right!important;
}
</style>
@stop

@section('title')
Global Ecommerce | Products
@stop

@section('content')
<div class="title-wrapper">
    <div class="container"><div class="container-inner">

          <h1>Search Products</h1>

          {{ Form::open(array('url'=>'products/search', 'class'=>'form-horizontal', 'method'=>'GET')) }}
          <div class="input-group col-md-4 overall_search">
              {{ Form::text('keyword','',array('class'=>'form-control','placeholder'=>'Search name, brand')) }}
              <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Search</button>
              </span>
          </div>
          {{ Form::close() }}

    </div></div>
</div>

<div class="main">
    <div class="container">
          <ul class="breadcrumb">
              <li><a href="{{ URL::to('') }}">Home</a></li>
              <li><a href="{{ URL::to('products') }}">Products</a></li>
              <li>Search</li>
              @if ( $check_keyword == true )
                    <li class="active" style="text-transform:capitalize">{{ $keyword }}</li>
              @endif
          </ul>
          <!-- BEGIN SIDEBAR & CONTENT -->

          <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-10">
          <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                    <a href="#"><i class="fa fa-th-large"></i></a>
                    <a href="#"><i class="fa fa-th-list"></i></a>
              </div>

              <div class="col-md-12 col-sm-12">
                    {{ Form::open(array('url'=>'products/search', 'class'=>'form-horizontal', 'method'=>'GET')) }}
                    <div class="pull-right">
                          <button type="submit" class="btn btn-primary search_btn"><i class="fa fa-search"></i></button>
                    </div>
                    @if ( $check_keyword == true )
                    {{ Form::hidden('keyword',$keyword) }}
                    @endif
                    <div class="pull-right">
                          <label class="control-label">Price&nbsp;Range:</label>
                          <select class="form-control input-sm" name="price_range" id="price_range">

                            @if ( $check_sort == true )
                                    @if ( $price == 'default' )
                                        <?php $price_a = 'selected'; $price_b = ''; $price_c = ''; $price_d = ''; $price_e = ''; $price_f = ''; ?>
                                    @elseif ( $price == 'below 50' )
                                        <?php $price_a = ''; $price_b = 'selected'; $price_c = ''; $price_d = ''; $price_e = ''; $price_f = ''; ?>
                                    @elseif ( $price == '50 to 100' )
                                        <?php $price_a = ''; $price_b = ''; $price_c = 'selected'; $price_d = ''; $price_e = ''; $price_f = ''; ?>
                                    @elseif ( $price == '100 to 200' )
                                        <?php $price_a = ''; $price_b = ''; $price_c = ''; $price_d = 'selected'; $price_e = ''; $price_f = ''; ?>
                                    @elseif ( $price == '200 to 500' )
                                        <?php $price_a = ''; $price_b = ''; $price_c = ''; $price_d = ''; $price_e = 'selected'; $price_f = ''; ?>
                                    @elseif ( $price == '500 above' )
                                        <?php $price_a = ''; $price_b = ''; $price_c = ''; $price_d = ''; $price_e = ''; $price_f = 'selected'; ?>
                                    @else
                                        <?php $price_a = 'selected'; $price_b = ''; $price_c = ''; $price_d = ''; $price_e = ''; $price_f = ''; ?>
                                    @endif
                                    <option value="{{ base64_encode('default') }}" {{ $price_a }}>Default</option>
                                    <option value="{{ base64_encode('below 50') }}" {{ $price_b }}>Below S$50</option>
                                    <option value="{{ base64_encode('50 to 100') }}" {{ $price_c }}>S$50 &gt; S$100</option>
                                    <option value="{{ base64_encode('100 to 200') }}" {{ $price_d }}>S$100 &gt; S$200</option>
                                    <option value="{{ base64_encode('200 to 500') }}" {{ $price_e }}>S$200 &gt; S$500</option>
                                    <option value="{{ base64_encode('500 above') }}" {{ $price_f }}>S$500 Above</option>
                              @else
                              <option value="{{ base64_encode('default') }}" selected="selected">Default</option>
                              <option value="{{ base64_encode('below 50') }}">Below S$50</option>
                              <option value="{{ base64_encode('50 to 100') }}">S$50 &gt; S$100</option>
                              <option value="{{ base64_encode('100 to 200') }}">S$100 &gt; S$200</option>
                              <option value="{{ base64_encode('200 to 500') }}">S$200 &gt; S$500</option>
                              <option value="{{ base64_encode('500 above') }}">S$500 Above</option>
                              @endif

                          </select>
                    </div>
                    <div class="pull-right">
                          <label class="control-label">Sort&nbsp;By:</label>
                          <select class="form-control input-sm" name="sort_by" id="sort_by">
                            
                            @if ( $check_sort == true )
                                  @if ( $sort == 'default' )
                                      <?php $sort_a = 'selected'; $sort_b = ''; $sort_c = ''; $sort_d = ''; $sort_e = ''; ?>
                                  @elseif ( $sort == 'a to z' )
                                      <?php $sort_a = ''; $sort_b = 'selected'; $sort_c = ''; $sort_d = ''; $sort_e = ''; ?>
                                  @elseif ( $sort == 'z to a' )
                                      <?php $sort_a = ''; $sort_b = ''; $sort_c = 'selected'; $sort_d = ''; $sort_e = ''; ?>
                                  @elseif ( $sort == 'low to high' )
                                      <?php $sort_a = ''; $sort_b = ''; $sort_c = ''; $sort_d = 'selected'; $sort_e = ''; ?>
                                  @elseif ( $sort == 'high to low' )
                                      <?php $sort_a = ''; $sort_b = ''; $sort_c = ''; $sort_d = ''; $sort_e = 'selected'; ?>
                                  @else
                                      <?php $sort_a = 'selected'; $sort_b = ''; $sort_c = ''; $sort_d = ''; $sort_e = ''; ?>
                                  @endif
                                  <option value="{{ base64_encode('default') }}" {{ $sort_a }}>Default</option>
                                  <option value="{{ base64_encode('a to z') }}" {{ $sort_b }}>Name (A - Z)</option>
                                  <option value="{{ base64_encode('z to a') }}" {{ $sort_c }}>Name (Z - A)</option>
                                  <option value="{{ base64_encode('low to high') }}" {{ $sort_d }}>Price (Low &gt; High)</option>
                                  <option value="{{ base64_encode('high to low') }}" {{ $sort_e }}>Price (High &gt; Low)</option>
                            @else
                            <option value="{{ base64_encode('default') }}" selected="selected">Default</option>
                            <option value="{{ base64_encode('a to z') }}">Name (A - Z)</option>
                            <option value="{{ base64_encode('z to a') }}">Name (Z - A)</option>
                            <option value="{{ base64_encode('low to high') }}">Price (Low &gt; High)</option>
                            <option value="{{ base64_encode('high to low') }}">Price (High &gt; Low)</option>
                            @endif
                    
                          </select>
                    </div>
                    {{ Form::close() }}
              </div>
              
          </div>
          <!-- BEGIN PRODUCT LIST -->
            <div class="row product-list">
              @if ( count($products) != 0 )
              @foreach ( $products as $product )
              <!-- PRODUCT ITEM START -->
              {{ Form::open(array('url'=>'cart/add', 'class'=>'form-horizontal')) }}
              <div class="col-md-3 col-sm-5 col-xs-12">
              <div class="product-item">
                    <div class="pi-img-wrapper">
                          <img src="{{ URL::to('/uploads/products/'.$product->image) }}" alt="{{ $product->product_name }}" width="239" height="239">
                          <div>
                              <a href="{{ URL::to('/uploads/products/'.$product->image) }}" class="btn btn-default fancybox-button">Zoom</a>
                              <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
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

                    @if ( $product->quantity - $product->quantity_use == 0 )
                          <p style="float:right;color:red;border:1px #ededed solid;padding: 3px 6px 4px 6px;;text-transform:uppercase;font-size:14px;margin-bottom:0px;">Out of stock</p>
                    @else
                          <button type="submit" class="btn btn-default add2cart">Add to cart</button>
                    @endif
              </div>
              </div>
              {{ Form::hidden('pid', $product->pid) }}
              {{ Form::hidden('quantity', '1') }}
              {{ Form::close() }}
              <!-- PRODUCT ITEM END -->
              @endforeach
              @else
                    <h1>There is no product!</h1>
              @endif
            </div>
            <!-- END PRODUCT LIST -->
            <!-- BEGIN PAGINATOR -->
            <div class="row">
              <div class="col-md-4 col-sm-4 items-info"></div>
              <div class="col-md-8 col-sm-8">
                <ul class="pagination pull-right">
                    @if ( $check_keyword == true && $check_sort != true )
                          {{ $products->appends(array('keyword' => $keyword))->links() }}
                    @elseif ( $check_keyword == true && $check_sort == true )
                          {{ $products->appends(array('keyword' => $keyword, 'price_range' => base64_encode($price), 'sort_by' => base64_encode($sort)))->links() }}
                    @else
                          {{ $products->links() }}
                    @endif
                </ul>
              </div>
            </div>
            <!-- END PAGINATOR -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
@stop

@section('scripts')
<script type="text/javascript">
function change_catelist(val)
{
          $.post("{{URL::to('product/get_subcategory') }}",{id: ""+ val +""}, function(data) 
          {
              $('#subcategory').html(data);
          });
}
</script>
@stop