<?php

class OfflineController extends BaseController {

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
		$offline = Offline_sale::all();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.order.offline_list',compact('offline','date_format','currency'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$members = User::all();
		$subcategory = Subcategory::all();
		return View::make('backend.admin.order.offline_create',compact('members','subcategory'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$mode = Input::get('mode');
		$pid = Input::get('product_name');
		$order_qty = Input::get('product_quantity');
		
		if ( $mode == 2 )
		{
			$rules = array(
				'account_no' => 'required',
				'account_name' => 'required',
				'bank_name' => 'required',
				'bank_branch' => 'required',
				'cheque_issue_date' => 'required',
				'customer_name' => 'required',
				'customer_email' => 'required',
				'customer_phone' => 'required',
				'customer_address' => 'required',
				'total_amount' => 'required',
				'selling_date' => 'required'
			);
		} elseif ( $mode == 3 ) {
			$rules = array(
				'transaction_id' => 'required',
				'customer_name' => 'required',
				'customer_email' => 'required',
				'customer_phone' => 'required',
				'customer_address' => 'required',
				'total_amount' => 'required',
				'selling_date' => 'required'
			);
		} elseif ( $mode == 4 ) {
			$rules = array(
				'description' => 'required',
				'customer_name' => 'required',
				'customer_email' => 'required',
				'customer_phone' => 'required',
				'customer_address' => 'required',
				'total_amount' => 'required',
				'selling_date' => 'required'
			);
		} else {
			$rules = array(
				'customer_name' => 'required',
				'customer_email' => 'required',
				'customer_phone' => 'required',
				'customer_address' => 'required',
				'total_amount' => 'required',
				'selling_date' => 'required'
			);
		}

		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/offline_sale/create')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('selling_date'));
		
		$offline = new Offline_sale;
		$offline->product_id = $pid;
		$offline->order_quantity = $order_qty;
		$offline->per_price = Input::get('product_price');
		$offline->total_amount = Input::get('total_amount');
		$offline->selling_date = $time;
		$offline->member_name = Input::get('customer_name');
		$offline->email_address = Input::get('customer_email');
		$offline->address = Input::get('customer_address');
		$offline->mobile_no = Input::get('customer_phone');
		if ( $mode == 1 )
		{
			$offline->cash = 1;

		} elseif ( $mode == 2 ) {
			$cheque_arr = array('account_no'=>Input::get('account_no'),'account_name'=>Input::get('account_name'),'bank_name'=>Input::get('bank_name'),'bank_branch'=>Input::get('bank_branch'),'cheque_issue_date'=>Input::get('cheque_issue_date'));
			$offline->cheque = serialize($cheque_arr);

		} elseif ( $mode == 3 ) {
			$offline->enet = Input::get('transaction_id');

		} else {
			$offline->other = Input::get('description');
		}
		$offline->save();

		$get_product = Product::find($pid);
		$qty = $get_product->quantity_use + $order_qty;
		Common::query_update_data('products','id',$pid,array('quantity_use'=>$qty));

		Session::flash('success', 'Offline sale is successfully created.');

		return Redirect::to('admin/offline_sale');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function get_member()
	{
		$id = Input::get('id');

		if ( $id != 0 )
		{
			$result = User::find($id);
			$member = array(
	            		'name' => $result->username,
	            		'email' => $result->email,
	            		'phone' => $result->phone,
	            		'address' => $result->address
	        		);
		} else {
			$member = '';
		}

		$data['status'] = 'success';
		$data['member'] = $member;
		echo json_encode($data);
	}

	public function get_product()
	{
		$id = Input::get('id');
		$val = '<select name="product_name" id="product" class="form-control" onChange="change_productlist(this.value)">';
		$qty_val = '<select name="product_quantity" id="quantity" class="form-control">';
		$price = '';

		if ( $id != '0')
		{
			$products = Product::where('subcategory_id','=',$id)->get();

			if ( count($products) != 0 )
			{
				foreach($products as $product)
		        		{
		        			$get_qty = $product->quantity - $product->quantity_use;
					for ( $i = 1; $i <= $get_qty; $i++ ) 
					{
		                  			$qty_val .= '<option value="'. $i .'">'. $i .'</option>';
		                   		}
		                   		$qty_val .= '</select>';

		            		$val .= '<option value="'. $product['id'] .'">'. $product['product_name'] .'</option>';

		            		$price .= $product->price.'&';
		            		$arr = explode('&', $price);
		        		}
		        		$val .= '</select>';

		        		$data['result'] = $val;
	        			$data['qty_result'] = $qty_val;
	        			$data['count'] = 1;
	        			$data['price'] = $arr[0];

	        		} else {
	        			$data['result'] = '<select name="product_name" id="product" class="form-control" onChange="change_productlist(this.value)" disabled><option value="0">-</option></select>';
	        			$data['qty_result'] = '<select name="product_quantity" id="quantity" class="form-control" disabled><option value="0">-</option></select>';

	        			$data['count'] = 0;
	        		}

	        		echo json_encode($data);

	        	} else {
	        		$data['result'] = '<select name="product_name" id="product" class="form-control" onChange="change_productlist(this.value)" disabled><option value="0">-</option></select>';
	        		$data['qty_result'] = '<select name="product_quantity" id="quantity" class="form-control" disabled><option value="0">-</option></select>';

	        		$data['count'] = 0;

	        		echo json_encode($data);
	        	}
	}

	public function get_product_qty()
	{
		$id = Input::get('id');
		$val = '<select name="product_quantity" id="quantity" class="form-control">';

		if ( $id != '0')
		{
			$product = Product::find($id);

			$get_qty = $product->quantity - $product->quantity_use;
			for ( $i = 1; $i <= $get_qty; $i++ ) 
			{
                  			$val .= '<option value="'. $i .'">'. $i .'</option>';
                   		}
                   		$val .= '</select>';
	        		
	        		$data['qty_result'] = $val;
	        		$data['price'] = $product->price;

	        		echo json_encode($data);
	        	} else {
	        		$data['qty_result'] = '<select name="product_quantity" id="quantity" class="form-control"><option value="0">-</option></select>';
	        		$data['price'] = '';
	        		echo json_encode($data);
	        	}
	}
	
	public function report_pdf()
	{
		$offlinesales = Offline_sale::join('products','products.id','=','offlinesales.product_id')
			->orderBy('offlinesales.created_at','desc')
			->select('products.product_name','offlinesales.*')
			->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		if ( count($offlinesales) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.order.offline_report_pdf',compact('offlinesales','date_format','currency'));
			return $pdf->stream();
		} else {
			Session::flash('error', 'There is no offline order.');
			return Redirect::to('admin/offline_sale');
		}
	}
	
	public function report_excel()
	{
		$date_format = Common::get_date();
		$offlinesales = Offline_sale::join('products','products.id','=','offlinesales.product_id')
			->orderBy('offlinesales.created_at','desc')
			->select('products.product_name','offlinesales.*')
			->get();
		if ( count($offlinesales) != 0 )
		{
			$i = 1;
			foreach ( $offlinesales as $offlinesale )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $offlinesale->member_name;
            			$temp['product'] = $offlinesale->product_name;
            			$temp['price'] = $offlinesale->per_price;
            			$temp['qty'] = $offlinesale->order_quantity;
            			$temp['total'] =$offlinesale->total_amount;
            			if ( $offlinesale->cash != 0 )
            			{
            				$temp['mop'] = 'Cash';
            			} elseif ( $offlinesale->cheque != null ) {
            				$temp['mop'] = 'Cheque';
            			} elseif ( $offlinesale->other != null ) {
            				$temp['mop'] = 'Other';
            			} elseif ( $offlinesale->enet != null ) {
            				$temp['mop'] = 'Enet';
            			}
            			$temp['selling'] = date($date_format, $offlinesale->selling_date);
            			$result[] = $temp;
            		}

			$filename = "offlinesale_report.csv";

			$header = array(
				'No.','Member Name', 'Product Name', 'Price', 'Order Quantity', 'Total', 'MOP', 'Selling Date'
			);
			
			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('error', 'There is no offline_sale.');
			return Redirect::to('admin/offline_sale');
		}
	}
}
