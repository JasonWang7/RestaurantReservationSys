<?php
/**
 * login controler
 * @author Jinhai Wang
 * Date: Feb 27, 2015
 */
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'config.php'); 
require_once($root.'util/authentication.class.php');
$useremailval = $_POST["email"];	
$passwordval = $_POST["password"];
echo 'something';
authentication::login($useremailval,$passwordval); 


?>