<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'timezone'), function(){
	
	Route::get('/', array('before' => 'product_delete', 'uses' => 'Frontend\HomeController@index', 'as'=>'home'));
	Route::post('change_currency', array('uses' => 'Frontend\HomeController@change_currency'));
	Route::get('home/{name}', array('uses' => 'Frontend\HomeController@pages'));
	Route::get('contact', array('uses' => 'Frontend\HomeController@contact'));
	Route::post('contact_send', array('uses' => 'Frontend\HomeController@contact_send'));
	Route::post('shipment_tracking', array('uses' => 'Frontend\HomeController@shipment_tracking'));
	
	Route::get('products', array('uses' => 'Frontend\ProductController@index', 'as'=>'product.index'));
	Route::get('product/detail/{slug}', array('uses' => 'Frontend\ProductController@detail', 'as'=>'product.detail'));
	Route::post('product/search_other_product', array('uses' => 'Frontend\ProductController@search_other_product', 'as'=>'product.search_other_product'));
	Route::post('product/get_subcategory', array('uses' => 'Frontend\ProductController@get_subcategory'));
	Route::get('products/search', array('uses' => 'Frontend\ProductController@search', 'as'=>'product.search'));
	Route::post('product/add_review', array('uses' => 'Frontend\ProductController@add_review', 'as'=>'product.add_review'));
	Route::get('product/review/{slug}', array('uses' => 'Frontend\ProductController@review', 'as'=>'product.review'));
	
	Route::get('cart', array('uses' => 'CartController@index', 'as'=>'cart.index'));
	Route::post('cart/add', array('uses' => 'CartController@add', 'as'=>'cart.add'));
	Route::post('cart/remove', array('uses' => 'CartController@remove', 'as'=>'cart.remove'));
	Route::post('cart/change_qty', array('uses' => 'CartController@change_qty', 'as'=>'cart.change_qty'));
	Route::post('cart/ajax_guest_login', array('uses' => 'CartController@ajax_guest_login', 'as'=>'cart.ajax_guest_login'));
	Route::post('cart/ajax_member_login', array('uses' => 'CartController@ajax_member_login', 'as'=>'cart.ajax_member_login'));
	Route::get('cart/checkout', array('uses' => 'CartController@checkout', 'as'=>'cart.checkout'));
	Route::get('cart/export_invoice', array('uses' => 'CartController@export_invoice', 'as'=>'cart.export_invoice'));
	
	Route::post('order/add_order', array('uses' => 'Frontend\OrderController@add_order', 'as'=>'order.add_order'));
	Route::post('order/post_payment', array('uses' => 'Frontend\OrderController@post_payment', 'as'=>'order.post_payment'));
	Route::get('order/cancel_payment', array('uses' => 'Frontend\OrderController@cancel_payment', 'as'=>'order.cancel_payment'));
	Route::get('order/success_payment', array('uses' => 'Frontend\OrderController@success_payment', 'as'=>'order.success_payment'));
	Route::get('member/order_history', array('uses' => 'Frontend\OrderController@order_history', 'as'=>'order.order_history'));
	Route::get('order/detail/{bill_no}', array('uses' => 'Frontend\OrderController@detail', 'as'=>'order.detail'));
	
	Route::get('register', array('uses' => 'Frontend\UserController@index', 'as'=>'register.index'));
	Route::post('register/create_member', array('uses' => 'Frontend\UserController@create_member', 'as'=>'register.create_member'));
	Route::get('register/activate_account/{id}', array('uses' => 'Frontend\UserController@activate_account', 'as'=>'register.activate_account'));
	Route::post('register/member_activate/{id}', array('uses' => 'Frontend\UserController@member_activate', 'as'=>'register.member_activate'));
	Route::get('login', array('uses' => 'Frontend\UserController@login', 'as'=>'register.login'));
	Route::post('register/member_login', array('uses' => 'Frontend\UserController@member_login', 'as'=>'register.member_login'));
	Route::get('member/logout', array('uses' => 'Frontend\UserController@member_logout', 'as'=>'member.logout'));
	Route::get('member/forget_password', array('uses' => 'Frontend\UserController@forget', 'as'=>'member.forget'));
	Route::post('member/recover_password', array('uses' => 'Frontend\UserController@recover_password', 'as'=>'member.recover_password'));
	Route::get('member/get_recover/{code}', array('uses' => 'Frontend\UserController@get_recover', 'as'=>'member.get_recover'));
	
	Route::post('member/add_wishlist', array('uses' => 'Frontend\UserController@add_wishlist', 'as'=>'member.add_wishlist'));
	Route::get('member/wishlist', array('uses' => 'Frontend\UserController@wishlist', 'as'=>'member.wishlist'));
	Route::post('member/delete_wishlist', array('uses' => 'Frontend\UserController@delete_wishlist', 'as'=>'member.delete_wishlist'));
	Route::get('member/profile', array('uses' => 'Frontend\UserController@profile', 'as'=>'member.profile'));
	Route::put('member/edit_profile/{id}', array('as' => 'member.edit_profile', 'uses' => 'Frontend\UserController@edit_profile'));
	
	Route::get('login/fb_callback', array('uses' => 'Frontend\UserController@fbCallback', 'as' => 'login.fbCallback'));
	
	Route::get('gallery', array('uses' => 'Frontend\GalleryController@index'));
	
});

	/*---------- START OF ADMIN ROUTE ----------*/
