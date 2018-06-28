<?php

class BaseController extends Controller {

	public function __construct()
	{
	    if(!Auth::check()) {
			return Redirect::to('/admin');
	    }
	    User::initRolePerm();
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Creates a view
	 *
	 * @param String $path path to the view file
	 * @param Array $data all the data
	 * @return void
	 */
	protected function view($path, array $data = [])
	{
		$this->layout->content = View::make($path, $data);
	}
	 
	/**
	 * Redirect back with input and with provided data
	 *
	 * @param Array $data all the data
	 * @return void
	 */
	protected function redirectBack($data = [])
	{
		return Redirect::back()->withInput()->with($data);
	}
	 
	/**
	 * Redirect to the previous url
	 *
	 * @return void
	 */
	public function redirectReferer()
	{
		$referer = Request::server('HTTP_REFERER');
		return Redirect::to($referer);
	}
	 
	/**
	 * Redirect to a given route, with optional data
	 *
	 * @param String $route route name
	 * @param Array $data optional data
	 * @return void
	 */
	protected function redirectRoute($route, $data = [])
	{
		return Redirect::route($route, $data);
	}

	/**
	 * File upload function
	 *
	 */
	protected function common_upload_picture($files, $path)
	{
	    	$file = array();
	    	$i = 0;
	    	foreach($files as $image) {
		    	if(isset($image))
		    	{
		    		$name       = $image->getClientOriginalName();   //for original image name
		    		$realname   = explode('.', $name);
		    		$imagename  = md5(uniqid(mt_rand())).$image->getClientOriginalName();   //for upload image name
			    	$uploadflag = $image->move($path, $imagename);    //move to desire folder path

			    	$file[$i] = array();
			    	$file[$i]['imagename'] = $imagename;
			    	$file[$i]['realname']  = $realname[0];
				$i++;
			}
		}
	    	return $file;
	}

}
