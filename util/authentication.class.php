<?php
/*****author: Jason Wang*******/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/database.class.php');
class authentication{
	private $useremail;
	private $password;
	private $role="regular";
	private $status="baned";
	private $username="";
	private $userid ='';


	/**
     * Sanitize data
     * @param String the data to be sanitized
     * @return String the sanitized data
     */
	function sanitize($data){

		return real_escape_string($data);
	}

	/**
     * login verification 
     * @param email
     * @param password
     * @return none
     */
	function login($email, $passwordparam){
		ob_start();  //tempory turn on buffer
		session_start();
		$useremail = $email;
		$password = $passwordparam;
		$path = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
		/*if(!isset($this->post['email']) && $this->post['email']==''&&!isset($this->post['password']))*/
		$isAuthenticated = false;
		$isAutenticated = mysqldatabaserrs::verifyUser($email,authentication::encryptPass($password));
		if($isAutenticated != true){  //user not fould or authenticated, redirect
			
			header('Location: '.$path.'loing');
			echo $root;
		}
		else{
			/***verified,retrive user info, generate session id, save value***/
			/*******SELECT USER DATA FROM DB***/
			$userInfo = mysqldatabaserrs::getBasicUserInfo($email);
			/****check if user status*****/
			if($userInfo->getStatus()!='baned'){
				session_regenerate_id();
				$_SESSION['sess_user_id'] = $userInfo->getUserId();
				$_SESSION['sess_username'] = $userInfo->getUserName();
				$_SESSION['sess_useremail'] = $email;
				$userInfo->getUserName();
				session_write_close();
				header('Location: /RRS/');

			}
			else{
				header('Location: suspended.php');
			}
			
		}		
	}


	/**
     * encrypt password
     * @param password
     * @return encrypted password
     */
	function encryptPass($pass){
		return $encrptedPass = hash('sha256',$pass);
	}

}
?>