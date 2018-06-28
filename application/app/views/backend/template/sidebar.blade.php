<div class="page-sidebar navbar-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->
	<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
		
		<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
		<li class="sidebar-toggler-wrapper">
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class="sidebar-toggler"></div>
			<!-- END SIDEBAR TOGGLER BUTTON -->
		</li>
			
		<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
		<li class="sidebar-search-wrapper">
			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
			<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
			<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
			<!-- END RESPONSIVE QUICK SEARCH FORM -->
		</li>

		<li class="start <?php echo(Request::segment(2)== 'home' && Request::segment(3) != 'back_up' && Request::segment(2) != 'general')?'active':''; ?>">
			<a href="{{URL::to('admin/home')}}">
				<span aria-hidden="true" class="icon-home"></span>
				<span class="title">Dashboard</span>
				<span class="selected"></span>
			</a>
		</li>

		@if(User::hasPermTo('general'))
		<li class="<?php echo(Request::segment(2)== 'general' )?'active':''; ?>">
			<a href="{{URL::to('admin/general')}}">
				<span aria-hidden="true" class="icon-settings"></span>
				<span class="title">Setting</span>
				<span class="selected"></span>
			</a>
		</li>
		@endif

		@if(User::hasPermTo('backup'))
		<li class="<?php echo(Request::segment(3)== 'back_up' )?'active':''; ?>">
			<a href="{{URL::to('admin/home/back_up')}}">
				<span aria-hidden="true" class="icon-layers"></span>
				<span class="title">System Backup</span>
				<span class="selected"></span>
			</a>
		</li>
		@endif
		
		@if(User::hasPermTo('country'))
		<li class="<?php echo(Request::segment(2)== 'country' )?'active':''; ?>">
			<a href="{{URL::to('admin/country')}}">
			<span aria-hidden="true" class="icon-flag"></span>
			<span class="title">Country</span>
			<span class="selected"></span>
			</a>
		</li>
		@endif

		@if(User::hasPermTo('user'))
		<li>
			<a href="javascript:;">
				<span aria-hidden="true" class="icon-user"></span>
				<span class="title">User</span>
				<span class="selected"></span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{URL::to('admin/module')}}">Module List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/role')}}">Role List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/user')}}">User List</a>
				</li>
			</ul>
		</li>
		@endif

		@if(User::hasPermTo('staff'))
		<li>
			<a href="javascript:;">
				<span aria-hidden="true" class="icon-emoticon-smile"></span>
				<span class="title">Staff</span>
				<span class="selected"></span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{URL::to('admin/staff')}}"><span aria-hidden="true" class="icon-emoticon-smile"></span> Staff List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/staff/payroll')}}"><span aria-hidden="true" class="icon-credit-card"></span> Payroll List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/salary_payment')}}"><span aria-hidden="true" class="icon-disc"></span> Payroll Records</a>
				</li>
			</ul>
		</li>
		@endif

		@if(User::hasPermTo('member'))
		<li class="<?php echo(Request::segment(2)== 'member' )?'active':''; ?>">
			<a href="{{URL::to('admin/member')}}">
			<span aria-hidden="true" class="icon-users"></span>
			<span class="title">Members</span>
			<span class="selected"></span>
			</a>
		</li>
		@endif

		<li>
			<a href="javascript:;">
				<span aria-hidden="true" class="icon-list"></span>
				<span class="title">Product Information</span>
				<span class="selected"></span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
			@if(User::hasPermTo('category'))
				<li>
					<a href="{{URL::to('admin/category')}}">Category List</a>
				</li>
			@endif
			@if(User::hasPermTo('subcategory'))
				<li>
					<a href="{{URL::to('admin/subcategory')}}">Subcategory List</a>
				</li>
			@endif
			@if(User::hasPermTo('brand'))
				<li>
					<a href="{{URL::to('admin/brand')}}">Brand List</a>
				</li>
			@endif
			@if(User::hasPermTo('product_info'))
				<li>
					<a href="{{URL::to('admin/product_info')}}">Product Info List</a>
				</li>
			@endif
			@if(User::hasPermTo('product'))
				<li>
					<a href="{{URL::to('admin/product')}}">Product List</a>
				</li>
			@endif
			</ul>
		</li>

		@if(User::hasPermTo('review'))
		<li class="<?php echo(Request::segment(2)== 'reviews' )?'active':''; ?>">
			<a href="{{URL::to('admin/reviews')}}">
			<span aria-hidden="true" class="icon-star"></span>
			<span class="title">Reviews</span>
			<span class="selected"></span>
			</a>
		</li>
		@endif

		@if(User::hasPermTo('discount'))
		<li class="<?php echo(Request::segment(2)== 'discount' )?'active':''; ?>">
			<a href="{{URL::to('admin/discount')}}">
				<span aria-hidden="true" class="icon-link"></span>
				<span class="title">Discount Method</span>
				<span class="selected"></span>
			</a>
		</li>
		@endif

		@if(User::hasPermTo('shipping'))
		<li class="<?php echo(Request::segment(2)== 'shipping' )?'active':''; ?>">
			<a href="{{URL::to('admin/shipping')}}">
				<span aria-hidden="true" class="icon-directions"></span>
				<span class="title">Shipping Method</span>
				<span class="selected"></span>
			</a>
		</li>
		@endif
		
		@if(User::hasPermTo('gst'))
		<li class="<?php echo(Request::segment(2)== 'gst' )?'active':''; ?>">
			<a href="{{URL::to('admin/gst')}}">
				<span aria-hidden="true" class="icon-paper-clip"></span>
				<span class="title">GST Method</span>
				<span class="selected"></span>
			</a>
		</li>
		@endif

		@if(User::hasPermTo('order'))
		<li>
			<a href="javascript:;">
				<span aria-hidden="true" class="icon-basket-loaded"></span>
				<span class="title">Order Information</span>
				<span class="selected"></span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{URL::to('admin/order')}}">Order List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/offline_sale')}}">Offline Sale List</a>
				</li>
			</ul>
		</li>
		@endif

		@if(User::hasPermTo('account'))
		<li>
			<a href="javascript:;">
				<span aria-hidden="true" class="icon-calculator"></span>
				<span class="title">Account</span>
				<span class="selected"></span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{URL::to('admin/stock')}}">Stocks List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/expense')}}">Expenses List</a>
				</li>
				<li>
					<a href="{{URL::to('admin/income')}}">Other Incomes List</a>
				</li>
			</ul>
		</li>
		@endif

		@if(User::hasPermTo('profitandloss'))
		<li class="<?php echo(Request::segment(2)== 'profitandloss' )?'active':''; ?>">
			<a href="{{URL::to('admin/profitandloss')}}">
				<span aria-hidden="true" class="icon-wallet"></span>
				<span class="title">Profit and Loss</span>
				<span class="selected"></span>
			</a>
		</li>
		@endif

		@if(User::hasPermTo('slider'))
		<li>
			<a href="javascript:;">
				<span aria-hidden="true" class="icon-briefcase"></span>
				<span class="title">CMS</span>
				<span class="selected"></span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{URL::to('admin/header_cms')}}"><span aria-hidden="true" class="icon-notebook"></span> Header CMS</a>
				</li>
				<li>
					<a href="{{URL::to('admin/slider')}}"><span aria-hidden="true" class="icon-equalizer"></span> Slider</a>
				</li>
				<li>
					<a href="{{URL::to('admin/gallery')}}"><span aria-hidden="true" class="icon-grid"></span> Gallery</a>
				</li>
				<li>
					<a href="{{URL::to('admin/pages')}}"><span aria-hidden="true" class="icon-docs"></span> Pages</a>
				</li>
				<li>
					<a href="{{URL::to('admin/footer_cms')}}"><span aria-hidden="true" class="icon-compass"></span> Footer CMS</a>
				</li>
			</ul>
		</li>
		@endif
		
	</ul>
	<!-- END SIDEBAR MENU -->
</div>