<?php

class PageController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"pages");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$pages = Page::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.pages.index',compact('pages','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.pages.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Page::$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/pages/create')
				->withErrors($validator)
				->withInput();
		}
		
		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('page_image'),'uploads/pages');

		$page = new Page;
		$page->name = Input::get('name');
		$page->title = Input::get('title');
		$page->description = Input::get('description');

		if($image_files) {
			for ($i=0; $i < count($image_files); $i++) {
				$page->image = $image_files[$i]['imagename'];
			}
		}

		$page->save();
		
		$menu = new Menu;
		$menu->page_id = $page->id;
		$menu->save();

		Session::flash('success', 'Page is successfully created.');
		return Redirect::to('admin/pages');
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
		$pages = Page::findOrFail($id);
		return View::make('backend.admin.pages.detail', compact('pages'));
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
		$pages = Page::find($id);
		$images = Page::where('id','=',$id)->where('image','!=',"")->get();
		return View::make('backend.admin.pages.edit', compact('pages','images'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pages = Page::find($id);
		$file = Input::file('page_image');
		
		$validator = Validator::make(Input::all(),Page::$rules);
		
		if( $validator->fails() ) {
			return Redirect::to('admin/pages/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}
		
		if(!is_null($file[0])){
			$image_files = array();
			$image_files = parent::common_upload_picture(Input::file('page_image'), 'uploads/pages');
				
			for ($i=0; $i < count($image_files); $i++) {
				$pages->image = $image_files[$i]['imagename'];
			}
		}
		
		$pages->name = Input::get('name');
		$pages->title = Input::get('title');
		$pages->description = Input::get('description');
		$pages->updated_at = Date('Y-m-d H:i:s');
		
		$pages->save();
		
		Session::flash('success', 'Page is successfully updated.');
		return Redirect::to('admin/pages');
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
		$pages = Page::find($id);
		unlink('uploads/pages/'.$pages->image);
		Page::destroy($id);

		$menu = DB::table('menu_setting')->where('page_id', $id)->pluck('id');
		Menu::destroy($menu);

		Session::flash('success', 'Page is successfully deleted.');
		return Redirect::to('admin/pages');
	}

	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$pages = Page::find($id);
		unlink('uploads/pages/'.$pages->image);
		Page::where('id','=',$id)->update(array('image' => ''));
	}


}
