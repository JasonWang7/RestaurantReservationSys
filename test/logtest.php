<?php
/*****testing file for review****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
include($root."view/include/header.php"); 
require_once($root.'util/database.class.php');
require_once($root.'model/accountlog.php');
/****how to add review****/
date_default_timezone_set('America/Toronto');
/*******get user ip******/
$ip=$_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {               // check ip from share internet
	$ip=$_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   // to check ip is pass from proxy
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
$ips = explode(",", $ip);
$usrIp = $ips[0];


echo 'session id'.$_SESSION['sess_user_id'];
$newlog = new accountlog;

$newlog->setActivity("Signed Up");
$newlog->setClientIp($usrIp);
$newlog->setUserId($_SESSION['sess_user_id']);
$newlog->insertActivity();
echo '<pre>'.print_r($newlog, true).'</pre>'; 
$loglist = $newlog->retriveListActivity(0);
echo '<pre>'.print_r($loglist, true).'</pre>'; 



?>