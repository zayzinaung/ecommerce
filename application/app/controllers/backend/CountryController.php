<?php

class CountryController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"country");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$country = Country::all();
		return View::make('backend.admin.country.index',compact('country'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.country.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:countries,country_name',
			'code' => 'required|unique:countries,country_code',
			'country_calling' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/country/create')
				->withErrors($validator)
				->withInput();
		}

		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('flag'),'uploads/flags');

		$country = new Country;
		$country->country_name = Input::get('name');
		$country->country_code = Input::get('code');
		$country->calling_code = Input::get('country_calling');

		if($image_files) {
			for ($i=0; $i < count($image_files); $i++) {
				$country->flag = $image_files[$i]['imagename'];
			}
		}

		$country->save();
		
		Session::flash('success', 'Country is successfully created.');
		return Redirect::to('admin/country');
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
		$country = Country::findOrFail($id);
		return View::make('backend.admin.country.detail', compact('country'));
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
		$country = Country::find($id);
		$images = Country::where('id','=',$id)->where('flag','!=',"")->get();
		return View::make('backend.admin.country.edit', compact('country','images'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$country = Country::find($id);
		$file = Input::file('flag');

		$rules = array(
			'name' => 'required|unique:countries,country_name,'.$id,
			'code' => 'required|unique:countries,country_code,'.$id,
			'country_calling' => 'required',
		);

		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {

			if(!is_null($file[0])){
				$image_files = array();
				$image_files = parent::common_upload_picture(Input::file('flag'), 'uploads/flags');
				
				for ($i=0; $i < count($image_files); $i++) {
				    $country->flag = $image_files[$i]['imagename'];
				}
			}

			$country->country_name = Input::get('name');
			$country->country_code = Input::get('code');
			$country->calling_code = Input::get('country_calling');
			$country->updated_at = time();

			$country->save();

			Session::flash('success', 'Country is successfully updated.');
			return Redirect::to('admin/country');
		} else {
			return Redirect::to('admin/country/'.$id.'/edit')->withErrors($validator)->withInput();
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
		$country = Country::find($id);
		if ( $country->flag != '' )
		{
			unlink('uploads/flags/'.$country->flag);
		}
		Country::destroy($id);
		Session::flash('success', 'Country is successfully deleted.');
		return Redirect::to('admin/country');
	}
	
	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$country = Country::find($id);
		unlink('uploads/flags/'.$country->flag);
		Country::where('id','=',$id)->update(array('flag' => ''));
	}


}
