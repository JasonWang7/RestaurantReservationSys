<?php
/******author: Jason Wang*****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
require_once($root.'model/reservation.php');
require_once($root.'model/user.php');
require_once($root.'model/restaurant.php');
class event{
	private $restaurantid;
	private $userId;   //as owneruserid who created
	private $eventid;
	private $eventname;
	private $eventdiscription;
 	private $eventpictureurl;
 	private $eventtime;
 	private $eventendtime;
	
	
	function insertEvent(){
		$auth = new mysqldatabaserrs;
		date_default_timezone_set('America/Toronto'); 
		$attStatusVal ='N/A';
		$dbconn = $auth->connectdb();
		//convert to date string
	    $date =date_create_from_format('d/m/Y H:i:s', $this->getEventTime());
	    $startdate = date_format($date,'Y-m-d H:i:s');
	    $date =date_create_from_format('d/m/Y H:i:s', $this->getEventEndTime());
	    $enddate = date_format($date,'Y-m-d H:i:s');

		$query = 'INSERT INTO `events`(`restaurantid`, `userId`, `eventname`,`eventdiscription`, `eventpictureurl`,`eventtime`,`eventendtime`)
				 VALUES (:restaurantid,:userId,:eventname,:eventdiscription,:eventpictureurl,:eventtime,:eventendtime)';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':restaurantid',$this->getRestaurantId());
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->bindValue(':eventname',$this->getEventName());
		$stmt->bindValue(':eventdiscription',$this->getEventDiscription());
		$stmt->bindValue(':eventpictureurl',$this->getEventPictureUrl());
		$stmt->bindValue(':eventtime',$startdate);
		$stmt->bindValue(':eventendtime',$enddate);
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
	function updateEvent($eventObjParam)
	{
		$affectedRowCount=0;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'UPDATE `events` SET `eventname`=:eventname,`eventdiscription`=:eventdiscription,`eventpictureurl`=:eventpictureurl,`eventtime`=:eventtime,`eventendtime`=:eventendtime WHERE `eventid`=:eventid;';
		$stmt = $dbconn->prepare($query);
		/*bind values to escape*/
		
		$stmt->bindValue(':eventname', $eventObjParam->getEventName());
		$stmt->bindValue(':eventdiscription', $eventObjParam->getEventDiscription());
		$stmt->bindValue(':eventpictureurl', $eventObjParam->getEventPictureUrl());
		$stmt->bindValue(':eventtime', $eventObjParam->getEventTime());
		$stmt->bindValue(':eventendtime', $eventObjParam->getEventEndTime());
		$stmt->bindValue(':eventid', $eventObjParam->getEventid());

		$result = $stmt->execute();
		$affectedRowCount = $stmt->rowCount();
		$auth->closeconnection($dbconn);

		if($affectedRowCount>0){
		  return true;
		}
		else{
		  return false;
		}
		return $result;
	}

	/**
	* delete event
	* @param reservation id
	* @return true or false
	*/
	function deleteEvent($eventidParam)
	{
		$affectedRowCount=0;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'DELETE from `events` WHERE `eventid`=:eventid;';
		$stmt = $dbconn->prepare($query);
		/*bind values to escape*/
		
		$stmt->bindValue(':eventid', $eventidParam);
		
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
	

	/***select attendance by event id ***/
	function retriveAttendanceByEventId($idParam){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  * FROM `events` where `eventid`=:eventid;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':eventid', $idParam, PDO::PARAM_INT);    
		$stmt->execute();
		$numRow = 0;
		$numRow =  $stmt->rowCount();
		if($numRow>0){
			$eventObj= new event;
			$eventObj = $stmt->fetchObject('event');
		}
		else{
			$eventObj = null;
		}

		$auth->closeconnection($dbconn);
		return $eventObj;
	}

	function retriveListEventByrestaurantId($restidParam,$offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `events` where restaurantid=:restaurantid order by `eventtime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);	
		$stmt->bindParam(':restaurantid', $restidParam, PDO::PARAM_INT);				
		$stmt->execute();

		$eventObj= new event;
		$eventList = array();
		while($eventObj = $stmt->fetchObject('event')){
			array_push($eventList,$eventObj);
		}
		$auth->closeconnection($dbconn);
		return $eventList;
	}

	function retriveListAttendanceByownerId($ownerIdParam,$offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `events` where userId=:userId order by `eventtime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);	
		$stmt->bindParam(':userId', $ownerIdParam, PDO::PARAM_INT);				
		$stmt->execute();

		$eventObj= new event;
		$eventList = array();
		while($eventObj = $stmt->fetchObject('event')){
			array_push($eventList,$eventObj);
		}
		$auth->closeconnection($dbconn);
		return $eventList;
	}

	function retriveListEvent($offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `events` order by `eventtime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);				
		$stmt->execute();

		$eventObj= new event;
		$eventList = array();
		while($eventObj = $stmt->fetchObject('event')){
			array_push($eventList,$eventObj);
		}
		$auth->closeconnection($dbconn);
		return $eventList;
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
	function getUserId(){
		return $this->userId;		
	}
	function getEventName(){
		return $this->eventname;		
	}
	function getEventid(){
		return $this->eventid;		
	}
	function getRestaurantId(){
		return $this->restaurantid;		
	}
	function getEventDiscription(){
		return $this->eventdiscription;		
	}
	function getEventPictureUrl(){
		return $this->eventpictureurl;		
	}
	function getEventTime(){
		return $this->eventtime;		
	}
	function getEventEndTime(){
		return $this->eventendtime;		
	}
	
	
	/*********************setter ********************/
	function setUserId($param){
		$this->userId= $param;	
	}
	function setEventName($param){
		$this->eventname= $param;	
	}
	function setEventid($param){
		$this->eventid= $param;		
	}
	function setRestaurantId($param){
		$this->restaurantid= $param;	
	}
	function setEventDiscription($param){
		$this->eventdiscription = $param;			
	}
	function setEventPictureUrl($param){
		$this->eventpictureurl = $param;			
	}
	function setEventTime($param){
		$this->eventtime = $param;		
	}
	function setEventEndTime($param){
		$this->eventendtime = $param;		
	}
	
}

?>