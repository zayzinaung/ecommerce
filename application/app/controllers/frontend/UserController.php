<?php
namespace Frontend;

use BaseController; use View; use URL; use Config; use Redirect;
use App; use Session; use Common; use Activation_code; use Country;
use Validator; use User; use Hash; use Auth; use Mail; use Utils\FacebookInterface;
use Input; use Wishlist; use Product; use DB;

class UserController extends BaseController {

	protected $fb;

	public function __construct(FacebookInterface $fb) {
		$this->fb = $fb;
	}
	
	public function index()
	{
		$countries = Country::all();
		return View::make('frontend.register.index',compact('countries'));
	}
	
	public function create_member()
	{
		$rules = array(
			'username'	=> 'required',
			'email'			=> 'required|email',
			'phone'			=> 'required|min:8|max:8',
			'address'		=> 'required',
			'recaptcha_response_field' => 'required|recaptcha',
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('register')
				->withErrors($validator)
				->withInput();
		}
		
		$user_email = Input::get('email');
		$email_setting = Common::get_from_email();

		$is_fbemail = User::where('email','=',$user_email)->where('facebook_id','=',0)->first();
		if ( $is_fbemail )
		{
			Session::flash('fail', "The email address you have entered is already registered.");
			return Redirect::to('register')->withInput();
		} else {

	            	$activation_code = Common::get_unique_numeric_id('activation_codes', 'activation_code', true);
	            	if ( $activation_code == false )
	            	{
	            		Common::get_unique_numeric_id('activation_codes', 'activation_code', true);
	            	}

	            	$calling_code = Common::query_single_data('countries', 'id', Input::get('country'), 'calling_code');

	            	$user = New User;
	            	$user->username = Input::get('username');
	            	$user->email = Input::get('email');
	            	$user->phone = Input::get('phone');
	            	$user->landline = Input::get('landline');
	            	$user->address = Input::get('address');
	            	$user->activation = 0;
	            	$user->neutral = Input::get('neutral');
	            	$user->country_id = Input::get('country');
	            	$user->role_id = 2;
	            	$user->name = 'Member';
	            	$user->save();

	            	$register_id = $user->id;
	            	if ($register_id > 0)
		          {
		          		$activation = New Activation_code;
		          		$activation->user_email = $register_id;
		          		$activation->activation_code = $activation_code;
		          		$activation->save();

		          		//gathers all necessary SMS & Email messages
		          		$name = Input::get('neutral') . '. ' . Input::get('username');
			          $msg_greeting = Common::query_single_data('messages', 'action_name', 'START GREETING', 'message');
			          $msg_greeting = preg_replace("/NAME/", $name, $msg_greeting->message);

			          $msg_ending = Common::query_single_data('messages', 'action_name', 'END GREETING', 'message');

			          $msg_email = Common::query_single_data('messages', 'action_name', 'ACCOUNT ACTIVATION', 'message');
			          $msg_email = preg_replace("/COMPANY/", 'Global Ecommerce', $msg_email->message);

			          $msg_sms = Common::query_single_data('messages', 'action_name', 'SMS 2FA', 'message');
			          $msg_sms = preg_replace("/2FA/", substr($activation_code,0,4), $msg_sms->message);
			          //ends gathering messages

			          // performs SMS to the user
	                		$sms = $msg_greeting . "\r\n" . $msg_sms . "\r\n" . $msg_ending->message;
	                		
			          $sent = User::process_sms_call($calling_code, Input::get('phone'), $sms);
	                		if ( $sent )
	                		{
	                			$masked_email  = preg_replace("/@/", 'AT', $user_email);
	                     		$message = "
	                     		<html>
		        				<head>
				          		<style type='text/css'>
				                 		h3 { font-size: 15px; color: #333; margin-top: 30px; }
				                 		h4 { color: #333; margin-top: 30px; }
				          		</style>
		        				</head>
		        				<body>
		                                
		        				<table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>
		        			 		<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
		        			 			<img src='".URL::to('/frontend/img/logo.png')."' class='logo_recepit' width='200'>
						          		<h3 style='margin-bottom:0;margin-top:0'>     
						           	". $msg_greeting ."
						          		</h3>
		                    					<p>". $msg_email ."</p>
		                    					<p><a href='".URL::to('register/activate_account/'.$register_id)."'>". URL::to('register/activate_account') ."</a></p>
		                    					<p>". $msg_ending->message ."</p>
		        					</div>
		        				</table>	                  
		        				</body>
		        			</html>";

			                    	$url  = 'https://api.sendgrid.com/';
			                    	$user_mail = 'crystaltech';
			                    	$pass = 'h@ppyl1fe';

			                    	$params = array(
			                    		'api_user'  => $user_mail,
			                      	'api_key'   => $pass,
			                      	'to'        => $user_email,
			                      	'subject'   => 'Your account has been created.',
			                      	'html'      => $message,
			                      	'text'      => '',
			                      	'from'      => $email_setting,
			                    	);

			                    	$request =  $url.'api/mail.send.json';
	
				          $session = curl_init($request);
				          curl_setopt($session, CURLOPT_POST, true);
				          curl_setopt($session, CURLOPT_POSTFIELDS, $params);
				          curl_setopt($session, CURLOPT_HEADER, false);
				          curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				          $response = curl_exec($session);
				          curl_close($session);
			                    
				          if(!empty($response)) {
		                        		Session::flash('success','Member is now register. Please checkout your SMS and Email boxes to get the instructions to activate your account.');
		                    		}

	                		} else {
	                    			Session::flash('fail', "System failed to process your registration! Don't worry, contact with us so that we can take some immediate steps.");
	                		}
	                		
		          } else {
		          		Session::flash('fail','Member registration fail. Please try again later.');
		          }

		          return Redirect::to('register');
		}
	}
	
	public function activate_account($id)
    	{
        		//$user_email = preg_replace("/AT/", '@', $masked_email);
        		$check_user = Activation_code::where('user_email','=',$id)->first();

       	 	if ($check_user) {
            		return View::make('frontend.register.activate_account',compact('id'));
        		} else {
        			Session::flash('fail',"Please Register First!");
            		return Redirect::to('register');
        		}
    	}
    	
    	public function member_activate($id)
    	{
    		//$user_email = preg_replace("/AT/", '@', $masked_email);
        		$check_user = Activation_code::where('user_email','=',$id)->first();

       	 	if ($check_user) {
       	 		$validator = Validator::make(Input::all(), Activation_code::$rules);

			if ($validator->fails()) {
				return Redirect::to('register/activate_account/'.$id)->withErrors($validator)->withInput();
			}

			$code = Input::get('activation_code');
			$validate_user = Activation_code::where('user_email','=',$id)->where('activation_code','=',$code)->first();
			
			if ( $validate_user )
			{
				$get_user = User::find($id);

				$pass  = substr(sha1(str_shuffle($get_user->email)),0,5);
		                    	$password = Hash::make($pass);

		                    	User::where('id','=',$id)->where('facebook_id','=',0)->update(array('password' => $password, 'activation' => 1));
		                    	Activation_code::where('user_email','=',$id)->delete();
		                    	Session::flash('success','Congratulations! Your account is activated now. You can login with the email : '.$get_user->email.' and password : '.$pass);
		                    	return Redirect::to('login');

			} else {
                    			Session::flash('fail',"Invalid Code! Please Try again!");
            			return Redirect::to('register/activate_account/'.$id);
			}
       	 	} else {
            		Session::flash('fail',"You are not authorized to visit this section!");
            		return Redirect::to('register/activate_account/'.$id);
       	 	}
    	}
    	
    	public function login()
	{
		return View::make('frontend.register.login')
			->with('fbLoginUrl', $this->getFbLoginUrl());
	}

	private function getFbLoginUrl() {
		return $this->fb->getLoginUrl(array('email'));
	}

	public function fbCallback() {
		$userProfile = $this->fb->checkLogin();
		if ( $userProfile ) {
			$id = $userProfile->getId();
			$name = $userProfile->getName();
			$email = $userProfile->getProperty('email');
			
			$query = User::where('facebook_id','=',$id)->first();
		        	if ( $query == null )
		        	{
		        		$user = New User;
		            	$user->username = $name;
		            	$user->facebook_id = $id;
		            	$user->email = $email;
		            	$user->activation = 1;
		            	$user->role_id = 2;
		            	$user->name = 'Member';
		            	$user->save();

		            	$uid = $user->id;
		            	Session::put('user_id', $uid);
		        	} else {
		        		Session::put('user_id', $query->id);
		        	}
		        	
		        	Session::put('logged_in', 1);
			Session::put('facebook_id', $id);
			Session::put('name', 'Member');
			Session::put('username', $name);
			Session::put('email', $email);
			Session::put('role_id', 2);
			Session::put('lastVisitDate', time());
			Session::put('login_type', 'user');
			Session::flash('success', 'You are successfully logged in.');
			return Redirect::to('/');
		} else {
			Session::flash('fail', 'Some unfortunate errors occured.');
			return Redirect::to('/');
		}
	}
	
	public function member_login()
	{
		$rules = array(
			'email' 	=> 'required|email',
			'password' => 'required'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator)
				->withInput();
		}
		
		if ( Session::get('attempt') != null )
                    	{
                      	if ( Session::get('attempt') > 3 )
                      	{
                        		$freeze_time = Session::get('current') + 180;
                        		if ( time() > $freeze_time )
                        		{
                        			Session::put('current',null);
                        			Session::put('attempt',null);
                        		}
                      	}
                    	}

            	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
		{
			$check_active = User::where('email','=',Input::get('email'))->where('is_active','=',0)->first();
			if ( $check_active == null )
			{
				$id = Auth::id();
				$user = User::set_authnication($id);
				Session::flash('success', 'You are successfully logged in.');
				return Redirect::to('/');
			} else {
				Session::flash('fail', 'Sorry! Your account is inactive. If you have any questions, please contact to the HR department.');
				return Redirect::to('login');
			}
    			
		} else {
			$count = 1;
			$get_attempt = Session::get('attempt');
			if ( $get_attempt != null )
			{
				if ( $get_attempt == 3 )
				{
					Session::put('current',time());
					Session::put('attempt', ++$get_attempt);
				} else {
					Session::put('attempt', ++$get_attempt);
				}
			} else {
				Session::put('attempt', ++$count);
			}
			
			Session::flash('fail', 'Email and Password do not match.');
			return Redirect::to('login');
		}
	}
	
	public function member_logout()
	{
		Session::flush();
		return Redirect::to('/');
	}

	public function forget()
	{
		return View::make('frontend.register.forget');
	}

	public function recover_password()
	{
		$rules = array(
			'email' 	=> 'required|email'
		);
  		$validator = Validator::make(Input::all(),$rules);

  		if($validator->fails()) {
   			return Redirect::to('member/forget')
				->withErrors($validator)
				->withInput();
 		}

 		$user = User::where('email', '=', Input::get('email'))->where('facebook_id','=',0);
      		if($user->count() == 1) {
        			$user = $user->first();
        			//generate code
        			$code                 = str_random(60);
        			$password             = str_random(10);
        			$user->code           = $code;
        			$user->password_temp  = Hash::make($password);
        			if($user->save()) {

        				$message = View::make('backend.sessions.email', array(
	           				'link' => URL::to('member/get_recover').'/'.$code,
		            			'username' => $user->username,
		            			'password' => $password));

				$url  = 'https://api.sendgrid.com/';
			          $user_mail = 'crystaltech';
			          $pass = 'h@ppyl1fe';
			          
			          $params = array(
			                    'api_user'  => $user_mail,
			                    'api_key'   => $pass,
			                    'to'        => $user->email,
			                    'subject'   => 'Your new password has been reset',
			                    'html'      => $message,
			                    'text'      => '',
			                    'from'      => Common::get_from_email(),
			          );

			          $request =  $url.'api/mail.send.json';
	
				$session = curl_init($request);
				curl_setopt($session, CURLOPT_POST, true);
				curl_setopt($session, CURLOPT_POSTFIELDS, $params);
				curl_setopt($session, CURLOPT_HEADER, false);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($session);
				curl_close($session);

		          		Session::flash('success', 'Success: Your password is reset, mail had been sent.');
				return Redirect::to('member/forget');
	       		}
     		} else {
     			Session::flash('fail', "Sorry! Can't find your email in our system.");
			return Redirect::to('member/forget');
     		}
	}
	
	public function get_recover($code) 
	{
 		$user = User::where('code', '=', $code)->where('password_temp', '!=', '');

  		if($user->count()) {
    			$user = $user->first();

    			$user->password       = $user->password_temp;
    			$user->password_temp  = '';
    			$user->code           = '';

    			if ($user->save()) {
        				return Redirect::to('login')
       					->with('message', 'Your account has been recover and you can sign in with new password.');
    			}
  		}
  		return Redirect::to('login')->with('fail', 'Sorry! Could not recover your account.');
  	}
  	
  	public function add_wishlist()
	{
		$id = Input::get('id');
        		$user_id = Input::get('user_id');

        		$is_exist = Wishlist::where('member_id','=',$user_id)->where('product_id','=',$id)->first();
        		if ( $is_exist == null )
        		{
        			$wishlist = New Wishlist;
        			$wishlist->member_id = $user_id;
        			$wishlist->product_id = $id;
        			$wishlist->created_at = time();
        			$wishlist->last_date = date('Y-m-d H:i:s', strtotime("+30 days"));
        			$wishlist->save();

        			$data['status'] = 'success';
		
        		} else {
        			$data['status'] = 'fail';
        		}

        		echo json_encode($data);
	}
	
	public function wishlist()
	{
		if ( Session::has('logged_in') )
		{
			$pid = '';
			$product = '';
			$wishlist = Wishlist::where('member_id','=',Session::get('user_id'))->get();
			foreach ( $wishlist as $w )
			{
				$pid[] = $w->product_id;
			}
			$products = Product::whereIn('id', $pid)->where('is_active','=',1)->where('is_delete','=',0)->get();
			if ( !empty($products) )
			{
				foreach ( $products as $p )
				{
					$product[] = DB::table('products')
						->join('product_images', 'product_images.product_id', '=', 'products.id')
						->where('products.id','=',$p->id)
						->where('product_images.image_order','=',1)
						->where('products.is_active','=',1)
						->where('products.is_delete','=',0)
						->orderBy('products.created_at','desc')
						->select('products.id as pid', 'product_images.id', 'product_images.product_id', 'products.price','products.product_name', 'products.slug', 'products.quantity','products.quantity_use','product_images.image','products.product_no')
						->first();
				}
			} else {
				$product = '';
			}

			return View::make('frontend.cart.wishlist',compact('product'));
		} else {
			App::abort(404);
		}
	}

	public function delete_wishlist()
	{
		if ( Session::has('logged_in') )
		{
			$pid = Input::get('id');
			$uid = Session::get('user_id');

			Wishlist::where('member_id','=',$uid)->where('product_id','=',$pid)->delete();

			$data['status'] = 'success';
			echo json_encode($data);

		} else {
			App::abort(404);
		}
	}

	public function profile()
	{
		if ( Session::get('facebook_id') == 0 )
		{
			$user = User::find(Session::get('user_id'));
			return View::make('frontend.register.profile',compact('user'));
		} else {
			App::abort(404);
		}
	}

	public function edit_profile($id)
	{
		$user = User::find($id);

		$rules = array(
			'username'	=> 'required',
			'phone'			=> 'required|min:8|max:8',
			'address'		=> 'required',
			'recaptcha_response_field' => 'required|recaptcha',
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('member/profile')
				->withErrors($validator)
				->withInput();
		}

		$name = Input::get('username');
		$neutral = Input::get('neutral');
		$phone = Input::get('phone');
		$landline = Input::get('landline');
		$address = Input::get('address');
		$old_password = Input::get('old_password');
		$change_pass = Input::get('change_password');

		if ( $change_pass == 'on' )
		{
        			$password = User::find($id)->password;
			if (Hash::check($old_password, $password))
			{
				$new_password = Input::get('new_password');
				$confirm_password = Hash::make(Input::get('confirm_password'));
				if (Hash::check($new_password, $confirm_password))
				{
					$user->password = Hash::make($new_password);
				} else {
					Session::flash('fail', "The confirm password and password must match.");
					return Redirect::to('member/profile');
				}
			} else {
				Session::flash('fail', "Sorry! Your old password incorrectly.");
				return Redirect::to('member/profile');
			}
		}

		Session::put('username', $name);
		$user->username = $name;
		$user->neutral = $neutral;
		$user->phone = $phone;
		$user->landline = $landline;
		$user->address = $address;
		$user->save();

		Session::flash('success', "Your information is successfully updated.");
		return Redirect::to('member/profile');
	}
	
}