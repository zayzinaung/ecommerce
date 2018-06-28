<?php

class OrderController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"order");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$orders = Order::where('is_cancel','=',0)->groupBy('bill_no')->orderBy('created_at','desc')->get();

		$stage = Common::query_single_data('shipment_levels','id',1,'level_status_message');
		$stage3 = Common::query_single_data('shipment_levels','id',3,'level_status_message');

		$date_format = Common::get_date();
		$prefix = Common::get_prefix();

		return View::make('backend.admin.order.index',compact('orders','stage','stage3','date_format','prefix'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($bill_no)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$no = strtoupper($bill_no);
		$orders = Order::get_orders($no);
		$order = Order::where('bill_no','=',$no)->groupBy('bill_no')->first();

		if ( $order->member_id != 0 )
		{
			$user = Common::query_single_row_by_single_source('users', 'id', $order->member_id);
			$guest_name='';$guest_email='';$guest_phone='';$guest_address='';
		} else {
			$user = '';
			$guest = unserialize($order->guest);
			$guest_name = $guest['name'];
			$guest_email = $guest['email'];
			$guest_phone = $guest['phone'];
			$guest_address = $guest['address'];
		}
		
		if ( count($orders) != 0 )
		{
			$price = 0.00;
			foreach ( $orders as $order )
			{
				$subtotal = $order->order_quantity * $order->original_price;
				$price+=$subtotal;
			}

			if ( $order->shipment_level == 0 )
			{
				$shipping = Shipping::find(2);
				$description = unserialize($shipping->description);
				$amount = $description['amount'];
			} else {
				$amount = 0.00;
			}

			$discount_total = Common::discount($price, $order->discount);
			$overall_total = Common::gst($discount_total, $order->gst);

			$date_format = Common::get_date();
			$prefix = Common::get_prefix();
			$currency = Common::get_currency();
			
			return View::make('backend.admin.order.detail',compact('orders','order','user','guest_name','guest_phone','guest_email','guest_address','amount','overall_total','date_format','prefix','currency'));
		} else {
			return Redirect::to('admin/error/show/404');
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($bill_no)
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$no = strtoupper($bill_no);
		$order = Order::where('bill_no','=',$no)->groupBy('bill_no')->first();
		$stage3 = Common::query_single_data('shipment_levels','id',3,'level_status_message');
		$date_format = Common::get_date();
		if ( count($order) != 0 )
		{
			$shipment_level = Shipment_level::find($order->shipment_level);
			if ( $shipment_level != null )
			{
				$level = $shipment_level->level_status_message;
			} else {
				$level = $stage3->level_status_message;
			}
			return View::make('backend.admin.order.edit',compact('order','level','date_format'));
		} else {
			return Redirect::to('admin/error/show/404');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($bill_no)
	{
		$date_format = Common::get_date();
		$no = strtoupper($bill_no);

		$level = Input::get('level');
		$name = Input::get('name');
		$phone = Input::get('phone');
		$date = Input::get('date');

		$prefix = Common::get_prefix();

		$order = Order::where('bill_no','=',$no)->groupBy('bill_no')->first();
		$member = User::find($order->member_id);

		$email_setting = Common::get_from_email();
		$to_email = Common::get_to_email();

		$time = date($date_format,strtotime($order->order_date));
		$consignment = $prefix."-".$time."-".$order->bill_no;
		
		if ( $level == 0 )
		{
			$rules = array(
				'name' => 'required',
				'phone' => 'required',
				'date' => 'required'
			);
		} elseif ( $level == 1 ) {
			$rules = array(
				'name' => 'required',
				'phone' => 'required'
			);
		} else {
			$rules = array(
				'date' => 'required'
			);
		}
		
		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()) {
			return Redirect::to('admin/order/'.$bill_no.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$get_time = Common::get_date_format(Input::get('date'));

		if ( $level == 0 )
		{
			Common::query_update_data('orders','bill_no',$no,array('courier_name'=>$name, 'courier_no'=>$phone, 'delivered_on'=>$get_time));

			$email_message = Email::where('name','=','charges_shipping')->first();
			$message = $email_message->content;

			$message = str_replace('{NAME}',$member->username,$message);
		          $message = str_replace('{CONSIGNMENT}',$consignment,$message);
		          $message = str_replace('{DELIEVERED}',$date,$message);
		          $message = str_replace('{COURIERNAME}',$name,$message);
		          $message = str_replace('{COURIERNO}',$phone,$message);
		          $message = str_replace('{NEWLINE}','<br/>',$message);

		} elseif ( $level == 1 ) {
			Common::query_update_data('orders','bill_no',$no,array('shipment_level'=>2, 'courier_name'=>$name, 'courier_no'=>$phone));

			$email_message = Email::where('name','=','sent_through')->first();
			$message = $email_message->content;

			$message = str_replace('{NAME}',$member->username,$message);
		          $message = str_replace('{CONSIGNMENT}',$consignment,$message);
		          $message = str_replace('{COURIERNAME}',$name,$message);
		          $message = str_replace('{COURIERNO}',$phone,$message);
		          $message = str_replace('{NEWLINE}','<br/>',$message);

		} else {
			Common::query_update_data('orders','bill_no',$no,array('shipment_level'=>3, 'delivered_on'=>$get_time));

			$email_message = Email::where('name','=','delivered_on')->first();
			$message = $email_message->content;

			$message = str_replace('{NAME}',$member->username,$message);
		          $message = str_replace('{CONSIGNMENT}',$consignment,$message);
		          $message = str_replace('{DELIEVERED}',$date,$message);
		          $message = str_replace('{NEWLINE}','<br/>',$message);
		}

		$msg = "
		<html>
		<head>
			<style type='text/css'>
				.logo_recepit { float: left; width: 200px; margin: 10px 20px 20px 0; }
			</style>
		</head>
		<body>
		          <table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>
		        		<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
		        			<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
		                    		<div>". $message ."</div>
		        		</div>
		        	</table>	                  
		</body>
		</html>";

		$url = 'https://api.sendgrid.com/';
        		$user = 'crystaltech';
        		$pass = 'h@ppyl1fe';
        		
		$params = array(
		          'api_user'  => $user,
		          'api_key'   => $pass,
		         	'to'        => $member->email,
		          'bcc[0]'    => $to_email,
		          'subject'   => $email_message->subject,
		          'html'      => $msg,
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

		if(!empty($response)){
                		Session::flash('success','Shipment status is successfully updated.');
            	}
		return Redirect::to('admin/order');
	}
	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($bill_no)
	{
		$orders = Common::query_multiple_rows_by_single_source('orders', 'bill_no', $bill_no);
		foreach ( $orders as $order )
		{
			$product = $order->product_id;
			$qty = $order->order_quantity;
			$get_product = Common::query_single_row_by_single_source('products', 'id', $product);

			if ( $get_product->quantity_use != 0 )
			{
				$use_qty = $get_product->quantity_use - $qty;
				Common::query_update_data('products','id',$product,array('quantity'=>$get_qty, 'quantity_use'=>$use_qty));
			}
		}
		Order::where('bill_no','=',$bill_no)->delete();
		Session::flash('success', 'Order is successfully deleted.');
		return Redirect::to('admin/order');
	}

	public function addto_cancel($bill_no)
	{
		Common::query_update_data('orders','bill_no',$bill_no,array('is_cancel' => 1));
	          Session::flash('success', 'Order is successfully added to a recycle bin.');
		return Redirect::to('admin/orders/cancel_list');
	}

	public function cancel_list()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$orders = Order::where('is_cancel','=',1)->groupBy('bill_no')->get();
		$date_format = Common::get_date();
		$prefix = Common::get_prefix();
		return View::make('backend.admin.order.cancel_list',compact('orders','date_format','prefix'));
	}

	public function restore_order()
	{
		$bill_no = Input::get('bill_no');
		$cancel = Input::get('cancel');

		if ( $cancel == 1 )
		{
	           	Common::query_update_data('orders','bill_no',$bill_no,array('is_cancel' => 0));
		} else {
			Common::query_update_data('orders','bill_no',$bill_no,array('is_cancel' => 1));
		}

            	Session::flash('success', 'Order is successfully restored.');
		return Redirect::to('admin/order');
	}
	
	public function order_payment($bill_no)
	{
		$no = strtoupper($bill_no);
		$order = Order::where('bill_no','=',$no)->groupBy('bill_no')->first();
		$orders = Order::where('bill_no','=',$no)->get();
		$currency = Common::get_currency();
		if ( count($orders) != 0 )
		{
			$price = 0.00;
			foreach ( $orders as $order )
			{
				$subtotal = $order->order_quantity * $order->original_price;
				$price+=$subtotal;
			}
			
			$discount_total = Common::discount($price, $order->discount);
			$overall_total = Common::gst($discount_total, $order->gst);

			$date_format = Common::get_date();
			$prefix = Common::get_prefix();

			return View::make('backend.admin.order.payment',compact('order','overall_total','date_format','prefix','currency'));
		} else {
			return Redirect::to('admin/error/show/404');
		}
	}
	
	public function add_payment($bill_no)
	{
		$no = strtoupper($bill_no);
		$mode = Input::get('mode');

		if ( $mode == 2 )
		{
			$rules = array(
				'account_no' => 'required',
				'account_name' => 'required',
				'bank_name' => 'required',
				'bank_branch' => 'required',
				'cheque_issue_date' => 'required'
			);
		} elseif ( $mode == 3 ) {
			$rules = array(
				'transaction_id' => 'required'
			);
		} elseif ( $mode == 4 ) {
			$rules = array(
				'description' => 'required'
			);
		} else {
			$rules = array();
		}

		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()) {
			return Redirect::to('admin/order/order_payment/'.$bill_no)
				->withErrors($validator)
				->withInput();
		}
		
		if ( $mode == 1 )
		{
			Common::query_update_data('orders','bill_no',$no,array('cash'=>1, 'is_paid'=>1));
		} elseif ( $mode == 2 ) {
			$cheque_arr = array('account_no'=>Input::get('account_no'),'account_name'=>Input::get('account_name'),'bank_name'=>Input::get('bank_name'),'bank_branch'=>Input::get('bank_branch'),'cheque_issue_date'=>Input::get('cheque_issue_date'));
			$cheque = serialize($cheque_arr);
			Common::query_update_data('orders','bill_no',$no,array('cheque'=>$cheque, 'is_paid'=>1));
		} elseif ( $mode == 3 ) {
			Common::query_update_data('orders','bill_no',$no,array('enet'=>Input::get('transaction_id'), 'is_paid'=>1));
		} else {
			Common::query_update_data('orders','bill_no',$no,array('other'=>Input::get('description'), 'is_paid'=>1));
		}

		Session::flash('success', 'Payment method is successfully updated.');
		return Redirect::to('admin/order');
	}

	public function view_receipt($bill_no)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$no = strtoupper($bill_no);
		$orders = Order::get_orders($no);
		$order = Order::where('bill_no','=',$no)->groupBy('bill_no')->first();

		if ( count($orders) != 0 )
		{
			$price = 0.00;
			foreach ( $orders as $order )
			{
				$subtotal = $order->order_quantity * $order->original_price;
				$price+=$subtotal;
			}

			$discount_total = Common::discount($price, $order->discount);
			$overall_total = Common::gst($discount_total, $order->gst);

			if ( $order->shipment_level == 0 )
			{
				$shipping = Shipping::find(2);
				$description = unserialize($shipping->description);
				$amount = $description['amount'];

				$shipping_cost = $overall_total + $amount;
			} else {
				$amount = 0.00;
				$shipping_cost = $overall_total;
			}

			$date_format = Common::get_date();
			$prefix = Common::get_prefix();
			$currency = Common::get_currency();

			$receipt = Other_setting::where('type','=','receipt')->first();

			return View::make('backend.admin.order.receipt',compact('orders','order','amount','shipping_cost','date_format','prefix','currency','receipt'));
		} else {
			return Redirect::to('admin/error/show/404');
		}
	}
	
	public function export_receipt($bill_no)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$no = strtoupper($bill_no);
		$orders = Order::get_orders($no);
		$order = Order::where('bill_no','=',$no)->groupBy('bill_no')->first();

		$currency = Common::get_currency();
		$receipt = Other_setting::where('type','=','receipt')->first();

		if ( count($orders) != 0 )
		{
			$price = 0.00;
			foreach ( $orders as $order )
			{
				$subtotal = $order->order_quantity * $order->original_price;
				$price+=$subtotal;
			}

			$discount_total = Common::discount($price, $order->discount);
			$overall_total = Common::gst($discount_total, $order->gst);

			if ( $order->shipment_level == 0 )
			{
				$shipping = Shipping::find(2);
				$description = unserialize($shipping->description);
				$amount = $description['amount'];

				$shipping_cost = $overall_total + $amount;
			} else {
				$amount = 0.00;
				$shipping_cost = $overall_total;
			}

			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.order.export_receipt',compact('orders','order','amount','shipping_cost','currency','receipt'));
			return $pdf->stream();
		} else {
			return Redirect::to('admin/error/show/404');
		}
	}

	public function send_receipt($bill_no)
	{
		$date_format = Common::get_date();

		$orders = Order::get_orders($bill_no);
		$order = Order::where('bill_no','=',$bill_no)->groupBy('bill_no')->first();

		$price = 0.00;
		foreach ( $orders as $order )
		{
			$subtotal = $order->order_quantity * $order->original_price;
			$price+=$subtotal;
		}

		$discount_total = Common::discount($price, $order->discount);
		$overall_total = Common::gst($discount_total, $order->gst);

		if ( $order->shipment_level == 0 )
		{
			$shipping = Shipping::find(2);
			$description = unserialize($shipping->description);
			$amount = $description['amount'];

			$shipping_cost = $overall_total + $amount;
		} else {
			$amount = 0.00;
			$shipping_cost = $overall_total;
		}

		$prefix = Common::get_prefix();
		$email_setting = Common::get_from_email();

		$time = strtotime($order->order_date);
		$date = date($date_format,$time);
		$masked_email = Common::query_single_data('users','id',$order->member_id,'email');

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
                        			<p style='font-weight:bold;margin-bottom:10px;margin-top:20px;'> Consignment Number. : ".$prefix."-".$date."-".$order->bill_no . "</p>
                      			</td></tr></tbody>
                    				</table>
                    				<table style='width:100%;border-collapse:collapse;border:1px solid #ccc;'>
                        			<thead style='border-bottom:1px solid #ccc;background: #F6F3EB;'>
                            			<th>#</th>
				          <th>Image</th>
				          <th>Title</th>
				          <th>Product No</th>
				          <th>Quantity</th>
				          <th>Unit price</th>
				          <th>Total</th>
                        			</thead>
                        			<tbody>";

                        			$i = 0; $total_amount = 0.00;
                        			foreach ( $orders as $order )
                				{
                					$product = "<tr>
					          <td style='padding:10px;font-size:15px;'>". $i ."</td>
					          <td style='padding:10px;font-size:15px;'><img src='". URL::to('/uploads/products/'.$order->image)."' width='50'></td>
					          <td style='padding:10px;font-size:15px;'>". $order->product_name ."</td>
					          <td style='padding:10px;font-size:15px;'>". $order->product_no ."</td>
					          <td style='padding:10px;font-size:15px;'>". $order->order_quantity ."</td>
					          <td style='padding:10px;font-size:15px;'>S$". $order->original_price ."</td>
					          <td style='padding:10px;font-size:15px;'>S$". number_format((float)$order->order_quantity * $order->original_price, 2, '.', '') ."</td>
					          </tr>";
					          $product_array[] = $product;
					          $total_amount+=$order->original_price;
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
                    				<td colspan='3' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Buying Total</td>
                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)$total_amount, 2, '.', '') ."</td>
                				</tr>";

                				if ( $order->discount != 0 )
                				{
                					$message3 = "<tr style='border-top:1px solid #ccc;'>
                    					<td colspan='3' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Discount</td>
                    					<td style='padding:10px;font-size:15px;font-weight:bold;'>". $order->discount ."%</td>
                					</tr>";
                				} else {
                					$message3 = '';
                				}

                				if ( $order->gst != 0 )
                				{
                					$message4 = "<tr style='border-top:1px solid #ccc;'>
                    					<td colspan='3' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>GST</td>
                    					<td style='padding:10px;font-size:15px;font-weight:bold;'>". $order->gst ."%</td>
                					</tr>";
                				} else {
                					$message4 = '';
                				}

                				$message5 = "<tr style='border-top:1px solid #ccc;'>
                    				<td colspan='3' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Shipping Cost</td>
                    				<td style='padding:10px;font-size:15px;font-weight:bold;'>S$". number_format((float)$amount, 2, '.', '') ."</td>
                				</tr>
                				<tr style='border-top:1px solid #ccc;'>
                    				<td colspan='3' style='padding:10px;font-size:15px;font-weight:bold;text-align:right;'>Overall Total</td>
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
			'subject'   => 'Order Receipt',
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
			                    
		if(!empty($response)) {
		          Session::flash('success','Receipt is successfully sent.');
		}

		Common::query_update_data('orders','bill_no',$no,array('receipt'=>1));

		return Redirect::to('admin/order');
	}
	
	public function report_pdf()
	{
		$orders = Order::join('products','products.id','=','orders.product_id')
			->join('users','users.id','=','orders.member_id')
			->where('orders.is_paid','=',1)
			->orderBy('orders.created_at','desc')
			->select('products.product_name','orders.*','users.username')
			->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		if ( count($orders) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.order.report_pdf',compact('orders','date_format','currency'));
			return $pdf->stream();
		} else {
			Session::flash('error', 'There is no order.');
			return Redirect::to('admin/order');
		}
	}

	public function report_excel()
	{
		$orders = Order::join('products','products.id','=','orders.product_id')
			->join('users','users.id','=','orders.member_id')
			->where('orders.is_paid','=',1)
			->orderBy('orders.created_at','desc')
			->select('products.product_name','orders.*','users.username')
			->get();
		$date_format = Common::get_date();
		if ( count($orders) != 0 )
		{
			$i = 1;
			foreach ( $orders as $order )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $order->username;
            			$temp['bill_no'] = $order->bill_no;
            			$temp['product'] = $order->product_name;
            			$temp['price'] = $order->original_price;
            			$temp['qty'] = $order->order_quantity;
            			$temp['total'] = $order->original_price * $order->order_quantity;
            			if ( $order->payment_method != 'paypal' )
            			{
	            			if ( $order->cash != 0 )
	            			{
	            				$temp['mop'] = 'Cash';
	            			} elseif ( $order->cheque != null ) {
	            				$temp['mop'] = 'Cheque';
	            			} elseif ( $order->other != null ) {
	            				$temp['mop'] = 'Other';
	            			} elseif ( $order->enet != null ) {
	            				$temp['mop'] = 'Enet';
	            			}
	            		} else {
	            			$temp['mop'] = 'paypal';
	            		}
            			$temp['order_date'] = date($date_format, strtotime($order->order_date));
            			$result[] = $temp;
            		}

			$filename = "order_report.csv";

			$header = array(
				'No.','Member Name', 'Bill No', 'Product Name', 'Price', 'Order Quantity', 'Total', 'MOP', 'Order Date'
			);
			
			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('error', 'There is no order.');
			return Redirect::to('admin/order');
		}
	}

}