Route::group(array('before' => 'timezone'), function(){

	Route::get('/admin','SessionsController@index');

	//login,logout,forget password
	Route::post('admin/sessions/login','SessionsController@login');
	Route::get('admin/sessions/logout','SessionsController@logout');
	Route::get('admin/sessions/forget','SessionsController@forget');
	Route::get('admin/sessions/getRecover/{code}','SessionsController@getRecover');
	Route::post('admin/sessions/recover_password','SessionsController@recover_password');
	
	//admin valid auth route
	Route::group(array('before' => 'auth'), function(){

		//error pages
		Route::get('admin/error','ErrorController@index');
		Route::get('admin/error/show/{page}','ErrorController@show');
		
		//general setting
		Route::controller('admin/general','GeneralController');
		Route::post('admin/setting/date_format', 'GeneralController@date_format');
		Route::post('admin/setting/change_timezone', 'GeneralController@change_timezone');
		Route::post('admin/setting/change_prefix', 'GeneralController@change_prefix');
		Route::post('admin/setting/change_email', 'GeneralController@change_email');
		Route::post('admin/setting/change_information', 'GeneralController@change_information');
		Route::post('admin/setting/update_cpf_setting','GeneralController@update_cpf_setting');
		Route::post('admin/setting/change_currency', 'GeneralController@change_currency');
		Route::put('admin/setting/update_info', array('as' => 'admin.setting.update_info', 'uses' => 'GeneralController@update_info'));
		Route::post('admin/setting/change_login_attempt','GeneralController@change_login_attempt');

		//Route::get('admin/backend_setting', 'BackendController@index');
		//Route::post('admin/backend_setting/change_currency', 'BackendController@change_currency');
		//Route::put('admin/backend_setting/update_info', array('as' => 'admin.backend_setting.update_info', 'uses' => 'BackendController@update_info'));

		Route::get('admin/home','HomeController@index');
		Route::get('admin/home/back_up','HomeController@back_up');
		
		Route::get('admin/home/getDownload/{filename}', function($filename)
		{
			//check if file exists in app/storage/file folder
		    	$file_path = storage_path() ."\backup\\". $filename;
		    	if(file_exists($file_path)) {
		        		//send Download
		        		return Response::download($file_path, $filename, ['content-type' => 'application/x-sql']);
		    	} else {
		        		//error
		        		exit('Requested file does not exist on our server!');
		    	}
		})->where('filename', '[A-Za-z0-9\-\_\.]+');

		//backup module
		Route::get('admin/home/back_up_now','HomeController@back_up_now');

		//user ,permission and role modules
		Route::resource('admin/user','UserController');

		Route::resource('admin/member','MemberController');
		Route::post('admin/member/is_active', 'MemberController@is_active');
		Route::get('admin/members/report_pdf', 'MemberController@report_pdf');
		Route::get('admin/members/report_excel', 'MemberController@report_excel');

		Route::resource('admin/module','ModuleController');
		Route::resource('admin/role','RoleController');
		Route::post('admin/role/get_role/{id}','RoleController@get_role');
		Route::resource('admin/permission','PermissionController');
		Route::get('admin/permission/delete/{id}', 'PermissionController@delete');
		Route::post('admin/permission/add_sub_permission','PermissionController@add_sub_permission');
		Route::post('admin/permission/getPermissionByRole/{id}/true','PermissionController@getPermissionByRole');
		
		//category module
		Route::resource('admin/category','CategoryController');
		Route::post('admin/category/get_subcategory', array('as' => 'category.get_subcategory', 'uses' => 'CategoryController@get_subcategory'));
		Route::get('admin/category_list/report_pdf', 'CategoryController@report_pdf');
		Route::get('admin/category_list/report_excel', 'CategoryController@report_excel');

		//subcategory module
		Route::resource('admin/subcategory','SubcategoryController');
		Route::get('admin/subcategory_list/report_pdf', 'SubcategoryController@report_pdf');
		Route::get('admin/subcategory_list/report_excel', 'SubcategoryController@report_excel');

		//brand module
		Route::resource('admin/brand','BrandController');
		Route::post('admin/brand/delete_image/{id}', 'BrandController@delete_image');
		Route::get('admin/brands/report_pdf', 'BrandController@report_pdf');
		Route::get('admin/brands/report_excel', 'BrandController@report_excel');

		//product information module
		Route::resource('admin/product_info','Product_infoController');

		//product color module
		Route::resource('admin/color','ColorController');
		Route::post('admin/color/delete_image/{id}', 'ColorController@delete_image');

		//product size module
		Route::resource('admin/size','SizeController');

		//product length module
		Route::resource('admin/length','LengthController');

		//product weight module
		Route::resource('admin/weight','WeightController');

		//product country module
		Route::resource('admin/country','CountryController');
		Route::post('admin/country/delete_image/{id}', 'CountryController@delete_image');
		
		//fuel module
		Route::resource('admin/fuel','FuelController');
		
		//product module
		Route::resource('admin/product','ProductController');
		Route::post('admin/product/addto_recycle/{id}', array('as' => 'admin.product.addto_recycle', 'uses' => 'ProductController@addto_recycle'));
		Route::get('admin/products/recycle_bin', array('as' => 'admin.product.recycle_bin', 'uses' => 'ProductController@recycle_bin'));
		Route::post('admin/product/delete_image/{id}', 'ProductController@delete_image');
		Route::get('admin/product/image_rearrange/{id}', 'ProductController@image_rearrange');
		Route::post('admin/product/update_discount_ajax', array('as' => 'admin.product.update_discount_ajax', 'uses' => 'ProductController@update_discount_ajax'));
		Route::post('admin/product/restore_product', 'ProductController@restore_product');
		Route::get('admin/products/report_pdf', 'ProductController@report_pdf');
		Route::get('admin/products/report_excel', 'ProductController@report_excel');
		Route::post('admin/product/clone_product/{id}', array('as' => 'admin.product.clone_product', 'uses' => 'ProductController@clone_product'));
		
		Route::put('admin/product/image_rearrange_update/{id}', array('as' => 'product.image_rearrange.update', 'uses' => 'ProductController@image_rearrange_update'));

		//discount module
		Route::resource('admin/discount','DiscountController');
		Route::post('admin/discount/is_active', 'DiscountController@is_active');

		//order module
		Route::resource('admin/order','OrderController');
		Route::post('admin/order/addto_cancel/{bill_no}', array('as' => 'admin.order.addto_cancel', 'uses' => 'OrderController@addto_cancel'));
		Route::get('admin/orders/cancel_list', array('as' => 'admin.order.cancel_list', 'uses' => 'OrderController@cancel_list'));
		Route::post('admin/order/restore_order', 'OrderController@restore_order');
		Route::get('admin/order/order_payment/{bill_no}', array('as' => 'admin.order.order_payment', 'uses' => 'OrderController@order_payment'));
		Route::post('admin/order/add_payment/{bill_no}', 'OrderController@add_payment');
		Route::get('admin/order/view_receipt/{bill_no}', 'OrderController@view_receipt');
		Route::get('admin/order/export_receipt/{bill_no}', 'OrderController@export_receipt');
		Route::post('admin/order/send_receipt/{bill_no}', 'OrderController@send_receipt');
		Route::get('admin/orders/report_pdf', 'OrderController@report_pdf');
		Route::get('admin/orders/report_excel', 'OrderController@report_excel');

		//shipping module
		Route::resource('admin/shipping','ShippingController');
		Route::post('admin/shipping/is_active', 'ShippingController@is_active');

		//gst module
		Route::resource('admin/gst','GstController');
		Route::post('admin/gst/is_apply', 'GstController@is_apply');
		Route::post('admin/gst/update_gst_ajax', 'GstController@update_gst_ajax');

		//slider module
		Route::resource('admin/slider','SliderController');
		Route::post('admin/slider/delete_image/{id}', 'SliderController@delete_image');
		
		//Offline sale module
		Route::resource('admin/offline_sale','OfflineController');
		Route::post('admin/offline_sale/get_member', 'OfflineController@get_member');
		Route::post('admin/offline_sale/get_product', 'OfflineController@get_product');
		Route::post('admin/offline_sale/get_product_qty', 'OfflineController@get_product_qty');
		Route::get('admin/offline_sale_list/report_pdf', 'OfflineController@report_pdf');
		Route::get('admin/offline_sale_list/report_excel', 'OfflineController@report_excel');
		
		//expense module
		Route::resource('admin/expense','ExpenseController');
		Route::post('admin/expense/get_expense', 'ExpenseController@get_expense');
		Route::get('admin/expenses/report_pdf', 'ExpenseController@report_pdf');
		Route::get('admin/expenses/report_excel', 'ExpenseController@report_excel');

		//income module
		Route::resource('admin/income','IncomeController');
		Route::post('admin/income/get_income', 'IncomeController@get_income');
		Route::get('admin/incomes/report_pdf', 'IncomeController@report_pdf');
		Route::get('admin/incomes/report_excel', 'IncomeController@report_excel');

		//stock module
		Route::resource('admin/stock','StockController');
		Route::get('admin/stocks/report_pdf', 'StockController@report_pdf');
		Route::get('admin/stocks/report_excel', 'StockController@report_excel');
		
		//profit and loss module
		Route::resource('admin/profitandloss','ProfitandlossController');

		//review module
		Route::resource('admin/reviews','ReviewController');

		//gallery module
		Route::resource('admin/gallery','GalleryController');
		Route::get('admin/facebook_gallery/edit/{id}','GalleryController@edit_facebook_id');
		Route::put('admin/facebook_gallery/update/{id}', array('as' => 'admin.fbgallery.update', 'uses' => 'GalleryController@update_facebook_id'));
		Route::post('admin/gallery/is_active','GalleryController@is_active');
		Route::get('admin/galleries/list','GalleryController@gallery_list');
		Route::post('admin/gallery/delete_image/{id}', 'GalleryController@delete_image');

		//pages module
		Route::resource('admin/pages','PageController');
		Route::post('admin/pages/delete_image/{id}', 'PageController@delete_image');
		
		//footer cms
		Route::resource('admin/footer_cms','FooterController');
		Route::get('admin/footer/menu','FooterController@footer_menu');
		Route::post('admin/footer/is_active','FooterController@is_active');
		Route::get('admin/footer/order_menu','FooterController@order_menu');
		Route::post('admin/footer/save_menu','FooterController@save_menu');

		//header cms
		Route::resource('admin/header_cms','HeaderController');
		Route::post('admin/header/is_active','HeaderController@is_active');
		Route::post('admin/header/save_menu','HeaderController@save_menu');

		//staff cms
		Route::get('admin/staff/change_status/{id}/{status}','StaffController@change_status');
		Route::get('admin/staff/get_staffs/{id}','StaffController@get_staffs');
		Route::get('admin/staff/remove_attribute/{id}/{attr}','StaffController@remove_attribute');
		Route::post('admin/staff/update_staff_info','StaffController@update_staff_info');
		Route::post('admin/staff/add_new_attribute','StaffController@add_new_attribute');
		Route::post('admin/staff/upload/{id}/{file}','StaffController@upload');
		Route::get('admin/staff/payroll','StaffController@payroll');
		Route::get('admin/staff/pay/{id}/{month}','StaffController@pay');
		Route::post('admin/staff/save_payment/{id}/{month}','StaffController@save_payment');
		Route::resource('admin/staff','StaffController');
		
		//for salary payment
		Route::get('admin/salary_payment/salary_record','Salary_paymentController@salary_record');
		Route::get('admin/salary_payment/salary_list/{date}','Salary_paymentController@salary_list');
		Route::resource('admin/salary_payment','Salary_paymentController');
		
		//for cpf
		Route::get('admin/cpf/create/{month}','CpfController@create');
		Route::resource('admin/cpf','CpfController');
		
	});
});
	/*---------- END OF ADMIN ROUTE ----------*/

?>