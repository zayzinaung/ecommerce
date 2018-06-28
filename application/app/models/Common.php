<?php

class Common extends Eloquent {

    public static function query_single_data($table,$target_field,$source_data,$desire_data)
    {
          return DB::table($table)->select($desire_data)->where($target_field, $source_data)->first();
    }

    public static function query_single_row_by_single_source($table, $target_field, $source_data)
    {
          return DB::table($table)->where($target_field, $source_data)->first();
    }

	public static function query_multiple_rows_by_single_source($table, $target_field, $source_data)
    {
		return DB::table($table)->where($target_field, $source_data)->get();
    }
    
    public static function query_update_data($table,$target_field,$source_data,$desire_data)
    {
          return DB::table($table)->where($target_field, $source_data)->update($desire_data);
    }

	public static function get_unique_numeric_id($check_table, $check_field)
    	{
        	// creates a random id
       	$random_unique_int = mt_rand(1000000000000000,9999999999999999);
        	if ($random_unique_int < 0)
            	$random_unique_int *= (-1);

        	// Make sure the random id isn't already in use
        	$query = DB::table($check_table)->where($check_field, $random_unique_int)->select($check_field)->first();
        		
        	if ( $query != null )
        	{
        		return false;
        	}
        	return $random_unique_int;
    	}
    
    public static function discount($first_no,$second_no)
    {
          $total = number_format((float)( $first_no * $second_no ) / 100, 2, '.', '');
          return number_format((float)$first_no - $total, 2, '.', '');
    }

    public static function gst($first_no,$second_no)
    {
          $total = number_format((float)( $first_no * $second_no ) / 100, 2, '.', '');
          return number_format((float)$first_no + $total, 2, '.', '');
    }
    
    public static function check_is_exist($key)
    {
          if ( $key != null )
          {
              $val = $key;
          } else {
              $val = 0;
          }
          return $val;
    }
    
    public static function wishlist()
    {
          if ( Session::has('user_id') )
          {
              $wishlist = Wishlist::where('member_id','=',Session::get('user_id'))->get();
              if ( count($wishlist) != 0 )
              {
                    foreach ( $wishlist as $w )
                    {
                        $products_id[] = $w->product_id;
                    }
              } else {
                    $products_id = '';
              }
              return $products_id;
          }
    }
    
    public static function get_prefix()
    {
          $get_prefix = General_setting::where('type','=','prefix')->first();
          return $get_prefix->format;
    }

    public static function get_from_email()
    {
          $get_email = General_setting::where('type','=','from_email')->first();
          return $get_email->format;
    }
    
    public static function get_to_email()
    {
          $get_email = General_setting::where('type','=','to_email')->first();
          return $get_email->format;
    }
    
    public static function get_currency()
    {
          $get_currency = General_setting::where('type','=','currency')->first();
          return $get_currency->info;
    }
    
    public static function get_date()
    {
        $get_date = General_setting::where('type','=','date_format')->first();
        $date = $get_date->format;
        $date = str_replace('{dd}', 'd', $date);
        $date = str_replace('{DD}', 'D', $date);
        $date = str_replace('{mm}', 'm', $date);
        $date = str_replace('{MM}', 'M', $date);
        $date = str_replace('{yy}', 'y', $date);
        $date = str_replace('{YY}', 'Y', $date);
        $date = str_replace('{jS}', 'jS', $date);
        $date = str_replace('{ll}', 'l', $date);
        $date = str_replace('{FF}', 'F', $date);
        return $date;
    }
    
    public static function get_date_format($time)
    {
          $time = str_replace('/', '-', $time);
          $time = str_replace('.', '-', $time);
          $time = str_replace(' ', '-', $time);
          $time = strtotime($time);
          return $time;
    }
    
