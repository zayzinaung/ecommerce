<?php

class Email extends Eloquent {

	protected $table = 'email';

	public static $rules = array(
		'subject'	=>	'required',
		'content'	=>	'required'
  	);

          public static function get($name)
          {
                $data = DB::table('email')->where('name','=',$name)->first();
                return $data;
          }

    // public static function send_activate_mail($member,$mail_type,$user_msg=NULL)
    // {
    // 	$email_format =  Email::get($mail_type);
    // 	$message      =  $email_format->content;
    // 	$link         =  url('main/activate', $member->activate_code);

    // 	$message      =  str_replace('{USERNAME}',$member->client_name, $message);
    // 	$message      =  str_replace('{NEWLINE}','<br/>',$message);
    // 	$message      =  str_replace('{LINK}',$link,$message);

    //   	$url    = 'https://api.sendgrid.com/';
    //   	$user   = 'crystaltech';
    //   	$pass   = 'h@ppyl1fe';
    //   	$params = array(
    //     	'api_user'  => $user,
    //     	'api_key'   => $pass,
    //     	'to'        => $member->email,
    //     	'subject'   => $email_format->subject,
    //     	'html'      => $message,
    //     	'from'      => $email_format->from,
    //     );

    // 	$request =  $url.'api/mail.send.json';

    // 	$session = curl_init($request);
    // 	curl_setopt ($session, CURLOPT_POST, true);
    // 	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // 	curl_setopt ($session, CURLOPT_HEADER, false);
    // 	curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);
    // 	$response = curl_exec($session);
    // 	curl_close($session);
        
    // 	if($response) {
    //     	return true;
    // 	} else {
    //     	return false;
    //   	}
    // }

    // public static function send_member_forgot_mail($member,$mail_type,$password)
    // {
    // 	$email_format = Email::get($mail_type);
    // 	$message = $email_format->content; 
    // 	$link    = url('main/recover', $member->code);

    //    	$message = str_replace('{USERNAME}',$member->email, $message);
    //    	$message = str_replace('{PASSWORD}',$password, $message);
    //    	$message = str_replace('{NEWLINE}','<br/>',$message);
    //     $message = str_replace('{LINK}',$link,$message); 
              
    //     $url    = 'https://api.sendgrid.com/';
    //     $user   = 'crystaltech';
    //     $pass   = 'h@ppyl1fe';
    //     $params = array(
    //             	'api_user'  => $user,
    //             	'api_key'   => $pass,
    //             	'to'        => $member->email,
    //             	'subject'   => $email_format->subject,
    //             	'html'      => $message,
    //             	'from'      => $email_format->from,          
    //             );
    //     $request =  $url.'api/mail.send.json';

    //     $session = curl_init($request);
    //     curl_setopt ($session, CURLOPT_POST, true);
    //     curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    //     curl_setopt ($session, CURLOPT_HEADER, false);
    //     curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($session);
    //     curl_close($session);
                      
    //     if($response) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

}