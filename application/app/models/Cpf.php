<?php 

	class Cpf extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
	protected $table = 'cpf_payments';

	public static function check_duplicate($month)
	{
		$cpf_payments = DB::table('cpf_payments')->where('month',$month)->get();
		foreach ($cpf_payments as $cpf_payment) {
			if(date('m-Y',strtotime('01-'.$cpf_payment->month)) == $month){
				return true;
			}
		}
		return false;
	}

	}
 ?>