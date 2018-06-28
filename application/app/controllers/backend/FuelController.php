<?php

class FuelController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"fuel");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$fuel = Fuel::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.fuel.index',compact('fuel','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.fuel.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:fuels,fuel_name'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/fuel/create')
				->withErrors($validator)
				->withInput();
		}

		$fuel = new Fuel;
		$fuel->fuel_name = Input::get('name');

		$fuel->save();

		Session::flash('success', 'Fuel is successfully created.');
		return Redirect::to('admin/fuel');
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
		$fuel = Fuel::findOrFail($id);
		return View::make('backend.admin.fuel.detail', compact('fuel'));
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
		$fuel = Fuel::find($id);
		return View::make('backend.admin.fuel.edit', compact('fuel'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$fuel = Fuel::find($id);

		$rules = array(
			'name' => 'required|unique:fuels,fuel_name,'.$id
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$fuel->fuel_name = Input::get('name');

			$fuel->save();

			Session::flash('success', 'Fuel is successfully updated.');
			return Redirect::to('admin/fuel');
		} else {
			return Redirect::to('admin/fuel/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Fuel::destroy($id);
		Session::flash('success', 'Fuel is successfully deleted.');
		return Redirect::to('admin/fuel');
	}


}
