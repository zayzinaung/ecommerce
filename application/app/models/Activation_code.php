<?php

	class Activation_code extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'activation_codes';

		public $timestamps = false;

		public static $rules = array(
			'activation_code'	=> 'required|min:4|max:4',
		);
		
	}

?>