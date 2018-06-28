<?php
	
	class Page extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'pages';
		
		public static $rules = array(
			'name' => 'required',
			'title' => 'required'
		);
		
	}

?>