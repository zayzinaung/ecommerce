<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static $add_rules = array(
		'name'		=> 'required',
		'username'	=> 'required|unique:users',
		'role_id'	=> 'required',
		'password'	=> 'min:6|required ',
		'passconf'	=> 'required|same:password' ,
		'email' 	=> 'required|unique:users|email'
	);

	public static function is_login()
	{
		if(Session::get('logged_in')) return TRUE;
		else return false;
	}
	
	public static function set_authnication($user_id)
	{
		$users = User::where('id','=',$user_id)->first();

		Session::put('user_id', $user_id);
		Session::put('logged_in', 1);
		Session::put('facebook_id', '');
		Session::put('name', $users->name);
		Session::put('username', $users->username);
		Session::put('email', $users->email);
		Session::put('role_id', $users->role_id);
		Session::put('lastVisitDate', time());
		Session::put('login_type', 'user');
	}

	public static function getPerm($role_id)
	{		
		$permissions = array();
		$perms = Permission::where('role_id','=',$role_id)->get();

		foreach($perms as $perm) {
			$permissions[$perm->permission] = static::assignPerm($perm->id);
		}
		return $permissions;
	}

	public static function assignPerm($perm_id)
	{
		$sub_perm_array = array();
		$sub_perms = DB::table('sub_permissions')->where('perm_id',$perm_id)->get();

		foreach($sub_perms as $sub_perm) {
			$sub_perm_array[$sub_perm->description] = true;
		}
		return $sub_perm_array;
	}

	public static function initRolePerm()
	{
		$roles = Role::all();
		$rolePermObj = array();
		foreach($roles as $role) {
			$rolePermObj[$role->description] = static::getPerm($role->id);
		}
		Session::put('rolePermObj',$rolePermObj);
	}

	public static function hasPermTo($module_name,$perm_name=NULL)
	{
		$role_id = Session::get('role_id');
		if ( $role_id == 1)
		{
			$rolePermObj = Session::get('rolePermObj');
			$cur_usr_desc = Role::where('id','=',$role_id)->pluck('description');
			$var['role_desc'] = $rolePermObj[$cur_usr_desc];
			foreach($var as $key => $module) {
	            		if($perm_name) {
	            			$perm_name = $perm_name.'_'.$module_name;
					return isset($module[$module_name][$perm_name]);
				} else {
					return isset($module[$module_name]);
				}
			}
		}
	}

	public static function roleHasPermTo($role,$perm_text,$module)
	{
		$perm_text = $perm_text.'_'.$module;
		$rolePermObj = Session::get('rolePermObj');
		$var['role_id'] = $rolePermObj[$role];
		foreach($var as $key => $perm) {
			echo (isset($perm[$module][$perm_text]))? 'checked':'';
		}
	}
	
	public static function process_sms_call($code, $mobile_number, $message)
	{
		$status = false;
		
		// builds the API URL to call
		$params = array(
		          'username' => 'TestAWH',
		          'password' => 'password',
		          'code'     => $code->calling_code,
		          'number'   => $mobile_number,
		          'msg'      => $message
		);
		
		$encoded_params = array();
		
		foreach ($params as $k => $v) {
		          $encoded_params[] = urlencode($k) . '=' . urlencode($v);
		}
		
		$message_send_url = 'http://69.64.74.216/my/api/sms-http.php?' . implode('&', $encoded_params);
		
		$ch = curl_init ($message_send_url);
        		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        		$message_send_response = curl_exec ($ch);
        		/*if (strlen($message_send_response) == 8) //if the message sent successfully
        		{
            		$status = true;
        		} else {
        			return $status;
        		}*/
        		return true;
	}
	
}
