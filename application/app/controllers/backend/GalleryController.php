<?php

class GalleryController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"gallery");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$facebook_gallery = General_setting::where('type', '=', 'facebook_gallery')->first();
		$gallery = General_setting::where('type', '=', 'gallery')->first();
		$get_fbgallery = Facebook_gallery::find(1);
		return View::make('backend.admin.gallery.index',compact('facebook_gallery','gallery','get_fbgallery'));
	}

	public function gallery_list()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$gallery = Gallery::all();
		return View::make('backend.admin.gallery.list',compact('gallery'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.gallery.add');
	}

	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required',
			'gallery_image' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/gallery/create')
				->withErrors($validator)
				->withInput();
		}

		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('gallery_image'),'uploads/gallery');

		$gallery = new Gallery;
		$gallery->name = Input::get('name');
		$gallery->alt = Input::get('alt');
		$gallery->title = Input::get('title');

		if($image_files) {
			for ($i=0; $i < count($image_files); $i++) {
				$gallery->image = $image_files[$i]['imagename'];
			}
		}
		
		$gallery->save();

		Session::flash('success', 'Gallery Image is successfully created.');
		return Redirect::to('admin/galleries/list');
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
		$gallery = Gallery::findOrFail($id);
		return View::make('backend.admin.gallery.detail', compact('gallery'));
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
		$gallery = Gallery::find($id);
		$images = Gallery::where('id','=',$id)->where('image','!=',"")->get();
		return View::make('backend.admin.gallery.edit', compact('gallery','images'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$file = Input::file('gallery_image');

		$rules = array(
			'name' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/gallery/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$gallery = Gallery::find($id);
		$gallery->name = Input::get('name');
		$gallery->alt = Input::get('alt');
		$gallery->title = Input::get('title');

		if(!is_null($file[0])){
			$image_files = array();
			$image_files = parent::common_upload_picture(Input::file('gallery_image'),'uploads/gallery');
				
			for ($i=0; $i < count($image_files); $i++) {
				$gallery->image = $image_files[$i]['imagename'];
			}
		}
		
		$gallery->updated_at = Date('Y-m-d H:i:s');
		$gallery->save();

		Session::flash('success', 'Gallery Image is successfully updated.');
		return Redirect::to('admin/galleries/list');
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
		$gallery = Gallery::find($id);
		unlink('uploads/gallery/'.$gallery->image);
		Gallery::destroy($id);
		Session::flash('success', 'Gallery Image is successfully deleted.');
		return Redirect::to('admin/galleries/list');
	}
	
	public function is_active()
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$type = Input::get('type');
		$value = General_setting::where('type','=',$type)->first();
		if ( $value->type === 'facebook_gallery' )
		{
			$gallery = General_setting::where('type','=','gallery')->first();
			if ( $value->type == 'active' )
			{
				$value->format = 'inactive';
				$value->save();

				$gallery->format = 'active';
				$gallery->save();
			} else {
				$value->format = 'active';
				$value->save();
				
				$gallery->format = 'inactive';
				$gallery->save();
			}
			
		} else {
			$facebook_gallery = General_setting::where('type','=','facebook_gallery')->first();
			if ( $value->type == 'active' )
			{
				$value->format = 'inactive';
				$value->save();

				$facebook_gallery->format = 'active';
				$facebook_gallery->save();
			} else {
				$value->format = 'active';
				$value->save();
				
				$facebook_gallery->format = 'inactive';
				$facebook_gallery->save();
			}
		}
		Session::flash('success', 'Gallery is successfully updated.');
		return Redirect::to('admin/gallery');
	}
	
	public function edit_facebook_id($id)
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$get_facebook = Facebook_gallery::find($id);
		return View::make('backend.admin.gallery.edit_facebook', compact('get_facebook'));
	}

	public function update_facebook_id($id)
	{
		$facebook = Facebook_gallery::find($id);

		$rules = array(
			'facebook_id'	=> 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/facebook_gallery/edit/'.$id)
				->withErrors($validator)
				->withInput();
		}

		$facebook->facebook_id = Input::get('facebook_id');
		$facebook->save();

		Session::flash('success', 'Facebook ID is successfully updated.');
		return Redirect::to('admin/gallery');
	}

	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$gallery = Gallery::find($id);
		unlink('uploads/gallery/'.$gallery->image);
		Gallery::where('id','=',$id)->update(array('image' => ''));
	}


}