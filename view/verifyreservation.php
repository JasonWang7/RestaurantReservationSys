<!--
    Author: Vince,jinhai wang
-->
<?php 
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
require_once($root ."util/database.class.php");
require_once($root ."model/reservation.php");
require_once($root.'util/authentication.class.php');
require_once($root.'model/invitationmail.php');
require_once($root.'model/user.php');
require_once($root.'model/restaurant.php');
$restaurantid = $_POST['restaurantid'];
$userid = $_SESSION['sess_user_id'];
$numguest = $_POST['numguest'];
$note = $_POST['note'];
$invitationList = $_POST['invitationList'];
$dinningtime = $_POST['datetime'] . ' ' . $_POST['dinningtime'].':00';
$email = $_POST['email'];
$phone = $_POST['phone'];
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
		$sendinvite = new invitationmail($instance,$userParam,$restaurantParam);
		$sendinvite->sendemail();
	}
}
?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h1>Your reservation was successfully booked.</h1>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>