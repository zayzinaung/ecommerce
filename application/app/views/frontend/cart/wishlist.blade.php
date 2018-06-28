@extends('frontend.template.template')

@section('style')
<style type="text/css" media="screen">
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
Global Ecommerce | Wishlist
@stop

@section('content')

<div class="title-wrapper">
    <div class="container"><div class="container-inner">
          <h1>Your Wishlist</h1>
    </div></div>
</div>

<div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1></h1>
            @if ( $product != '' )
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Title</th>
                    <th class="goods-page-ref-no">Product No</th>
                    <th class="goods-page-price">Unit price</th>
                    <th>Remove from wishlist</th>
                  </tr>

                  @foreach ( $product as $p )
                  <tr id = "{{$p->pid}}">
                    <td class="goods-page-image">
                      <a href="{{ URL::to('product/detail/'.$p->slug) }}"><img src="{{ URL::to('/uploads/products/'.$p->image) }}" alt="{{ $p->product_name }}"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="{{ URL::to('product/detail/'.$p->slug) }}">{{ $p->product_name }}</a></h3>
                      <!--p><strong>Item 1</strong> - Color: Green; Size: S</p>
                      <em>More info is here</em-->
                    </td>
                    <td class="goods-page-ref-no">
                      {{ $p->product_no }}
                    </td>
                    
                    <?php $currency_val = Common::convert_currency(); ?>
                    <td class="goods-page-price">
                      @if ( Session::has('currency_type') )
                        @if ( Session::get('currency_type') == 'MMK' )
                               <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format(round($p->price * $currency_val )) }}</strong>
                        @else
                              <strong><span>{{ Session::get('currency_symbol') }} </span>{{ number_format((float)$p->price * $currency_val, 2, '.', '') }}</strong>
                        @endif
                      @else
                              <strong><span>{{ $currency_symbol }} </span>{{ $p->price * $currency_val }}</strong>
                      @endif
                    </td>
                    <td>
                       <button type="button" class="btn delete_wishlist" data-id="{{ $p->pid }}" style="background:transparent"><i class="fa fa-trash-o" style="font-size:17px;color:grey;"></i></button>
                    </td>
                  </tr>
                  @endforeach

                </table>
                </div>

              </div>
            </div>
            @else
              <h2>There is no product in your wishlist!</h2>
            @endif
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

      </div>
    </div>

@stop

@section('scripts')
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
      $('.delete_wishlist').click(function(){
        
        var ele = $(this);
        var pid = ele.attr('data-id');

        ele.html("<img src='{{ URL::to('frontend/img/loading.gif') }}'>");
        $("#"+pid).css("background-color", "rgba(255, 0, 0, 0.1)");

        var param = {
            id: pid
        };
        
        $.post("{{ URL::to('member/delete_wishlist') }}", param, function (data) {
          if (data.status == 'success') {
            $('#'+pid).fadeOut();
          } else {

          }
        }, 'JSON');
      });
});
</script>
@stop