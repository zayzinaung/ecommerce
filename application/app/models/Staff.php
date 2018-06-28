<?php

class Staff extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staffs';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static $add_rules = array(
		'id'	=>	'unique:staffs',
		'name'		=> 'required',
		'email' 		=> 'required|email|unique:staffs',
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

	public static function getAgeGroup($dob)
	{
		$age =  date('Y') - date('Y',$dob);
		if($age) {
			 switch ($age) {
			 	case ($age>16 && $age<=35 ) :		 		
			 		return "35 years and below";
			 	break;
			 	case ($age>35 && $age<=45 ) :
			 		return "Above 35 to 45 years";
			 	break;
			 	case ($age>45 && $age<=50 ) :
			 		return "Above 45 to 50 years";
			 	break;
			 	case ($age>50 && $age<=55 ) :
			 		return "Above 50 to 55 years";
			 	break;
			 	case ($age>55 && $age<=60 ) :
			 		return "Above 55 to 60 years";
			 	break;
			 	case ($age>60 && $age<=65 ) :
			 		return "Above 60 to 65 years";
			 	break;
			 	case ($age>65 ) :
			 		return "Above 65 years";
			 	break;
			 	default:
			 		return '-' ;
			 	break;
			 }
		}
		else return  "Invalid Age";
	}

	public static function getConByEmployee($dob,$salary)
	{
	   if($salary >= 500){
		if($salary < 5000){
			$age_group = Staff::getAgeGroup($dob);
			if($age_group){
				if($salary < 750){
				                      $salary = $salary - 500;
						switch ($age_group) {
						 	case ($age_group == "35 years and below") :
						 		return 	Cpf_setting::get_employeepercentage(8)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 35 to 45 years") :
						 		return   Cpf_setting::get_employeepercentage(9)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 45 to 50 years") :
						 		return   Cpf_setting::get_employeepercentage(10)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 50 to 55 years") :
						 		return   Cpf_setting::get_employeepercentage(11)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 55 to 60 years") :
						 		return   Cpf_setting::get_employeepercentage(12)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 60 to 65 years") :
						 		return   Cpf_setting::get_employeepercentage(13)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 65 years") :
						 		return   Cpf_setting::get_employeepercentage(14)/100 * $salary;
						 	break;
						 	default:
						 		return  '-' ;
						 	break;
						 }
				}else{
						$salary = $salary - 500;
						switch ($age_group) {
						 	case ($age_group == "35 years and below") :
						 		return 	Cpf_setting::get_employeepercentage(1)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 35 to 45 years") :
						 		return   Cpf_setting::get_employeepercentage(2)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 45 to 50 years") :
						 		return   Cpf_setting::get_employeepercentage(3)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 50 to 55 years") :
						 		return   Cpf_setting::get_employeepercentage(4)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 55 to 60 years") :
						 		return   Cpf_setting::get_employeepercentage(5)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 60 to 65 years") :
						 		return   Cpf_setting::get_employeepercentage(6)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 65 years") :
						 		return   Cpf_setting::get_employeepercentage(7)/100 * $salary;
						 	break;
						 	default:
						 		return  '-' ;
						 	break;
						 }
				}
			}
		}
		else{
			return Cpf_setting::get_employeepercentage(15);
		}

	   }else{
			return 0;
	   }
	}
	
	public static function getConByEmployer($dob,$salary)
	{
		if($salary < 5000){
			$age_group = Staff::getAgeGroup($dob);
			if($age_group){
				if($salary < 750){
						 switch ($age_group) {
						 	case ($age_group == "35 years and below") :
						 		return 	Cpf_setting::get_employerpercentage(8)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 35 to 45 years") :
						 		return   Cpf_setting::get_employerpercentage(9)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 45 to 50 years") :
						 		return   Cpf_setting::get_employerpercentage(10)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 50 to 55 years") :
						 		return   Cpf_setting::get_employerpercentage(11)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 55 to 60 years") :
						 		return   Cpf_setting::get_employerpercentage(12)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 60 to 65 years") :
						 		return   Cpf_setting::get_employerpercentage(13)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 65 years") :
						 		return   Cpf_setting::get_employerpercentage(14)/100 * $salary;
						 	break;
						 	default:
						 		return '-' ;
						 	break;
						 }
				}else{
						 switch ($age_group) {
						 	case ($age_group == "35 years and below") :
						 		return 	Cpf_setting::get_employerpercentage(1)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 35 to 45 years") :
						 		return   Cpf_setting::get_employerpercentage(2)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 45 to 50 years") :
						 		return   Cpf_setting::get_employerpercentage(3)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 50 to 55 years") :
						 		return   Cpf_setting::get_employerpercentage(4)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 55 to 60 years") :
						 		return   Cpf_setting::get_employerpercentage(5)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 60 to 65 years") :
						 		return   Cpf_setting::get_employerpercentage(6)/100 * $salary;
						 	break;
						 	case ($age_group == "Above 65 years") :
						 		return   Cpf_setting::get_employerpercentage(7)/100 * $salary;
						 	break;
						 	default:
						 		return '-' ;
						 	break;
						 }
				}
			}
		 }
		else{
	   		return Cpf_setting::get_employerpercentage(15);
		}
	}
	
	public static function get_file($id,$file)
	{
		$table_name = $file;
		$file_path =URL::to('uploads').'/'.$file;
		$default_file_path = URL::to('uploads/profiles/avatar.jpg');
		$data = DB::table($table_name)->where('staff_id','=',$id);
		return ($data->count()==1)? $file_path.'/'.$data->first()->file : $default_file_path;
	}

	public static function insert_file($id,$file_name,$file)
	{
		$table_name = $file;
		$data = array('file' => $file_name);

		if(DB::table($table_name)->where('staff_id','=',$id)->count() == 1 ){
			
			$old_file_name = DB::table($table_name)->where('staff_id','=',$id)->first()->file;
			$file_path =URL::to('uploads').'/'.$file.'/'.$old_file_name;
			$link_prefix    = '|http://(www\.)?' . str_replace('.', '\.', $_SERVER['HTTP_HOST']) . '|i';
		          	$file_path      = $_SERVER['DOCUMENT_ROOT'] . preg_replace($link_prefix, '', $file_path);

			DB::table($table_name)->where('staff_id','=',$id)->update($data);
			if(file_exists($file_path)){
				unlink($file_path);
		          	}
		}else{
			$new_arr =  array( 'staff_id'=> $id);
			$data = array_merge($data , $new_arr);
			DB::table($table_name)->insert($data);
		}

	}

}
