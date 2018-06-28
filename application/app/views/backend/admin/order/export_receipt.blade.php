<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt</title>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style type="text/css" media="screen">
    .product { clear:both; margin-top:20px; width:100%; border-top:2px solid #333; }
    .product thead { border-bottom:2px solid #333; }
    .product thead th { text-align: left; padding: 4px 0; }
    .product tr td { padding: 10px 0; }
  </style>
</head>
<body>
    <table>
    <tbody>
    <tr>
          <td><img src="{{ URL::to('/frontend/img/logo.png') }}" style="float: left; width: 200px;"></td>
          <td><p style="margin-left:200px">Address : {{ $receipt->address }}</p><p style="margin-left:200px">Phone : {{ $receipt->phone }}</p></td>
    </tr>
    </tbody>
    </table>

    <table class="product">
    <thead>
          <tr>
              <th style="width:4%">#</th>
              <th style="width:10%">Image</th>
              <th style="width:30%">Title</th>
              <th style="width:15%">Product No</th>
              <th style="width:15%">Quantity</th>
              <th style="width:15%">Unit price</th>
              <th style="width:15%">Total</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; $total_amount = 0.00; ?>
    @foreach ( $orders as $order )
    <tr class="product">
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical"><img src="{{ URL::to('/uploads/products/'.$order->image) }}" width="50"></td>
          <td class="vertical">{{ $order->product_name }}</td>
          <td class="vertical" style="text-align:center">{{ $order->product_no }}</td>
          <td class="vertical" style="text-align:center">{{ $order->order_quantity }}</td>
          <td class="vertical">{{ $currency }} {{ $order->original_price }}</td>
          <td class="vertical">{{ $currency }} {{ number_format((float)$order->order_quantity * $order->original_price, 2, '.', '') }}</td>
    </tr>
    <?php $total_amount+=$order->original_price; ?>
    @endforeach
    </tbody>

    <tbody style="border-top:2px solid #333">
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Buying Total</td>
              <td> </td>
              <td>{{ $currency }} {{ number_format((float)$total_amount, 2, '.', ''); }}</td>
          </tr>
    </tbody>

    @if ( $order->discount != 0 )
    <tbody>
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Discount</td>
              <td> </td>
              <td>{{ $order->discount }}%</td>
          </tr>
    </tbody>
    @endif

    @if ( $order->gst != 0 )
    <tbody>
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">GST</td>
              <td> </td>
              <td>{{ $order->gst }}%</td>
          </tr>
    </tbody>
    @endif

    <tbody>
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Shipping Cost</td>
              <td> </td>
              <td>
                  {{ $currency }} {{ number_format((float)$amount, 2, '.', '') }}
              </td>
          </tr>
    </tbody>

    <tbody style="border-top:2px solid #333;border-bottom:2px solid #333;">
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Overall Total</td>
              <td> </td>
              <td style="font-weight:bold;font-size:18px;color:#35aa47">
                  {{ $currency }} {{ number_format((float)$shipping_cost, 2, '.', ''); }}
              </td>
          </tr>
    </tbody>
    
    <tbody>
          <tr>
              <td colspan="7">{{ $receipt->description }}</td>
          </tr>
    </tbody>

    <tbody>
          <tr>
              <td colspan="7">{{ $receipt->position }}</td>
          </tr>
    </tbody>
    
    <tbody>
          <tr>
              <td colspan="7">{{ $receipt->name }}</td>
          </tr>
    </tbody>

    @if ( $receipt->sign != null )
    <tbody>
          <tr>
              <td colspan="7"><img src="{{ URL::to('/uploads/sign/'.$receipt->sign) }}"></td>
          </tr>
    </tbody>
    @endif

    </table>
    
</body>
</html>