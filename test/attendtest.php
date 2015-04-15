<?php
/*****testing file for review****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
include($root."view/include/header.php"); 
require_once($root.'util/database.class.php');
require_once($root.'model/accountlog.php');
require_once($root.'model/attendance.php');
/****how to add review****/
date_default_timezone_set('America/Toronto');
/*******get user ip******/


echo 'session id'.$_SESSION['sess_user_id'];

$attendances = new attendance;
$attendances->setOwnerUserId($_SESSION['sess_user_id']);
echo '<pre>'.print_r($attendances, true).'</pre>'; 
//get owner id and select from view ownership_
$attendanceList = $attendances->retriveListAttendanceByownerId($attendances->getOwnerUserId(),0);
echo '<pre>'.print_r($attendanceList, true).'</pre>'; 
if($attendanceList>0){
	echo $attendances->renderView($attendanceList);
}
else{
	echo '<p>No attendance yet.</p>';
}


?>