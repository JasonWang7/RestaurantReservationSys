<?php
/**
 * user controller that calls user model to create user account
 * @author Jinhai Wang
 * Date: Feb 25, 2015
 */
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
	
	header("Location: /RRS/success");

?>