@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">
.white {
  color: #fff!important;
  text-decoration: none;
}
.white:hover {
  color: #fff;
  text-decoration: none;
}
.title-wrapper {
  min-height: 75px!important;
  padding-top: 25px!important;
}
.container h1 {
  border-bottom: 0px!important;
  font-size: 22px!important;
}
</style>
@stop

@section('title')
Global Ecommerce | Order History
@stop

@section('content')

<div class="title-wrapper">
    <div class="container"><div class="container-inner">
          <h1>Member Order History</h1>
    </div></div>
</div>

<div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1></h1>
            @if ( count($orders) != 0 )
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Order History">
                  <tr>
                      <th style="width:1%">#</th>
                 <th style="width:18%">Consignment No.</th>
                  <th style="width:12%">Bill no</th>
                  <th style="width:12%">Order Date</th>
                  <th style="width:10%">MOP</th>
                  <th style="width:15%">Payment Status</th>
                    <th style="width:18%">Shipment Status</th>
                  <th style="width:9%">Status</th>
                  <th style="width:1%">View Detail</th>
                  </tr>
                  <?php $i=1; $prefix = Common::get_prefix(); ?>
                  @foreach ( $orders as $row )
                  <tr>
                    <td>{{ $i++ }}</td>
                    <?php $time = strtotime($row->order_date); $date = date($date_format,$time); ?>
                    <td>{{ $prefix }}-{{ $date }}-{{ $row->bill_no }}</td>
                    <td>{{ $row->bill_no }}</td>
                    <td>{{ $date }}</td>
                    <td>{{ ucfirst($row->payment_method) }}</td>
                  
                    <td style="color:#FF0707;font-size:16px;">
                    @if ( $row->payment_method != 'paypal' )
                          @if ( $row->cash == 0 && $row->cheque == null && $row->other == null && $row->enet == null )
                              Unpaid
                          @else
                              Paid
                          @endif
                    @else
                          Paid
                    @endif
                    </td>

                    <td>
                    <?php $level = Shipment_level::find($row->shipment_level); ?>
                    @if ( $level != null )
                      <span data-toggle="tooltip" data-placement="top" data-original-title="{{ $level->level_status_message; }}" style="cursor:pointer">Free Shipping</span>
                    @else
                      @if ( $row->courier_name == null && $row->courier_no == null && $row->delivered_on == 0 )
                        <span data-toggle="tooltip" data-placement="top" data-original-title="{{ $stage->level_status_message }}" style="cursor:pointer">Charges Shipping</span>
                      @else
                        <span data-toggle="tooltip" data-placement="top" data-original-title="{{ $stage3->level_status_message }}" style="cursor:pointer">Charges Shipping</span>
                      @endif
                    @endif
                    </td>

                    <td style="color:#FF0707;font-size:16px;">
                    @if ( $row->cash == 0 && $row->cheque == null && $row->other == null && $row->enet == null )
                          Uncomplete
                    @else
                          Complete
                    @endif
                    </td>

                  <td>
                          {{ Form::open(array('method' => 'GET', 'route' => array('order.detail', strtolower($row->bill_no)))) }}
                          <button class="btn btn-primary" type="submit"><i class="fa fa-eye"></i></button>
                          {{ Form::close() }}
                    </td>
                  </tr>
                  @endforeach
                </table>

                </div>

              </div>
            </div>
            {{ $orders->links() }}
            @else
              <h2>There is no order history.</h2>
            @endif
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

      </div>
    </div>

@stop