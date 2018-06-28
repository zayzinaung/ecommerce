<?php
namespace Frontend;

use BaseController; use View; use Response; use Request; use Input; use Redirect; use URL;
use Session; use App; use Product; use Slider; use Wishlist; use Common; use Page;
use Validator; use General_setting; use Footer;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function index()
	{
		$products = Product::join('product_images', 'product_images.product_id', '=', 'products.id')
				->where('product_images.image_order','=',1)
				->where('products.is_active','=',1)
				->where('products.is_delete','=',0)
				->orderBy('products.created_at','desc')
				->limit(10)
				->select('products.id as pid', 'product_images.*', 'products.*')
				->get();
		$sliders = Slider::all();

		$products_id = Common::wishlist();

		$currency_symbol = Common::get_currency_format();
		
		return View::make('frontend.pages.index', compact('products','sliders','products_id','currency_symbol'));
	}
	
	public function pages($name)
	{
		$page = Page::where('name','=',$name)->first();
		if ( count($page) == 0 )
		{
			App::abort(404);
		}
		return View::make('frontend.pages.page', compact('page'));
	}
	
	public function change_currency()
	{
		$val = Input::get('value');

		if ( $val == 'GBP' )
		{
			Session::put('currency_symbol', '£');
		} elseif ( $val == 'EUR' ) {
			Session::put('currency_symbol', '€');
		} elseif ( $val == 'MYR' ) {
			Session::put('currency_symbol', 'RM');
		} elseif ( $val == 'MMK' ) {
			Session::put('currency_symbol', 'Ks');
		} elseif ( $val == 'SGD' ) {
			Session::put('currency_symbol', 'S$');
		} elseif ( $val == 'THB' ) {
			Session::put('currency_symbol', '฿');
		} else {
			Session::put('currency_symbol', '$');
		}

		Session::put('currency_type', $val);

		$data['status'] = 'success';
		echo json_encode($data);
	}

	public function contact()
	{
		$contact = Page::where('name','=','contact')->first();
		$contact_data = Footer::where('name','=','fourth_column')->first();
		return View::make('frontend.pages.contact', compact('contact','contact_data'));
	}

	public function contact_send()
	{
		$rules = array(
			'name'		=>	'required',
			'email'		=>	'required|email',
			'message'	=>	'required',
		);
		$validator = Validator::make(Input::all(), $rules);

		if( $validator->fails() ) {
			return Redirect::to('contact')
				->withErrors($validator)
				->withInput();
		}

		$message = Input::get('message');
		$from = Input::get('email');
		$email = General_setting::where('type','=','to_email')->first();
		$to = $email->format;

		$msg = "
	                    	<html>
		        	<head>
				<style type='text/css'>
					.logo_recepit { float: left; width: 200px; margin: 10px 20px 20px 0; }
				         	h3 { font-size: 15px; color: #333; margin-top: 30px; }
				          	h4 { color: #333; margin-top: 30px; }
				</style>
		        	</head>
		        	<body>
		                    <table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>
		        			<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
		        				<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
		        				<p>Message : </p>
		                    			<p>". $message ."</p>
		        			</div>
		        		</table>	                  
		        	</body>
		        	</html>";

		$admin_url  = 'https://api.sendgrid.com/';
		$admin_user = 'crystaltech';
		$admin_pass = 'h@ppyl1fe';

		$admin_params = array(
			'api_user'  => $admin_user,
			'api_key'   => $admin_pass,
			'to'        => $to,
			'subject'   => 'Contact',
			'html'      => $msg,
			'text'      => '',
			'from'      => $from,
		);

		$admin_request =  $admin_url.'api/mail.send.json';
		
		$admin_session = curl_init($admin_request);
		curl_setopt($admin_session, CURLOPT_POST, true);
		curl_setopt($admin_session, CURLOPT_POSTFIELDS, $admin_params);
		curl_setopt($admin_session, CURLOPT_HEADER, false);
		curl_setopt($admin_session, CURLOPT_RETURNTRANSFER, true);
		$admin_response = curl_exec($admin_session);
		curl_close($admin_session);
		
		if(!empty($admin_response)) {
		          Session::flash('success','Message has been sent successfully.');
		}
		
		return Redirect::to('contact');
	}

	public function shipment_tracking()
	{
		$shipment = Input::get('shipment_no');
            
        		if( $shipment != NULL )
        		{
            		$pieces = explode("-", $shipment);
            		$pieces[0] = 1212;
            		$pieces[1] = 2323;
            		if( isset($pieces[2]) == null ) 
            		{ 
            			$bill_no = 356;
            		} else {
            			$bill_no = $pieces[2];
            		}
            		$status = $this->common_model->query_single_row("orders","bill_no",$bill_no);
                		if( $this->common_model->query_single_duplicate_data("orders","bill_no",$bill_no)==TRUE )
                		{
                    			if( $status->shipment_level_id == 1 )
                    			{
                        			echo 'Your Shipment is Under Process';

                    			} else if( $status->shipment_level_id == 2 ) {
                        			echo 'Your shipment has been sent through courier name => '.'['.$status->courier_name.']'.' and courier no => '.'['.$status->courier_no.']';
                    			} else {
                        			echo 'Your shipment has been delivered on '.'['. date('d/m/Y',$status->delivered_on).']';
                    			}
                		} else {
                    			echo "Your consignment number is invalid or doesn't exist.";
               		}
        		} else {
            		echo "Your consignment number is invalid or doesn't exist.";
        		}
	}
	
}
