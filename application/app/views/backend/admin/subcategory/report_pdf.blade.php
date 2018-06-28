<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Subcategory</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { width:100%; border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Subcategory Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:30%;text-align:left;">Category Name</th>
              <th style="width:30%;text-align:left;">Subcategory Name</th>
              <th style="width:20%;text-align:left;">Created at</th>
              <th style="width:20%;text-align:left;">Updated at</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; ?>
    @foreach ( $subcategories as $subcategory )
    <tr>
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $subcategory->category_name }}</td>
          <td class="vertical">{{ $subcategory->subcategory_name }}</td>
          <td class="vertical">{{ date($date_format, strtotime($subcategory->create)) }}</td>
          <td class="vertical">{{ date($date_format, strtotime($subcategory->update)) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>