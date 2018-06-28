@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">
.goods-page h3 {
font-size: 18px;
margin-bottom: 15px;
color: #8e44ad;
font-weight: bold;
}
.goods-page h4 {
font-size: 20px;
margin-bottom: 15px;
}
.shipment_info h4{
  text-transform: capitalize;
  color:#d84a38;
  font-size: 18px;
}
</style>
@stop

@section('title')
Global Ecommerce | Order Detail
@stop

@section('content')

<div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Order Detail</h1>
            @if ( count($order_detail) != 0 )
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">

                <h2 style="margin-bottom:15px;text-transform: none;padding-bottom:10px;border-bottom:1px solid #666;">
                    @if ( $order->shipment_level == 1 )
                          {{ $level }}.
                    @elseif ( $order->shipment_level == 2 )
                          {{ $level }} <span style="color:#d84a38">{{ $order->courier_name }}</span> , phone number <span style="color:#d84a38">{{ $order->courier_no }}</span>.
                    @elseif ( $order->shipment_level == 3 )
                          {{ $level }} <span style="color:#d84a38">{{ date($date_format,$order->delivered_on) }}</span>.
                    @else
                          @if ( $cname != '' )
                              {{ $level }} <span style="color:#d84a38">{{ date($date_format,$deliver) }}</span> with <span style="color:#d84a38">{{ $cname }}</span> , phone number <span style="color:#d84a38">{{ $cno }}</span>.
                          @else
                              {{ $level }}
                          @endif
                    @endif
                </h2>

                <h3>Bill Number : {{ $order->bill_no }}</h3>
                <?php $data = strtotime($order->order_date); $date = date($date_format, $data); ?>
                <h4>Order Date : {{ $date }}</h4>

                <div class="shipment_info">
                @if ( $amount != 0.00 )
                  <h4>Charges Shipping : Your order will arrive within {{ $day }} days.</h4>
                @else
                  <h4>Free Shipping : Your order will arrive within {{ $day }} days.</h4>
                @endif
                </div>

                <table summary="Order History" style="margin-top:30px">
                  <tr>
                    <th>#</th>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Name</th>
                    <th class="goods-page-ref-no">Product No</th>
                    <th class="goods-page-quantity">Quantity</th>
                    <th class="goods-page-price">Unit price</th>
                    <th class="goods-page-total" colspan="2">Total</th>
                  </tr>
                  <?php $i=1; $total_amount = 0.00; ?>
                  @foreach ( $order_detail as $row )
                  <tr>
                  <td>{{ $i++ }}</td>
                  <td class="goods-page-image"><img src="{{ URL::to('/uploads/products/'.$row->image) }}" alt="{{ $row->product_name }}"></td>
                  <td>{{ $row->product_name }}</td>
                  <td>{{ $row->product_no }}</td>
                  <td>{{ $row->order_quantity }}</td>

                  <?php $currency_val = Common::convert_currency(); ?>
                  <td>
                  @if ( Session::has('currency_type') )
                    @if ( Session::get('currency_type') == 'MMK' )
                          {{ Session::get('currency_symbol') }} {{ number_format(round($row->original_price * $currency_val )) }}
                    @else
                          {{ Session::get('currency_symbol') }} {{ number_format((float)$row->original_price * $currency_val, 2, '.', '') }}
                    @endif
                  @else
                          {{ $currency_symbol }} {{ $row->original_price * $currency_val }}
                  @endif
                  </td>

                  <td>
                  @if ( Session::has('currency_type') )
                    @if ( Session::get('currency_type') == 'MMK' )
                          {{ Session::get('currency_symbol') }} {{ number_format(round(($row->order_quantity * $row->original_price) * $currency_val )) }}
                    @else
                          {{ Session::get('currency_symbol') }} {{ number_format((float)($row->order_quantity * $row->original_price) * $currency_val, 2, '.', '') }}
                    @endif
                  @else
                          {{ $currency_symbol }} {{ ($row->order_quantity * $row->original_price) * $currency_val }}
                  @endif
                  </td>

                  </tr>
                  <?php $total_amount+=$row->original_price; ?>
                  @endforeach
                </table>
                </div>
                
              <div class="shopping-total">
                  <ul>
                    <li class="shopping-total-price">
                      <em>Buying total</em>
                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <strong class="price"><span>{{ Session::get('currency_symbol') }} </span><span class="cart_total_qty" style="font-size:19px">{{ number_format(round($total_amount * $currency_val )) }}<span></strong>
                          @else
                              <strong class="price"><span>{{ Session::get('currency_symbol') }} </span><span class="cart_total_qty" style="font-size:19px">{{ number_format((float)$total_amount * $currency_val, 2, '.', '') }}<span></strong>
                          @endif
                      @else
                          <strong class="price"><span>{{ $currency_symbol }} </span><span class="cart_total_qty" style="font-size:19px">{{ $total_amount * $currency_val }}<span></strong>
                      @endif
                    </li>
                    @if ( $order->discount != 0 )
                    <li>
                      <em>Discount</em>
                      <strong class="price">{{ $order->discount }} %</strong>
                    </li>
                    @endif
                    @if ( $order->gst != 0 )
                    <li>
                      <em>GST</em>
                      <strong class="price">{{ $order->gst }} %</strong>
                    </li>
                    @endif
                    
                    <li>
                      <em>Shipping Cost</em>
                      @if ( Session::has('currency_type') )
                        @if ( Session::get('currency_type') == 'MMK' )
                              <strong class="price">{{ Session::get('currency_symbol') }} {{ number_format(round($amount * $currency_val )) }}</strong>
                        @else
                              <strong class="price">{{ Session::get('currency_symbol') }} {{ number_format((float)$amount * $currency_val, 2, '.', '') }}</strong>
                        @endif
                      @else
                              <strong class="price">{{ $currency_symbol }} {{ $amount * $currency_val }}</strong>
                      @endif
                    </li>
                    
                    <li>
                      <em>Overall Total</em>
                      @if ( Session::has('currency_type') )
                          @if ( Session::get('currency_type') == 'MMK' )
                              <strong class="overall_total" style="color:#35aa47;font-size:22px;">{{ Session::get('currency_symbol') }} {{ number_format(round($overall_total * $currency_val)) }}</strong>
                          @else
                              <strong class="overall_total" style="color:#35aa47;font-size:22px;">{{ Session::get('currency_symbol') }} {{ number_format((float)$overall_total * $currency_val, 2, '.', '') }}</strong>
                          @endif
                      @else
                          <strong class="price"><span>{{ $currency_symbol }} </span><span class="cart_total_qty" style="font-size:19px">{{ $overall_total * $currency_val }}<span></strong>
                      @endif
                    </li>
                    
                  </ul>
              </div>

              </div>

            </div>
            @else
              <h2>There is no order detail.</h2>
            @endif
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

      </div>
</div>

@stop