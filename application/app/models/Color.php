<?php
	
	class Color extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'colors';

		public static $rules = array(
			'code' => 'required|unique:colors,color_code'
		);
		
	}

?>