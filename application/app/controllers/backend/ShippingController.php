<?php

class ShippingController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"shipping");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$shipping = Shipping::all();
		$currency = Common::get_currency();
		return View::make('backend.admin.shipping.index',compact('shipping','currency'));
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
	public function show($id)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$shipping = Shipping::findOrFail($id);

		$description = unserialize($shipping->description);

		$day = $description['day'];
		$currency = Common::get_currency();

		if ( array_key_exists('amount', $description) )
		{
			$amount = $description['amount'];
			return View::make('backend.admin.shipping.detail', compact('shipping','amount','day','currency'));
		} else {
			return View::make('backend.admin.shipping.detail', compact('shipping','day'));
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$shipping = Shipping::find($id);

		$description = unserialize($shipping->description);

		$day = $description['day'];

		if ( array_key_exists('amount', $description) )
		{
			$amount = $description['amount'];
			return View::make('backend.admin.shipping.edit', compact('shipping','amount','day'));
		} else {
			return View::make('backend.admin.shipping.edit', compact('shipping','day'));
		}
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$shipping = Shipping::find($id);
		
		if ( $shipping->method == 'free_shipping' )
		{
			$rules = array(
				'day'	=> 'required'
			);
		} elseif ( $shipping->method == 'charges_shipping' ) {
			$rules = array(
				'day'	=> 'required',
				'amount' => 'required'
			);
		}
		
		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()) {
			return Redirect::to('admin/shipping/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$day = Input::get('day');
		$amount = Input::get('amount');

		if ( $amount != null )
		{
			$desc_arr = array('day' => $day, 'amount' => $amount);
		} else {
			$desc_arr = array('day' => $day);
		}

		$shipping->description = serialize($desc_arr);
		$shipping->save();

		Session::flash('success', 'Shipping is successfully updated.');
		return Redirect::to('admin/shipping');
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
	
	public function is_active()
	{
		$id = Input::get('id');
		$active = Input::get('active');

		if ( $active == 1 )
		{
			DB::table('shipping')
	           		->where('id', $id)
	           		->update(array('is_active' => 0));
		} else {
			DB::table('shipping')
		           	->where('id', $id)
		           	->update(array('is_active' => 1));
		}

            	Session::flash('success', 'Shipping is successfully edited.');
		return Redirect::to('admin/shipping');
	}


}
