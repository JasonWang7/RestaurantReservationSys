<?php 
	/******Author: Jinhai Wang*******/
	ob_start();
	include("include/header.php");
	//check if user login, if user is from owner link
	if(isset($_GET["id"])&&isset($_GET["action"])&&isset($_GET["userid"])&&isset($_GET["restid"])&& isset($_SESSION['sess_username'])&& strpos($_SERVER['HTTP_REFERER'],'manageaowner') !== false){
		
		$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
		
		include_once($root.'model/user.php');
		include_once($root.'model/reservation.php'); 
		include_once($root.'model/transaction.php'); 
		include_once($root.'model/attendance.php'); 
		$idParam = $_GET["id"];
		$reasonParam='';
		$actionParam=$_GET["action"];
		$restid = $_GET["restid"];
		$useridParam = $_GET["userid"];
		
		$attendanceObj = new attendance;
		$attendanceObj = $attendanceObj->retriveAttendanceByReservationId($idParam);
		//echo '<pre>'.print_r($attendanceObj, true).'</pre>'; 
		//check the status if is attended, attend do nothing
		//if it is attend, miss -reward point -$4 charge
		//if it is attend, N/A -reward point 

		//if it is N/A, attend +point
		//if it is N/A, miss - $4 charge
		//if it is N/A, do nothing

		//if it is missed, attend +reward point +$4 refund
		//if it is missed, miss do nothing
		//if it is missed, N/A +$4 refund
		if($attendanceObj!=null){

			$transactionObj = new transaction;
			$transactionObj->setRestaurantId($restid );
			$transactionObj->setReservationId($idParam);
			$transactionObj->setUserId($useridParam);
			
			$descrtiptionParam ="";
			$amount=0;
			$point =0;
			$statusParam='N/A';
			if($attendanceObj->getAttendanceStatus()=='N/A'&&$actionParam=='Attend'){
				$point=200;
				$statusParam='Attended';
			}
			else if($attendanceObj->getAttendanceStatus()=='N/A'&&$actionParam=='Miss'){
				$amount=-4; //charge
				$descrtiptionParam="Charged for missing reservation.";
				$statusParam='Missed';
			}
			else if($attendanceObj->getAttendanceStatus()=='Attended'&&$actionParam=='Miss'){
				$point =-200;
				$amount=-4; //charge
				$descrtiptionParam="Owner changed Attend to Missed. Charged for missing reservation.";
				$statusParam='Missed';
			}
			else if($attendanceObj->getAttendanceStatus()=='Attended'&&$actionParam=='NA'){
				$point =-200;
				$statusParam='N/A';
			}
			else if($attendanceObj->getAttendanceStatus()=='Missed'&&$actionParam=='Attend'){
				$point =200;
				$amount=4;  //refund
				$descrtiptionParam="Owner changed Missed to Attend. Refund previous charged amount.";
				$statusParam='Attended';
			}
			else if($attendanceObj->getAttendanceStatus()=='Missed'&&$actionParam=='NA'){
				$amount=4;  //refund
				$descrtiptionParam="Owner changed Missed to N/A. Refund previous charged amount.";
				$statusParam='N/A';
			}
			
			$noUpdate = false;
			if($attendanceObj->getAttendanceStatus()=='Attended'&&$actionParam=='Attend'){
				$noUpdate = true;
			}
			else if($attendanceObj->getAttendanceStatus()=='Missed'&&$actionParam=='Miss'){
				$noUpdate = true;
			}
			else if($attendanceObj->getAttendanceStatus()=='N/A'&&$actionParam=='NA'){
				$noUpdate = true;
			}
			if($noUpdate==false ){
				if($amount!=0){
					$isChanged = $transactionObj->insertTransction($amount,$descrtiptionParam);
				}
				
				//update attendance status
				$attendanceObj->updateAttendance($statusParam);
			}
			header('Location: /RRS/manageaowner');
		}
		//check the status if is attended, attend do nothing
		//if it is attend, miss -reward point +$4
		//if it is attend, N/A -reward point 

		//if it is N/A, attend +point
		//if it is N/A, miss + $4
		//if it is N/A, do nothing

		//if it is missed, attend +reward point -$4
		//if it is missed, miss do nothing
		//if it is missed, N/A +$4

	


		//if($isChanged){
			
		//}
		  	
		
	}
	include("include/footer.php");

?>


