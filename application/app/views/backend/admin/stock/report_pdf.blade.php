<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Stock</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { width:100%; border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Stock Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:25%;text-align:left;">Stock Name</th>
              <th style="width:15%;text-align:left;">Amount</th>
              <th style="width:15%;text-align:left;">Quantity</th>
              <th style="width:25%;text-align:left;">Bought From</th>
              <th style="width:20%;text-align:left;">Buying Date</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; ?>
    @foreach ( $stocks as $stock )
    <tr>
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $stock->stock_name }}</td>
          <td class="vertical">{{ $currency }} {{ $stock->amount }}</td>
          <td class="vertical">{{ $stock->quantity }}</td>
          <td class="vertical">{{ $stock->bought_from }}</td>
          <td class="vertical">{{ date($date_format, $stock->buying_date) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>