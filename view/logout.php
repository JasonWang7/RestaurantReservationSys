<?php 
/****jinhai wang****/
require_once($root.'model/accountlog.php');
session_start();
if (isset($_SESSION['sess_username'])) {
	//log user activity
	//create log class				
	$newlog = new accountlog;
	$userIP = $newlog->getIpAddress();
	$newlog->setActivity("Logged Out");
	$newlog->setClientIp($userIP);
	$newlog->setUserId($_SESSION['sess_user_id']);
	$newlog->insertActivity();
   	session_destroy();
   	header('Location: /RRS/');
} 
 ?>