<?php

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class CustomFBRedirectLoginHelper extends FacebookRedirectLoginHelper
{
	public function __construct()
	{
		$config = Config::get('facebook');
		FacebookSession::setDefaultApplication($config['appId'], $config['secret']);

		parent::__construct(route('login.fbCallback'));
	}

	protected function storeState($state)
	{
		Session::put('facebook.state', $state);		
	}

	protected function loadState()
	{
		return $this->state = Session::get('facebook.state');
	}	
}