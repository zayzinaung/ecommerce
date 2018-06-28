<?php

class UserController extends BaseController {

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
		$user = User::where('name','=','Member')->get();
		return View::make('backend.admin.user.index',compact('user'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$roles = Role::all();
		return View::make('backend.admin.user.add',compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),User::$add_rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/user/create')
				->withErrors($validator)
				->withInput();
		}
		
		$user = new User;
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->role_id = Input::get('role_id');
		$user->save();

		Session::flash('success', 'User is successfully created.');
		return Redirect::to('admin/user');
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
		$user = User::findOrFail($id);
		$date_format = Common::get_date();
		return View::make('backend.admin.user.detail', compact('user','date_format'));
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
		$role = Role::all();
		$user = User::find($id);
		$permissions = Permission::getPermissionByRole($user->role_id);
		return View::make('backend.admin.user.edit')
			->with('user', $user)
			->with('role',$role)
			->with('permission',$permissions);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name' => 'required',
			'username' =>	'required|unique:users,username,'.$id,
			'role_id'	=> 'required',
			'email' => 'required|email|unique:users,email,'.$id 
		);

		if(Input::get('password')) {
			$rules['passconf'] = 'required|same:password';
		}

		$messages = array(
			'check_user_unique' => 'The :attribute field must be unique.',
		);

		$validator = Validator::make(Input::all(),$rules,$messages);

		if($validator->passes()) {
			$user = User::find($id);
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->role_id = Input::get('role_id');
			$user->save();

			Session::flash('success', 'User is successfully updated.');
			return Redirect::to('admin/user');
		} else {
			return Redirect::to('admin/user/'.$id.'/edit')->withErrors($validator)->withInput();
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
		User::destroy($id);
		Session::flash('success', 'User is successfully deleted.');
		return Redirect::route('backend.admin.user.index');
	}

}
?>