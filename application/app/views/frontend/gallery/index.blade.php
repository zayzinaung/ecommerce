@extends('frontend.template.template')

@section('style')
{{ HTML::style('frontend/css/gallery.css') }}
<style type="text/css" media="screen">
.title-wrapper {
  min-height: 75px!important;
  padding-top: 25px!important;
}
.container h1 {
  float: left;
  border-bottom: 0px!important;
  font-size: 22px!important;
}
.pagination {
  width: 100%;
  text-align: center;
  margin-top: 30px;
}
</style>
@stop

@section('title')
Global Ecommerce | Gallery
@stop

@section('content')
<div class="title-wrapper">
    <div class="container"><div class="container-inner">
          <h1>Gallery</h1>
    </div></div>
</div>

<div class="main">
    <div class="container">
          <ul class="breadcrumb">
              <li><a href="{{ URL::to('') }}">Home</a></li>
              <li class="active">Gallery</li>
          </ul>

          <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">

              <div class="row margin-bottom-40">

                @if ( $get_gallery->format == 'active' )
                    @if ( count($gallery) != 0 )
                    @foreach ( $gallery as $g )
                    <div class="col-md-3 col-sm-4 gallery-item">
                          <a data-rel="fancybox-button" title="{{ $g->name }}" href="{{ URL::to('uploads/gallery/'.$g->image) }}" class="fancybox-button">
                          <img alt="{{ $g->alt }}" src="{{ URL::to('uploads/gallery/'.$g->image) }}" title="{{ $g->title }}" width="263" height="263">
                          <div class="zoomix"><i class="fa fa-search"></i></div>
                          </a> 
                    </div>
                    @endforeach
                    @endif
                    {{ $gallery->links() }}
                @endif

                @if ( $get_fbgallery->format == 'active' )
                    <iframe scrolling="no" marginheight="0" style="height: 805px;padding:20px;" src="http://facebookgalleria.com/gallery.php?id={{ $fb_id->facebook_id }}&rows=4&margin=10&cols=6&width=170&font_size=11&title_color=000000&hide_next_back=0&share_buttons=1&shape=rectangle&frame=1" frameborder="0" width="100%"></iframe>
                @endif

              </div>
              
          </div>
          </div>
          
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop