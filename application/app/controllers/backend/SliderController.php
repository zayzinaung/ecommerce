<?php

class SliderController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"slider");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$slider = Slider::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.slider.index',compact('slider','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.slider.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/slider/create')
				->withErrors($validator)
				->withInput();
		}
		
		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('slider_image'),'uploads/sliders');

		$slider = new Slider;
		$slider->slider_name = Input::get('name');
		$slider->description = Input::get('description');

		if($image_files) {
			for ($i=0; $i < count($image_files); $i++) {
				$slider->slider_image = $image_files[$i]['imagename'];
			}
		}

		$slider->save();

		Session::flash('success', 'Slider is successfully created.');
		return Redirect::to('admin/slider');
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
		$slider = Slider::findOrFail($id);
		return View::make('backend.admin.slider.detail', compact('slider'));
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
		$slider = Slider::find($id);
		$images = Slider::where('id','=',$id)->where('slider_image','!=',"")->get();
		return View::make('backend.admin.slider.edit', compact('slider','images'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$slider = Slider::find($id);
		$file = Input::file('slider_image');

		$rules = array(
			'name' => 'required'
		);

		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {

			if(!is_null($file[0])){
				$image_files = array();
				$image_files = parent::common_upload_picture(Input::file('slider_image'), 'uploads/sliders');
				
				for ($i=0; $i < count($image_files); $i++) {
				    $slider->slider_image = $image_files[$i]['imagename'];
				}
			}

			$slider->slider_name = Input::get('name');
			$slider->description = Input::get('description');

			$slider->save();

			Session::flash('success', 'Slider is successfully updated.');
			return Redirect::to('admin/slider');
		} else {
			return Redirect::to('admin/slider/'.$id.'/edit')->withErrors($validator)->withInput();
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
		$slider = Slider::find($id);
		unlink('uploads/sliders/'.$slider->slider_image);
		Slider::destroy($id);
		Session::flash('success', 'Slider is successfully deleted.');
		return Redirect::to('admin/slider');
	}
	
	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$slider = Slider::find($id);
		unlink('uploads/sliders/'.$slider->slider_image);
		Slider::where('id','=',$id)->update(array('slider_image' => ''));
	}


}
