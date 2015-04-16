<?php 
	/******Author: Jinhai Wang*******/
	$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
	include("include/header.php");
	include_once($root.'model/attendance.php');
	//check if user login, if user is from owner link
	if(isset($_GET["id"])&&isset($_GET["rid"])&&isset($_GET["userid"])&& isset($_SESSION['sess_username'])&& strpos($_SERVER['HTTP_REFERER'],'manageaowner') !== false){
		ob_start();
		
		
		include_once($root.'model/user.php');
		include_once($root.'model/reservation.php'); 
		$idParam = $_GET["id"];
		$reasonParam='';
		
		$reservationObj = new Reservation;
		$isChanged = $reservationObj->acceptReservation($idParam,$reasonParam);
		//update to attendance table
		$attendanceObj = new attendance;
		
		$attendanceObj = $attendanceObj->retriveAttendanceByReservationId($idParam);
		//check if it is not in attendance table, insert one
		if($attendanceObj==null){
			$attendanceObjtemp = new attendance;
			$attendanceObjtemp->setReservationId($idParam);
			$attendanceObjtemp->setUserId($_GET["userid"]);
			$attendanceObjtemp->setRestaurantId($_GET["rid"]);
			
			if(!isset($_GET["eventid"])){
				$attendanceObjtemp->setEventid(null);
			}
			else{
				$attendanceObjtemp->setEventid($_GET["eventid"]);
			}
			
			$attendanceObjtemp->insertAttendance();

		}
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


