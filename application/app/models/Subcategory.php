<?php

	class Subcategory extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'subcategories';

		public static $sluggable = array(
        			'build_from' => 'subcategory_name',
        			'save_to'    => 'slug',
        			'unique'       => true,
        			'on_update'  => false,
    		);
	}

?>