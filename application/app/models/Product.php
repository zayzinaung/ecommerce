<?php
	
	class Product extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'products';
		
		public static $sluggable = array(
        			'build_from' => 'product_name',
        			'save_to'    => 'slug',
        			'unique'       => true,
        			'on_update'  => false,
    		);
		
		public static function is_valid_product($id)
		{
			$data = Product::where('id','=',$id)
	    				->first();
	    		if ( $data )
	    		{
	    			return true;
	    		} else {
	    			return false;
	    		}
		}
		
		public static function get_product_images($id)
		{
	    		$data = DB::table('product_images')->where('product_id','=',$id)
	    				->where('image','!=',"")
	    				->orderBy('image_order')
	    				->get();
	        		return $data;
	    	}
	    	
	    	public static function delete_image($id)
		{
			$query = Product_image::where('product_id','=',$id)->get();
			if ( $query )
			{
				foreach ( $query as $q )
				{
					unlink('uploads/products/'.$q->image);
				}
				Product_image::where('product_id', $id)->delete();
			}
		}

		public function product_images()
		{
			return $this->hasMany('Product_image','product_id');
		}

		public function product_info_data()
		{
			return $this->belongsTo('Product_info_data');
		}

		public function brand() {
			return $this->belongsTo('Brand');
		}

		public function color() {
			return $this->belongsTo('Color');
		}

		public function country() {
			return $this->belongsTo('Country');
		}
		
		public function length() {
			return $this->belongsTo('Length');
		}

		public function size() {
			return $this->belongsTo('Size');
		}

		public function weight() {
			return $this->belongsTo('Weight');
		}

		public function fuel() {
			return $this->belongsTo('Fuel');
		}

		public function category() {
			return $this->belongsTo('Category');
		}

		public function subcategory()
		{
			return $this->belongsTo('Subcategory');
		}

		public function product_info()
		{
			return $this->belongsTo('Product_info');
		}

		public static function delete_info_data($id)
		{
			DB::table('product_info_data')->where('product_id', $id)->delete();
		}
		
		public static function getProductBySlug($slug)
		{
			$data = Product::where('slug','=',$slug)
	    				->first();
	    		if ( $data )
	    		{
	    			return $data->id;
	    		} else {
	    			return false;
	    		}
		}

	}

?>