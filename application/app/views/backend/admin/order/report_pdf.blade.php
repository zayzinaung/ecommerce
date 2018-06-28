<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Order</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { width:100%; border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Order Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:14%;text-align:left;">Member Name</th>
              <th style="width:15%;text-align:left;">Bill No.</th>
              <th style="width:18%;text-align:left;">Product Name</th>
              <th style="width:10%;text-align:left;">Price</th>
              <th style="width:7%;text-align:left;">Order Qty</th>
              <th style="width:10%;text-align:left;">Total</th>
              <th style="width:10%;text-align:left;">MOP</th>
              <th style="width:16%;text-align:left;">Order Date</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; ?>
    @foreach ( $orders as $order )
    <tr>
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $order->username }}</td>
          <td class="vertical">{{ $order->bill_no }}</td>
          <td class="vertical">{{ $order->product_name }}</td>
          <td class="vertical">{{ $currency }} {{ $order->original_price }}</td>
          <td class="vertical">{{ $order->order_quantity }}</td>
          <?php $price = $order->order_quantity * $order->original_price; ?>
          <td class="vertical">{{ $currency }} {{ $price }}</td>
          <td class="vertical">
          @if ( $order->payment_method != 'paypal' )
            @if ( $order->cash != 0 )
                Cash
            @elseif ( $order->cheque != null )
                Cheque
            @elseif ( $order->other != null )
                Other
            @elseif ( $order->enet != null )
                Enet
            @endif
          @else
                Paypal
          @endif
          </td>
          <td class="vertical">{{ date($date_format, strtotime($order->order_date)) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>