    public static function convert_currency()
    {
          $amount = 1;

          $get_format = General_setting::where('type','=','currency')->first();
          $from = $get_format->format;
          
          if ( Session::has('currency_type') )
          {
              $to = Session::get('currency_type');
              
              $url = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to"; 
              $request = curl_init(); 
              $timeOut = 0;
              curl_setopt ($request, CURLOPT_URL, $url);
              curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
              curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
              curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut); 
              $response = curl_exec($request);
              curl_close($request);
              //return $response;
              
              $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s';
              preg_match($regularExpression, $response, $finalData);
              
              if ( !empty ($finalData) )
              {
                    $result = str_replace(' '.$to, '', $finalData[1]);
                    return $result;
              } else {
                    $result = 1;
                    return $result;
              }
          } else {
              $result = 1;
              return $result;
          }
    }
    
    public static function get_currency_format()
    {
          $get = General_setting::where('type','=','currency')->first();
          $format = $get->symbol;
          return $format;
    }
    
    public static function product_orderby_query($order_key,$order_value,$cate,$subcate,$brand,$keyword)
    {
          $query = DB::table('products')
                          ->join('product_images', 'product_images.product_id', '=', 'products.id')
                          ->where('product_images.image_order','=',1)
                          ->where('products.is_active','=',1)
                          ->where('products.is_delete','=',0);
          if ( $subcate != '' )
          {
              $query->where('products.category_id','=',$cate);
              $query->where('products.subcategory_id','=',$subcate);
          } elseif ( $cate != '' && $subcate == '' ) {
              $query->where('products.category_id','=',$cate);
          } elseif ( $brand != '' ) {
              $query->where('products.brand','=',$brand);
          } elseif ( $keyword != '' ) {
              $query->where("product_name","like","%".$keyword."%");
          }

          $query->orderBy($order_key,$order_value);
          $query->select('products.id as pid', 'product_images.*', 'products.*');
          $products = $query->paginate(10);
          
          return $products;
    }
    
    public static function product_price_query($key,$var,$value,$cate,$subcate,$order_key,$order_value,$brand,$keyword)
    {
          $query = DB::table('products')
                          ->join('product_images', 'product_images.product_id', '=', 'products.id')
                          ->where('product_images.image_order','=',1)
                          ->where('products.is_active','=',1)
                          ->where('products.is_delete','=',0);
          if ( $subcate != '' )
          {
              $query->where('products.category_id','=',$cate);
              $query->where('products.subcategory_id','=',$subcate);
          } elseif ( $cate != '' && $subcate == '' ) {
              $query->where('products.category_id','=',$cate);
          } elseif ( $brand != '' ) {
              $query->where('products.brand','=',$brand);
          } elseif ( $keyword != '' ) {
              $query->where("product_name","like","%".$keyword."%");
          }

          $query->where($key,$var,$value);
          $query->orderBy($order_key,$order_value);
          $query->select('products.id as pid', 'product_images.*', 'products.*');
          $products = $query->paginate(10);

          return $products;
    }

    public static function product_price_between_query($key,$var,$value,$var2,$value2,$cate,$subcate,$order_key,$order_value,$brand,$keyword)
    {
          $query = DB::table('products')
                          ->join('product_images', 'product_images.product_id', '=', 'products.id')
                          ->where('product_images.image_order','=',1)
                          ->where('products.is_active','=',1)
                          ->where('products.is_delete','=',0);
          if ( $subcate != '' )
          {
              $query->where('products.category_id','=',$cate);
              $query->where('products.subcategory_id','=',$subcate);
          } elseif ( $cate != '' && $subcate == '' ) {
              $query->where('products.category_id','=',$cate);
          } elseif ( $brand != '' ) {
              $query->where('products.brand','=',$brand);
          } elseif ( $keyword != '' ) {
              $query->where("product_name","like","%".$keyword."%");
          }

          $query->where($key,$var,$value);
          $query->where($key,$var2,$value2);
          $query->orderBy($order_key,$order_value);
          $query->select('products.id as pid', 'product_images.*', 'products.*');
          $products = $query->paginate(10);

          return $products;
    }

    public static function post_orderby_query($sort,$category_id,$subcategory_id,$brand,$keyword)
    {
          if ( $sort == 'a to z' )
          {
              return Common::product_orderby_query('products.product_name','asc',$category_id,$subcategory_id,$brand,$keyword);
          } elseif ( $sort == 'z to a' ) {
              return Common::product_orderby_query('products.product_name','desc',$category_id,$subcategory_id,$brand,$keyword);
          } elseif ( $sort == 'low to high' ) {
              return Common::product_orderby_query('products.price','asc',$category_id,$subcategory_id,$brand,$keyword);
          } elseif ( $sort == 'high to low' ) {
              return Common::product_orderby_query('products.price','desc',$category_id,$subcategory_id,$brand,$keyword);
          } else {
              return Common::product_orderby_query('products.created_at','desc',$category_id,$subcategory_id,$brand,$keyword);
          }
    }

    public static function post_price_query($price,$category_id,$subcategory_id,$brand,$keyword)
    {
          if ( $price == 'below 50' )
          {
              return Common::product_price_query('products.price','<=',50.00,$category_id,$subcategory_id,'products.created_at','desc',$brand,$keyword);
          } elseif ( $price == '50 to 100' ) {
              return Common::product_price_between_query('products.price','>=',50.00,'<=',100.00,$category_id,$subcategory_id,'products.created_at','desc',$brand,$keyword);
          } elseif ( $price == '100 to 200' ) {
              return Common::product_price_between_query('products.price','>=',100.00,'<=',200.00,$category_id,$subcategory_id,'products.created_at','desc',$brand,$keyword);
          } elseif ( $price == '200 to 500' ) {
              return Common::product_price_between_query('products.price','>=',200.00,'<=',500.00,$category_id,$subcategory_id,'products.created_at','desc',$brand,$keyword);
          } elseif ( $price == '500 above' ) {
              return Common::product_price_query('products.price','>=',500.00,$category_id,$subcategory_id,'products.created_at','desc',$brand,$keyword);
          } else {
              return Common::product_orderby_query('products.created_at','desc',$category_id,$subcategory_id,$brand,$keyword);
          }
    }

    public static function post_sort_price_query($sort,$price,$category_id,$subcategory_id,$brand,$keyword)
    {
          if ( $sort == 'a to z' && $price == 'below 50' )
          {
              return Common::product_price_query('products.price','<=',50.00,$category_id,$subcategory_id,'products.product_name','asc',$brand,$keyword);

          } elseif ( $sort == 'a to z' && $price == '50 to 100' ) {
              return Common::product_price_between_query('products.price','>=',50.00,'<=',100.00,$category_id,$subcategory_id,'products.product_name','asc',$brand,$keyword);

          } elseif ( $sort == 'a to z' && $price == '100 to 200' ) {
              return Common::product_price_between_query('products.price','>=',100.00,'<=',200.00,$category_id,$subcategory_id,'products.product_name','asc',$brand,$keyword);

          } elseif ( $sort == 'a to z' && $price == '200 to 500' ) {
              return Common::product_price_between_query('products.price','>=',200.00,'<=',500.00,$category_id,$subcategory_id,'products.product_name','asc',$brand,$keyword);

          } elseif ( $sort == 'a to z' && $price == '500 above' ) {
              return Common::product_price_query('products.price','>=',500.00,$category_id,$subcategory_id,'products.product_name','asc',$brand,$keyword);

          }
          elseif ( $sort == 'z to a' && $price == 'below 50' )
          {
              return Common::product_price_query('products.price','<=',50.00,$category_id,$subcategory_id,'products.product_name','desc',$brand,$keyword);

          } elseif ( $sort == 'z to a' && $price == '50 to 100' ) {
              return Common::product_price_between_query('products.price','>=',50.00,'<=',100.00,$category_id,$subcategory_id,'products.product_name','desc',$brand,$keyword);

          } elseif ( $sort == 'z to a' && $price == '100 to 200' ) {
              return Common::product_price_between_query('products.price','>=',100.00,'<=',200.00,$category_id,$subcategory_id,'products.product_name','desc',$brand,$keyword);

          } elseif ( $sort == 'z to a' && $price == '200 to 500' ) {
              return Common::product_price_between_query('products.price','>=',200.00,'<=',500.00,$category_id,$subcategory_id,'products.product_name','desc',$brand,$keyword);

          } elseif ( $sort == 'z to a' && $price == '500 above' ) {
              return Common::product_price_query('products.price','>=',500.00,$category_id,$subcategory_id,'products.product_name','desc',$brand,$keyword);

          }
          elseif ( $sort == 'low to high' && $price == 'below 50' )
          {
              return Common::product_price_query('products.price','<=',50.00,$category_id,$subcategory_id,'products.price','asc',$brand,$keyword);

          } elseif ( $sort == 'low to high' && $price == '50 to 100' ) {
              return Common::product_price_between_query('products.price','>=',50.00,'<=',100.00,$category_id,$subcategory_id,'products.price','asc',$brand,$keyword);

          } elseif ( $sort == 'low to high' && $price == '100 to 200' ) {
              return Common::product_price_between_query('products.price','>=',100.00,'<=',200.00,$category_id,$subcategory_id,'products.price','asc',$brand,$keyword);

          } elseif ( $sort == 'low to high' && $price == '200 to 500' ) {
              return Common::product_price_between_query('products.price','>=',200.00,'<=',500.00,$category_id,$subcategory_id,'products.price','asc',$brand,$keyword);

          } elseif ( $sort == 'low to high' && $price == '500 above' ) {
              return Common::product_price_query('products.price','>=',500.00,$category_id,$subcategory_id,'products.price','asc',$brand,$keyword);

          }
          elseif ( $sort == 'high to low' && $price == 'below 50' )
          {
              return Common::product_price_query('products.price','<=',50.00,$category_id,$subcategory_id,'products.price','desc',$brand,$keyword);

          } elseif ( $sort == 'high to low' && $price == '50 to 100' ) {
              return Common::product_price_between_query('products.price','>=',50.00,'<=',100.00,$category_id,$subcategory_id,'products.price','desc',$brand,$keyword);

          } elseif ( $sort == 'high to low' && $price == '100 to 200' ) {
              return Common::product_price_between_query('products.price','>=',100.00,'<=',200.00,$category_id,$subcategory_id,'products.price','desc',$brand,$keyword);

          } elseif ( $sort == 'high to low' && $price == '200 to 500' ) {
              return Common::product_price_between_query('products.price','>=',200.00,'<=',500.00,$category_id,$subcategory_id,'products.price','desc',$brand,$keyword);

          } elseif ( $sort == 'high to low' && $price == '500 above' ) {
              return Common::product_price_query('products.price','>=',500.00,$category_id,$subcategory_id,'products.price','desc',$brand,$keyword);

          } else {
              return Common::product_orderby_query('products.created_at','desc',$category_id,$subcategory_id,$brand,$keyword);
          }
    }

    public static function get_menu()
    {
          $data = array();
          $menu = Menu::where('parent_id','=',0)->where('header_active','=',1)->groupBy('id')->orderBy('header_ordering')->get();
          foreach ($menu as $row) 
          {
              $page = Page::find($row->page_id);
              $child_level = array();
              $menus2 = Menu::where('parent_id','=',$row->id)->where('header_active','=',1)->groupBy('id')->orderBy('header_ordering')->get();
              if(count($menus2) > 0 )
              {  
                    $level2 = array();               
                    foreach ($menus2 as $row2) 
                    {
                          $page2 = Page::find($row2->page_id);
                          $menu2 = array(
                              'id' => $row2->id,
                              'menu_name' => $page2->title,
                              'menu_slug' => $page2->name,
                              'childs' => array()
                          );  
                
                          $menus3 = Menu::where('parent_id','=',$row2->id)->where('header_active','=',1)->groupBy('id')->orderBy('header_ordering')->get();
                          if(count($menus3) > 0 )
                          {
                              $child_level_3 = array();
                              foreach ($menus3 as $row3) 
                              {
                                    $page3 = Page::find($row3->page_id);
                                    $menu3 = array(
                                        'id' => $row3->id,
                                        'menu_name' => $page3->title,
                                        'menu_slug' => $page3->name,
                                        'childs' => array()
                                    );  
                                    $child_level_3[] = $menu3;
                              }
                              $menu2['childs'] = $child_level_3;
                          }
                          $level2[] = $menu2 ;
                    }
                    $child_level = $level2;
              }
              $level = array(
                    'id' => $row->id,
                    'menu_name' => $page->title,
                    'menu_slug' => $page->name,
                    'childs' => $child_level
              );      
              $data[] = $level;
          }
          return $data;
    }

    public static function get_yearly_income_array($month)
    {
          $start_date = date('Y-').$month.'-01 00:00:00';
          $end_date = date('Y-m-',strtotime($start_date)).date('t',strtotime($start_date)).' 23:59:59';

          $from = strtotime($start_date);
          $to = strtotime($end_date);
          $charge=0;

          $online_sold = Order::where('orders.is_paid','=',1)->where('orders.is_cancel','=',0)->get();
          foreach ( $online_sold as $row )
          {
              if( $from <= strtotime($row->created_at) && strtotime($row->created_at) <= $to )
              {
                    $sold_amount = ($row->original_price) * ($row->order_quantity);
                    $discount_total = Common::discount($sold_amount, $row->discount);
                    $overall_total = Common::gst($discount_total, $row->gst);
                    $charge += $overall_total;
              }
          }

          $offline_sold = Offline_sale::all();
          foreach ( $offline_sold as $row )
          {
              if( $from <= $row->selling_date && $row->selling_date <= $to )
              {
                    $sold_amount = ($row->order_quantity) * ($row->per_price);
                    $charge += $sold_amount;
              }
          }

          $other_incomes = Income::all();
          foreach ( $other_incomes as $row )
          {
              if( $from <= $row->received_date && $row->received_date <= $to )
              {
                    $charge += $row->income_amount;
              }
          }

          return floatval($charge);
    }
    
    public static function get_yearly_expense_array($month)
    {
          $from = $start_date = strtotime('01-'.$month.'-'.date('Y').' 00:00:00');
          $to = $end_date = strtotime(date('t',$start_date).'-'.date('m-Y',$start_date).' 23:59:59');
          $charge=0;

          $stocks = Stock::all();
          foreach ( $stocks as $row )
          {
              if( $from <= $row->buying_date && $row->buying_date <= $to )
              {
                    $charge += $row->amount;
              }
          }
          
          $expenses = Expense::all();
          foreach ( $expenses as $row )
          {
              if( $from <= $row->payment_date && $row->payment_date <= $to )
              {
                    $charge += $row->expense_amount;
              }
          }

          return floatval($charge);
    }

}
?>