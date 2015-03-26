<!-- Vincent Tieu, Jinhai Wang created this page -->
<?php 
ob_start();
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include("include/header.php");
include($root.'model/reservation.php');
if(isset($_GET["delete"])){

  $reserv = new Reservation;
  $isdelted = $reserv->deleteReservation($_GET["id"]);
  header('Location: /RRS/account');
}



 ?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h2>Are you sure you want to cancel your reservation?</h2>
      <p>Please proceed by clicking cancel or closing the window if you don't wish to cancel your reservation...</p>
      <p><a class="btn btn-primary btn-lg" href ="cancel?delete=true<?php if(isset($_GET["id"])){echo "&id=".$_GET["id"]; } ?>">Cancel Reservation</a></p>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>
