<?php

class IncomeController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"account");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$income = Income::all();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.income.index',compact('income','date_format','currency'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$incomes = Income::all();
		return View::make('backend.admin.income.add', compact('incomes'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$mode = Input::get('mode');

		if ( $mode == 2 )
		{
			$rules = array(
				'account_no' => 'required',
				'account_name' => 'required',
				'bank_name' => 'required',
				'bank_branch' => 'required',
				'cheque_issue_date' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		} elseif ( $mode == 3 ) {
			$rules = array(
				'transaction_id' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		} elseif ( $mode == 4 ) {
			$rules = array(
				'description' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		} else {
			$rules = array(
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		}

		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/income/create')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('received_date'));

		$income = new Income;
		$income->income_name = Input::get('name');
		$income->income_amount = Input::get('amount');
		$income->received_date = $time;

		if ( $mode == 1 )
		{
			$income->cash = 1;

		} elseif ( $mode == 2 ) {
			$cheque_arr = array('account_no'=>Input::get('account_no'),'account_name'=>Input::get('account_name'),'bank_name'=>Input::get('bank_name'),'bank_branch'=>Input::get('bank_branch'),'cheque_issue_date'=>Input::get('cheque_issue_date'));
			$income->cheque = serialize($cheque_arr);

		} elseif ( $mode == 3 ) {
			$income->enet = Input::get('transaction_id');

		} else {
			$income->other = Input::get('description');
		}

		$income->save();

		Session::flash('success', 'Income is successfully created.');
		return Redirect::to('admin/income');
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
		$income = Income::findOrFail($id);
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.income.detail', compact('income','date_format','currency'));
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
		$income = Income::find($id);
		$get_income = Income::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.income.edit', compact('income','get_income','date_format'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$mode = Input::get('mode_active');
		$income = Income::find($id);

		if ( $mode == 2 )
		{
			$rules = array(
				'account_no' => 'required',
				'account_name' => 'required',
				'bank_name' => 'required',
				'bank_branch' => 'required',
				'cheque_issue_date' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		} elseif ( $mode == 3 ) {
			$rules = array(
				'transaction_id' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		} elseif ( $mode == 4 ) {
			$rules = array(
				'description' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		} else {
			$rules = array(
				'name' => 'required',
				'amount' => 'required',
				'received_date' => 'required'
			);
		}

		$validator = Validator::make(Input::all(),$rules);

		if($validator->fails()) {
			return Redirect::to('admin/income/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('received_date'));

		$income->income_name = Input::get('name');
		$income->income_amount = Input::get('amount');
		$income->received_date = $time;

		if ( $mode == 1 )
		{
			$income->cash = 1;
			$income->cheque = NULL;
			$income->enet = NULL;
			$income->other = NULL;

		} elseif ( $mode == 2 ) {
			$cheque_arr = array('account_no'=>Input::get('account_no'),'account_name'=>Input::get('account_name'),'bank_name'=>Input::get('bank_name'),'bank_branch'=>Input::get('bank_branch'),'cheque_issue_date'=>Input::get('cheque_issue_date'));
			$income->cheque = serialize($cheque_arr);
			$income->cash = 0;
			$income->enet = NULL;
			$income->other = NULL;

		} elseif ( $mode == 3 ) {
			$income->enet = Input::get('transaction_id');
			$income->cheque = NULL;
			$income->cash = 0;
			$income->other = NULL;

		} else {
			$income->other = Input::get('description');
			$income->cheque = NULL;
			$income->enet = NULL;
			$income->cash = 0;
		}

		$income->save();

		Session::flash('success', 'Income is successfully updated.');
		return Redirect::to('admin/income');
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
		Income::destroy($id);
		Session::flash('success', 'Income is successfully deleted.');
		return Redirect::to('admin/income');
	}

	public function get_income()
	{
		$id = Input::get('id');

		if ( $id != 0 )
		{
			$result = Income::find($id);
			$income = $result->income_name;
		} else {
			$income = '';
		}

		$data['status'] = 'success';
		$data['income'] = $income;
		echo json_encode($data);
	}
	
	public function report_pdf()
	{
		$incomes = Income::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		if ( count($incomes) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.income.report_pdf',compact('incomes','date_format','currency'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no other income.');
			return Redirect::to('admin/income');
		}
	}
	
	public function report_excel()
	{
		$incomes = Income::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($incomes) != 0 )
		{
			$i = 1;
			foreach ( $incomes as $income )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $income->income_name;
            			$temp['amount'] = $income->income_amount;
            			if ( $income->cash != 0 )
            			{
            				$temp['mop'] = 'Cash';
            			} elseif ( $income->cheque != null ) {
            				$temp['mop'] = 'Cheque';
            			} elseif ( $income->other != null ) {
            				$temp['mop'] = 'Other';
            			} elseif ( $income->enet != null ) {
            				$temp['mop'] = 'Enet';
            			}
            			$temp['receive'] = date($date_format, $income->received_date);
            			$result[] = $temp;
            		}

			$filename = "other_income_report.csv";

			$header = array(
				'No.','Other income Name', 'Other income Amount', 'MOP', 'Received Date'
			);

			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no income.');
			return Redirect::to('admin/income');
		}
	}


}
