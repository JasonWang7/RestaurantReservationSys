<?php
/*****jinhai Wang****/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'model/user.php');
require_once($root.'model/accountlog.php');


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
		$body='Hi'.$userObj->getUserName().', <br/> <br/> You have registered accunt at Reserve4u. 
				Please verify your email and get started using your Website account. <br/> <br/> 
				<a href="'.'http://localhost/RRS/verify/'.$activation_code.'">'.'/localhost/RRS/verify/'.$activation_code.'</a>';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: reserve4u110@gmail.com' . "\r\n";
		mail($to,$subject,$body,$headers);
		session_start();
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $userInfo->getUserId();
		$_SESSION['sess_username'] = $userInfo->getUserName();
		$_SESSION['sess_useremail'] = $userObj->getUserEmail();
		$userInfo->getUserName();
		session_write_close();
		//log user activity
		/*******get user ip******/
		$ip=$_SERVER['REMOTE_ADDR'];
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {               // check ip from share internet
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   // to check ip is pass from proxy
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		$ips = explode(",", $ip);
		$usrIp = $ips[0];
		//create log class
		$newlog = new accountlog;
		$newlog->setActivity("Signed Up");
		$newlog->setClientIp($usrIp);
		$newlog->setUserId($_SESSION['sess_user_id']);
		$newlog->insertActivity();
		
		header('Location: /RRS/success');	
	}
	else{
		header('Location: /RRS/register');	
	}







?>