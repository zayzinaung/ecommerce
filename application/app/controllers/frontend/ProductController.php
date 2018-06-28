<?php
namespace Frontend;

use BaseController;
use View; use Response; use Request; use Input; use Redirect; use URL; use Session; use App;
use Product; use Brand; use Color; use Size; use Length; use Weight; use Fuel; use Country;
use Product_info; use Product_info_data; use Product_image; use Common; use Wishlist;
use Category; use Subcategory; use Review; use User; use Validator;

class ProductController extends BaseController {

	public function index()
	{
		$path = Request::input();
		$check_subcate = array_key_exists('subcategory', $path);
		$check_cate = array_key_exists('category', $path);
		$check_sort = array_key_exists('sort_by', $path);

		if ( $check_sort )
		{
			$sort = base64_decode($path['sort_by']);
			$price = base64_decode($path['price_range']);
		} else {
			$sort = 'default';
			$price = 'default';
		}

		if ( $check_cate )
		{
			$category = Category::where('slug','=',$path['category'])->first();
			$category_id = $category->id;
		} else {
			$category = '';
			$category_id = '';
		}

		if ( $check_subcate )
		{
			$subcategory = Subcategory::where('slug','=',$path['subcategory'])->first();
			$subcategory_id = $subcategory->id;
		} else {
			$subcategory = '';
			$subcategory_id = '';
		}

		if ( $check_subcate == true )
		{
			if ( $sort != 'default' && $price == 'default' )
			{
				$products = Common::post_orderby_query($sort,$category_id,$subcategory_id,'','');
				
			} elseif ( $sort == 'default' && $price != 'default' ) {

				$products = Common::post_price_query($price,$category_id,$subcategory_id,'','');

			} elseif ( $sort != 'default' && $price != 'default' ) {

				$products = Common::post_sort_price_query($sort,$price,$category_id,$subcategory_id,'','');

			} else {
				
				$products = Common::product_orderby_query('products.created_at','desc',$category_id,$subcategory_id,'','');
			}

		} elseif ( $check_subcate != true && $check_cate == true ) {

			if ( $sort != 'default' && $price == 'default' )
			{
				$products = Common::post_orderby_query($sort,$category_id,$subcategory_id,'','');
				
			} elseif ( $sort == 'default' && $price != 'default' ) {

				$products = Common::post_price_query($price,$category_id,$subcategory_id,'','');

			} elseif ( $sort != 'default' && $price != 'default' ) {

				$products = Common::post_sort_price_query($sort,$price,$category_id,$subcategory_id,'','');

			} else {
				$products = Common::product_orderby_query('products.created_at','desc',$category_id,$subcategory_id,'','');
			}
			
		} else {

			if ( $sort != 'default' && $price == 'default' )
			{
				$products = Common::post_orderby_query($sort,$category_id,$subcategory_id,'','');
				
			} elseif ( $sort == 'default' && $price != 'default' ) {

				$products = Common::post_price_query($price,$category_id,$subcategory_id,'','');

			} elseif ( $sort != 'default' && $price != 'default' ) {

				$products = Common::post_sort_price_query($sort,$price,$category_id,$subcategory_id,'','');

			} else {
				$products = Common::product_orderby_query('products.created_at','desc',$category_id,$subcategory_id,'','');
			}
			
		}

		$products_id = Common::wishlist();

		$categories = Category::all();

		$currency_symbol = Common::get_currency_format();
		
		return View::make('frontend.product.index', compact('products','products_id','categories','category','subcategory','check_sort','sort','price','check_subcate','check_cate','currency_symbol'));
	}
	
