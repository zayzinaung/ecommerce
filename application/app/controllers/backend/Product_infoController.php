<?php

class Product_infoController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"product_info");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$productinfo = Product_info::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.productinfo.index',compact('productinfo','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.productinfo.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:product_info,product_label',
			'type' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/product_info/create')
				->withErrors($validator)
				->withInput();
		}
		
		$product_info = new Product_info;
		$product_info->product_label = Input::get('name');
		$product_info->input_type = Input::get('type');

		$product_info->save();

		Session::flash('success', 'Product Info is successfully created.');
		return Redirect::to('admin/product_info');
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
		$product_info = Product_info::findOrFail($id);
		return View::make('backend.admin.productinfo.detail', compact('product_info'));
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
		$product_info = Product_info::find($id);
		return View::make('backend.admin.productinfo.edit', compact('product_info'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product_info = Product_info::find($id);

		$rules = array(
			'name' => 'required|unique:product_info,product_label,'.$id,
			'type' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$product_info->product_label = Input::get('name');
			$product_info->input_type = Input::get('type');

			$product_info->save();

			Session::flash('success', 'Product Info is successfully updated.');
			return Redirect::to('admin/product_info');
		} else {
			return Redirect::to('admin/product_info/'.$id.'/edit')->withErrors($validator)->withInput();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		Product_info::destroy($id);
		Session::flash('success', 'Product Info is successfully deleted.');
		return Redirect::to('admin/product_info');
	}


}
