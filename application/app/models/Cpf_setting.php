<?php 

	class Cpf_setting extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
	protected $table = 'cpf_setting';

	public static function get_employeepercentage($id)
	{
		return Cpf_setting::find($id)->employee;
	}

	public static function get_employerpercentage($id)
	{
		return Cpf_setting::find($id)->employer;
	}

	}

 ?>