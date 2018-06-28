<?php

	class Order extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'orders';

		public static function get_orders($bill_no)
	          {
	                    return Order::where('bill_no','=',$bill_no)
	                           	->join('products', 'orders.product_id', '=', 'products.id')
	                              	->join('product_images', 'product_images.product_id', '=', 'products.id')
	                              	->where('product_images.image_order','=',1)
	                              	->select('orders.*', 'product_images.image', 'products.product_name', 'products.product_no' )
	                              	->get();
	          }
		
	}

?>