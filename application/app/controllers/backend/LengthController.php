<?php

class LengthController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"length");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$length = Length::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.length.index',compact('length','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.length.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:length,length_name',
			'sample' => 'required|unique:length,length_sample'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/length/create')
				->withErrors($validator)
				->withInput();
		}
		
		$length = new Length;
		$length->length_name = Input::get('name');
		$length->length_sample = Input::get('sample');

		$length->save();

		Session::flash('success', 'Length is successfully created.');
		return Redirect::to('admin/length');
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
		$length = Length::findOrFail($id);
		return View::make('backend.admin.length.detail', compact('length'));
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
		$length = Length::find($id);
		return View::make('backend.admin.length.edit', compact('length'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$length = Length::find($id);

		$rules = array(
			'name'	=> 'required|unique:length,length_name,'.$id,
			'sample' => 'required|unique:length,length_sample,'.$id
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$length->length_name = Input::get('name');
			$length->length_sample = Input::get('sample');

			$length->save();

			Session::flash('success', 'Length is successfully updated.');
			return Redirect::to('admin/length');
		} else {
			return Redirect::to('admin/length/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Length::destroy($id);
		Session::flash('success', 'Length is successfully deleted.');
		return Redirect::to('admin/length');
	}


}
