<?php

use Carbon\Carbon;

class GeneralController extends BaseController {
	
	public function __construct()
	{
		parent::__construct();
		define('MODULE',"general");
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$theme = General_setting::where('type','=','theme')->first();
		$get_format = General_setting::where('type','=','date_format')->first();
		$date_format = Common::get_date();
		$cpf = DB::table('cpf_setting')->get();
		$receipt = Other_setting::where('type','=','receipt')->first();
		$invoice = Other_setting::where('type','=','invoice')->first();
		return View::make('backend.admin.general.index',compact('theme','get_format','date_format','cpf','receipt','invoice'));
	}
	
	public function postSave($id)
	{
		$general = General_setting::find($id);
		$general->format = Input::get('theme');
		$general->save();
		
		Session::flash('success', 'General setting is successfully updated.');
		return Redirect::to('admin/general');
	}
	
	public function date_format()
	{
		$date = Input::get('date_format');

            	$date_format = General_setting::where('type','=','date_format')->first();
            	$date_format->format = $date;
            	$date_format->save();
            	return Redirect::to('admin/general');
	}
	
	public function change_timezone()
	{
		$time = Input::get('timezone');
		$timezone = General_setting::where('type','=','timezone')->first();
		$timezone->format = $time;
            	$timezone->save();
            	return Redirect::to('admin/general');
	}
	
	public function change_prefix()
	{
		$get_prefix = Input::get('prefix');
		$prefix = General_setting::where('type','=','prefix')->first();
		$prefix->format = $get_prefix;
            	$prefix->save();
            	return Redirect::to('admin/general');
	}
	
	public function change_email()
	{
		$from_email = Input::get('from_email');
		$to_email = Input::get('to_email');
		$getfrom_email = General_setting::where('type','=','from_email')->first();
		$getfrom_email->format = $from_email;
            	$getfrom_email->save();
            	$getto_email = General_setting::where('type','=','to_email')->first();
		$getto_email->format = $to_email;
            	$getto_email->save();
            	return Redirect::to('admin/general');
	}
	
	public function change_information()
	{
		$tab = Input::get('tab');
		
		$rules = array(
			'phone' => 'required',
			'email' => 'required',
			'address' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);
		
		if( $validator->fails() ) {
			return Redirect::to('admin/general#'.$tab)
				->withErrors($validator)
				->withInput();
		}
		
		$data = array('phone'=>Input::get('phone'), 'email'=>Input::get('email'), 'address'=>Input::get('address'), 'fax'=>Input::get('fax'), 'landline'=>Input::get('landline'));
		$company_info = General_setting::where('type','=','company_info')->first();
		$company_info->format = serialize($data);
		$company_info->save();
		
		Session::flash('success', 'Company Info is successfully updated.');
		return Redirect::to('admin/general#'.$tab);
	}
	
	public function update_cpf_setting()
	{
		return Response::json(General_setting::update_cpf_setting(),200);
	}

	public function change_currency()
	{
		$get_currency = Input::get('currency');
		$currency = General_setting::where('type','=','currency')->first();
		$currency->format = $get_currency;
		if ( $get_currency == 'GBP' )
		{
			$currency->symbol = '£';
		} elseif ( $get_currency == 'EUR' ) {
			$currency->symbol = '€';
		} elseif ( $get_currency == 'MYR' ) {
			$currency->symbol = 'RM';
		} elseif ( $get_currency == 'MMK' ) {
			$currency->symbol = 'Ks';
		} elseif ( $get_currency == 'SGD' ) {
			$currency->symbol = 'S$';
		} elseif ( $get_currency == 'THB' ) {
			$currency->symbol = '฿';
		} else {
			$currency->symbol = '$';
		}
            	$currency->save();
            	return Redirect::to('admin/general');
	}

	public function update_info()
	{
		$receipt = Other_setting::find(Input::get('id'));
		
		$address = Input::get('address');
		$phone = Input::get('phone');
		$description = Input::get('description');
		$position = Input::get('position');
		$name = Input::get('name');
		$file = Input::file('signfile');

		$receipt->address = $address;
		$receipt->phone = $phone;
		$receipt->description = $description;
		$receipt->position = $position;
		$receipt->name = $name;

		if(!is_null($file[0])){
			if ( $receipt->sign != null )
			{
				unlink('uploads/sign/'.$receipt->sign);
			}
			$image_files = array();
			$image_files = parent::common_upload_picture(Input::file('signfile'), 'uploads/sign');
				
			for ($i=0; $i < count($image_files); $i++) {
				$receipt->sign = $image_files[$i]['imagename'];
			}
		}
		$receipt->save();

		return Redirect::to('admin/general');
	}
	
	public function change_login_attempt()
	{
		
	}
	
}

?>