<!--
    Author: Vince
-->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
include($root ."util/database.class.php");
include($root ."model/reservation.php");

$restaurantid = 1;
$userid = $_SESSION['sess_user_id'];
$numguest = $_POST['numguest'];
$note = $_POST['note'];
$invitationList = $_POST['invitationList'];
$dinningtime = $_POST['dinningtime'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$datetime = $_POST['datetime'];

echo insertReservation($restaurantid, $userid, $numguest, $note, $invitationList, $dinningtime, $datetime, $email, $phone)
?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h1>Your reservation was successfully booked.</h1>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>