	public function search()
	{
		$path = Request::input();
		$check_keyword = array_key_exists('keyword', $path);
		$check_sort = array_key_exists('sort_by', $path);

		if ( $check_sort )
		{
			$sort = base64_decode($path['sort_by']);
			$price = base64_decode($path['price_range']);
		} else {
			$sort = 'default';
			$price = 'default';
		}

		if ( $check_keyword == true )
		{
			$keyword = $path['keyword'];
		} else {
			App::abort(404);
		}

		$check_brand = Brand::where("brand_name","like","%".$keyword."%")->first();
		if ( $check_brand )
		{
			$brand_id = $check_brand->id;
		} else {
			$brand_id = '';
		}

		if ( $check_brand != null )
		{
			if ( $sort != 'default' && $price == 'default' )
			{
				$products = Common::post_orderby_query($sort,'','',$brand_id,'');
				
			} elseif ( $sort == 'default' && $price != 'default' ) {

				$products = Common::post_price_query($price,'','',$brand_id,'');

			} elseif ( $sort != 'default' && $price != 'default' ) {

				$products = Common::post_sort_price_query($sort,$price,'','',$brand_id,'');

			} else {
				
				$products = Common::product_orderby_query('products.created_at','desc','','',$brand_id,'');
			}

		} else {
			if ( $sort != 'default' && $price == 'default' )
			{
				$products = Common::post_orderby_query($sort,'','','',$keyword);
				
			} elseif ( $sort == 'default' && $price != 'default' ) {

				$products = Common::post_price_query($price,'','','',$keyword);

			} elseif ( $sort != 'default' && $price != 'default' ) {

				$products = Common::post_sort_price_query($sort,$price,'','','',$keyword);

			} else {
				
				$products = Common::product_orderby_query('products.created_at','desc','','','',$keyword);
			}
		}

		$products_id = Common::wishlist();

		$categories = Category::all();

		$currency_symbol = Common::get_currency_format();

		return View::make('frontend.product.search', compact('products','products_id','categories','check_keyword','keyword','check_sort','sort','price','currency_symbol'));
	}
	
	public function detail($slug)
	{
		$id = Product::getProductBySlug($slug);
		if(!$id){
            		App::abort(404);
        		}

        		$get_name = Product::where('slug','=',$slug)->first();
        		if ( $get_name )
        		{
        			$get_more = Product::where('product_name','=',$get_name->product_name)->select('more_data')->get();
        			foreach ( $get_more as $m )
        			{
        				$more = unserialize($m->more_data);
        				$get_color = $more['colors'];
        				$get_size = $more['sizes'];
        				$get_length = $more['length'];
        				$get_weight = $more['weight'];
        				$get_fuel = $more['fuels'];
        				
        				$temp_color['colors'] = Color::find($get_color);
        				$colors[] = $temp_color;

        				$temp_size['sizes'] = Size::find($get_size);
        				$sizes[] = $temp_size;

        				$temp_length['length'] = Length::find($get_length);
        				$length[] = $temp_length;

        				$temp_weight['weight'] = Weight::find($get_weight);
        				$weight[] = $temp_weight;

        				$temp_fuel['fuels'] = Fuel::find($get_fuel);
        				$fuels[] = $temp_fuel;
        			}
        		}

        		$product = Product::findOrFail($id);

        		$more_data = unserialize($product->more_data);
        		$choose_color = Common::query_single_row_by_single_source('colors','id',$more_data['colors']);
        		$choose_size = Common::query_single_row_by_single_source('sizes','id',$more_data['sizes']);
        		$choose_length = Common::query_single_row_by_single_source('length','id',$more_data['length']);
        		$choose_weight = Common::query_single_row_by_single_source('weight','id',$more_data['weight']);
        		$choose_fuel = Common::query_single_row_by_single_source('fuels','id',$more_data['fuels']);

		$product_images = Product::get_product_images($id);
		$detail_image = array_shift($product_images);

		$category = Product::find($id)->category;
		$subcategory = Product::find($id)->subcategory;

		$brand_id = Product::find($id)->brand;
		$brand = Common::query_single_row_by_single_source('brands','id',$brand_id);

		$product_info_data = Product_info_data::where('product_id','=',$id)->get();
		
		if ( Session::has('logged_in') )
		{
			$wishlist = Wishlist::where('member_id','=',Session::get('user_id'))->where('product_id','=',$id)->first();
		}

		if ( $product->discount != 0 )
		{
			$sale_price = Common::discount($product->price,$product->discount);
		} else {
			$sale_price = $product->price;
		}

		$categories = Category::all();

		$currency_symbol = Common::get_currency_format();

		$sum = Review::where('product_id','=', $product->id)->sum('rating');
		$count = Review::where('product_id','=', $product->id)->get()->count();
		$review = Review::where('product_id','=', $product->id)->orderBy('created_at','desc')->limit(2)->get();
		if ( $sum != 0 )
		{
			$rating_total = $sum / $count;
		} else {
			$rating_total = '';
		}

		$date_format = Common::get_date();

		return View::make('frontend.product.detail', compact('product', 'product_images', 'detail_image', 'category', 'subcategory', 'brand', 'choose_color', 'colors', 'choose_size', 'sizes', 'choose_length', 'length', 'choose_weight', 'weight', 'choose_fuel', 'fuels', 'product_info_data', 'wishlist', 'sale_price', 'categories', 'currency_symbol','review','rating_total','count','date_format'));
	}

