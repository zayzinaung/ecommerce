<?php 
namespace Utils;

interface FacebookInterface {
	public function getLoginUrl($scope);
	public function checkLogin();
	public function getUserInfo($session);
}

?>
