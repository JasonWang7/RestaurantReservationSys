<?php 
	/******Author: Jinhai Wang*******/
	include("include/header.php");
	//check if user login, if user is from owner link
	if(isset($_POST["reservationid"])&& isset($_SESSION['sess_username'])&& strpos($_SERVER['HTTP_REFERER'],'manageaowner') !== false){
		ob_start();
		$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
		include_once($root.'model/attendance.php');
		include_once($root.'model/user.php');
		include_once($root.'model/reservation.php'); 
		$idParam = $_POST["reservationid"];
		$reasonParam='';
		if(isset($_POST['reason'])){
			$reasonParam= $_POST['reason'];
		}		
		$reservationObj = new Reservation;
		$isChanged = $reservationObj->rejectReservation($idParam,$reasonParam);

		$attendanceObj = new attendance;
		$attendanceObj = $attendanceObj->retriveAttendanceByReservationId($idParam);
		//check if it is not in attendance table, insert one
		if($attendanceObj!=null){
			$attendanceObjtemp = new attendance;			
			$isDeleted = $attendanceObjtemp->deleteAttendance($idParam);
		}
		//if($isChanged){
			echo '<div class="row">
			  <div class="col-12">  
			    <div class="jumbotron">
			      <h2>Reservation Rejected!</h2>
			      <p>Click on <a href="manageaowner">back</a> to owner panel.</p>
			    </div>
			  </div>
			</div>';	
		//}
		  	
		
	}
	include("include/footer.php");

?>


