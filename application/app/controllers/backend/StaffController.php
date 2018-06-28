<?php

class StaffController extends BaseController {

	public function __construct()
	{
		parent::__construct();	
		define('MODULE',"staff");				
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
		return View::make('backend.admin.staff.index',compact('staff'));
	}

	public function payroll()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$staff = Staff::where('status',0)->get();
		return View::make('backend.admin.staff.payroll',compact('staff'));
	}

	public function pay($staff_id,$month=Null)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$month = ($month)?$month:date('m-Y');
		
		if(Salary_payment::check_duplicate($staff_id,$month)){
			Session::flash('success', 'The selected month for this staff is already paid.');
			return Redirect::to('admin/staff/payroll');
		}
		$staff          = Staff::find($staff_id);
		$conByEmp = Staff::getConByEmployee($staff->dob,$staff->salary);
		return View::make('backend.admin.staff.salarypayment_form',compact('staff','conByEmp','month'));
	}

	public function save_payment($staff_id,$month)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');

		$rules = array(
			'salary'         	  => 'required|numeric',
			'comission'         => 'numeric',
			'overtime'           => 'numeric',
			'conByEmp'         => 'required|numeric',
			'salary_advance'  => 'numeric',
			'amount'             => 'required|numeric',
			'month'   	   => 'required',
			'payment_date'    => 'required'
		);

		if(Input::get('mode')==1){
			$rules['bank_name'] = 'required';
			$rules['branch_name'] = 'required';
			$rules['cheque_date'] = 'required';
			$rules['cheque_no'] = 'required';
			$rules['cheque_issue_date'] = 'required';
		}
		else if(Input::get('mode')==2){
			$rules['bank_name'] = 'required';
			$rules['acc_type'] = 'required';
			$rules['acc_no'] = 'required';
			$rules['receipt_no'] = 'required';
		}

		$validator=Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/staff/pay/'.$staff_id.'/'.$month)
				->withErrors($validator)
				->withInput();
		}
			
		$payment_info='';

		if(Input::get('mode')==1) { /*cheque*/
			$method = 'Cheque';
			$payment_info = array(
				'Bank Name' => Input::get('bank_name'),
				'Branch Name' => Input::get('branch_name'),
				'Cheque Date' => Input::get('cheque_date'),
				'Cheque No' => Input::get('cheque_no'),
				'Cheque Issue Date' =>Input::get('cheque_issue_date'),
				'Remark' => Input::get('remark'),
			);

		}
		elseif(Input::get('mode')==2) { /*bank transfer*/
			$method = 'Bank Transfers';
			$payment_info = array(
				'Bank Name' => Input::get('bank_name'),
				'Account Type' => Input::get('acc_type'),				 	
				'Account No' => Input::get('acc_no'),			 					 	
				'Receipt No' => Input::get('receipt_no'),
			);

		} else { /*cash */
			$method = 'Cash';
		}


		$data = array(
			'staff_id'=> $staff_id,				
			'gross_salary'=> Input::get('salary'),
			'comission'=> Input::get('comission'),
			'overtime'=> Input::get('overtime'),
			'conByEmp'=> Input::get('conByEmp'),
			'salary_advance'=> Input::get('salary_advance'),
			'amount'=> Input::get('amount'),
			'month'=> Input::get('month'),
			'payment_date'=>strtotime(Input::get('payment_date')),
			'method' => $method,
			'cpf_status' => 1,
			'payment_info' => serialize($payment_info)
		);		
			
		DB::table('salary_payments')->insert($data);

		Session::flash('success', 'Successfully made a staff salary payment.');
		return Redirect::to('admin/staff/payroll');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{  				
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.staff.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator=Validator::make(Input::all(),Staff::$add_rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/staff/create')
				->withErrors($validator)
				->withInput();
		}

		$staff=new Staff;
		$staff->name=Input::get('name');
		$staff->email=Input::get('email');
		$staff->dob=strtotime(Input::get('dob'));
		$staff->designation=Input::get('designation');
		$staff->salutation=Input::get('salutation');
		$staff->ic_type=Input::get('ictype');
		$staff->fin=Input::get('fin');
		$staff->fin_exp_date=Input::get('fin_exp_date');
		$staff->ppn=Input::get('ppn');
		$staff->ppn_exp_date=Input::get('ppn_exp_date');
		$staff->salary=Input::get('salary');
		$staff->basic_salary=Input::get('salary');
		$staff->join_date=strtotime(Input::get('join_date'));
		$staff->save();

		Session::flash('success', 'Staff has been added');
		return Redirect::to('admin/staff');
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
		$staff = Staff::findOrFail($id);
		return View::make('backend.admin.staff.detail',compact('staff'));
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
		$staff = Staff::find($id);
		return View::make('backend.admin.staff.edit',compact('staff'));
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
			'id'		=> 'unique:staffs,id,'.$id,
			'name'		=> 'required',
			'email' 		=> 'required|email|unique:staffs,email,'.$id,
			'salary' 		=> 'required|numeric',
			'dob' 		=> 'required',
			'salutation'	=> 'required',
			'ictype'		=> 'required',
			'fin'		=> 'required',
			'fin_exp_date'	=> '',
			'ppn'		=> 'required',
			'ppn_exp_date'	=> '',
			'designation'	=> 'required',
			'join_date'	=> 'required'
		);

		$messages = array(
			'check_staff_unique' => 'The :attribute field must be unique.',
		);

		$validator=Validator::make(Input::all(),$rules,$messages);

		if( $validator->fails() ) {
			return Redirect::to('admin/staff/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$staff = Staff::find($id);
		$staff->name=Input::get('name');
		$staff->email=Input::get('email');
		$staff->dob=strtotime(Input::get('dob'));
		$staff->designation=Input::get('designation');
		$staff->salutation=Input::get('salutation');
		$staff->ic_type=Input::get('ictype');
		$staff->fin=Input::get('fin');
		$staff->fin_exp_date=Input::get('fin_exp_date');
		$staff->ppn=Input::get('ppn');
		$staff->ppn_exp_date=Input::get('ppn_exp_date');
		$staff->salary=Input::get('salary');
		$staff->basic_salary=Input::get('salary');
		$staff->join_date=strtotime(Input::get('join_date'));
		$staff->save();

		Session::flash('success', 'Staff has been updated');
		return Redirect::to('admin/staff');
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
		try {
			Staff::destroy($id);
			Session::flash('success', 'You have successfully deleted a staff.');

		} catch (PDOException  $e) {
			Session::flash('error', 'Couldn\'t delete this staff, it may be used in other modules.');
		}
		
		return Redirect::to('admin/staff');
	}

	public function update_staff_info()
	{
		$id = Input::get('pk');
		$name =  Input::get('name');
		$value = Input::get('value');

		$staff = Staff::find($id);

		if(count($staff)){
			$info_data = unserialize($staff->data);
			$info_data[$name] = $value;

			$staff->data = serialize($info_data);
			$staff->save();
			echo "Successfully updated the staff detail.";
		}
		else{
			echo "Sorry,.. can't find this staff.";
		}
		
	}

	public function add_new_attribute()
	{
		$id = Input::get('id');
		$name =  Input::get('name');

		$staff = Staff::find($id);

		if(count($staff)){
			$info_data = unserialize($staff->data);
			$info_data[$name] = '';

			$staff->data = serialize($info_data);
			$staff->save();
			Session::flash('success', 'Successfully save the attribute name.');
			return Redirect::to('admin/staff/'.$id);
		}
		else{
			Session::flash('error', 'Please Enter Valid Name.');
			return Redirect::to('admin/staff/'.$id);
		}

	}

	public function remove_attribute($id,$attribute)
	{
		$staff = Staff::find($id);

		if(count($staff)){
			$info_data = unserialize($staff->data);
			unset($info_data[$attribute]);
			$staff->data = serialize($info_data);
			$staff->save();
			Session::flash('success', 'Successfully remove the attribute name.');
			return Redirect::to('admin/staff/'.$id);
		}
		else{
			Session::flash('error', 'Can\'t remove attribute.');
			return Redirect::to('admin/staff/'.$id);
		}

	}
	
	public function upload($id,$file)
	{	
		if(Input::file('userfile')){
			$file_name = time().'_'.$id.$file.'.'.Input::file('userfile')->getClientOriginalExtension();
			Input::file('userfile')->move('uploads/'.$file,$file_name);
			Staff::insert_file($id,$file_name,$file);
		 	$success = array('success' => 'Successfully Uploaded!','file-name'=>$file_name);
			return Response::json($success);
		}
		else{
			$error = array('error' => 'Sorry..Can\'t upload this');
			return Response::json($error);
		}
	}

	public function get_staffs($id)
	{
		$staff = Staff::find($id);
		$position_id = ($staff->position_id)?$staff->position_id:'';
		$department_id = ($position_id)?Position::find($staff->position_id)->dept_id:'';
		$grp_id = ($position_id)?Position::find($staff->position_id)->grp_id:'';
		$grd_id = ($position_id)?Position::find($staff->position_id)->grd_id:'';
		$staff->department = ($department_id)?Department::find($department_id)->name:'';
		$staff->group = ($grp_id)?Group::find($grp_id)->name:'';
		$staff->grade = ($grd_id)?Grade::find($grd_id)->name:'';
		return Response::json($staff);
	}
	
	public function change_status($id,$status)
	{
		$staff = Staff::find($id);
		$status_name = ($status == 0)?"Active":"Inactive";
		if($staff && ($status == 0 || $status ==1) )
		{
			$staff->status = $status;
			$staff->save();
			Session::flash('success', 'Successfully change this staff to '.$status_name.'.');
			return Redirect::to('admin/staff/');
		}
		else{
			Session::flash('error', 'Can\'t change this staff to '.$status_name.'.');
			return Redirect::to('admin/staff/');
		}
	}
}
?>