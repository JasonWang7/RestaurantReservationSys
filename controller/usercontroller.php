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
	//set activation code based on email hash and time()
	$activation_code=md5($_POST["email"].time());
	$userObj->setActivationCode($activation_code);
	$result = $userObj->insertUser();
	if ($result == 1){
		$userInfo = user::selectBasicInfo($userObj->getUserEmail());
		//send activation email
		$to=$userObj->getUserEmail();
		$subject="Reserve4U Email verification";
		$body='Hi, <br/> <br/> You have registered accunt at Reserve4u. 
				Please verify your email and get started using your Website account. <br/> <br/> 
				<a href="'.'/localhost/RRS/verify/'.$activation_code.'">'.'/localhost/RRS/verify/'.$activation_code.'</a>';
		mail($to,$subject,$body);
		session_start();
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $userInfo->getUserId();
		$_SESSION['sess_username'] = $userInfo->getUserName();
		$_SESSION['sess_useremail'] = $userObj->getUserEmail();
		$userInfo->getUserName();
		session_write_close();
		//print($to.$subject.$body);
		header('Location: /RRS/success');	
	}
	else{
		header('Location: /RRS/register');	
	}







?>