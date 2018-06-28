<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Products</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="{{ URL::to('/frontend/img/favicon.png') }}">
  <style type="text/css" media="screen">
    table.collapse { border-collapse: collapse; border: 1pt solid black; }
    table.collapse td { border: 1pt solid black; padding: 6px; font-size: 14px; }
    table.collapse th { border: 1pt solid black; padding: 6px; font-size: 14px; }
  </style>
</head>
<body>
    <h3 style="margin-bottom:15px;text-align:center;text-decoration:underline;">Product Report</h3>
    <table class="collapse">
    <thead>
          <tr>
              <th style="width:1%">#</th>
              <th style="width:23%">Product Name</th>
              <th style="width:10%">Product No</th>
              <th style="width:10%">Subcategory</th>
              <th style="width:10%">Quantity</th>
              <th style="width:10%">Used Quantity</th>
              <th style="width:10%">Left Quantity</th>
              <th style="width:10%">Price</th>
              <th style="width:17%">Created at</th>
          </tr>
    </thead>
    <tbody>

    <?php $i = 0; ?>
    @foreach ( $products as $product )
    <tr class="product">
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical">{{ $product->product_name }}</td>
          <td class="vertical" style="text-align:center">{{ $product->product_no }}</td>
          <td class="vertical">{{ $product->subcategory_name }}</td>
          <td class="vertical" style="text-align:center">{{ $product->quantity }}</td>
          <td class="vertical" style="text-align:center">{{ $product->quantity_use }}</td>
          <?php $qty = $product->quantity - $product->quantity_use; ?>
          <td class="vertical" style="text-align:center">{{ $qty }}</td>
          <td class="vertical">{{ $currency }} {{ $product->price }}</td>
          <td class="vertical">{{ date($date_format, strtotime($product->create)) }}</td>
    </tr>
    @endforeach
    </tbody>

    </table>
    
</body>
</html>