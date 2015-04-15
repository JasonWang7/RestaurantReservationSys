<?php 
	/******Author: Jinhai Wang*******/
	include("include/header.php");
	//check if user login, if user is from owner link
	if(isset($_GET["id"])&& isset($_SESSION['sess_username'])&& strpos($_SERVER['HTTP_REFERER'],'manageaowner') !== false){
		ob_start();
		$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
		
		include($root.'model/user.php');
		include($root.'model/reservation.php'); 
		$idParam = $_GET["id"];
		$reasonParam='';
		
		$reservationObj = new Reservation;
		$isChanged = $reservationObj->acceptReservation($idParam,$reasonParam);
		//update to attendance table


		//if($isChanged){
			echo '<div class="row">
			  <div class="col-12">  
			    <div class="jumbotron">
			      <h2>Reservation Accepted!</h2>
			      <p>Click on <a href="manageaowner">back</a> to owner panel.</p>
			    </div>
			  </div>
			</div>';	
		//}
		  	
		
	}
	include("include/footer.php");

?>


