<?php

class CartController extends BaseController {
	
	public function index()
	{
		$currency_symbol = Common::get_currency_format();
		$get = General_setting::find(6);
		$currency_format = $get->format;

		return View::make('frontend.cart.index', compact('currency_format','currency_symbol'));
	}
	
	public function add()
	{
		$id = Input::get('pid');
		$qty = Input::get('quantity');
		$product = Product::findOrFail($id);
		$image = Common::query_single_data('product_images','product_id',$id,'image');
		
		$discount = number_format((float)( $product->price * $product->discount ) / 100, 2, '.', '');
		$sale_price = number_format((float)$product->price - $discount, 2, '.', '');

                    	if ( $discount != 0.00 )
                    	{
                    		$price = $sale_price;
                    	} else {
                    		$price = $product->price;
                    	}	
                    	$item = array(
		          'id' => $product->id,
		          'name' => $product->product_name,
		          'qty' => $qty,
		          'price' => $price,
		          'options' => array(
		                    	'slug' => $product->slug,
		                    	'product_no' => $product->product_no,
		                    	'image' => $image,
		                    	'quantity' => $product->quantity,
		                    	'quantity_use' => $product->quntity_use,
		                    	'discount' => $product->discount
		          )
	          );
		
                	Cart::add($item);

                	return Redirect::to('cart');
	}
	
	public function remove()
	{
		$rowid = Input::get('row_id');
		Cart::remove($rowid);
		return Redirect::to('cart');
	}
	
	public function change_qty()
	{
		$id = Input::get('id');
        		$q = Input::get('qty');
        		$subtotal = Input::get('subtotal');
        		$subid = Input::get('subtotalid');
        		$total = Cart::total();

        		Cart::update($id, array('qty' => $q));

        		$update = array(
            		'rowid' => $id,
            		'qty' => $q,
            		'subtotal' => $subtotal
        		);

        		$data['status'] = 'success';
		$data['result'] = $update;
		$data['newsubtotal'] = $subtotal;
		$data['subid'] = $subid;
		$data['total'] = $total;
		echo json_encode($data);
	}
	
	public function ajax_guest_login()
	{
		$errors = array();
        		$data = array();

        		$name = Input::get('name');
        		$guest_email = Input::get('guest_email');
        		$phone = Input::get('phone');
        		$address = Input::get('address');

        		if (empty($name)) {
            		$errors['name'] = 'This field is required.';
        		}
        		if (empty($guest_email)) {
            		$errors['guest_email'] = 'This field is required.';
        		}
        		if (empty($phone)) {
            		$errors['phone'] = 'This field is required.';
        		}
        		if (empty($address)) {
            		$errors['address'] = 'This field is required.';
        		}
        		
        		if ( ! empty($errors)) {
	            	$data['status'] = 'fail';
	            	$data['errors']  = $errors;
	        	} else {
	        		if (!filter_var($guest_email, FILTER_VALIDATE_EMAIL)) {
				$data['email_error'] = "Not a valid email address";
			} else {
				Session::put('login_type', 'guest');
				Session::put('guest_name', $name);
				Session::put('guest_email', $guest_email);
				Session::put('guest_phone', $phone);
				Session::put('guest_address', $address);

				$data['status'] = 'success';
	            		$data['email'] = $guest_email;
			}
	        	}

	        	echo json_encode($data);
	}

	public function ajax_member_login()
	{
		$errors = array();
        		$data = array();

        		$email = Input::get('email');
        		$password = Input::get('password');

        		if ( Session::get('user_id') != null )
        		{
        			$data['status'] = 'login';
        		} else {

	        		if (empty($email)) {
	            		$errors['email'] = 'This field is required.';
	        		}

	        		if (empty($password)) {
		            	$errors['password'] = 'This field is required.';
		        	}

	        		if ( ! empty($errors)) {
		            	$data['status'] = 'fail';
		            	$data['errors']  = $errors;
		        	} else {
		        		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
				{
					$check_active = User::where('email','=',Input::get('email'))->where('activation','=',0)->first();
					if ( $check_active == null )
					{
						$id = Auth::id();
						$user = User::set_authnication($id);
						
						$data['login'] = 'successfully';
					} else {
						$data['login'] = 'error';
						$data['msg'] = 'Sorry! Your account is inactive. If you have any questions, please contact to the HR department.';
					}
		    			
				} else {
					$data['login'] = 'error';
					$data['msg'] = 'Email and Password do not match.';
				}
		            	$data['status'] = 'success';
		            	$data['email'] = $email;
		        	}
		}

	        	echo json_encode($data);
	}
	
