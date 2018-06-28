<?php

class ModuleController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"user");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$module = Class_lists::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.module.index',compact('module','date_format'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.module.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),Class_lists::$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/module/create')
				->withErrors($validator)
				->withInput();
		}
		
		$module = new Class_lists;
		$module->name = strtolower(Input::get('name'));
		$module->description = Input::get('description');
		$module->save();

		Session::flash('success', 'Module is successfully created.');
		return Redirect::to('admin/module');
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
		$module = Class_lists::findOrFail($id);
		return View::make('backend.admin.module.detail', compact('module'));
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
		$module = Class_lists::find($id);
		// show the edit form and pass the nerd
		return View::make('backend.admin.module.edit')
			->with('module', $module);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$module = Class_lists::find($id);
		$validator = Validator::make(Input::all(),Class_lists::$rules);
		if($validator->passes()) {
			$module->name = strtolower(Input::get('name'));
			$module->description = Input::get('description');
			$module->save();
			Session::flash('success', 'Module is successfully updated.');
			return Redirect::to('admin/module');
		} else {
			return Redirect::to('admin/module/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Class_lists::destroy($id);
		Session::flash('success', 'Module is successfully deleted.');
		return Redirect::route('backend.admin.module.index');
	}

}
