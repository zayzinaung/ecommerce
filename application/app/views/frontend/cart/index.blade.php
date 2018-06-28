@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">
.white {
  color: #fff;
  text-decoration: none;
}
.white:hover {
  color: #fff;
  text-decoration: none;
}
#islogin_region{
  background: #fff;
  margin-top: 25px;
  margin-bottom: 10px;
  float: left;
  clear: both;
  width: 99%;
}
#islogin_region h2{
  background: #a7b0b8;
  color: #fff;
  font: 17px 'PT Sans Narrow', sans-serif;
  margin: 0;
  padding: 9px 20px 8px !important;
  opacity: 0.5;
}
.islogin_inner{
  display: none;
  float: left;
  width: 100%;
  padding: 30px 15px 10px 15px;
}
.right {
  float: right;
}
</style>
@stop

@section('title')
Global Ecommerce | Cart
@stop

@section('content')

<div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          @if ( Cart::count() != 0 )
          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
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

                    <?php $currency_val = Common::convert_currency(); ?>
                    <td class="goods-page-quantity">
                      <div class="cart_page product-quantity">
                          @if ( Session::has('currency_type') )
                              @if ( Session::get('currency_type') == 'MMK' )
                                    <input id="product-quantity" name="myqty" type="text" value="{{ $c->qty }}" data-value="{{ $c->options->quantity - $c->options->quantity_use }}" readonly class="cart_qty form-control" data-id="{{ $c->rowid }}" data-price="{{ round($c->price * $currency_val) }}" data-stotal="stotal{{ $c->rowid }}" data-currency="MMK" data-symbol="Ks">
                              @else
                                    <input id="product-quantity" name="myqty" type="text" value="{{ $c->qty }}" data-value="{{ $c->options->quantity - $c->options->quantity_use }}" readonly class="cart_qty form-control" data-id="{{ $c->rowid }}" data-price="{{ number_format((float)($c->price * $currency_val), 2, '.', '') }}" data-stotal="stotal{{ $c->rowid }}" data-currency="{{ Session::get('currency_type') }}" data-symbol="{{ Session::get('currency_symbol') }}">
                              @endif
                          @else
                              <input id="product-quantity" name="myqty" type="text" value="{{ $c->qty }}" data-value="{{ $c->options->quantity - $c->options->quantity_use }}" readonly class="cart_qty form-control" data-id="{{ $c->rowid }}" data-price="{{ $c->price * $currency_val }}" data-stotal="stotal{{ $c->rowid }}" data-currency="{{ $currency_format }}" data-symbol="{{ $currency_symbol }}">
                          @endif
                      </div>
                    </td>

                    <td class="goods-page-price">
                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format(round($c->price * $currency_val)) }}</strong>
                          @else
                              <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format((float)($c->price * $currency_val), 2, '.', '') }}</strong>
                          @endif
                      @else
                          <strong><span>{{ $currency_symbol }} </span>{{ $c->price * $currency_val }}</strong>
                      @endif
                    </td>
                    <td class="goods-page-total">
                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <strong><span>{{ Session::get('currency_symbol') }} </span><span class="stotal{{ $c->rowid }}" style="font-size:21px">{{ number_format(round(($c->qty * $c->price) * $currency_val )) }}</span></strong>
                          @else
                              <strong><span>{{ Session::get('currency_symbol') }} </span><span class="stotal{{ $c->rowid }}" style="font-size:21px">{{ number_format((float)(($c->qty * $c->price) * $currency_val ), 2, '.', '') }}</span></strong>
                          @endif
                      @else
                          <strong><span>{{ $currency_symbol }} </span><span class="stotal{{ $c->rowid }}" style="font-size:21px">{{ ($c->qty * $c->price) * $currency_val }}</span></strong>
                      @endif
                    </td>
                    <td class="del-goods-col">
                      {{ Form::open(array('url'=>'cart/remove', 'class'=>'form-horizontal')) }}
                          <a onclick="$(this).closest('form').submit()" style="cursor:pointer">
                          <i class="fa fa-trash-o fa-lg" style="font-size:18px"></i>
                          </a>
                      {{ Form::hidden('row_id',$c->rowid) }}
                      {{ Form::close() }}
                    </td>
                  </tr>
                  @endforeach
                </table>
                </div>

                <div class="shopping-total">
                  <ul>
                    <li class="shopping-total-price">
                      <em>Buying total</em>
                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <strong class="price"><span>{{ Session::get('currency_symbol') }} </span><span class="cart_total_qty" style="font-size:19px">{{ number_format(round(Cart::total() * $currency_val )) }}<span></strong>
                          @else
                              <strong class="price"><span>{{ Session::get('currency_symbol') }} </span><span class="cart_total_qty" style="font-size:19px">{{ number_format((float)Cart::total() * $currency_val, 2, '.', '') }}<span></strong>
                          @endif
                      @else
                          <strong class="price"><span>{{ $currency_symbol }} </span><span class="cart_total_qty" style="font-size:19px">{{ Cart::total() * $currency_val }}<span></strong>
                      @endif
                    </li>
                  </ul>
                </div>
              </div>
              <a href="{{ URL::to('/') }}" class="white"><button class="btn btn-default" type="button">Continue shopping <i class="fa fa-shopping-cart"></i></button></a>
              <a class="white proceed"><button class="btn btn-primary proceed_btn" type="button">Proceed <i class="fa fa-arrow-right"></i></button></a>
            </div>

            <?php if ( Session::get('user_id') == null ) {
                $val = '';
                $email = '';
                $checked = '';
            ?> <input type="hidden" class="guest_login" value="1">
            <?php } else {
                $val = 'disabled';
                $checked = 'checked';
                $email = Session::get('email');
            ?> <input type="hidden" class="member_login" value="2">
            <?php } ?>

          <div id="islogin_region" class="form-horizontal">
          <h2>Are you the guest or the member ?</h2>
          <div class="islogin_inner">
              <?php
              if ( Session::has('guest_name') )
              {
                  $session_guestname = Session::get('guest_name');
                  $session_email = Session::get('guest_email');
                  $session_phone = Session::get('guest_phone');
                  $session_address = Session::get('guest_address');
              } else {
                  $session_guestname = '';
                  $session_email = '';
                  $session_phone = '';
                  $session_address = '';
              }
              ?>
              <div class="row">
                <div class="col-md-6">
                  <input type="radio" name="islogin_type" value="1" id="guest_radio" style="float:left;margin-right:5px;">
                  <h4>I am the guest!</h4>
                    <div class="guest_region">
                    <div class="form-group">
                      <label for="name" class="col-lg-3 control-label">Name <span class="require">*</span></label>
                      <div id="name-group" class="col-lg-8 guest-group">
                        {{ Form::text('name', $session_guestname,array('class'=>'form-control','id'=>'name')) }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="guest_email" class="col-lg-3 control-label">Email <span class="require">*</span></label>
                      <div id="guest-email-group" class="col-lg-8 guest-group">
                        {{ Form::text('guest_email', $session_email,array('class'=>'form-control','id'=>'guest_email')) }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="phone" class="col-lg-3 control-label">Phone <span class="require">*</span></label>
                      <div id="phone-group" class="col-lg-8 guest-group">
                        {{ Form::text('phone', $session_phone,array('class'=>'form-control','id'=>'phone')) }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="address" class="col-lg-3 control-label">Address <span class="require">*</span></label>
                      <div id="address-group" class="col-lg-8 guest-group">
                        {{ Form::textarea('address', $session_address,array('class'=>'form-control','id'=>'address','rows'=>'2')) }}
                      </div>
                    </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <input type="radio" name="islogin_type" value="2" id="member_radio" style="float:left;margin-right:5px;" <?php echo $checked; ?>>
                  <h4>I am the member!</h4>
                    <div class="member_region">
                    <div class="form-group">
                      <label for="login_email" class="col-lg-3 control-label">Email <span class="require">*</span></label>
                      <div id="member-email-group" class="col-lg-8 member-group">
                        {{ Form::text('member_email', $email ,array('class'=>'form-control','id'=>'member_email', $val)) }}
                      </div>
                    </div>
                    @if ( !Session::has('user_id') )
                    <div class="form-group">
                      <label for="password" class="col-lg-3 control-label">Password <span class="require">*</span></label>
                      <div id="password-group" class="col-lg-8 member-group">
                        {{ Form::password('password', array('class' => 'form-control', 'id' => 'password')) }}
                      </div>
                    </div>
                    @endif
                    </div>
                </div>
              </div>
              
              <button class="btn btn-primary right ajax_check" type="button" style="margin-top:10px">Confirm <i class="fa fa-arrow-right"></i></button>
              
          </div>
          </div><!-- end of islogin_region -->

          </div>
          @else
          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
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
$(document).ready(function(){

  $('.proceed').click(function(){
    $('.islogin_inner').slideDown('slow');
    $('#islogin_region h2').css({"background-color":"#a7b0b8","opacity": "1", "border-bottom": "solid 1px #ecebeb", "padding-bottom": "10px"});
  });

  if ( $('.guest_login').val() == 1 )
  {
    $("#guest_radio").prop("checked", true);
    $('.member_region').hide();
  } else {
    $("#member_radio").prop("checked", true);
    $('.guest_region').hide();
  }

$("input:radio[name=islogin_type]").click(function() {
  var value = $(this).val();
  if ( value == 1 )
  {
    $('.member_region').slideUp('slow');
    $('.guest_region').slideDown('slow');
  } else {
    $('.guest_region').slideUp('slow');
    $('.member_region').slideDown('slow');
  }
});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('.cart_page .bootstrap-touchspin .btn').click(function(){

    var a = $(this).closest('.cart_page').find('.cart_qty').val();

    var ele = $(this).closest('.cart_page').find('input[name=myqty]');

    var htotal = $('.header_total_qty').val();

    var sub = ele.attr('data-price');
    var currency = ele.attr('data-currency');
    var symbol = ele.attr('data-symbol');

    var b = a * sub;
        
    var param = {
        id: ele.attr('data-id'),
        qty: a,
        subtotal: b,
        subtotalid: ele.attr('data-stotal')
    };
    
    $.post("{{ URL::to('cart/change_qty') }}", param, function (data) {
      if (data.status == 'success') {

          var subtotal = $('.'+data.subid).text();
          subtotal = subtotal.replace(/,/g, '');

          var temp = 0;

          var total = $('.cart_total_qty').text();
          total = total.replace(/,/g, '');
          total = parseFloat(total);

          if (data['result']['subtotal'] > subtotal) {

              temp = data['result']['subtotal'] - subtotal;

              total += temp;

          } else {

              temp = subtotal - data['result']['subtotal'];

              total -= temp;
          }
          
          if ( currency == 'MMK' )
          {
              //var f_total = formatCurrency(total);
              //var s_total = formatCurrency(data.newsubtotal);
              $('.'+data.subid).text(data.newsubtotal);
              $('#'+data.subid).text(symbol+' '+data.newsubtotal);
              $('.cart_total_qty').text(total);
              $('.header_total').text(total);
          } else {
              $('.'+data.subid).text(parseFloat(data.newsubtotal).toFixed(2));
              $('#'+data.subid).text(symbol+parseFloat(data.newsubtotal).toFixed(2));
              var f_total = parseFloat(total).toFixed(2);
              $('.cart_total_qty').text(f_total);
              $('.header_total').text(f_total);
          }
          
          $('.header_qty').text('x '+a);

      } else {
          console.log('fail');
      }
    }, 'JSON');

  });

});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('.ajax_check').click(function(){

    var ele = $(this);
    ele.html("<img src='{{ URL::to('frontend/img/check.gif') }}' width='20'>");

    var value = $('input[name=islogin_type]:checked').val();
    if ( value == 1 )
    {
          $('.guest-group').removeClass('has-error');
          $('.help-block').remove();

          var formData = {
              name      : $('input[name=name]').val(),
              guest_email     : $('input[name=guest_email]').val(),
              phone    : $('input[name=phone]').val(),
              address     : $('textarea[name=address]').val()
          };
          $.ajax({
              type    : 'POST',
              url     : "{{ URL::to('cart/ajax_guest_login') }}",
              data    : formData,
              dataType  : 'json',
              encode    : true
          })
          .done(function(data) {
              if(data.status == 'fail')
              {
                    if (data.errors.name) {
                          $('#name-group').addClass('has-error');
                          $('#name-group').append('<div class="help-block">' + data.errors.name + '</div>');
                    }
                    if (data.errors.guest_email) {
                          $('#guest-email-group').addClass('has-error');
                          $('#guest-email-group').append('<div class="help-block">' + data.errors.guest_email + '</div>');
                    }
                    if (data.errors.phone) {
                          $('#phone-group').addClass('has-error');
                          $('#phone-group').append('<div class="help-block">' + data.errors.phone + '</div>');
                    }
                    if (data.errors.address) {
                          $('#address-group').addClass('has-error');
                          $('#address-group').append('<div class="help-block">' + data.errors.address + '</div>');
                    }
                    ele.html('Confirm <i class="fa fa-arrow-right"></i>');
              } else {

                    if(data.email_error)
                    {
                      $('#guest-email-group').addClass('has-error');
                      $('#guest-email-group').append('<div class="help-block">' + data.email_error + '</div>');
                      ele.html('Confirm <i class="fa fa-arrow-right"></i>');
                    }

                    if(data.status == 'success')
                    {
                          window.location.href = '{{ URL::to("cart/checkout") }}';
                    }

              }
          })
          .fail(function(data) {
              console.log(data);
          });
    } else {
          $('.member-group').removeClass('has-error');
          $('.help-block').remove();

          var formData = {
              email      : $('input[name=member_email]').val(),
              password     : $('input[name=password]').val()
          };
          $.ajax({
              type    : 'POST',
              url     : "{{ URL::to('cart/ajax_member_login') }}",
              data    : formData,
              dataType  : 'json',
              encode    : true
          })
          .done(function(data) {

              if ( data.status == 'login' )
              {
                    window.location.href = '{{ URL::to("cart/checkout") }}';
              } else if ( data.status == 'fail' ) {
                    if (data.errors.email) {
                          $('#member-email-group').addClass('has-error');
                          $('#member-email-group').append('<div class="help-block">' + data.errors.email + '</div>');
                    }
                    if (data.errors.password) {
                          $('#password-group').addClass('has-error');
                          $('#password-group').append('<div class="help-block">' + data.errors.password + '</div>');
                    }
                    ele.html('Confirm <i class="fa fa-arrow-right"></i>');
              } else {
                    if ( data.login == 'error' )
                    {
                        $('#member-email-group').addClass('has-error');
                        $('#password-group').addClass('has-error');
                        $('#member-email-group').append('<div class="help-block">' + data.msg + '</div>');
                        ele.html('Confirm <i class="fa fa-arrow-right"></i>');
                    } else {
                        window.location.href = '{{ URL::to("cart/checkout") }}';
                    }
              }
          })
          .fail(function(data) {
              console.log(data);
          });
    }

  });
});
</script>

@stop