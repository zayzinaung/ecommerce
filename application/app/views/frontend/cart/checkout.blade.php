@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">
.white { color: #fff; text-decoration: none; }
.white:hover { color: #fff; text-decoration: none; }
.right { float: right; }
.shipping_region { float: left; background: rgba(167, 176, 184, 0.24); padding: 0 15px; margin-top: 10px; margin-bottom: 10px; }
.payment_region { margin: 30px 10px 20px 0; padding-bottom: 10px; background: #fff; }
.payment_region h2 {
  background: #a7b0b8;
  color: #fff;
  font: 17px 'PT Sans Narrow', sans-serif;
  margin: 0 0 15px;
  padding: 9px 20px 8px !important;
}
.payment { padding: 0 10px 15px 15px; }
.shipping_region h4 { font-weight: bold; margin: 20px 0 15px 0; }
.shipment { margin-bottom:20px; }
.total_region { clear: both; width: 100%; padding-top: 10px; border-top: 1px solid #ecebeb; }
.total_inner { float:right; width: 230px; }
.total_region em { font: 18px 'PT Sans Narrow', sans-serif; float: left; text-transform: uppercase; position: relative; top: 2px; font-weight: bold; }
.total_region strong { color: #e84d1c; font: 21px 'PT Sans Narrow', sans-serif; font-weight: normal; float: right; }
</style>
@stop

@section('title')
Global Ecommerce | Checkout
@stop

@section('content')
<div class="main">
    <div class="container">
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
     <!-- BEGIN CONTENT -->
     @if ( Cart::count() != 0 )
          @if ( Session::has('guest_name') || Session::has('user_id') )
          <div class="col-md-12 col-sm-12">
              <h1>Checkout</h1>
              {{ Form::open(array('url'=>'order/post_payment', 'class'=>'form-horizontal', 'id'=>'order_form')) }}
              <div class="goods-page">
              <div class="goods-data clearfix">
              <div class="table-wrapper-responsive">
              <table summary="Shopping cart">
                    <tr>
                          <th class="goods-page-image">Image</th>
                          <th class="goods-page-description">Title</th>
                          <th class="goods-page-ref-no">Product No</th>
                          <th class="goods-page-quantity">Quantity</th>
                          <th class="goods-page-price">Unit price</th>
                          <th class="goods-page-total" colspan="2">Total</th>
                    </tr>

                    @foreach ( Cart::content() as $c )
                    <tr>
                          <td class="goods-page-image">
                              <a href="{{ URL::to('product/detail/'.$c->options->slug) }}"><img src="{{ URL::to('/uploads/products/'.$c->options->image->image) }}" alt="{{ $c->name }}"></a>
                          </td>
                          <td class="goods-page-description">
                              <h3><a href="{{ URL::to('product/detail/'.$c->options->slug) }}">{{ $c->name }}</a></h3>
                              <!--p><strong>Item 1</strong> - Color: Green; Size: S</p>
                              <em>More info is here</em-->
                          </td>
                          <td class="goods-page-ref-no">
                              {{ $c->options->product_no }}
                          </td>
                          <td class="goods-page-quantity">
                              {{ $c->qty }}
                          </td>
                          <?php $currency_val = Common::convert_currency(); ?>
                          <td class="goods-page-price">
                              @if ( Session::has('currency_type') )
                                    @if ( Session::get('currency_type') == 'MMK' )
                                        <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format(round($c->price * $currency )) }}</strong>
                                    @else
                                        <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format((float)($c->price * $currency ), 2, '.', '') }}</strong>
                                    @endif
                              @else
                                    <strong><span>{{ $currency_symbol }} </span>{{ $c->price * $currency }}</strong>
                              @endif
                          </td>
                          <td class="goods-page-total">
                              @if ( Session::has('currency_type') )
                                    @if ( Session::get('currency_type') == 'MMK' )
                                        <strong><span>{{ Session::get('currency_symbol') }} </span><span class="stotal{{ $c->rowid }}" style="font-size:21px">{{ number_format(round(($c->qty * $c->price) * $currency )) }}</span></strong>
                                    @else
                                        <strong><span>{{ Session::get('currency_symbol') }} </span><span class="stotal{{ $c->rowid }}" style="font-size:21px">{{ number_format((float)(($c->qty * $c->price) * $currency ), 2, '.', '') }}</span></strong>
                                    @endif
                              @else
                                    <strong><span>{{ $currency_symbol }} </span><span class="stotal{{ $c->rowid }}" style="font-size:21px">{{ ($c->qty * $c->price) * $currency }}</span></strong>
                              @endif
                          </td>
                    </tr>
                    @endforeach
              </table>
              </div>
              
              @if ( $shipping_method != null )
              <div class="col-md-offset-4 shipping_region">
                    <h4>Delivery Method</h4>
                    @foreach ( $shipping_method as $shipping )
                          <?php $desc = unserialize($shipping->description); ?>
                          <div class="shipment">
                              @if ( $shipping->method == 'Free Shipping' )
                                    @if ( Session::has('currency_type') )
                                        @if ( Session::get('currency_type') == 'MMK' )
                                            <input type="radio" name="shipping" value="{{ $shipping->method }}" style="float:left;margin-right:5px;" data-value="0" data-currency="MMK" data-symbol="Ks" checked>{{ $shipping->method }}<br/>
                                        @else
                                            <input type="radio" name="shipping" value="{{ $shipping->method }}" style="float:left;margin-right:5px;" data-value="0" data-currency="{{ Session::get('currency_type') }}" data-symbol="{{ Session::get('currency_symbol') }}" checked>{{ $shipping->method }}<br/>
                                        @endif
                                    @else
                                        <input type="radio" name="shipping" value="{{ $shipping->method }}" style="float:left;margin-right:5px;" data-value="0" data-currency="{{ $currency_format }}" data-symbol="{{ $currency_symbol }}" checked>{{ $shipping->method }}<br/>
                                    @endif
                                    <span style="color:#c13726;padding-left:20px;">arrive within {{ $desc['day'] }} days</span>
                              @else
                                    @if ( Session::has('currency_type') )
                                        @if ( Session::get('currency_type') == 'MMK' )
                                            <input type="radio" name="shipping" value="{{ $shipping->method }}" style="float:left;margin-right:5px;" data-value="{{ number_format(round($desc['amount'] * $currency )) }}" data-currency="MMK" data-symbol="Ks">{{ $shipping->method }}<br/>
                                            <span style="color:#c13726;padding-left:20px;">arrive within {{ $desc['day'] }} days and charges {{ Session::get('currency_symbol') }} {{ number_format(round($desc['amount'] * $currency )) }}</span>
                                        @else
                                            <input type="radio" name="shipping" value="{{ $shipping->method }}" style="float:left;margin-right:5px;" data-value="{{ number_format((float)$desc['amount'] * $currency, 2, '.', '') }}" data-currency="{{ Session::get('currency_type') }}" data-symbol="{{ Session::get('currency_symbol') }}">{{ $shipping->method }}<br/>
                                            <span style="color:#c13726;padding-left:20px;">arrive within {{ $desc['day'] }} days and charges {{ Session::get('currency_symbol') }} {{ number_format((float)$desc['amount'] * $currency, 2, '.', '') }}</span>
                                        @endif
                                    @else
                                        <input type="radio" name="shipping" value="{{ $shipping->method }}" style="float:left;margin-right:5px;" data-value="{{ number_format((float)$desc['amount'] * $currency, 2, '.', '') }}" data-currency="{{ $currency_format }}" data-symbol="{{ $currency_symbol }}">{{ $shipping->method }}<br/>
                                        <span style="color:#c13726;padding-left:20px;">arrive within {{ $desc['day'] }} days and charges {{ $currency_symbol }} {{ $desc['amount'] * $currency }}</span>
                                    @endif
                              @endif
                          </div>
                    @endforeach
              </div>
              @endif

              <div class="shopping-total">
              <ul>
                    <li class="shopping-total-price">
                          <em>Buying total</em>
                          @if ( Session::has('currency_type') )
                              @if ( Session::get('currency_type') == 'MMK' )
                                  <strong class="price"><span>{{ Session::get('currency_symbol') }} </span><span class="cart_total_qty" style="font-size:19px">{{ number_format(round(Cart::total() * $currency )) }}<span></strong>
                              @else
                                  <strong class="price"><span>{{ Session::get('currency_symbol') }} </span><span class="cart_total_qty" style="font-size:19px">{{ number_format((float)Cart::total() * $currency, 2, '.', '') }}<span></strong>
                              @endif
                          @else
                              <strong class="price"><span>{{ $currency_symbol }} </span><span class="cart_total_qty" style="font-size:19px">{{ Cart::total() * $currency }}<span></strong>
                          @endif
                    </li>

                    @if ( Session::has('user_id') && $discount_amount != 0 )
                    <li>
                          <em>Discount</em>
                          <strong class="price">{{ $discount_amount }} %</strong>
                          {{ Form::hidden('discount', $discount_amount) }}
                    </li>
                    @endif
                    
                    @if ( $gst != 0 )
                    <li>
                          <em>GST</em>
                          <strong class="price">{{ $gst }} %</strong>
                          {{ Form::hidden('gst', $gst) }}
                    </li>
                    @endif

                    <li>
                          <em>Shipping Cost</em>
                          @if ( Session::has('currency_type') )
                                    @if ( Session::get('currency_type') == 'MMK' )
                                        <strong class="shipping_cost">Ks 0</strong>
                                    @else
                                        <strong class="shipping_cost">{{ Session::get('currency_symbol') }} 0.00</strong>
                                    @endif
                              @else
                                    <strong class="shipping_cost">{{ $currency_symbol }} 0.00</strong>
                          @endif
                    </li>
              </ul>
              </div>

              <div class="total_region">
                    <div class="total_inner">
                    <em>Overall Total</em>
                    @if ( Session::has('currency_type') )
                              @if ( Session::get('currency_type') == 'MMK' )
                                  <strong class="overall_total" style="color:#35aa47;font-size:22px;" data-value="{{ number_format(round($overall_total * $currency)) }}">{{ Session::get('currency_symbol') }} {{ number_format(round($overall_total * $currency)) }}</strong>
                              @else
                                  <strong class="overall_total" style="color:#35aa47;font-size:22px;" data-value="{{ number_format((float)$overall_total * $currency_val, 2, '.', '') }}">{{ Session::get('currency_symbol') }} {{ number_format((float)$overall_total * $currency, 2, '.', '') }}</strong>
                              @endif
                          @else
                              <strong class="price overall_total" data-value="{{ $overall_total * $currency_val }}"><span>{{ $currency_symbol }} </span><span class="cart_total_qty" style="font-size:19px">{{ $overall_total * $currency }}<span></strong>
                          @endif
                    </div>
              </div>

              </div><!-- end of goods-data -->
              
              <div class="payment_region">
                    <h2>Payment Method</h2>
                    <div class="payment">
                          <input type="radio" name="payment" value="paypal" style="float:left;margin-right:5px;" checked>Pay with Paypal
                    </div>
                    <div class="payment">
                          <input type="radio" name="payment" value="offline" style="float:left;margin-right:5px;">Pay with Cash/Cheque
                    </div>
              </div>

              <div class="row">
                    <div class="col-md-1 col-xs-12">
                          <button class="btn btn-default" type="button"><a href="{{ URL::to('cart') }}" class="white"><i class="fa fa-arrow-left"></i> Back</a></button>
                    </div>
                    <div class="col-md-2 col-xs-12">
                          <button class="btn btn purple" type="button"><a href="{{ URL::to('cart/export_invoice') }}" class="white" target="_blank"><i class="fa fa-file-pdf-o"></i> Invoice</a></button>
                    </div>
                    <div class="col-md-offset-4 col-md-3 col-xs-12" style="margin-top:8px;text-align:right;">
                          <input type="checkbox" name="agree" value="1" style="margin-right:5px;"><span style="font: 13px 'PT Sans Narrow', sans-serif;font-weight: bold;color:#f3565d;float:right;margin-top:2px;">I agree to terms and conditions</span>
                    </div>
                    <div class="col-md-2 col-xs-12">
                          <a class="white proceed"><button class="btn btn-primary proceed_btn" type="button" id="checkout">Checkout <i class="fa fa-check"></i></button></a>
                    </div>
              </div>
              
              </div><!-- end of goods-page -->
              
              {{ Form::close() }}
          </div>
          @else
          <div class="col-md-12 col-sm-12">
            <h1>Checkout</h1>
            <div class="shopping-cart-page">
              <div class="shopping-cart-data clearfix">
                <p>Sorry, the cart page is not completed yet.</p>
                <p>Please complete the cart page firstly.</p>
              </div>
            </div>
          </div>
          @endif
     @else
          <div class="col-md-12 col-sm-12">
            <h1>Checkout</h1>
            <div class="shopping-cart-page">
              <div class="shopping-cart-data clearfix">
                <p>Your shopping cart is empty!</p>
              </div>
            </div>
          </div>
     @endif
     
     <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->

    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
$("input:radio[name=shipping]").click(function() {
  var value = $(this).val();

  var currency = $(this).attr('data-currency');
  var symbol = $(this).attr('data-symbol');

  if ( currency == 'MMK' )
  {
          var amount = $(this).attr('data-value');
          amount = amount.replace(/,/g, '');
          var total = $('.overall_total').attr('data-value');
          total = total.replace(/,/g, '');
          var overall = parseInt(amount)+parseInt(total);
  } else {
          var amount = parseFloat($(this).attr('data-value')).toFixed(2);
          var total = parseFloat($('.overall_total').attr('data-value')).toFixed(2);
          var overall = parseFloat(parseFloat(amount)+parseFloat(total)).toFixed(2);
  }

  if ( value == 'Free Shipping' )
  {
          $('.shipping_cost').text(symbol + ' 0.00');
          $('.overall_total').text(symbol + ' ' + overall);
  } else {
          $('.shipping_cost').text(symbol + ' ' + amount);
          $('.overall_total').text(symbol + ' ' + overall);
  }

});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    document.getElementById("checkout").disabled = true;
    $('.proceed_btn').css({"background-color":"rgb(232, 77, 28)"});
    $('input[type="checkbox"]').click(function(){
          if ( $(this).prop("checked") == true )
          {
              document.getElementById("checkout").disabled = false;
              $('.proceed_btn').css({"background-color":"#e84d1c"});
          } else if ( $(this).prop("checked") == false ) {
              document.getElementById("checkout").disabled = true;
          }
    });
    
    $('#checkout').click(function() {
          var payment_val = $("input:radio[name=payment]:checked").val();
          if ( payment_val == 'paypal' )
          {
              $('#order_form').attr('action', "{{ URL::to('order/post_payment') }}").submit();
          } else {
              $('#order_form').attr('action', "{{ URL::to('order/add_order') }}").submit();
          }
    });
});
</script>
@stop