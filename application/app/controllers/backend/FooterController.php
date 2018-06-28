<?php

class FooterController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"footer");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$first_column = Footer::where('name','=','first_column')->first();
		$third_column = Footer::where('name','=','third_column')->first();
		$fourth_column = Footer::where('name','=','fourth_column')->first();

		return View::make('backend.admin.footer.index', compact('first_column','third_column','fourth_column'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		$footer_cms = Footer::find($id);
		return View::make('backend.admin.footer.edit', compact('footer_cms'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$footer_cms = Footer::find($id);

		if ( $footer_cms->name == 'first_column' )
		{
			$rules = array(
				'title' => 'required',
				'text' => 'required'
			);
		} elseif ( $footer_cms->name == 'third_column' ) {
			$rules = array(
				'url' => 'required'
			);
		} elseif ( $footer_cms->name == 'fourth_column' ) {
			$rules = array(
				'fourth_title' => 'required',
				'address' => 'required',
				'phone' => 'required',
				'email' => 'required'
			);
		}
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/footer_cms/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		if ( $footer_cms->name == 'first_column' )
		{
			$footer_cms->title = Input::get('title');
			$footer_cms->text = Input::get('text');
		} elseif ( $footer_cms->name == 'third_column' ) {
			$footer_cms->title = Input::get('url');
		} elseif ( $footer_cms->name == 'fourth_column' ) {
			$footer_cms->title = Input::get('fourth_title');
			$footer_cms->text = Input::get('address');
			$footer_cms->phone = Input::get('phone');
			$footer_cms->email = Input::get('email');
			$footer_cms->fax = Input::get('fax');
		}
		
		$footer_cms->save();

		Session::flash('success', 'Footer is successfully updated.');
		return Redirect::to('admin/footer_cms');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function footer_menu()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$footer_menu = Menu::all();

		return View::make('backend.admin.footer.footer_menu', compact('footer_menu'));
	}
	
	public function is_active()
	{
		$menu = Menu::find(Input::get('id'));
		if ( $menu->footer_active == 0 )
		{
			$menu->footer_active = 1;
		} else {
			$menu->footer_active = 0;
		}
		$menu->save();

		Session::flash('success', 'Footer menu is successfully updated.');
		return Redirect::to('admin/footer/menu');
	}
	
	public function order_menu()
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$footer_menu = Menu::where('footer_active','=',1)->orderBy('footer_ordering')->get();

		return View::make('backend.admin.footer.reorder_menu', compact('footer_menu'));
	}
	
	public function save_menu()
	{
		$menus = json_decode(Input::get('reorder'),true);
		$a = 0;
		foreach($menus as $m)
		{
			DB::table('menu_setting')->where('id','=', $m['id'])->update(array('footer_ordering'=>$a));
			$a++;
		}

		Session::flash('success', 'Footer menu is successfully updated.');
		return Redirect::to('admin/footer/menu');
	}

}
