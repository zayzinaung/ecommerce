<?php

class PermissionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permissions = Permission::get_permission_list();
		return View::make('backend.admin.permission.view')->with('permission',$permission);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$role = Input::get('role_id');
		$count = Permission::isPermDuplicate();
		if($count==0) {
			Permission::add_permission();
			return Redirect::to('admin/role/'.$role);
		} else {
			Session::flash('error', 'Role Duplicate');
			return Redirect::to('admin/role/'.$role);
		}
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

	public function delete($id)
	{
		DB::table('permissions')->where('id', '=', $id)->delete();
	}

	public function add_sub_permission()
	{
		Permission::add_sub_permission();
	}
	
	public function getPermissionByRole($id,$field=NULL)
	{
		if(is_null($field)) {
			$role = Permission::where('role_id','=',$id)->get();
			echo json_encode($role);
		} else {
			$role=Permission::where('role_id',$id)->pluck($field);
			echo json_encode($role);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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


}
