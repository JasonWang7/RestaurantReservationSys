<?php 
	/*******Author: Jason*****/
	include_once($root.'model/attendance.php');
	
	if(isset($_SESSION['sess_user_id'])){
		
		$attendances = new attendance;
		$attendances->setOwnerUserId($_SESSION['sess_user_id']);
		//get owner id and select from view ownership_
		$attendanceList = $attendances->retriveListAttendanceByownerId($attendances->getOwnerUserId(),0);
		if($attendanceList>0){
			echo $attendances->renderView($attendanceList);
		}
		else{
			echo '<p>No attendance yet.</p>';
		}
		
	}
	else{
		echo '<p>No attendance yet.</p>';
	}
	

 ?>  