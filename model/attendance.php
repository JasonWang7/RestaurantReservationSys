<?php
/******author: Jason Wang*****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
require_once($root.'model/reservation.php');
require_once($root.'model/user.php');
require_once($root.'model/restaurant.php');
class attendance{
	private $reservationid;
	private $userId;
	private $attendancestatus;
	private $eventid;
	private $restaurantid;
	private $updatetime;
 	private $reservationObj;
 	private $userObj;
 	private $restaurantObj;
 	private $owneruserid;
	
	function insertAttendance(){
		$auth = new mysqldatabaserrs;
		date_default_timezone_set('America/Toronto'); 
		$attStatusVal ='N/A';
		$dbconn = $auth->connectdb();
		$query = 'INSERT INTO `eventattandance`(`reservationid`, `userId`, `restaurantid`,`attendancestatus`, `eventid`)
				 VALUES (:reservationid,:userId,:restaurantid,:attendancestatus,:eventid)';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':reservationid',$this->getReservationId());
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->bindValue(':restaurantid',$this->getRestaurantId());
		$stmt->bindValue(':attendancestatus',$attStatusVal);
		$stmt->bindValue(':eventid',$this->getEventid());
		$stmt->execute();
		
		$affectedRowCount = $stmt->rowCount();		
		$auth->closeconnection($dbconn);
		if($affectedRowCount>0){
			$this->setAttendanceStatus($attStatusVal);
			return true;
		}
		else{
			return false;
		}
	}

	/**
	* update attendacne
	* @param usrid
	* @return true or false
	*/
	function updateAttendance($statusParam)
	{
		$affectedRowCount=0;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'UPDATE `eventattandance` SET `attendancestatus`=:attendancestatus WHERE `reservationid`=:reservationid and`userId`=:userId;';
		$stmt = $dbconn->prepare($query);
		/*bind values to escape*/
		$stmt->bindValue(':attendancestatus', $statusParam);
		$stmt->bindValue(':reservationid', $this->getReservationId());
		$stmt->bindValue(':userId', $this->getUserId());
		$result = $stmt->execute();
		$affectedRowCount = $stmt->rowCount();
		$auth->closeconnection($dbconn);

		if($affectedRowCount>0){
		  $this->setAttendanceStatus($statusParam);
		  return true;
		}
		else{
		  return false;
		}
		return $result;
	}

	/**
	* delete attendacne
	* @param reservation id
	* @return true or false
	*/
	function deleteAttendance($reservationidParam)
	{
		$affectedRowCount=0;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'DELETE from `eventattandance` WHERE `reservationid`=:reservationid;';
		$stmt = $dbconn->prepare($query);
		/*bind values to escape*/
		
		$stmt->bindValue(':reservationid', $reservationidParam);
		
		$result = $stmt->execute();
		$affectedRowCount = $stmt->rowCount();
		$auth->closeconnection($dbconn);

		if($affectedRowCount>0){
		  $this->setAttendanceStatus($statusParam);
		  return true;
		}
		else{
		  return false;
		}
		return $result;
	}
	/***select attendance by reservation id and user id***/
	function retriveAttendanceById($reservationIdParam,$useIdParam){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  * FROM `eventattandance` where reservationid=:reservationid and userId=:userId;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':reservationid', $reservationIdParam, PDO::PARAM_INT);    
		$stmt->bindParam(':userId', $useIdParam, PDO::PARAM_INT);    
		$stmt->execute();

		$attendanceObj= new attendance;
		$attendanceObj = $stmt->fetchObject('attendance');

		$auth->closeconnection($dbconn);
		return $attendanceObj;
	}

	/***select attendance by reservation id ***/
	function retriveAttendanceByReservationId($idParam){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  * FROM `eventattandance` where reservationid=:reservationid;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':reservationid', $idParam, PDO::PARAM_INT);    
		$stmt->execute();
		$numRow = 0;
		$numRow =  $stmt->rowCount();
		if($numRow>0){
			$attendanceObj= new attendance;
			$attendanceObj = $stmt->fetchObject('attendance');
		}
		else{
			$attendanceObj = null;
		}

		$auth->closeconnection($dbconn);
		return $attendanceObj;
	}

	function retriveListAttendanceByrestaurantId($offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `eventattandance` where restaurantid=:restaurantid order by `updatetime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);	
		$stmt->bindParam(':restaurantid', $this->getRestaurantId(), PDO::PARAM_INT);				
		$stmt->execute();

		$attendanceObj= new attendance;
		$attendanceList = array();
		while($attendanceObj = $stmt->fetchObject('attendance')){
			array_push($attendanceList,$attendanceObj);
		}
		$auth->closeconnection($dbconn);
		return $attendanceList;
	}

	function retriveListAttendanceByownerId($ownerIdParam,$offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `view_owner_ownership_attendance` where owneruserid=:ownerIdParam order by `updatetime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);	
		$stmt->bindParam(':ownerIdParam', $ownerIdParam, PDO::PARAM_INT);				
		$stmt->execute();

		$attendanceObj= new attendance;
		$attendanceList = array();
		while($attendanceObj = $stmt->fetchObject('attendance')){
			array_push($attendanceList,$attendanceObj);
		}
		$auth->closeconnection($dbconn);
		return $attendanceList;
	}

	function retriveListAttendance($offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `eventattandance` where userid=:userid order by `updatetime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);	
		$stmt->bindParam(':userid', $this->getUserId(), PDO::PARAM_INT);				
		$stmt->execute();

		$attendanceObj= new accountlog;
		$attendanceList = array();
		while($attendanceObj = $stmt->fetchObject('attendance')){
			array_push($attendanceList,$attendanceObj);
		}
		$auth->closeconnection($dbconn);
		return $attendanceList;
	}
	
	function renderView($attendanceList){
		$renderedview='';
		$tablebody='';
		if(count($attendanceList)<1){
			$renderedview = 'No Attendance to Display';
			return $renderedview;
		}

		$tablebegin= '<p>Note: Button will be inactive 6 hours after reservation time. Customer will be be charged $4 if he is marked as Missed.</p>
					<table class="table table-striped table-hover ">
		              <thead>
		                <tr>
		                  <th>Reservation #</th>
		                  <th>Restaurant</th>
		                  <th>Event</th>
		                  <th>Reservation Time</th>
		                  <th>Customer Name</th>
		                  <th>Attendance Status</th>
		                  <th>View</th>
		                  <th></th>
		                </tr>
		              </thead>
		              <tbody>';
		foreach($attendanceList as $att){


          	//get reservation
          	$reservationVal = new reservation;
          	$reservationVal = $reservationVal->retriveReservationById($att->getReservationId());
          	$att->setReservationObj($reservationVal);
          	//get restaurant
          	$restaurantVal = new restaurant;
          	$restaurantVal = $restaurantVal->selectRestaurantInfoById($att->getRestaurantId());
          	$att->setRestaurantObj($restaurantVal);
          	//get user
          	$userVal = new user;
          	$userVal = $userVal->selectUserInfoByUserId($att->getUserId());
          	$att->setUserObj($userVal);
          	//$event
          	$eventName ='';
          
			$dd = date_create_from_format('Y-m-d H:i:s', $att->getReservationObj()->getDinningTime());
			$dtime = date_format($dd,'d/m/Y H:i:s');
			if($att->getAttendanceStatus()=="Attended"){
			  
			  $statusval='<td>'.'<span class="glyphicon glyphicon-ok"></span> '. $att->getAttendanceStatus().'</td>';
			}
			else{
			  
			  if($att->getAttendanceStatus()=="Missed"){
			    $statusval='<td>'.'<span class="glyphicon glyphicon-eye-open"></span> '.$att->getAttendanceStatus() .'</td>';
			  }
			  else{
			    $statusval='<td>'. $att->getAttendanceStatus() .'</td>';
			  }
			}
			date_default_timezone_set('America/Toronto'); 

			$dt = new DateTime();
			$dt->add(new DateInterval('PT6H'));
			
			//check if datetime expired by offset 6 hours

			if($dd>$dt ){
			  $actionbtn='<div class="btn-group">
			          <a class="btn btn-success" href="attend?action=Attend&id='.$att->getReservationId().'&restid='.$att->getRestaurantId().
			          '&userid='.$att->getUserId().'" >Attended</a>
			          <a class="btn btn-default" href="attend?action=NA&id='.$att->getReservationId().'&restid='.$att->getRestaurantId().
			          '&userid='.$att->getUserId().'" >N/A</a>
			          <a class="btn btn-primary" href="attend?action=Miss&id='.$att->getReservationId().'&restid='.$att->getRestaurantId().
			          '&userid='.$att->getUserId().'" >Missed</a>
			        </div>';
			}
			else if($dd<$dt ){
			  $actionbtn='<div class="btn-group">
			          <a class="btn btn-success disabled" href="attend?id='.$att->getReservationId().'" >Attended</a>
			          <a class="btn btn-default disabled" href="attend?id='.$att->getReservationId().'" >N/A</a>
			          <a class="btn btn-primary disabled" href="attend?id='.$att->getReservationId().'" >Missed</a>
			        </div>';  
			}

			$tablebody =$tablebody. '<tr>' . '<td>' . $att->getReservationId() . '</td><td><a href="profile?id=' . $att->getRestaurantId() . '">'.$att->getRestaurantObj()->getRestaurantName().'</td>'.
			'<td>'.$eventName.'</td>'.
			'<td>' .$dtime. "</td>".
			'<td>'.$att->getUserObj()->getFirstName().' '.$att->getUserObj()->getLastName() .'</td>'.
			"<td>" . $att->getAttendanceStatus() .
			'</td>'.
			'<td><a class="btn btn-info" href="#"  data-toggle="modal" data-target="#viewttendancereservationmodal'.$att->getReservationId().'">View</a></td>'.
			'<td>'.$actionbtn.'</td>'.'</tr>';
			$tablebody =$tablebody.  '</a>';

			$tablebody =$tablebody. '
			<div class="modal fade" id="viewttendancereservationmodal'.$att->getReservationId().'" tabindex="-1" role="dialog" aria-labelledby="viewttendancereservationmodal'.$att->getReservationId().'" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4 class="modal-title" id="label">Reservation at ' . $att->getRestaurantObj()->getRestaurantName().'</h4>
			  </div>
			  <div class="modal-body">
			    <div class="row">
			      <form id="booktable" name="booktable" ACTION="modifyreservation" METHOD=post>
			                        
			      <div class="col-md-4">
			        <h3>Date: </h3><input  type="text" value="'. explode(" ", $dtime)[0] .'" name="datetime" id="datepicker1" disabled>
			      </div>
			      <div class="col-md-4">
			        <h3>Time:</h3><input type="text" value="'.explode(" ", $dtime)[1] .'" name="dinningtime" disabled>
			        
			      </div>
			      <div class="col-md-4">
			        <h3># of Guests: </h3><input type="text" name="numguest" value="'. $att->getReservationObj()->getNumGuest().'" disabled>
			      </div>
			    </div>
			    <div class="row">
			      <div class="col-md-12">
			        <h3>Special Request / Note:</h3>
			        <textarea name="note" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="" disabled>'.$att->getReservationObj()->getNote().'</textarea>
			      </div>
			    </div>
			    <div class="row">
			      <div class="col-md-12">
			        <h3>Phone Number:</h3><input type="text" name="phone" value="'.$att->getReservationObj()->getPhone().'" disabled>
			      </div>
			    </div>
			    <div class="row">
			      <div class="col-md-12">
			        <h3>Email Address:</h3>    <input type="text" name="email" value="'.$att->getReservationObj()->getEmail().'" disabled>  
			      </div>
			    </div>
			    
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			  </form>
			</div>
			</div>
			</div>
			';
			
		}
		
        $tableendtag = '</tbody>
            			</table>';
  		$renderedview=$tablebegin.$tablebody.$tableendtag;
		return $renderedview;

	}
	/*********************getter ********************/
	function getReservationId(){
		return $this->reservationid;		
	}
	function getUserId(){
		return $this->userId;		
	}
	function getAttendanceStatus(){
		return $this->attendancestatus;		
	}
	function getEventid(){
		return $this->eventid;		
	}
	function getUpdatetime(){
		return $this->updatetime;		
	}
	function getRestaurantId(){
		return $this->restaurantid;		
	}
	function getReservationObj(){
		return $this->reservationObj;		
	}
	function getUserObj(){
		return $this->userObj;		
	}
	function getRestaurantObj(){
		return $this->restaurantObj;		
	}
	function getOwnerUserId(){
		return $this->owneruserid;		
	}
	
	/*********************setter ********************/
	function setReservationId($param){
		$this->reservationid= $param;		
	}
	function setUserId($param){
		$this->userId= $param;	
	}
	function setAttendanceStatus($param){
		$this->attendancestatus= $param;	
	}
	function setEventid($param){
		$this->eventid= $param;		
	}
	function setUpdatetime($param){
		$this->updatetime= $param;	
	}
	function setRestaurantId($param){
		$this->restaurantid = $param;			
	}
	function setReservationObj($param){
		$this->reservationObj = $param;			
	}
	function setUserObj($param){
		$this->userObj = $param;		
	}
	function setRestaurantObj($param){
		$this->restaurantObj = $param;		
	}
	function setOwnerUserId($param){
		$this->owneruserid = $param;	
	}
}

?>