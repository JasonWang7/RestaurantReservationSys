<?php
/*****jinhai Wang****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'model/user.php');

	$userObj = new user;	
	$userObj->setUserEmail($_POST["email"]);	
	$userObj->setFirstName($_POST["firstname"]);	
	$userObj->setLastName($_POST["lastname"]);			
	$userObj->setPassword($_POST["pass1"]);					
	$userObj->setCity($_POST["city"]);		
	$userObj->setUserName($_POST["username"]);
	$result = $userObj->insertUser();
	if ($result == 1){
		$userInfo = user::selectBasicInfo($userObj->getUserEmail());
		session_start();
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $userInfo->getUserId();
		$_SESSION['sess_username'] = $userInfo->getUserName();
		$_SESSION['sess_useremail'] = $userObj->getUserEmail();
		$userInfo->getUserName();
		session_write_close();
		header('Location: /RRS/');	
	}
	else{
		header('Location: /RRS/register');	
	}







?>