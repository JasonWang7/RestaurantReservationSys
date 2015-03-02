<!--
    Author: Vince
-->
<?php 
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
require_once($root ."util/database.class.php");
require_once($root ."model/reservation.php");
require_once($root.'util/authentication.class.php');

$restaurantid = 1;
$userid = 1;
$numguest = $_POST['numguest'];
$note = $_POST['note'];
$invitationList = $_POST['invitationList'];
$dinningtime = $_POST['datetime'] . ' ' . $_POST['dinningtime'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$instance = new Reservation;
echo $instance->insertReservation($restaurantid, $userid, $numguest, $note, $invitationList, $dinningtime, $email, $phone);
  
?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h1>Your reservation was successfully booked.</h1>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>