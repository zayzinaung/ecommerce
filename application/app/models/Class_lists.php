<?php 
	
	class Class_lists extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		// protected $table = 'users';
		public static $rules = array(
			'name'		=>	'required',
			'description'	=>	'required'
		);
	}

?>