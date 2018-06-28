<?php

class RoleController extends BaseController {

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
		$role = Role::where('role_desc','!=','Member')->get();
		$date_format = Common::get_date();
		return View::make('backend.admin.role.index',compact('role','date_format'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.role.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),Role::$rules);

		if ( $validator->fails() ) {
			return Redirect::to('admin/role/create')
				->withErrors($validator)
				->withInput();
		}
		
		$module = new Role;
		$module->description = Input::get('description');
		$module->role_desc = Input::get('name');
		$module->save();

		Session::flash('success', 'Role is successfully created.');
		return Redirect::to('admin/role');
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
		$role = Role::find($id);
		$role_id = $role->id;

		$permission = Permission::where('role_id','=',$role_id)->get();
		$role = Role::find($id);
		$module = Class_lists::all();

		$permissions_array = array();
		$modules_array = array();
		foreach ($permission as $per) {
			array_push($permissions_array, $per->permission) ;
		}
		asort($permissions_array);
		foreach ($module as $mod) {
			$modules_array[$mod->id] = $mod->name;
		}
		$modules = array_diff($modules_array,$permissions_array);
		return View::make('backend.admin.permission.view',compact('modules','permission','role','module'));
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
		$role = Role::find($id);
		return View::make('backend.admin.role.edit')
			->with('role', $role);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::find($id);
		$validator = Validator::make(Input::all(),Role::$rules);
		if($validator->passes()) {
			$role->description = Input::get('description');
			$role->role_desc = Input::get('name');
			$role->save();
			Session::flash('success', 'Role is successfully updated.');
			return Redirect::to('admin/role');
		} else {
			return Redirect::to('admin/role/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Role::destroy($id);
		Session::flash('success', 'Role is successfully deleted.');
		return Redirect::route('backend.admin.role.index');
	}

	public function get_role($id)
	{
		$role = Permission::where('role_id','=',$id)->get();
		return $role->toJson();
	}

}
