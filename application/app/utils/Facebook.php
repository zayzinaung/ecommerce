<?php
namespace Utils;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use CustomFBRedirectLoginHelper;


class Facebook implements FacebookInterface
{
	public function __construct() 
	{
		$this->fbHelper = new CustomFBRedirectLoginHelper(route('login.fbCallback'));
	}

	public function getLoginUrl($scope = array())
	{
		return $this->fbHelper->getLoginUrl($scope);
	}
	
	public function checkLogin()
	{
		try {

			$session = $this->fbHelper->getSessionFromRedirect();
			
		} catch(FacebookRequestException $ex) {
		  // When Facebook returns an error
			return false;

		} catch(\Exception $ex) {
		  // When validation fails or other local issues
			return false;
		}

		if ($session) {
		 	
		 	echo 'Login Successful !!<br />'; 
		 	return $this->getUserInfo($session);
		}

		return false;
	}
	
	public function getUserInfo($session)
	{
		try {

			$userProfile = (new FacebookRequest(
	      		$session, 'GET', '/me?fields=id,name,email,gender,hometown,picture'
	    	))->execute()->getGraphObject(GraphUser::className());

	    	return $userProfile;

  		} catch(FacebookRequestException $e) {

    		echo "Exception occured, code: " . $e->getCode();
    		echo " with message: " . $e->getMessage();
    		return false;
  		}   
	}

}