	public function search_other_product()
	{
		$id = Input::get('pid');
		$product_name = Input::get('name');

		$color = Input::get('color');
		$size = Input::get('size');
		$length = Input::get('length');
		$weight = Input::get('weight');
		$fuel = Input::get('fuel');

		$get_serial = array('colors' => $color, 'sizes' => $size, 'length' => $length, 'weight' => $weight, 'fuels' => $fuel );
		$serial_arr = serialize($get_serial);

		$get_detail = Product::where('product_name','=',$product_name)->where("more_data","like","%".$serial_arr."%")->first();
		if ( $get_detail != null )
		{
			return Redirect::to('product/detail/'.$get_detail->slug);
		} else {
			return View::make('frontend.product.search_error');
		}
	}
	
	public function get_subcategory()
	{
		$id = Input::get('id');
		$val = '';

		if ( $id != '0')
		{
			$subcategories = Category::find($id)->subcategories;

			foreach($subcategories as $subcategory)
	        		{
	            		$val .= '<option value="'. $subcategory['id'] .'">'. $subcategory['subcategory_name'] .'</option>';
	        		}
	        		echo $val;
	        	} else {
	        		$val = '<option value="0">-</option>';
	        		echo $val;
	        	}
	}
	
	public function add_review()
	{
		$slug = Input::get('product_slug');

		$rules = array(
			'rating' => 'required',
			'review_text' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);
		
		if( $validator->fails() ) {
			Session::flash('error', 'Required');
			return Redirect::to('product/detail/'.$slug)
				->withErrors($validator)
				->withInput();
		}

		$rating = Input::get('rating');
		$text = Input::get('review_text');
		$product_id = Input::get('product_id');

		$review = New Review;
		$review->user_id = Session::get('user_id');
		$review->product_id = $product_id;
		$review->rating = $rating;
		$review->review = $text;
		$review->save();

		return Redirect::to('product/detail/'.$slug);
	}

	public function review($slug)
	{
		$id = Product::getProductBySlug($slug);
		if(!$id){
            		App::abort(404);
        		}

        		$product = Product::findOrFail($id);

        		$category = Product::find($id)->category;
		$subcategory = Product::find($id)->subcategory;
        		$categories = Category::all();

        		$product_images = Product::get_product_images($id);
		$detail_image = array_shift($product_images);

		if ( $product->discount != 0 )
		{
			$sale_price = Common::discount($product->price,$product->discount);
		} else {
			$sale_price = $product->price;
		}

		$currency_symbol = Common::get_currency_format();
		$date_format = Common::get_date();

		$sum = Review::where('product_id','=', $product->id)->sum('rating');
		$count = Review::where('product_id','=', $product->id)->get()->count();
		$review = Review::where('product_id','=', $product->id)->orderBy('created_at','desc')->limit(2)->get();
		$rating_total = $sum / $count;

		$review = Review::where('product_id','=',$product->id)->orderBy('created_at','desc')->paginate(2);

		return View::make('frontend.product.review', compact('review','product','category','subcategory','categories','detail_image','currency_symbol','sale_price','date_format','rating_total'));
	}
	
}
