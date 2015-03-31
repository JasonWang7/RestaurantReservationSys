<?php 
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
 
require_once($root ."util/database.class.php");
require_once($root ."model/reservation.php");
require_once($root.'util/authentication.class.php');
require_once($root.'model/invitationmail.php');
require_once($root.'model/user.php');
require_once($root.'model/restaurant.php');
$restaurantid = 1;
$userid = 65;
$numguest = 55;
$note = "Test send invitation";
$invitationList = "wangjinhaifirst@hotmail.com;jinhai@mail.uoguelph.ca";
$dinningtime = '12/03/2015 12:00:00';
$email ="wangjinhaifirst@hotmail.com";
$phone = "1234";
$instance = new Reservation;
//echo $restaurantid.$userid.$numguest.$note.$invitationList.$dinningtime.$email.$phone;
$isReserved = $instance->insertReservation($restaurantid, $userid, $numguest, $note, $invitationList, $dinningtime,$email, $phone);
if($isReserved){
	//send invitation 
	if( $invitationList!=""&&strpos($invitationList, '@')!=false){
		//pass $reserveParam,$userParam,$restaurantParam
		$userParam = new user;
		$restaurantParam = new restaurant;
		$restaurantParam =$restaurantParam->selectRestaurantInfoById($restaurantid);
		$userParam = $userParam->selectUserInfo($email);
		echo '<pre>'.print_r($userParam, true).'</pre>'; 
		echo '<pre>'.print_r($restaurantParam, true).'</pre>'; 
		
		$sendinvite = new invitationmail($instance,$userParam,$restaurantParam);
		echo 'there';
		$sendinvite->sendemail();
	}
}




?>