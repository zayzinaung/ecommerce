<?php

namespace Frontend;

use BaseController;
use View;
use Response;
use Request;
use Input;
use Redirect;
use URL;
use Session;
use App;
use Cart;
use Order;
use Shipment_level;
use Shipping;
use Common;
use Product;
use Paypal_transaction;
use Omnipay\Omnipay;

class OrderController extends BaseController {
   	
	public function add_order()
	{
		$today = date("YmdHis");
		$timestamp = substr(strtotime($today),6,4);
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$random = strtoupper(substr( md5(rand()), 0, 2));
		$uniqid = $random . $timestamp . $rand;

		if ( Session::get('login_type') == 'guest' )
		{
			$get_type = array('name'=>Session::get('guest_name'), 'email'=>Session::get('guest_email'), 'phone'=>Session::get('guest_phone'), 'address'=>Session::get('guest_address'));
			$type = serialize($get_type);
			$member_id = 0;
		} else {
			$type = null;
			$member_id = Session::get('user_id');
		}

		$gst = Common::check_is_exist(Input::get('gst'));

		$discount = Common::check_is_exist(Input::get('discount'));

		$discount_total = Common::discount(Cart::total(), $discount);
		$overall_total = Common::gst($discount_total, $gst);

		if ( Input::get('shipping') === 'Charges Shipping' )
		{
			$shipping_level = 0;
			$shipping = Shipping::find(2);
			$description = unserialize($shipping->description);
			$amount = $description['amount'];
			$shipping_cost = $overall_total + $amount;
		} else {
			$shipping_level = 1;
			$amount = 0.00;
			$shipping_cost = $overall_total;
		}
		
		foreach ( Cart::content()  as $cart )
		{
			$order = new Order;
			$order->member_id = $member_id;
			$order->product_id = $cart->id;
			$order->shipment_level = $shipping_level;
			$order->bill_no = $uniqid;
			$order->guest = $type;
			$order->order_quantity = $cart->qty;
			$order->original_price = $cart->price;
			$order->discount = $discount;
			$order->gst = $gst;
			$order->order_date = Date('Y-m-d H:i:s');
			$order->payment_method = Input::get('payment');
			$order->updated_at = Date('Y-m-d H:i:s');
			$order->save();

			$get_product = Product::find($cart->id);
			$qty = $get_product->quantity_use + $cart->qty;
			Common::query_update_data('products','id',$cart->id,array('quantity_use'=>$qty));
		}
		
		$prefix = Common::get_prefix();
		$email_setting = Common::get_from_email();

		$date_format = Common::get_date();
		$time = strtotime(Date('Y-m-d H:i:s'));
		$date = date($date_format,$time);
		$masked_email = Common::query_single_data('users','id',$member_id,'email');

		$message = "
	          <html>
		<head>
			<style type='text/css'>
				.logo_recepit { float: left; width: 200px; margin: 10px 20px 20px 0; }
				.address { float: right; margin: 15px 0 0 0; }
				.address span { float: left; font-size: 15px; margin-bottom: 10px; }
			</style>
		</head>
		<body>
		<table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>

                	<table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:0;background-color:#ffffff;border-radius:5px'>
                		<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
                		<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
                    		<table style='width:100%;border-collapse:collapse'>
                    			<tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:0'>
                    				<h2 style='margin-bottom:0;margin-top:0'>     
                    					Thank You so much for buying from our website
                    				</h2>
                    
                    				<table><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:0;background-color:#ffffff;border-radius:5px'>
                        			<p style='font-weight:bold;margin-bottom:10px;margin-top:20px;'> Consignment Number. : ".$prefix."-".$date."-".$uniqid. "</p>
                      			</td></tr></tbody>
                    				</table>
                    				<table style='width:100%;border-collapse:collapse;border:1px solid #ccc;'>
                        			<thead style='border-bottom:1px solid #ccc;background: #F6F3EB;'>
				          <th>Image</th>
				          <th>Title</th>
				          <th>Product No</th>
				          <th>Quantity</th>
				          <th>Unit price</th>
				          <th>Total</th>
                        			</thead>
                        			<tbody>";
                        			
                        			foreach ( Cart::content() as $cart )
                				{
                					$product = "<tr>
					          <td style='padding:10px;font-size:15px;text-align:center;'><img src='".URL::to('/uploads/products/'.$cart->options->image->image)."' width='50'></td>
					          <td style='padding:10px;font-size:15px;'>". $cart->name ."</td>
					          <td style='padding:10px;font-size:15px;text-align:center;'>". $cart->options->product_no ."</td>
					          <td style='padding:10px;font-size:15px;text-align:center;'>". $cart->qty ."</td>
					          <td style='padding:10px;font-size:15px;text-align:center;'>S$". $cart->price ."</td>
					          <td style='padding:10px;font-size:15px;text-align:center;'>S$". number_format((float)$cart->qty * $cart->price, 2, '.', '') ."</td>
					          </tr>";
					          $product_array[] = $product;
                    				}

                    				$product_arr = '';
				          	if(!empty($product_array))
				         	{
				            	foreach($product_array as $p_arr)
				                    	{
				                        	$product_arr .= $p_arr;
				                    	}
				       	}

				       	$message2 = "<tbody>
                				<tr style='border-top:1px solid #ccc;'>
                    				<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Buying Total</td>
                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)Cart::total(), 2, '.', '') ."</td>
                				</tr>";

                				if ( $discount != 0 )
                				{
                					$message3 = "<tr style='border-top:1px solid #ccc;'>
                    					<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Discount</td>
                    					<td style='padding:10px;font-size:15px;font-weight:bold;'>". $discount ."%</td>
                					</tr>";
                				} else {
                					$message3 = '';
                				}

                				if ( $gst != 0 )
                				{
                					$message4 = "<tr style='border-top:1px solid #ccc;'>
                    					<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>GST</td>
                    					<td style='padding:10px;font-size:15px;font-weight:bold;'>". $gst ."%</td>
                					</tr>";
                				} else {
                					$message4 = '';
                				}

                				$message5 = "<tr style='border-top:1px solid #ccc;'>
                    				<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Shipping Cost</td>
                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)$amount, 2, '.', '') ."</td>
                				</tr>
                				<tr style='border-top:1px solid #ccc;'>
                    				<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Overall Total</td>
                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)$shipping_cost, 2, '.', '') ."</td>
                				</tr>
                				</tbody></table>
		</body>
		</html>";

		$content = $message.$product_arr.$message2.$message3.$message4.$message5;

		$url  = 'https://api.sendgrid.com/';
		$user = 'crystaltech';
		$pass = 'h@ppyl1fe';

		$params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'to'        => $masked_email->email,
			'subject'   => 'Order Confirmation',
			'html'      => $content,
			'text'      => '',
			'from'      => $email_setting,
		);

		$request =  $url.'api/mail.send.json';
		
		$session = curl_init($request);
		curl_setopt($session, CURLOPT_POST, true);
		curl_setopt($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($session);
		curl_close($session);

		
		$admin_msg = "
	                    	<html>
		        	<head>
				<style type='text/css'>
					.logo_recepit { float: left; width: 200px; margin: 10px 20px 20px 0; }
				         	h3 { font-size: 15px; color: #333; margin-top: 30px; }
				          	h4 { color: #333; margin-top: 30px; }
				</style>
		        	</head>
		        	<body>
		                    <table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>
		        			<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
		        				<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
		                    			<p>Cosignment No. : ". $date."-".$uniqid ."</p>
		                    			<p>Overall Total : S$". number_format((float)$shipping_cost, 2, '.', '') ."</p>
		        			</div>
		        		</table>	                  
		        	</body>
		        	</html>";

		$admin_url  = 'https://api.sendgrid.com/';
		$admin_user = 'crystaltech';
		$admin_pass = 'h@ppyl1fe';

		$admin_params = array(
			'api_user'  => $admin_user,
			'api_key'   => $admin_pass,
			'to'        => 'ptaung4@gmail.com',
			'subject'   => 'Order Information',
			'html'      => $admin_msg,
			'text'      => '',
			'from'      => $email_setting,
		);

		$admin_request =  $admin_url.'api/mail.send.json';
	
		$admin_session = curl_init($admin_request);
		curl_setopt($admin_session, CURLOPT_POST, true);
		curl_setopt($admin_session, CURLOPT_POSTFIELDS, $admin_params);
		curl_setopt($admin_session, CURLOPT_HEADER, false);
		curl_setopt($admin_session, CURLOPT_RETURNTRANSFER, true);
		$admin_response = curl_exec($admin_session);
		curl_close($admin_session);
			                    
		if(!empty($admin_response)) {
		          Session::flash('success','Order data has been sent successfully.');
		}

		if ( Session::get('login_type') == 'guest' )
		{
			Session::forget('guest_name');
			Session::forget('guest_email');
			Session::forget('guest_phone');
			Session::forget('guest_address');
		}
		
		Cart::destroy();
		return Redirect::to('/');
	}

	public function post_payment()
	{
		if ( Session::get('login_type') == 'guest' )
		{
			$member_name = Session::get('guest_name');
		} else {
			$member_name = Session::get('username');
		}

		$gst = Common::check_is_exist(Input::get('gst'));
		$discount = Common::check_is_exist(Input::get('discount'));

		Session::put('shipping', Input::get('shipping'));
		Session::put('gst', $gst);
		Session::put('discount', $discount);

		$discount_total = Common::discount(Cart::total(), $discount);
		$overall_total = Common::gst($discount_total, $gst);

		$currency_val = Common::convert_currency();

		if ( Input::get('shipping') === 'Charges Shipping' )
		{
			$shipping_level = 0;
			$shipping = Shipping::find(2);
			$description = unserialize($shipping->description);
			$amount = $description['amount'];
			$total_cost = $overall_total + $amount;
		} else {
			$shipping_level = 1;
			$amount = 0.00;
			$total_cost = $overall_total;
		}

		if ( Session::has('currency_type') )
		{
			if ( Session::get('currency_type') == 'MMK' )
			{
				$format = Session::get('currency_type');
				$shipping_cost = number_format(round($total_cost * $currency_val));
			} else {
				$format = Session::get('currency_type');
				$shipping_cost = number_format((float)$total_cost * $currency_val, 2, '.', '');
			}
		} else {
			$get = General_setting::find(6);
			$format = $get->format;
			$shipping_cost = $total_cost * $currency_val;
		}

		$params = array(
              		'cancelUrl' 	=> action('Frontend\OrderController@cancel_payment'),
              		'returnUrl' 	=> action('Frontend\OrderController@success_payment'),
                		'name'		=> $member_name,
                		'description' 	=> "Overall Total",
                		'amount' 	=> $shipping_cost,
                		'currency' 	=> $format
        		);
            	
        		Session::put('params', $params);
        		Session::save();
	    
	   	$gateway = Omnipay::create('PayPal_Express');
	   	$gateway->setUsername('pandab_1342092639_biz_api1.gmail.com');
   		$gateway->setPassword('1342092662');
   		$gateway->setSignature('A9.Ppp2bHKT.NxxVJUsJk-qjzGQnAyNoyyWOiVb59Z7weyYSPESXkNaj');
	   	$gateway->setTestMode(true);
	  	$response = $gateway->purchase($params)->send();
    		if ($response->isSuccessful()) {
	      
	      		// payment was successful: update database
	      		print_r($response);
		} elseif ($response->isRedirect()) {
	      		
	      		// redirect to offsite payment gateway
	      		$response->redirect();
	  	} else {
		      // payment failed: display message to customer
		      echo $response->getMessage();
	  	}
	}
	
	public function success_payment()
  	{
  		$today = date("YmdHis");
		$timestamp = substr(strtotime($today),6,4);
		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
		$random = strtoupper(substr( md5(rand()), 0, 2));
		$uniqid = $random . $timestamp . $rand;

		$order_info = Cart::content();
		$email_setting = Common::get_from_email();
		$to_email = Common::get_to_email();

		if ( Session::get('login_type') == 'guest' )
		{
			$get_type = array('name'=>Session::get('guest_name'), 'email'=>Session::get('guest_email'), 'phone'=>Session::get('guest_phone'), 'address'=>Session::get('guest_address'));
			$type = serialize($get_type);
			$member_id = 0;
		} else {
			$type = null;
			$member_id = Session::get('user_id');
		}
		
		$gst = Session::get('gst');
		$discount = Session::get('discount');

		$discount_total = Common::discount(Cart::total(), $discount);
		$overall_total = Common::gst($discount_total, $gst);
		
		if ( Session::get('shipping') == 'Charges Shipping' )
		{
			$shipping_level = 0;
			$shipping = Shipping::find(2);
			$description = unserialize($shipping->description);
			$amount = $description['amount'];
			$shipping_cost = $overall_total + $amount;
		} else {
			$shipping_level = 1;
			$amount = 0.00;
			$shipping_cost = $overall_total;
		}

		$date_format = Common::get_date();
		$time = strtotime(Date('Y-m-d H:i:s'));
		$date = date($date_format,$time);
		$masked_email = Common::query_single_data('users','id',$member_id,'email');

   		$gateway = Omnipay::create('PayPal_Express');
   		$gateway->setUsername('pandab_1342092639_biz_api1.gmail.com');
   		$gateway->setPassword('1342092662');
   		$gateway->setSignature('A9.Ppp2bHKT.NxxVJUsJk-qjzGQnAyNoyyWOiVb59Z7weyYSPESXkNaj');
   		$gateway->setTestMode(true);
      	
		$params = Session::get('params');
  		$response = $gateway->completePurchase($params)->send();
  		$paypalResponse = $response->getData(); // this is the raw response object
  	
  		if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
      			// Response
      			//print_r($paypalResponse);

      			$paypal = new Paypal_transaction;
			$paypal->transaction_id = $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'];
			$paypal->order_bill_no = $uniqid;
			$paypal->date = strtotime($paypalResponse['TIMESTAMP']);
			$paypal->save();

			foreach (  $order_info as $cart )
			{
				$order = new Order;
				$order->member_id = $member_id;
				$order->product_id = $cart->id;
				$order->shipment_level = $shipping_level;
				$order->bill_no = $uniqid;
				$order->guest = $type;
				$order->order_quantity = $cart->qty;
				$order->original_price = $cart->price;
				$order->discount = $discount;
				$order->gst = $gst;
				$order->order_date = Date('Y-m-d H:i:s');
				$order->payment_method = 'paypal';
				$order->updated_at = Date('Y-m-d H:i:s');
				$order->save();

				$get_product = Product::find($cart->id);
				$qty = $get_product->quantity_use + $cart->qty;
				Common::query_update_data('products','id',$cart->id,array('quantity_use'=>$qty));
			}

			$message = "
		          <html>
			<head>
				<style type='text/css'>
					.logo_recepit { float: left; width: 200px; margin: 10px 20px 20px 0; }
					.address { float: right; margin: 15px 0 0 0; }
					.address span { float: left; font-size: 15px; margin-bottom: 10px; }
				</style>
			</head>
			<body>
			<table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>

	                	<table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:0;background-color:#ffffff;border-radius:5px'>
	                		<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
	                		<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
	                    		<table style='width:100%;border-collapse:collapse'>
	                    			<tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:0'>
	                    				<h2 style='margin-bottom:0;margin-top:0'>     
	                    					Thank You so much for buying from our website
	                    				</h2>
	                    
	                    				<table><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:0;background-color:#ffffff;border-radius:5px'>
	                        			<p style='font-weight:bold;margin-bottom:10px;margin-top:20px;'> Consignment Number. : ".$prefix."-". $date."-".$uniqid . "</p>
	                      			</td></tr></tbody>
	                    				</table>
	                    				<table style='width:100%;border-collapse:collapse;border:1px solid #ccc;'>
	                        			<thead style='border-bottom:1px solid #ccc;background: #F6F3EB;'>
					          <th>Image</th>
					          <th>Title</th>
					          <th>Product No</th>
					          <th>Quantity</th>
					          <th>Unit price</th>
					          <th>Total</th>
	                        			</thead>
	                        			<tbody>";
	                        			
	                        			foreach ( Cart::content() as $cart )
	                				{
	                					$product = "<tr>
						          <td style='padding:10px;font-size:15px;text-align:center;'><img src='".URL::to('/uploads/products/'.$cart->options->image->image)."' width='50'></td>
						          <td style='padding:10px;font-size:15px;'>". $cart->name ."</td>
						          <td style='padding:10px;font-size:15px;text-align:center;'>". $cart->options->product_no ."</td>
						          <td style='padding:10px;font-size:15px;text-align:center;'>". $cart->qty ."</td>
						          <td style='padding:10px;font-size:15px;text-align:center;'>S$". $cart->price ."</td>
						          <td style='padding:10px;font-size:15px;text-align:center;'>S$". number_format((float)$cart->qty * $cart->price, 2, '.', '') ."</td>
						          </tr>";
						          $product_array[] = $product;
	                    				}

	                    				$product_arr = '';
					          	if(!empty($product_array))
					         	{
					            	foreach($product_array as $p_arr)
					                    	{
					                        	$product_arr .= $p_arr;
					                    	}
					       	}

					       	$message2 = "<tbody>
	                				<tr style='border-top:1px solid #ccc;'>
	                    				<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Buying Total</td>
	                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)Cart::total(), 2, '.', '') ."</td>
	                				</tr>";

	                				if ( $discount != 0 )
	                				{
	                					$message3 = "<tr style='border-top:1px solid #ccc;'>
	                    					<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Discount</td>
	                    					<td style='padding:10px;font-size:15px;font-weight:bold;'>". $discount ."%</td>
	                					</tr>";
	                				} else {
	                					$message3 = '';
	                				}

	                				if ( $gst != 0 )
	                				{
	                					$message4 = "<tr style='border-top:1px solid #ccc;'>
	                    					<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>GST</td>
	                    					<td style='padding:10px;font-size:15px;font-weight:bold;'>". $gst ."%</td>
	                					</tr>";
	                				} else {
	                					$message4 = '';
	                				}

	                				$message5 = "<tr style='border-top:1px solid #ccc;'>
	                    				<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Shipping Cost</td>
	                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)$amount, 2, '.', '') ."</td>
	                				</tr>
	                				<tr style='border-top:1px solid #ccc;'>
	                    				<td colspan='5' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Overall Total</td>
	                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)$shipping_cost, 2, '.', '') ."</td>
	                				</tr>
	                				</tbody></table>
			</body>
			</html>";

			$content = $message.$product_arr.$message2.$message3.$message4.$message5;

			$url  = 'https://api.sendgrid.com/';
			$user = 'crystaltech';
			$pass = 'h@ppyl1fe';

			$params = array(
				'api_user'  => $user,
				'api_key'   => $pass,
				'to'        => $masked_email->email,
				'subject'   => 'Order Confirmation',
				'html'      => $content,
				'text'      => '',
				'from'      => $email_setting,
			);

			$request =  $url.'api/mail.send.json';
		
			$session = curl_init($request);
			curl_setopt($session, CURLOPT_POST, true);
			curl_setopt($session, CURLOPT_POSTFIELDS, $params);
			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($session);
			curl_close($session);

			
			$admin_msg = "
		                    	<html>
			        	<head>
					<style type='text/css'>
						.logo_recepit { float: left; width: 200px; margin: 10px 20px 20px 0; }
					         	h3 { font-size: 15px; color: #333; margin-top: 30px; }
					          	h4 { color: #333; margin-top: 30px; }
					</style>
			        	</head>
			        	<body>
			                    <table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>
			        			<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
			        				<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
			                    			<p>Cosignment No. : ". $date."-".$uniqid ."</p>
			                    			<p>Overall Total : S$". number_format((float)$shipping_cost, 2, '.', '') ."</p>
			        			</div>
			        		</table>	                  
			        	</body>
			        	</html>";

			$admin_url  = 'https://api.sendgrid.com/';
			$admin_user = 'crystaltech';
			$admin_pass = 'h@ppyl1fe';

			$admin_params = array(
				'api_user'  => $admin_user,
				'api_key'   => $admin_pass,
				'to'        => $to_email,
				'subject'   => 'Order Information',
				'html'      => $admin_msg,
				'text'      => '',
				'from'      => $email_setting,
			);

			$admin_request =  $admin_url.'api/mail.send.json';
		
			$admin_session = curl_init($admin_request);
			curl_setopt($admin_session, CURLOPT_POST, true);
			curl_setopt($admin_session, CURLOPT_POSTFIELDS, $admin_params);
			curl_setopt($admin_session, CURLOPT_HEADER, false);
			curl_setopt($admin_session, CURLOPT_RETURNTRANSFER, true);
			$admin_response = curl_exec($admin_session);
			curl_close($admin_session);
				                    
			if(!empty($admin_response)) {
			          Session::flash('success','Order data has been sent successfully.');
			}
			
			if ( Session::get('login_type') == 'guest' )
			{
				Session::forget('guest_name');
				Session::forget('guest_email');
				Session::forget('guest_phone');
				Session::forget('guest_address');
			}
			
			Cart::destroy();
			Session::forget('shipping');
			Session::forget('gst');
			Session::forget('discount');
			return Redirect::to('/');
  		
  		} else {
      			
      			//Failed transaction
  			Session::flash('error','Unfortunately an error occured.');
  			return Redirect::to('/');
      			
  		}
  		//return Redirect::to('/');
  	}

  	public function cancel_payment()
  	{
  		return Redirect::to('/');
  	}
	
	public function order_history()
	{
		if ( Session::has('logged_in') != 1 )
		{
			App::abort(404);
		} else {
			$orders = Order::where('member_id','=',Session::get('user_id'))->groupBy('bill_no')->orderBy('order_date','desc')->paginate(10);
			$stage = Common::query_single_data('shipment_levels','id',1,'level_status_message');
			$stage3 = Common::query_single_data('shipment_levels','id',3,'level_status_message');

			$date_format = Common::get_date();
			
			return View::make('frontend.order.order_history',compact('orders','stage','stage3','date_format'));
		}
	}

	public function detail($bill_no)
	{
		if ( Session::has('logged_in') != 1 )
		{
			App::abort(404);
		} else {
			$no = strtoupper($bill_no);
			$order_detail = Order::where('bill_no','=',$no)
					->join('products', 'orders.product_id', '=', 'products.id')
					->join('product_images', 'product_images.product_id', '=', 'products.id')
					->where('product_images.image_order','=',1)
					->select('orders.*', 'product_images.image', 'products.product_name', 'products.product_no')
					->get();
			$order = Order::where('member_id','=',Session::get('user_id'))->where('bill_no','=',$no)->groupBy('bill_no')->first();

			$shipping = Shipment_level::find($order->shipment_level);
			$stage = Common::query_single_data('shipment_levels','id',1,'level_status_message');
			$stage3 = Common::query_single_data('shipment_levels','id',3,'level_status_message');
			if ( $shipping != null )
			{
				$level = $shipping->level_status_message;
			} else {
				if ( $order->courier_name == null && $order->courier_no == null && $order->delivered_on == 0 )
				{
					$level = $stage->level_status_message;
					$cname = '';
				} else {
					$level = $stage3->level_status_message;
					$cname = $order->courier_name;
					$cno = $order->courier_no;
					$deliver = $order->delivered_on;
				}
			}

			$price = 0.00;
			foreach ( $order_detail as $o_detail )
			{
				if ( $o_detail->shipment_level == 0 )
				{
					$shipping = Shipping::where('method','=','Charges Shipping')->where('is_active','=',1)->first();
					$description = unserialize($shipping->description);
					$day = $description['day'];
					$amount = $description['amount'];
				} else {
					$shipping = Shipping::where('method','=','Free Shipping')->where('is_active','=',1)->first();
					$description = unserialize($shipping->description);
					$day = $description['day'];
					$amount = 0.00;
				}

				$subtotal = $o_detail->order_quantity * $o_detail->original_price;
				$price+=$subtotal;
			}
			
			$discount_total = Common::discount($price, $order->discount);
			$overall_total = Common::gst($discount_total, $order->gst);

			$date_format = Common::get_date();
			$currency_symbol = Common::get_currency_format();

			return View::make('frontend.order.detail',compact('order_detail','order','day','amount','level', 'overall_total','cname','cno','deliver','date_format','currency_symbol'));
		}
	}
	
}
?>