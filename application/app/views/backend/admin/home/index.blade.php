@extends('backend.template.template')
@section('content')
<div class="page-content">
	<h3 class="page-title">
		Dashboard <small>dashboard & statistics</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span> Home
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Dashboard</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-12 table-responsive">
			<div class="portlet box  blue-madison">
				<div class="portlet-title">
					<div class="caption">
						<span aria-hidden="true" class="icon-bar-chart"></span> Yearly Profit / Loss For Current Year ( {{ date('Y'); }} )
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div id="chart_2" class="chart"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		@if(User::hasPermTo('user'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue-hoki">
				<div class="visual">
					<i class="fa fa-user"></i>
				</div>
				<div class="details">
					<div class="number">
						User
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/user')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('product'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue-madison">
				<div class="visual">
					<i class="fa fa-list-ul"></i>
				</div>
				<div class="details">
					<div class="number">
						Product
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/product')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('discount'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat green-meadow">
				<div class="visual">
					<i class="fa fa-link"></i>
				</div>
				<div class="details">
					<div class="number">
						Discount
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/discount')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('shipping'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat red-sunglo">
				<div class="visual">
					<i class="fa fa-truck"></i>
				</div>
				<div class="details">
					<div class="number">
						Shipping
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/shipping')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('member'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat yellow-crusta">
				<div class="visual">
					<i class="fa fa-users"></i>
				</div>
				<div class="details">
					<div class="number">
						Member
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/member')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('order'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat purple-plum">
				<div class="visual">
					<i class="fa fa-shopping-cart"></i>
				</div>
				<div class="details">
					<div class="number">
						Order
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/order')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('gst'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat grey-cascade">
				<div class="visual">
					<i class="fa fa-paperclip"></i>
				</div>
				<div class="details">
					<div class="number">
						GST
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/gst')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif

		@if(User::hasPermTo('slider'))
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat purple">
				<div class="visual">
					<i class="fa fa-sliders"></i>
				</div>
				<div class="details">
					<div class="number">
						Slider
					</div>
					<div class="desc">
						Management
					</div>
				</div>
				<a class="more" href="{{URL::to('/admin/slider')}}">
					View <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
		@endif
	</div>

</div>
@stop