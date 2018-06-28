<?php

class GstController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"gst");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$gst = Gst::all();
		return View::make('backend.admin.gst.index',compact('gst'));
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
	public function edit()
	{
		//
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
	public function destroy()
	{
		//
	}

	public function is_apply()
	{
		$id = Input::get('id');
		$apply = Input::get('apply');

		if ( $apply == 1 )
		{
			DB::table('gst')
	           		->where('id', $id)
	           		->update(array('is_apply' => 0));
		} else {
			DB::table('gst')
		           	->where('id', $id)
		           	->update(array('is_apply' => 1));
		}

            	Session::flash('success', 'GST is successfully edited.');
		return Redirect::to('admin/gst');
	}
	
	public function update_gst_ajax()
	{
		$id = Input::get('id');
		$tax = Input::get('tax');

		if ( DB::table('gst')->where('id','=',$id)->update(array('tax'=>$tax)) )
		{
			$data['status'] = 'success';
		} else {
			$data['status'] = 'fail';
		}
		
        		echo json_encode($data);
	}


}
