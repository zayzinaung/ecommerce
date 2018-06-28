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
.container h2 {
  text-transform: none;
  text-align: center;
  margin-bottom: 30px;
}
.container a {
  text-decoration: none;
  color: #fff;
}
</style>
@stop

@section('title')
Global Ecommerce | Search Error
@stop


@section('content')

<div class="title-wrapper">
    <div class="container"><div class="container-inner">
          <h1>Search Error</h1>
    </div></div>
</div>

<div class="main">
    <div class="container">
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
          <h1></h1>
          <div class="goods-page">
              <div class="goods-data clearfix">
              <div class="table-wrapper-responsive" style="text-align:center">
                    <h2>Sorry, your searching product does not exist.</h2>
                    <button type="submit" class="btn btn-info"><a href="{{ URL::previous() }}"><i class="fa fa-long-arrow-left"></i> Go Back</a></button>
                    
              </div>
              </div>
          </div>
          </div>
    </div>
    </div>
</div>

@stop