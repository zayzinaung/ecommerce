<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Income</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { width:100%; border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Income Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:30%;text-align:left;">Income Name</th>
              <th style="width:20%;text-align:left;">Amount</th>
              <th style="width:20%;text-align:left;">MOP</th>
              <th style="width:30%;text-align:left;">Received Date</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; ?>
    @foreach ( $incomes as $income )
    <tr>
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $income->income_name }}</td>
          <td class="vertical">{{ $currency }} {{ $income->income_amount }}</td>
          <td class="vertical">
          @if ( $income->cash != 0 )
              Cash
          @elseif ( $income->cheque != null )
              Cheque
          @elseif ( $income->other != null )
              Other
          @elseif ( $income->enet != null )
              Enet
          @endif
          </td>
          <td class="vertical">{{ date($date_format, $income->received_date) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>