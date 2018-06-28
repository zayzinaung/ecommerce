<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Offline Sale</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { width:100%; border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Offline Sale Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:15%;text-align:left;">Member Name</th>
              <th style="width:25%;text-align:left;">Product Name</th>
              <th style="width:10%;text-align:left;">Price</th>
              <th style="width:15%;text-align:left;">Order Qty</th>
              <th style="width:10%;text-align:left;">Total</th>
              <th style="width:10%;text-align:left;">MOP</th>
              <th style="width:15%;text-align:left;">Order Date</th>
          </tr>
    </thead>
    <tbody>
    
    <?php $i = 0; ?>
    @foreach ( $offlinesales as $offlinesale )
    <tr>
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $offlinesale->member_name }}</td>
          <td class="vertical">{{ $offlinesale->product_name }}</td>
          <td class="vertical">{{ $currency }} {{ $offlinesale->per_price }}</td>
          <td class="vertical">{{ $offlinesale->order_quantity }}</td>
          <td class="vertical">{{ $currency }} {{ $offlinesale->total_amount }}</td>
          <td class="vertical">
          @if ( $offlinesale->payment_method != 'paypal' )
            @if ( $offlinesale->cash != 0 )
                Cash
            @elseif ( $offlinesale->cheque != null )
                Cheque
            @elseif ( $offlinesale->other != null )
                Other
            @elseif ( $offlinesale->enet != null )
                Enet
            @endif
          @else
                Paypal
          @endif
          </td>
          <td class="vertical">{{ date($date_format, $offlinesale->selling_date) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>