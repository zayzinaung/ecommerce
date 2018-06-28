<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Member</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { width:100%; border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Member Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:20%;text-align:left;">Member Name</th>
              <th style="width:15%;text-align:left;">Email</th>
              <th style="width:15%;text-align:left;">Phone</th>
              <th style="width:10%;text-align:left;">Is Active</th>
              <th style="width:20%;text-align:left;">Created at</th>
              <th style="width:20%;text-align:left;">Updated at</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; ?>
    @foreach ( $members as $member )
    <tr>
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $member->username }}</td>
          <td class="vertical">{{ $member->email }}</td>
          <td class="vertical">@if ( $member->phone != 0 ) {{ $member->phone }} @else - @endif</td>
          <td class="vertical">{{ $member->is_active }}</td>
          <td class="vertical">{{ date($date_format, strtotime($member->created_at)) }}</td>
          <td class="vertical">{{ date($date_format, strtotime($member->updated_at)) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>