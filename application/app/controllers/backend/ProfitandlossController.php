<?php

class ProfitandlossController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"profitandloss");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$profitandloss = Profitandloss::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.profitandloss.index',compact('profitandloss','date_format'));
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
		$profitandloss = New Profitandloss;
		$profitandloss->from_date = strtotime(Input::get('from_date'));
		$profitandloss->to_date = strtotime(Input::get('to_date'));
		$profitandloss->save();

		Session::flash('success', 'Profit and loss is successfully added.');
		return Redirect::to('admin/profitandloss');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$path = Request::input();
		$check_date = array_key_exists('from_date', $path);
		$date_format = Common::get_date();
		$currency = Common::get_currency();

		if ( $check_date )
		{
			$from_time = Common::get_date_format($path['from_date']);
			$to_time = Common::get_date_format($path['to_date']);

			$from = Date('Y-m-d', $from_time);
			$to = Date('Y-m-d', $to_time);
			$from_date = $from_time;
			$to_date = $to_time;
		} else {
			$from = '0000-00-00'; $to = '0000-00-00'; $from_date = '0000-00-00'; $to_date = '0000-00-00';
		}
		
		$online_sold = Order::join('products', 'orders.product_id', '=', 'products.id')
				->where('orders.order_date','>=',$from)
				->where('orders.order_date','<=',$to)
				->where('orders.is_paid','=',1)
				->where('orders.is_cancel','=',0)
				->get();

		$get_gst = Order::where('order_date','>=',$from)->where('order_date','<=',$to)->where('is_paid','=',1)->where('is_cancel','=',0)->groupBy('bill_no')->get();

		$offline_sold = Offline_sale::join('products', 'offlinesales.product_id', '=', 'products.id')
				->where('offlinesales.created_at','>=',$from)
				->where('offlinesales.created_at','<=',$to)
				->get();

		$other_incomes = Income::where('incomes.received_date','>=',$from_date)
				->where('incomes.received_date','<=',$to_date)
				->get();

		$stock = Stock::where('stocks.created_at','>=',$from)
				->where('stocks.created_at','<=',$to)
				->get();

		$expenses = Expense::where('expenses.payment_date','>=',$from_date)
				->where('expenses.payment_date','<=',$to_date)
				->get();

		return View::make('backend.admin.profitandloss.list', compact('from','to','online_sold','offline_sold','other_incomes','stock','expenses','get_gst','date_format','currency'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		Profitandloss::destroy($id);
		Session::flash('success', 'Profit and loss is successfully deleted.');
		return Redirect::to('admin/profitandloss');
	}


}
