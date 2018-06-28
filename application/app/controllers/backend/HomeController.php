<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function index()
	{
		if(Auth::check()) {
			if(Auth::user()->role_id==1)
			{
				return View::make('backend.admin.home.index');
			} else {
				return View::make('backend.sessions.login');
			}
		} else {
			return View::make('backend.sessions.login');
		}
	}
	
	public function back_up()
	{
		//$backupPath = app_path() . "\storage\backup\\";
		//$backup_file = File::files($backupPath);
		//rsort($backup_file);

		$backupPath = storage_path('backup');
		$backup_file = File::allFiles($backupPath);

		$backup =array();
		foreach($backup_file as $path)
		{
		      	$backup[] = pathinfo($path);
		}
		//$this->view('admin.home.back_up',compact('backup'));
		return View::make('backend.admin.home.back_up',compact('backup'));
	}
	
	public function back_up_now()
	{
		
		Artisan::call('db:backup');

		Session::flash('success', 'Successfully backup your data.');
		return Redirect::to('admin/home/back_up');
	}
	
}
