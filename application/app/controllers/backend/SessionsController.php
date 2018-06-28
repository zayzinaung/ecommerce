<?php

class SessionsController extends Controller {

	public function __construct()
	{
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()) {
			if(Auth::user()->role_id==1)
			{
				return Redirect::to('admin/home');
			} else {
				return View::make('backend.sessions.login');
			}
		}
		return View::make('backend.sessions.login');
	}

	public function login()
	{
		$rules = array(
			'username'	=>	'required|min:3|max:32',
			'password'	=>	'required|min:3|max:32'
		);
		$validator=Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('/admin')
				->withErrors($validator)
				->withInput();
		}
		
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if (Auth::attempt($credentials)) {
			$id = Auth::id();
			$user = User::set_authnication($id);
			return Redirect::to('/admin/home')->with('success', 'You are successfully logged in.');
		} else {
			Session::flash('error_message', 'Username and Password do not match.');
			return Redirect::to('/admin');
		}
	}

	public function logout()
	{
		Session::flush();
		return Redirect::to('/admin');
	}

	public function forget()
	{
		return View::make('backend.sessions.forget');
	}
	
	public function recover_password()
	{
  		$validator = Validator::make(Input::all(),
    				array(
        				'email' => 'required|email'
       				)
    			);
  		if($validator->fails()) {
   			 return 'The Email you have entered is invalid!';
 		} else {
      		$user = User::where('email', '=', Input::get('email'));
      		if($user->count() == 1) {
        		$user = $user->first();
        		//generate code
        		$code                 = str_random(60);
        		$password             = str_random(10);
        		$user->code           = $code;
        		$user->password_temp  = Hash::make($password);
        		if($user->save()) {
        			$message = View::make('backend.sessions.email', array(
	           			'link' => URL::to('admin/sessions/getRecover').'/'.$code,
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
			
		          	return "Your password is reset, mail had been sent.";
	       		}
     		} else {
     			return "Can't find your email in our system.";
     		}
  		}
	}

	public function getRecover($code) 
	{
 		$user = User::where('code', '=', $code)->where('password_temp', '!=', '');

  		if($user->count()) {
    		$user = $user->first();

    		$user->password       = $user->password_temp;
    		$user->password_temp  = '';
    		$user->code           = '';

    		if ($user->save()) {
        		return Redirect::to('admin')
       				->with('message', 'Your account has been recover and you can sign in with new password.');
    		}
  		}
  		return Redirect::to('admin')->with('error_message', 'Could not recover your account.');
  	}

}
