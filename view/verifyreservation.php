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
$userid = $_SESSION['sess_user_id'];
$numguest = $_POST['numguest'];
$note = $_POST['note'];
$invitationList = $_POST['invitationList'];
$dinningtime = $_POST['datetime'] . ' ' . $_POST['dinningtime'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$instance = new Reservation;
//echo $restaurantid.$userid.$numguest.$note.$invitationList.$dinningtime.$email.$phone;
$instance->insertReservation($restaurantid, $userid, $numguest, $note, $invitationList, $dinningtime,$email, $phone);
?>
