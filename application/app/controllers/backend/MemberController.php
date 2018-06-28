<?php

class MemberController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		define('MODULE',"member");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$member = User::where('name','=','Member')->where('facebook_id','=',0)->orderBy('created_at', 'DESC')->get();
		$date_format = Common::get_date();
		return View::make('backend.admin.member.index',compact('member','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$countries = Country::all();
		return View::make('backend.admin.member.add',compact('countries'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'username'	=> 'required',
			'email'		=> 'required|email',
			'phone'		=> 'required|min:8|max:8',
			'address'	=> 'required',
			'password'	=> 'required',
			'confirm_password'	=> 'required|same:password',
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/member/create')
				->withErrors($validator)
				->withInput();
		}

		$user_email = Input::get('email');

		$is_fbemail = User::where('email','=',$user_email)->where('facebook_id','=',0)->first();
		if ( $is_fbemail )
		{
			Session::flash('error', "The email address you have entered is already registered.");
			return Redirect::to('admin/member/create');
		} else {

	            	$calling_code = Common::query_single_data('countries', 'id', Input::get('country'), 'calling_code');

	            	$user = New User;
	            	$user->username = Input::get('username');
	            	$user->email = Input::get('email');
	            	$user->phone = Input::get('phone');
	            	$user->landline = Input::get('landline');
	            	$user->address = Input::get('address');
	            	$user->activation = 1;
	            	$user->neutral = Input::get('neutral');
	            	$user->country_id = Input::get('country');
	            	$user->role_id = 2;
	            	$user->name = 'Member';
	            	$user->password = Hash::make(Input::get('password'));
	            	$user->save();

	            	$register_id = $user->id;
	            	if ($register_id > 0)
		          {
		          		//gathers all necessary SMS & Email messages
		          		$name = Input::get('neutral') . '. ' . Input::get('username');

			          $msg_ending = Common::query_single_data('messages', 'action_name', 'END GREETING', 'message');

			          // performs SMS to the user
	                		$sms = 'Dear '. $name . "\r\n" . 'Now you are a member of our website. Please check your mailbox to get the email and password.' . "\r\n" . $msg_ending->message;

	                		//$sent = User::process_sms_call($calling_code, Input::get('phone'), $sms);
	                		$sent = true;
	                		if ( $sent )
	                		{
	                			/*$email  = Input::get('email');
	                			$password = Input::get('password');
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
						          		<h3 style='margin-bottom:0;margin-top:0'>     
						           	Dear ". $name ."
						          		</h3>
						          		<p>Congratulations! Now you are a member of our website.</p>
		                    					<p>You can login with the email : ". $email ." and password : ". $password ."</p>
		                    					<p>". $msg_ending->message ."</p>
		        					</div>
		        				</table>	                  
		        				</body>
		        			</html>";

			                    	$url  = 'https://api.sendgrid.com/';
			                    	$user = 'crystaltech';
			                    	$pass = 'h@ppyl1fe';

			                    	$params = array(
			                    		'api_user'  => $user,
			                      	'api_key'   => $pass,
			                      	'to'        => 'ptaung4@gmail.com',
			                      	'subject'   => 'Your account has been created.',
			                      	'html'      => '$message',
			                      	'text'      => '',
			                      	'from'      => 'zinaung@official-crystal.com',
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
		                        		Session::flash('success','Member is successfully created.');
		                    		}*/
	                		} else {
	                    			Session::flash('error', "System failed to process your registration! Don't worry, contact with us so that we can take some immediate steps.");
	                		}
		          } else {
		          		Session::flash('error','Member registration fail. Please try again later.');
		          }

		          return Redirect::to('admin/member');
	          }
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
		$member = User::findOrFail($id);
		return View::make('backend.admin.member.detail', compact('member'));
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
		$member = User::find($id);
		return View::make('backend.admin.member.edit', compact('member'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$member = User::find($id);

		$rules = array(
			'name' => 'required',
			'address' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$member->username = Input::get('name');
			$member->landline = Input::get('landline');
			$member->neutral = Input::get('neutral');
			$member->address = Input::get('address');
			$member->save();

			Session::flash('success', 'Member is successfully updated.');
			return Redirect::to('admin/member');
		} else {
			return Redirect::to('admin/member/'.$id.'/edit')->withErrors($validator)->withInput();
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
		User::destroy($id);
		Session::flash('success', 'Member is successfully deleted.');
		return Redirect::to('admin/member');
	}
	
	public function is_active()
	{
		$id = Input::get('id');
		$active = Input::get('active');

		if ( $active == 1 )
		{
			DB::table('users')
	           		->where('id', $id)
	           		->update(array('is_active' => 0));
		} else {
			DB::table('users')
	           		->where('id', $id)
	           		->update(array('is_active' => 1));
		}

            	Session::flash('success', 'Member is successfully edited.');
		return Redirect::to('admin/member');
	}

	public function report_pdf()
	{
		$members = User::where('role_id','!=',1)->orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($members) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.member.report_pdf',compact('members','date_format'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no member.');
			return Redirect::to('admin/member');
		}
	}
	
	public function report_excel()
	{
		$members = User::where('role_id','!=',1)->orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($members) != 0 )
		{
			$i = 1;
			foreach ( $members as $member )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $member->username;
            			$temp['email'] = $member->email;
            			if ( $member->phone != 0 )
            			{
            				$temp['phone'] = $member->phone;
            			} else {
            				$temp['phone'] = '-';
            			}
            			$temp['active'] = $member->is_active;
            			$temp['create'] = date($date_format, strtotime($member->created_at));
            			$result[] = $temp;
            		}

			$filename = "member_report.csv";

			$header = array(
				'No.','Name', 'Email', 'Phone', 'Is Active', 'Created Date'
			);

			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no member.');
			return Redirect::to('admin/member');
		}
	}


}
