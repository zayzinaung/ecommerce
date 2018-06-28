<?php 

	class Salary_payment extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
	protected $table = 'salary_payments';

	public static function get_this_staff_all_salary($staff_id)
	{
		return DB::table('salary_payments')->where('staff_id',$staff_id)->get();
	}

	public static function check_duplicate($staff_id,$month)
	{
		$salary_payments = DB::table('salary_payments')->where('staff_id',$staff_id)->get();
		foreach ($salary_payments as $salary_payment) {
			if(date('m-Y',strtotime('01-'.$salary_payment->month)) == $month){
				return true;
			}
		}
		return false;
	}

	public static function get_group_by_month()
	{
	        $payroll = Salary_payment::all();
	        $payment_arr = array();
	        foreach ($payroll as $payroll) {

	        	 $payment_date = date('d-m-Y',$payroll->payment_date);

	        	 if(!isset($payment_arr[$payment_date]))
	        	 {
	        	 	$payment_arr[$payment_date] = 0;
	        	 }

	        	 $payment_arr[$payment_date] += $payroll->amount;

	        }

	        return $payment_arr;

	}

	public static function this_month_salary($date)
	{
	        $payroll = Salary_payment::all();
	        $payment_arr = array();$count = 0;
	        foreach ($payroll as $payroll) {

	        	 $payment_date = date('d-m-Y',$payroll->payment_date);

	        	 if($payment_date == $date){
	        	 	$payment_arr[$count]['id'] = $payroll->id;
	        	 	$payment_arr[$count]['staff_id'] = $payroll->staff_id;
	        	 	$payment_arr[$count]['total_amount'] = $payroll->amount;
	        	 	$payment_arr[$count]['method'] = $payroll->method;
	        	 	$payment_arr[$count]['payment_date'] = $payroll->payment_date;
	        	 	$count++;
	        	 }

	        }

	        return $payment_arr;

	}


	}

 ?>