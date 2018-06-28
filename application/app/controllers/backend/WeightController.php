<?php

class WeightController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"weight");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$weight = Weight::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.weight.index',compact('weight','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.weight.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:weight,weight_name',
			'sample' => 'required|unique:weight,weight_sample'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/weight/create')
				->withErrors($validator)
				->withInput();
		}

		$weight = new Weight;
		$weight->weight_name = Input::get('name');
		$weight->weight_sample = Input::get('sample');

		$weight->save();

		Session::flash('success', 'Weight is successfully created.');
		return Redirect::to('admin/weight');
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
		$weight = Weight::findOrFail($id);
		return View::make('backend.admin.weight.detail', compact('weight'));
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
		$weight = Weight::find($id);
		return View::make('backend.admin.weight.edit', compact('weight'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$weight = Weight::find($id);

		$rules = array(
			'name'	=> 'required|unique:weight,weight_name,'.$id,
			'sample' => 'required|unique:weight,weight_sample,'.$id
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$weight->weight_name = Input::get('name');
			$weight->weight_sample = Input::get('sample');

			$weight->save();

			Session::flash('success', 'Weight is successfully updated.');
			return Redirect::to('admin/weight');
		} else {
			return Redirect::to('admin/weight/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Weight::destroy($id);
		Session::flash('success', 'Weight is successfully deleted.');
		return Redirect::to('admin/weight');
	}


}
