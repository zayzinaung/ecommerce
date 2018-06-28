<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
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
          <td><p style="margin-left:250px">Address : {{ $invoice->address }}</p><p style="margin-left:250px">Phone : {{ $invoice->phone }}</p></td>
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

    <?php $i = 0; ?>
    @foreach ( Cart::content() as $c )
    <tr class="product">
          <?php $i++; ?>
          <td class="vertical">{{ $i }}</td>
          <td class="vertical"><img src="{{ URL::to('/uploads/products/'.$c->options->image->image) }}" alt="{{ $c->name }}" width="50"></td>
          <td class="vertical">{{ $c->name }}</td>
          <td class="vertical" style="text-align:center">{{ $c->options->product_no }}</td>
          <td class="vertical" style="text-align:center">{{ $c->qty }}</td>
          <td class="vertical">S${{ $c->price }}</td>
          <td class="vertical">S${{ number_format((float)$c->qty * $c->price, 2, '.', '') }}</td>
    </tr>
    @endforeach
    </tbody>

    <tbody style="border-top:2px solid #333">
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Buying Total</td>
              <td> </td>
              <td>S${{ number_format((float)Cart::total(), 2, '.', '') }}</td>
          </tr>
    </tbody>

    @if ( $discount_amount != 0 )
    <tbody>
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Discount</td>
              <td> </td>
              <td>{{ $discount_amount }} %</td>
          </tr>
    </tbody>
    @endif

    @if ( $gst != 0 )
    <tbody>
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">GST</td>
              <td> </td>
              <td>{{ $gst }} %</td>
          </tr>
    </tbody>
    @endif

    <tbody style="border-top:2px solid #333;border-bottom:2px solid #333;">
          <tr>
              <td colspan="5" style="font-weight:bold;text-align:right;">Overall Total</td>
              <td> </td>
              <td style="font-weight:bold;font-size:18px;color:#35aa47">S${{ $overall_total }}</td>
          </tr>
    </tbody>
    
    @if ( $amount != '' )
    <tbody>
          <tr>
              <td colspan="7" style="color:red">** If you're choosing charges shipping, you need to pay the shipping costs S${{ $amount }} **</td>
          </tr>
    </tbody>
    @endif
    
    <tbody>
          <tr>
              <td colspan="7">{{ $invoice->description }}</td>
          </tr>
    </tbody>

    <tbody>
          <tr>
              <td colspan="7">{{ $invoice->position }}</td>
          </tr>
    </tbody>

    <tbody>
          <tr>
              <td colspan="7">{{ $invoice->name }}</td>
          </tr>
    </tbody>

    @if ( $invoice->sign != null )
    <tbody>
          <tr>
              <td colspan="7"><img src="{{ URL::to('/uploads/sign/'.$invoice->sign) }}"></td>
          </tr>
    </tbody>
    @endif

    </table>
    
</body>
</html>