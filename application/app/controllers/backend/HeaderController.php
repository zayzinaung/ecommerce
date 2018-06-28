<?php

class HeaderController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"header");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$header_menu = Menu::all();
		return View::make('backend.admin.header_cms.index', compact('header_menu'));
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
	public function show()
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$data = Common::get_menu();
		return View::make('backend.admin.header_cms.reorder_menu', compact('data'));
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
	public function update()
	{
		//
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
	
	public function is_active()
	{
		$menu = Menu::find(Input::get('id'));
		if ( $menu->header_active == 0 )
		{
			$menu->header_active = 1;
		} else {
			$menu->header_active = 0;
		}
		$menu->save();

		Session::flash('success', 'Header menu is successfully updated.');
		return Redirect::to('admin/header_cms');
	}
	
	public function save_menu()
	{
		$menus = json_decode(Input::get('reorder'),true);
		$child = array();
		$a=0;
		foreach($menus as $m)
		{			
			if(isset($m['children']))
			{
				$b=0;
				foreach($m['children'] as $l)					
				{
					if(isset($l['children']))
					{
						$c=0;
						foreach($l['children'] as $l2)
						{
							$level3[] = $l2['id'];
							DB::table('menu_setting')->where('id','=',$l2['id'])
								->update(array('parent_id'=> $l['id'],'header_ordering'=>$c));
							$c++;	
						}		
					}
					DB::table('menu_setting')->where('id','=', $l['id'])
						->update(array('parent_id'=> $m['id'],'header_ordering'=>$b));	
					$b++;
				}							
			}
			DB::table('menu_setting')->where('id','=', $m['id'])
				->update(array('parent_id'=>'0','header_ordering'=>$a));
			$a++;		
		}
		
		Session::flash('success', 'Header menu is successfully updated.');
		return Redirect::to('admin/header_cms');
	}


}
