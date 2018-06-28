<?php

class Salary_paymentController extends BaseController {

	public function __construct()
	{
		parent::__construct();	
		define('MODULE',"salary_payment");				
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$staff = Staff::all();
		return View::make('backend.admin.salary_payment.index',compact('staff'));
	}
	
	public function salary_record()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$payroll=Salary_payment::get_group_by_month();
		return View::make('backend.admin.salary_payment.overall',compact('payroll'));
	}

	public function salary_list($date)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$payroll = Salary_payment::this_month_salary($date);
		return View::make('backend.admin.salary_payment.record',compact('payroll','date'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
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
		$staff = Staff::find($id);
		$salary_payment = Salary_payment::get_this_staff_all_salary($id);
		return View::make('backend.admin.salary_payment.detail',compact('salary_payment','staff'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
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
		Salary_payment::destroy($id);
		Session::flash('success', 'You have successfully deleted a salary payment.');
		return Redirect::to('admin/salary_payment');
	}


}
