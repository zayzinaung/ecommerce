<?php

class CpfController extends BaseController {

	public function __construct()
	{
		parent::__construct();	
		define('MODULE',"cpf");				
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$cpf = Cpf::all();
		return View::make('backend.admin.cpf.index',compact('cpf'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($month)
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$month = ($month)?$month:date('m-Y');		
		
		if(Cpf::check_duplicate($month)){
			Session::flash('success', 'The selected month for CPF is already generated.');
			return Redirect::to('admin/cpf');
		}
		
		$salary_payment = Salary_payment::all();

		$ids = $staff_information = array();
		$contByEmployee = $contByEmployer = 0; $i = 0;

		foreach ($salary_payment as $row ) {

			array_push($ids, $row->id);
			$staff_information[$i]= array();

			if($row->month == $month){
				
				/* Get the detail information of employees */
			 	$staff = Staff::find($row->staff_id);
			 	$salary = $row->gross_salary;
			 	$staff_information[$i] = array(
					'staff_id'             => $row->staff_id,
					'name'                => $staff->name,
					'salary'                => $salary,
					'contByEmployee' => Staff::getConByEmployee($staff->dob,$salary),
					'contByEmployer' => Staff::getConByEmployer($staff->dob,$salary)
				);			 	

			 	$contByEmployee += $staff_information[$i]['contByEmployee'];
				$contByEmployer += $staff_information[$i]['contByEmployer'];
			}
			$i++;
		}
		@$staff_array[$month] = array(
			'ids' => $ids,
			'staff_information' => $staff_information,
			'contByEmployee'  => $contByEmployee,
			'contByEmployer'  => $contByEmployer
		);

		Session::put($staff_array);

		return View::make('backend.admin.cpf.create',compact('month','contByEmployer','contByEmployee'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'payment_date' => 'required',
			'month' 	   => 'required|check_valid_month'
		);
		$message = array(
			'check_valid_month'	=> 'The selected month isn\'t same with generated month.'
		);
		$validator=Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/cpf/create')
				->withErrors($validator)
				->withInput();
		}

		$month = Input::get('month');
		$new_arr = Session::get($month);

		$cpf  		        = new Cpf;
		$cpf->payment_date = strtotime(Input::get('payment_date'));
		$cpf->month            = Input::get('month');
		$cpf->staff_information = serialize($new_arr['staff_information']);
		$cpf->employee        = $new_arr['contByEmployee'];
		$cpf->employer        = $new_arr['contByEmployer'];
		$cpf->save();
			
		Session::forget($month);

		Session::flash('success', 'Cpf has been added');
		return Redirect::to('admin/cpf');
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
		$cpf = Cpf::findOrFail($id);
		return View::make('backend.admin.cpf.detail',compact('cpf'));
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
		$cpf = Cpf::find($id);

		$month = $cpf->month;
		$salary_payment = Salary_payment::all();

		$ids = $staff_information = array();
		$contByEmployee = $contByEmployer = 0; $i = 0;

		foreach ($salary_payment as $row ) {

			array_push($ids, $row->id);
			$staff_information[$i]= array();

			if($row->month == $month){
				
				/* Get the detail information of employees */
			 	$staff = Staff::find($row->staff_id);
			 	$salary = $row->gross_salary;
			 	$staff_information[$i] = array(
					'staff_id'             => $row->staff_id,
					'name'                => $staff->name,
					'salary'                => $salary,
					'contByEmployee' => Staff::getConByEmployee($staff->dob,$salary),
					'contByEmployer' => Staff::getConByEmployer($staff->dob,$salary)
				);			 	

			 	$contByEmployee += $staff_information[$i]['contByEmployee'];
				$contByEmployer += $staff_information[$i]['contByEmployer'];
			}
			$i++;
		}
		@$staff_array[$month] = array(
			'ids' => $ids,
			'staff_information' => $staff_information,
			'contByEmployee'  => $contByEmployee,
			'contByEmployer'  => $contByEmployer
		);

		Session::put($staff_array);
		return View::make('backend.admin.cpf.edit',compact('cpf','month','contByEmployer','contByEmployee'));
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
			'payment_date' => 'required',
			'month' 	   => 'required|check_update_valid_month'
		);
		$message = array(
			'check_update_valid_month'	=> 'The selected month isn\'t same with generated month.'
		);
		$validator=Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/cpf/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}
		
		$month = Input::get('month');
		$new_arr = Session::get($month);

		$cpf  		        = Cpf::find($id);
		$cpf->payment_date = strtotime(Input::get('payment_date'));
		$cpf->month            = Input::get('month');
		$cpf->staff_information        = serialize($new_arr['staff_information']);
		$cpf->employee        = $new_arr['contByEmployee'];
		$cpf->employer        = $new_arr['contByEmployer'];
		$cpf->save();
		
		Session::forget($month);

		Session::flash('success', 'Cpf has been updated.');
		return Redirect::to('admin/cpf');
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
		Cpf::destroy($id);
		Session::flash('success', 'You have successfully deleted a cpf.');
		return Redirect::to('admin/cpf');
	}
	

}
