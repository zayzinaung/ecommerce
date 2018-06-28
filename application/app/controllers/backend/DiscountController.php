<?php

class DiscountController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"discount");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$discount = Discount::all();
		$currency = Common::get_currency();
		return View::make('backend.admin.discount.index',compact('discount','currency'));
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
		$discount = Discount::findOrFail($id);

		$description = unserialize($discount->description);

		$discount_rate = $description['discount_rate'];
		$remark = $description['remark'];

		$currency = Common::get_currency();

		if ( array_key_exists('price', $description) )
		{
			$price = $description['price'];
			return View::make('backend.admin.discount.detail', compact('discount','price','discount_rate','remark','currency'));
		}

		if ( array_key_exists('qty', $description) )
		{
			$qty = $description['qty'];
			return View::make('backend.admin.discount.detail', compact('discount','qty','discount_rate','remark'));
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
		$discount = Discount::find($id);

		$description = unserialize($discount->description);

		$discount_rate = $description['discount_rate'];
		$remark = $description['remark'];

		$currency = Common::get_currency();

		if ( array_key_exists('price', $description) )
		{
			$price = $description['price'];
			return View::make('backend.admin.discount.edit', compact('discount','price','discount_rate','remark','currency'));
		}

		if ( array_key_exists('qty', $description) )
		{
			$qty = $description['qty'];
			return View::make('backend.admin.discount.edit', compact('discount','qty','discount_rate','remark'));
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
		$discount = Discount::find($id);
		
		if ( $discount->method == 'price' )
		{
			$rules = array(
				'price'	=> 'required',
				'discount_rate' => 'required',
				'remark' => 'required'
			);
		} elseif ( $discount->method == 'qty' ) {
			$rules = array(
				'qty'	=> 'required',
				'discount_rate' => 'required',
				'remark' => 'required'
			);
		}
		
		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()) {
			return Redirect::to('admin/discount/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$price = Input::get('price');
		$qty = Input::get('qty');
		$discount_rate = Input::get('discount_rate');
		$remark = Input::get('remark');

		if ( $price != null )
		{
			$desc_arr = array('price' => $price, 'discount_rate' => $discount_rate, 'remark' => $remark);
		} elseif ( $qty != null ) {
			$desc_arr = array('qty' => $qty, 'discount_rate' => $discount_rate, 'remark' => $remark);
		}

		$discount->description = serialize($desc_arr);
		$discount->save();

		Session::flash('success', 'Discount is successfully updated.');
		return Redirect::to('admin/discount');
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
			DB::table('discounts')
	           		->where('id', $id)
	           		->update(array('is_active' => 0));
		} else {
			$get_active = Discount::where('is_active','=',1)->first();
			if ( $get_active != null )
			{
				DB::table('discounts')->where('id', $get_active->id)->update(array('is_active' => 0));
				DB::table('discounts')->where('id', $id)->update(array('is_active' => 1));

			} else {
				DB::table('discounts')
		           		->where('id', $id)
		           		->update(array('is_active' => 1));
			}
		}

            	Session::flash('success', 'Discount is successfully edited.');
		return Redirect::to('admin/discount');
	}


}
