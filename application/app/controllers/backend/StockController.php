<?php

class StockController extends BaseController {


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
		$stock = Stock::all();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.stock.index',compact('stock','date_format','currency'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$currency = Common::get_currency();
		return View::make('backend.admin.stock.add',compact('currency'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required',
			'date' => 'required',
			'amount' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/stock/create')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('date'));

		$stock = new Stock;
		$stock->stock_name = Input::get('name');
		$stock->buying_date = $time;
		$stock->amount = Input::get('amount');
		$stock->quantity = Input::get('quantity');
		$stock->bought_from = Input::get('bought_from');
		$stock->save();

		Session::flash('success', 'Stock is successfully created.');
		return Redirect::to('admin/stock');
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
		$stock = Stock::findOrFail($id);
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.stock.detail', compact('stock','date_format','currency'));
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
		$stock = Stock::find($id);
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.stock.edit', compact('stock','date_format','currency'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$stock= Stock::find($id);

		$rules = array(
			'name' => 'required',
			'date' => 'required',
			'amount' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->fails()) {
			return Redirect::to('admin/stock/'.$id.'/edit')
				->withErrors($validator)
				->withInput();
		}

		$time = Common::get_date_format(Input::get('date'));

		$stock->stock_name = Input::get('name');
		$stock->buying_date = $time;
		$stock->amount = Input::get('amount');
		$stock->quantity = Input::get('quantity');
		$stock->bought_from = Input::get('bought_from');
		$stock->save();

		Session::flash('success', 'Stock is successfully updated.');
		return Redirect::to('admin/stock');
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
		Stock::destroy($id);
		Session::flash('success', 'Stock is successfully deleted.');
		return Redirect::to('admin/stock');
	}
	
	public function report_pdf()
	{
		$stocks = Stock::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		if ( count($stocks) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.stock.report_pdf',compact('stocks','date_format','currency'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no stock.');
			return Redirect::to('admin/stock');
		}
	}
	
	public function report_excel()
	{
		$stocks = Stock::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($stocks) != 0 )
		{
			$i = 1;
			foreach ( $stocks as $stock )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $stock->stock_name;
            			$temp['amount'] = $stock->amount;
            			$temp['qty'] = $stock->quantity;
            			$temp['bought'] = $stock->bought_from;
            			$temp['buying'] = date($date_format, $stock->buying_date);
            			$result[] = $temp;
            		}
            		
			$filename = "stock_report.csv";

			$header = array(
				'No.','Stock Name', 'Amount', 'Quantity', 'Bought From', 'Buying Date'
			);
			
			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no stock.');
			return Redirect::to('admin/stock');
		}
	}


}
