<?php  

class Role extends Eloquent {

	protected $table = 'roles';

	public static $rules = array(
		'description'	=>	'required',
		'name'			=>	'required'
	);

}

?>