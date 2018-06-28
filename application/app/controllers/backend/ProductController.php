<?php

class ProductController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"product");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$product = Product::where('is_delete','=',0)->orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.product.index',compact('product','date_format','currency'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$brand = Brand::all();
		$color = Color::orderBy('color_name','asc')->get();
		$countries = Country::all();
		$length = Length::all();
		$size = Size::all();
		$weight = Weight::all();
		$fuel = Fuel::all();
		$category = Category::all();
		$product_info = Product_info::all();
		$currency = Common::get_currency();
		return View::make('backend.admin.product.add', compact('color', 'countries', 'length', 'size', 'weight', 'fuel', 'category', 'brand', 'product_info', 'currency'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required',
			'product_no' => 'required',
			'quantity' => 'required',
			'price' => 'required'
		);
		
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/product/create')
				->withErrors($validator)
				->withInput();
		}
		
		$product = new Product;
		$product->product_name = Input::get('name');
		$product->product_no = Input::get('product_no');
		$product->quantity = Input::get('quantity');
		$product->price = Input::get('price');
		$product->category_id = Input::get('category');
		$product->subcategory_id = Input::get('subcategory');
		$product->description = Input::get('description');

		$product->meta_title = Input::get('meta_title');
		$product->meta_keywords = Input::get('meta_keywords');
		$product->meta_description = Input::get('meta_description');

		$is_active = Input::get('active');
		if ( $is_active == 'on' )
		{
			$is_active = '1';
		} else {
			$is_active = '0';
		}
		$product->is_active = $is_active;

		$color_check = Input::get('color_check');
		if ( $color_check == 'on' )
		{
			$color = Input::get('color');
		} else {
			$color = null;
		}

		$size_check = Input::get('size_check');
		if ( $size_check == 'on' )
		{
			$size = Input::get('size');
		} else {
			$size = null;
		}
			
		$length_check = Input::get('length_check');
		if ( $length_check == 'on' )
		{
			$length = Input::get('length');
		} else {
			$length = null;
		}
			
		$weight_check = Input::get('weight_check');
		if ( $weight_check == 'on' )
		{
			$weight = Input::get('weight');
		} else {
			$weight = null;
		}

		$fuel_check = Input::get('fuel_check');
		if ( $fuel_check == 'on' )
		{
			$fuel = Input::get('fuel');
		} else {
			$fuel = null;
		}
			
		$product->brand = Input::get('brand');

		$new_array = array('colors' => $color, 'sizes' => $size, 'length' => $length, 'weight' => $weight, 'fuels' => $fuel );
		$product->more_data = serialize($new_array);

		$product->country_id = Input::get('country');

		$product->save();
		$pid = $product->id;

		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('images'),'uploads/products');

		if ( $image_files ) {
			for ( $i=0; $i < count($image_files); $i++ ) {
				$product_image = new Product_image();
				$product_image->product_id = $pid;
				$product_image->image = $image_files[$i]['imagename'];
				$product_image->image_order = $i + 1;
				$product_image->save();
			}
		}

		$product_info = Product_info::all();
		if ( $product_info )
		{
			foreach ( $product_info as $pi)
			{
				$name = $pi->id;
				$product_info_check = Input::get($name.'_check');
				if ( $product_info_check == 'on' )
				{
					$info_data = Input::get($name);

					$product_data = new Product_info_data();
					$product_data->product_id = $pid;
					$product_data->product_info_id = $pi->id;
					$product_data->data = $info_data;
					$product_data->save();
				}
			}
		}
		
		Session::flash('success', 'Product is successfully created.');
		return Redirect::to('admin/product');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');

		$is_product = Product::is_valid_product($id);
		if(!$is_product){
            		return Redirect::to('admin/error/show/404');
        		}

		$product = Product::findOrFail($id);
		$product_images = Product::get_product_images($id);
		$category = Product::find($id)->category;
		$subcategory = Product::find($id)->subcategory;
		
		$brand_id = Product::find($id)->brand;
		$brand = Common::query_single_row_by_single_source('brands','id',$brand_id);

		$more_data = unserialize($product->more_data);

		$color = Common::query_single_row_by_single_source('colors','id',$more_data['colors']);
		
		$size = Common::query_single_row_by_single_source('sizes','id',$more_data['sizes']);

		$length = Common::query_single_row_by_single_source('length','id',$more_data['length']);
		
		$weight = Common::query_single_row_by_single_source('weight','id',$more_data['weight']);

		$fuel = Common::query_single_row_by_single_source('fuels','id',$more_data['fuels']);

		$country = Country::find($product->country_id);

		$date_format = Common::get_date();
		$currency = Common::get_currency();

		return View::make('backend.admin.product.detail', compact('product', 'product_images', 'category', 'subcategory', 'brand', 'color', 'size', 'length', 'weight', 'fuel', 'country','date_format','currency'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$product = Product::find($id);
		$categories = Category::all();
		if ( $categories )
		{
			$result = null;
			$result['NULL'] = '-';
			foreach($categories as $cate)
			{
				if($cate['category_name']!='')
				{
					$result[$cate['id']] = $cate['category_name'];
				}
			}
		}

		$subcategories = Category::find($product->category_id)->subcategories;
		if ( $subcategories )
		{
			$sub_result = null;
			$sub_result['NULL'] = '-';
			foreach($subcategories as $subcate)
			{
				if($subcate['subcategory_name']!='')
				{
					$sub_result[$subcate['id']] = $subcate['subcategory_name'];
				}
			}
		}

		$brand = Brand::all();

		$images = Product::get_product_images($id);

		$more_data = unserialize($product->more_data);

		$color = Color::orderBy('color_name','asc')->get();
		$choose_color = Common::query_single_row_by_single_source('colors','id',$more_data['colors']);
		
		$size = Size::all();
		$choose_size = Common::query_single_row_by_single_source('sizes','id',$more_data['sizes']);
		
		$length = Length::all();
		$choose_length = Common::query_single_row_by_single_source('length','id',$more_data['length']);
		
		$weight = Weight::all();
		$choose_weight = Common::query_single_row_by_single_source('weight','id',$more_data['weight']);

		$fuel = Fuel::all();
		$choose_fuel = Common::query_single_row_by_single_source('fuels','id',$more_data['fuels']);
		
		$country = Country::all();
		$choose_country = Country::find($product->country_id);

		$product_info = Product_info::all();
		$get_product_info = Product_info_data::where('product_id','=',$id)->get();

		$currency = Common::get_currency();
		
		return View::make('backend.admin.product.edit', compact('product', 'result', 'sub_result', 'images', 'brand', 'color', 'choose_color', 'size', 'choose_size', 'length', 'choose_length', 'weight', 'choose_weight', 'fuel', 'choose_fuel', 'country', 'choose_country', 'product_info','get_product_info','currency'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = Product::find($id);
		$file = Input::file('images');

		$rules = array(
			'name' => 'required',
			'product_no' => 'required',
			'quantity' => 'required',
			'price' => 'required'
		);
		
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {

			$product->product_name = Input::get('name');
			$product->product_no = Input::get('product_no');
			$product->quantity = Input::get('quantity');
			$product->price = Input::get('price');
			$product->category_id = Input::get('category');
			$product->subcategory_id = Input::get('subcategory');
			$product->description = Input::get('description');

			$product->meta_title = Input::get('meta_title');
			$product->meta_keywords = Input::get('meta_keywords');
			$product->meta_description = Input::get('meta_description');

			$product->updated_at = time();

			$is_active = Input::get('active');
			if ( $is_active == 'on' )
			{
				$is_active = '1';
			} else {
				$is_active = '0';
			}
			$product->is_active = $is_active;

			$color_check = Input::get('color_check');
			if ( $color_check == 'on' )
			{
				$color = Input::get('color');
			} else {
				$color = null;
			}

			$size_check = Input::get('size_check');
			if ( $size_check == 'on' )
			{
				$size = Input::get('size');
			} else {
				$size = null;
			}
			
			$length_check = Input::get('length_check');
			if ( $length_check == 'on' )
			{
				$length = Input::get('length');
			} else {
				$length = null;
			}
			
			$weight_check = Input::get('weight_check');
			if ( $weight_check == 'on' )
			{
				$weight = Input::get('weight');
			} else {
				$weight = null;
			}

			$fuel_check = Input::get('fuel_check');
			if ( $fuel_check == 'on' )
			{
				$fuel = Input::get('fuel');
			} else {
				$fuel = null;
			}
			
			$product->brand = Input::get('brand');

			$new_array = array('colors' => $color, 'sizes' => $size, 'length' => $length, 'weight' => $weight, 'fuels' => $fuel );
			$product->more_data = serialize($new_array);

			$product->country_id = Input::get('country');

			$product->save();
			$pid = $product->id;

			if(!is_null($file[0])){
				$image_files = array();
				$image_files = parent::common_upload_picture(Input::file('images'),'uploads/products');

				for ($i=0; $i < count($image_files); $i++) {
					$product_image = new Product_image();
					$product_image->product_id = $pid;
				    	$product_image->image = $image_files[$i]['imagename'];
				    	$product_image->image_order = $i + 1;
				    	$product_image->save();
				}
			}

			$product_info = Product_info::all();
			if ( $product_info )
			{
				foreach ( $product_info as $pi)
				{
					$name = $pi->id;
					$product_info_check = Input::get($name.'_check');

					if ( $product_info_check == 'on' )
					{
						$info_data = Input::get($name);
						$is_exist = Product_info_data::where('product_id','=',$pid)->where('product_info_id','=',$pi->id)->first();
						if ( $is_exist )
						{
							$is_exist->data = $info_data;
							$is_exist->save();
						} else {
							$product_data = new Product_info_data();
							$product_data->product_id = $pid;
							$product_data->product_info_id = $pi->id;
							$product_data->data = $info_data;
							$product_data->save();
						}
					} else {
						Product_info_data::where('product_id','=',$pid)->where('product_info_id','=',$pi->id)->delete();
					}
				}
			}
			
			Session::flash('success', 'Product is successfully updated.');
			return Redirect::to('admin/product/'.$id);

		} else {
			return Redirect::to('admin/product/'.$id.'/edit')->withErrors($validator)->withInput();
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		Product::delete_image($id);
		Product::delete_info_data($id);
		Product::destroy($id);
		Session::flash('success', 'Product is successfully deleted.');
		return Redirect::to('admin/products/recycle_bin');
	}

	public function addto_recycle($id)
	{
		Product::where('id', $id)->update(array('is_delete' => 1));
	          Session::flash('success', 'Product is successfully created to a recycle bin.');
		return Redirect::to('admin/products/recycle_bin');
	}

	public function recycle_bin()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$product = Product::where('is_delete','=',1)->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		return View::make('backend.admin.product.recycle_bin',compact('product','date_format','currency'));
	}

	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$product = Product_image::find($id);
		unlink('uploads/products/'.$product->image);
		Product_image::where('id','=',$id)->delete();
	}

	public function image_rearrange($id)
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');

		$is_product = Product::is_valid_product($id);
		if(!$is_product){
            		return Redirect::to('admin/error/show/404');
        		}

		$product = Product::find($id);
		$images = Product::get_product_images($id);
		
		return View::make('backend.admin.product.image_rearrange', compact('product', 'images'));
	}
	
	public function image_rearrange_update($id)
	{
		$is_product = Product::is_valid_product($id);
		if(!$is_product){
            		return Redirect::to('admin/error/show/404');
        		}

        		$product = Product::find($id);
	        	$images = Product::get_product_images($id);

	        	foreach($images as $image){
	           	$image_order = Input::get('img'.$image->id);
	           	DB::table('product_images')
	           		->where('id', $image->id)
	           		->where('product_id', $id)
	           		->update(array('image_order' => $image_order));
	        	}

	          Session::flash('success', 'Images are successfully rearranged.');
		return Redirect::to('admin/product/'.$id);
	}

	public function update_discount_ajax()
	{
		$product_id = Input::get('id');
		$discount = Input::get('discount');

		if ( DB::table('products')->where('id','=',$product_id)->update(array('discount'=>$discount)) )
		{
			$data['status'] = 'success';
		} else {
			$data['status'] = 'fail';
		}
		
        		echo json_encode($data);
	}
	
	public function restore_product()
	{
		$id = Input::get('id');
		$delete = Input::get('delete');

		if ( $delete == 1 )
		{
			Product::where('id', $id)->update(array('is_delete' => 0));
		} else {
			Product::where('id', $id)->update(array('is_delete' => 1));
		}

            	Session::flash('success', 'Product is successfully restored.');
		return Redirect::to('admin/product');
	}
	
	public function report_pdf()
	{
		$products = Product::join('subcategories','subcategories.id','=','products.subcategory_id')
			->select('products.created_at as create','products.*','subcategories.*')
			->orderBy('products.created_at','desc')->get();
		$date_format = Common::get_date();
		$currency = Common::get_currency();
		if ( count($products) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.product.report_pdf',compact('products','date_format','currency'));
			return $pdf->stream();
		} else {
			Session::flash('error', 'There is no product.');
			return Redirect::to('admin/product');
		}
	}

	public function report_excel()
	{
		$products = Product::join('subcategories','subcategories.id','=','products.subcategory_id')
			->select('products.created_at as create','products.*','subcategories.*')
			->orderBy('products.created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($products) != 0 )
		{
			$i = 1;
			foreach ( $products as $product )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $product->product_name;
            			$temp['product_no'] = $product->product_no;
            			$temp['subcategory'] = $product->subcategory_name;
            			$temp['qty'] = $product->quantity;
            			$temp['use_qty'] = $product->quantity_use;
            			$temp['left_qty'] = $product->quantity - $product->quantity_use;
            			$temp['price'] = $product->price;
            			$temp['create'] = date($date_format, strtotime($product->create));
            			$result[] = $temp;
            		}

			$filename = "product.csv";

			$header = array(
				'No.','Product Name', 'Product No', 'Subcategory', 'Quantity', 'Used Quantity', 'Left Quantity', 'Price', 'Created Date'
			);
			
			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('error', 'There is no product.');
			return Redirect::to('admin/product');
		}
	}
	
	public function clone_product($id)
	{
		$product = Product::find($id);

		$new_product = New Product;
		$new_product->product_name = $product->product_name;
		$new_product->quantity = 0;
		$new_product->product_no = $product->product_no;
		$new_product->description = $product->description;
		$new_product->price = $product->price;
		$new_product->discount = $product->discount;
		$new_product->category_id = $product->category_id;
		$new_product->subcategory_id = $product->subcategory_id;
		$new_product->brand = $product->brand;
		$new_product->more_data = $product->more_data;
		$new_product->country_id = $product->country_id;
		$new_product->meta_title = $product->meta_title;
		$new_product->meta_keywords = $product->meta_keywords;
		$new_product->meta_description = $product->meta_description;
		$new_product->is_active = 0;
		$new_product->is_delete = 0;
		$new_product->save();
		$pid = $new_product->id;

		$product_info = Product_info_data::where('product_id','=',$id)->get();
		if ( count($product_info) != 0 )
		{
			foreach ( $product_info as $p )
			{
				$new_info = New Product_info_data;
				$new_info->product_id = $pid;
				$new_info->product_info_id = $p->product_info_id;
				$new_info->data = $p->data;
				$new_info->save();
			}
		}

		Session::flash('success', 'Product is successfully cloned.');
		return Redirect::to('admin/product');
	}

}
