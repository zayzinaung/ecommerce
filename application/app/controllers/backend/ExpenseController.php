<?php

class ExpenseController extends BaseController {

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
		$expense = Expense::all();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.expense.index',compact('expense','date_format','currency'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$expenses = Expense::all();
		return View::make('backend.admin.expense.add', compact('expenses'));
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
				'payment_date' => 'required'
			);
		} elseif ( $mode == 3 ) {
			$rules = array(
				'transaction_id' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'payment_date' => 'required'
			);
		} elseif ( $mode == 4 ) {
			$rules = array(
				'description' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'payment_date' => 'required'
			);
		} else {
			$rules = array(
				'name' => 'required',
				'amount' => 'required',
				'payment_date' => 'required'
			);
		}

		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/expense/create')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('payment_date'));

		$expense = new Expense;
		$expense->expense_name = Input::get('name');
		$expense->expense_amount = Input::get('amount');
		$expense->payment_date = $time;

		if ( $mode == 1 )
		{
			$expense->cash = 1;

		} elseif ( $mode == 2 ) {
			$cheque_arr = array('account_no'=>Input::get('account_no'),'account_name'=>Input::get('account_name'),'bank_name'=>Input::get('bank_name'),'bank_branch'=>Input::get('bank_branch'),'cheque_issue_date'=>Input::get('cheque_issue_date'));
			$expense->cheque = serialize($cheque_arr);

		} elseif ( $mode == 3 ) {
			$expense->enet = Input::get('transaction_id');

		} else {
			$expense->other = Input::get('description');
		}

		$expense->save();

		Session::flash('success', 'Expense is successfully created.');
		return Redirect::to('admin/expense');
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
		$expense = Expense::findOrFail($id);
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.expense.detail', compact('expense','date_format','currency'));
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
		$expense = Expense::find($id);
		$get_expense = Expense::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.expense.edit', compact('expense','get_expense','date_format'));
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
		$expense = Expense::find($id);

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
				'payment_date' => 'required'
			);
		} elseif ( $mode == 3 ) {
			$rules = array(
				'transaction_id' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'payment_date' => 'required'
			);
		} elseif ( $mode == 4 ) {
			$rules = array(
				'description' => 'required',
				'name' => 'required',
				'amount' => 'required',
				'payment_date' => 'required'
			);
		} else {
			$rules = array(
				'name' => 'required',
				'amount' => 'required',
				'payment_date' => 'required'
			);
		}

		$validator = Validator::make(Input::all(),$rules);

		if($validator->fails()) {
			return Redirect::to('admin/expense/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('payment_date'));

		$expense->expense_name = Input::get('name');
		$expense->expense_amount = Input::get('amount');
		$expense->payment_date = $time;

		if ( $mode == 1 )
		{
			$expense->cash = 1;
			$expense->cheque = NULL;
			$expense->enet = NULL;
			$expense->other = NULL;

		} elseif ( $mode == 2 ) {
			$cheque_arr = array('account_no'=>Input::get('account_no'),'account_name'=>Input::get('account_name'),'bank_name'=>Input::get('bank_name'),'bank_branch'=>Input::get('bank_branch'),'cheque_issue_date'=>Input::get('cheque_issue_date'));
			$expense->cheque = serialize($cheque_arr);
			$expense->cash = 0;
			$expense->enet = NULL;
			$expense->other = NULL;

		} elseif ( $mode == 3 ) {
			$expense->enet = Input::get('transaction_id');
			$expense->cheque = NULL;
			$expense->cash = 0;
			$expense->other = NULL;

		} else {
			$expense->other = Input::get('description');
			$expense->cheque = NULL;
			$expense->enet = NULL;
			$expense->cash = 0;
		}

		$expense->save();

		Session::flash('success', 'Expense is successfully updated.');
		return Redirect::to('admin/expense');
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
		Expense::destroy($id);
		Session::flash('success', 'Expense is successfully deleted.');
		return Redirect::to('admin/expense');
	}

	public function get_expense()
	{
		$id = Input::get('id');

		if ( $id != 0 )
		{
			$result = Expense::find($id);
			$expense = $result->expense_name;
		} else {
			$expense = '';
		}

		$data['status'] = 'success';
		$data['expense'] = $expense;
		echo json_encode($data);
	}
	
	public function report_pdf()
	{
		$expenses = Expense::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		if ( count($expenses) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.expense.report_pdf',compact('expenses','date_format','currency'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no expense.');
			return Redirect::to('admin/expense');
		}
	}
	
	public function report_excel()
	{
		$expenses = Expense::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($expenses) != 0 )
		{
			$i = 1;
			foreach ( $expenses as $expense )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $expense->expense_name;
            			$temp['amount'] = $expense->expense_amount;
            			if ( $expense->cash != 0 )
            			{
            				$temp['mop'] = 'Cash';
            			} elseif ( $expense->cheque != null ) {
            				$temp['mop'] = 'Cheque';
            			} elseif ( $expense->other != null ) {
            				$temp['mop'] = 'Other';
            			} elseif ( $expense->enet != null ) {
            				$temp['mop'] = 'Enet';
            			}
            			$temp['payment'] = date($date_format, $expense->payment_date);
            			$result[] = $temp;
            		}

			$filename = "expense_report.csv";

			$header = array(
				'No.','Expense Name', 'Expense Amount', 'MOP', 'Payment Date'
			);
			
			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no expense.');
			return Redirect::to('admin/expense');
		}
	}


}
