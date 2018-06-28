@extends('frontend.template.template')

@section('title')
Global Ecommerce | 404
@stop

@section('content')

<div class="main corporate">
<div class="container">
<!-- BEGIN SIDEBAR & CONTENT -->
        	<div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            	<div class="content-page page-404">
               	<div class="number">
                  		404
               	</div>
               	<div class="details">
                  		<h3>Oops!  You're lost.</h3>
                  		<p>
                     		We can't find the page you're looking for.<br>
                     		<a href="{{ URL::to('/') }}" class="link">Return Home</a>
                  		</p>
               	</div>
            	</div>
          </div>
          <!-- END CONTENT -->
        	</div>
<!-- END SIDEBAR & CONTENT -->
</div>
</div>

@stop

