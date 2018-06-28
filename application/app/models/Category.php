<?php

	class Category extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'categories';

		public static $sluggable = array(
        			'build_from' => 'category_name',
        			'save_to'    => 'slug',
        			'unique'       => true,
        			'on_update'  => false,
    		);
		
		public function subcategories()
		{
			return $this->hasMany('Subcategory');
		}
		
	}

?>