<?php

class SizeController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"size");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$size = Size::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.size.index',compact('size','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.size.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:sizes,size_name'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/size/create')
				->withErrors($validator)
				->withInput();
		}

		$size = new Size;
		$size->size_name = Input::get('name');

		$size->save();

		Session::flash('success', 'Size is successfully created.');
		return Redirect::to('admin/size');
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
		$size = Size::findOrFail($id);
		return View::make('backend.admin.size.detail', compact('size'));
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
		$size = Size::find($id);
		return View::make('backend.admin.size.edit', compact('size'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$size = Size::find($id);

		$rules = array(
			'name' => 'required|unique:sizes,size_name,'.$id
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$size->size_name = Input::get('name');

			$size->save();

			Session::flash('success', 'Size is successfully updated.');
			return Redirect::to('admin/size');
		} else {
			return Redirect::to('admin/size/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Size::destroy($id);
		Session::flash('success', 'Size is successfully deleted.');
		return Redirect::to('admin/size');
	}


}
