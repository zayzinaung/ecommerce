<?php

class ColorController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"color");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$color = Color::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.color.index',compact('color','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.color.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Color::$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/color/create')
				->withErrors($validator)
				->withInput();
		}
		
		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('color_image'),'uploads/color_images');

		$get_code = str_replace('#','',Input::get('code'));

		$color = new Color;
		$color->color_name = Input::get('name');
		$color->color_code = '#'.$get_code;

		if($image_files) {
			for ($i=0; $i < count($image_files); $i++) {
				$color->color_image = $image_files[$i]['imagename'];
			}
		}

		$color->save();

		Session::flash('success', 'Color is successfully created.');
		return Redirect::to('admin/color');
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
		$color = Color::findOrFail($id);
		return View::make('backend.admin.color.detail', compact('color'));
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
		$color = Color::find($id);
		$images = Color::where('id','=',$id)->where('color_image','!=',"")->get();
		return View::make('backend.admin.color.edit', compact('color','images'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$color = Color::find($id);
		$file = Input::file('color_image');

		$rules = array(
			'code' => 'required|unique:colors,color_code,'.$id
		);

		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {

			if(!is_null($file[0])){
				$image_files = array();
				$image_files = parent::common_upload_picture(Input::file('color_image'), 'uploads/color_images');
				
				for ($i=0; $i < count($image_files); $i++) {
				    $color->color_image = $image_files[$i]['imagename'];
				}
			}

			$get_code = str_replace('#','',Input::get('code'));
			
			$color->color_name = Input::get('name');
			$color->color_code = '#'.$get_code;
			$color->updated_at = Date('Y-m-d H:i:s');

			$color->save();

			Session::flash('success', 'Color is successfully updated.');
			return Redirect::to('admin/color');
		} else {
			return Redirect::to('admin/color/'.$id.'/edit')->withErrors($validator)->withInput();
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
		$color = Color::find($id);
		unlink('uploads/color_images/'.$color->color_image);
		Color::destroy($id);
		Session::flash('success', 'Color is successfully deleted.');
		return Redirect::to('admin/color');
	}

	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$color = Color::find($id);
		unlink('uploads/color_images/'.$color->color_image);
		Color::where('id','=',$id)->update(array('color_image' => ''));
	}


}
