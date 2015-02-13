<?php
require_once('../models/user.php');
$userObj = new user;
$userObj->setUserEmail($_POST["email"]);	
$userObj->setFirstName($_POST["firstname"]);	
$userObj->setLastName($_POST["lastname"]);			
$userObj->setPassword($_POST["pass1"]);		
$userObj->setPhone($_POST["phone"]);				
$userObj->setAddress($_POST["address"]);		
$userObj->setPostcode($_POST["postcode"]);				
$userObj->setCity($_POST["city"]);	
$userObj->setRole($_POST["role"]);			
$userObj->setLikes($_POST["likes"]);	
$userObj->setUserName($_POST["username"]);
$result = $userObj->insertUser();
if($result == true)
{
	echo 'successfully created account!'; 
}

?>