	public function checkout()
	{
		$shipping = Common::query_multiple_rows_by_single_source('shipping', 'is_active', 1);

		$currency_symbol = Common::get_currency_format();
		$get = General_setting::find(6);
		$currency_format = $get->format;
		$currency = Common::convert_currency();

		if ( count($shipping) != 0 )
		{
			$shipping_method = $shipping;
		} else {
			$shipping_method = null;
		}

		$gst = Common::query_single_row_by_single_source('gst', 'is_apply', 1);
		if ( $gst != null )
		{
			$gst = $gst->tax;
		} else {
			$gst = 0;
		}

		$discount_amount = 0;

		if ( Session::has('logged_in') && Cart::count() != 0 )
		{
			$discount = Common::query_single_row_by_single_source('discounts', 'is_active', 1);
			if ( $discount != null )
			{
				$description = unserialize($discount->description);
				$discount_rate = $description['discount_rate'];
				$remark = $description['remark'];

				if ( array_key_exists('price', $description) )
				{
					if ( $description['price'] < Cart::total() )
					{
						$discount_amount = $discount_rate;
					}
				}

				if ( array_key_exists('qty', $description) )
				{
					if ( $description['qty'] < Cart::count() )
					{
						$discount_amount = $discount_rate;
					}
				}

				$discount_total = Common::discount(Cart::total(), $discount_amount);
				$overall_total = Common::gst($discount_total, $gst);

				return View::make('frontend.cart.checkout',compact('discount_amount','remark','gst','overall_total','shipping_method','currency_symbol','currency_format','currency'));
			}
		}
		
		$overall_total = Common::gst(Cart::total(), $gst);

		return View::make('frontend.cart.checkout',compact('gst','overall_total','discount_amount','shipping_method','currency_format','currency_symbol','currency_format','currency'));
	}

	public function export_invoice()
	{
		$shipping = Shipping::where('method','=','Charges Shipping')->where('is_active','=',1)->first();
		$invoice = Other_setting::where('type','=','invoice')->first();

		if ( $shipping != null )
		{
			$description = unserialize($shipping->description);
			$amount = $description['amount'];
		} else {
			$amount = '';
		}

		$gst = Common::query_single_row_by_single_source('gst', 'is_apply', 1);
		if ( $gst != null )
		{
			$gst = $gst->tax;
		} else {
			$gst = 0;
		}

		$discount_amount = 0;
		
		if ( Cart::count() != 0 )
		{
			$discount = Common::query_single_row_by_single_source('discounts', 'is_active', 1);
			if ( $discount != null )
			{
				$description = unserialize($discount->description);
				$discount_rate = $description['discount_rate'];

				if ( array_key_exists('price', $description) )
				{
					if ( $description['price'] < Cart::total() )
					{
						$discount_amount = $discount_rate;
					}
				}

				if ( array_key_exists('qty', $description) )
				{
					if ( $description['qty'] < Cart::count() )
					{
						$discount_amount = $discount_rate;
					}
				}

				$discount_total = Common::discount(Cart::total(), $discount_amount);
				$overall_total = Common::gst($discount_total, $gst);

			} else {
				$overall_total = Common::gst(Cart::total(), $gst);
			}
			
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('frontend.export.invoice',compact('discount_amount','overall_total','gst','amount','invoice'));
			return $pdf->stream();
		} else {
			App::abort(404);
		}
	}
	
}
