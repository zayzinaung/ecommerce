<?php

class ErrorController extends BaseController {

	public function index()
	{
		return View::make('backend.admin.errors.404');
	}

	public function show($page_no)
	{
		switch ($page_no) {
			case '403':return View::make('backend.admin.errors.403');
			break;

			case '404':return View::make('backend.admin.errors.404');
			break;

			default:return View::make('backend.admin.errors.404');
			break;
		}
	}

}

?>