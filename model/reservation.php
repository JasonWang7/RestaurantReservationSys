<?php
/* Written by Vincent Tieu, Jinhai Wang */
error_reporting(0);
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class Reservation{
  private $restaurantid;
  private $reservationid;
  private $userId;
  private $numguest;
  private $note;
  private $invitationList;
  private $dinningtime;
  private $email;
  private $phone;


  /**
  * Retrive reservations for a user
  * @param userid
  * @return object with reservatio information.
  */
  function selectUserReservations($curruserId){
    $dbconn = mysqldatabaserrs::connectdb();
    $query = 'select * from reservation where userId=:curruserId;';
    $stmt = $dbconn->prepare($query);

    $stmt->bindValue(':curruserId',$curruserId);        

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    mysqldatabaserrs::closeconnction($dbconn);
    return $result;
  }

  /***select reservation by reservation id ***/
  function retriveReservationById($idParam){
    $auth = new mysqldatabaserrs;
    $dbconn = $auth->connectdb();
    $query = 'SELECT  * FROM `reservation` where reservationid=:reservationid;';
    $stmt = $dbconn->prepare($query);

    /*bind values to escape*/
    $stmt->bindParam(':reservationid', $idParam, PDO::PARAM_INT);    
    $stmt->execute();

    $reserveObj= new Reservation;
    $reserveObj = $stmt->fetchObject('Reservation');
   
    $auth->closeconnection($dbconn);
    return $reserveObj;
  }


  /**
  * Retrive reservations for a restaurant
  * @param restaurantid
  * @return object with reservatio information.
  */
  function selectRestaurantReservations($currrestId){
    $dbconn = mysqldatabaserrs::connectdb();
    $query = 'select * from reservation where restaurantId=:currrestId;';
    $stmt = $dbconn->prepare($query);

    $stmt->bindValue(':currrestId',$currrestId);        

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    mysqldatabaserrs::closeconnction($dbconn);
    return $result;
  }
  
  /**
	* retrieve count of ordered reservation Ids
	* @param user ID
	* @return array of reservation Ids
	*/
	function selectOrderedIdCount()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select restaurantid, count(restaurantid) from reservation group by restaurantid;';
		
		$stmt = $dbconn->prepare($query);			

		$stmt->execute();
		$result = $stmt->fetchAll();
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $result;
	}

  /**
  * insert new reservation into database
  * @return true or false
  */

  function insertReservation($restaurantidparam, $useridparam, $numguestparam, $noteparam, $invitationListparam, $dinningtimeparam,$emailparam, $phoneparam)
  {
   
    $auth = new mysqldatabaserrs;
    $dbconn = $auth->connectdb();
    //convert to date string
    $date =date_create_from_format('d/m/Y H:i:s', $dinningtimeparam);
    $date = date_format($date,'Y-m-d H:i:s');
    
    $query = 'INSERT INTO reservation (restaurantid, userId, numguest, note, invitationList, dinningtime, email, phone) VALUES (:restaurantid,  :userId, :numguest, :note, :invitationList,:dinningdate, :email, :phone);';
    $stmt = $dbconn->prepare($query);
    /*bind values to escape*/
    $stmt->bindValue(':restaurantid', $restaurantidparam);
    $stmt->bindValue(':userId', $useridparam);
    $stmt->bindValue(':numguest', $numguestparam);
    $stmt->bindValue(':dinningdate',$date);
    $stmt->bindValue(':note', $noteparam);
    $stmt->bindValue(':invitationList', $invitationListparam);
    $stmt->bindValue(':email', $emailparam);
    $stmt->bindValue(':phone', $phoneparam);

    $result = $stmt->execute();
    $insertedID = $dbconn->lastInsertId();
    if($insertedID!=0){
      $this->setReservationId($insertedID);
      $this->setUserId($useridparam);
      $this->setRestaurantId($restaurantidparam);
      $this->setNumGuest($numguestparam);
      $this->setNote( $noteparam);
      $this->setInvitationList($invitationListparam);
      $this->setDinningTime($date);
      $this->setEmail($emailparam);
      $this->sePhonet($phoneparam);
    }
    $auth->closeconnection($dbconn);

    return $result;
  }

  function deleteReservation($reservationidparam)
  {
   
    $auth = new mysqldatabaserrs;
    $dbconn = $auth->connectdb();
    
    $query = 'delete from reservation where reservationid=:reservationidparam;';
    $stmt = $dbconn->prepare($query);
    /*bind values to escape*/
   
    $stmt->bindValue(':reservationidparam', $reservationidparam);
    $result = $stmt->execute();
    $auth->closeconnection($dbconn);
    return $result;
  }

  /**
  * update reservation into database
  * @param reservation obj
  * @param dinningtimeparam time string in d/m/Y H:i:s formate
  * @return true or false
  */
  function updateReservation($reservationIdVal,$numberOfGuestsVal,$noteVal,$invitationListVal,$userEmailVal,$userPhoneVal,$dinningtimeparam)
  {
   
    $auth = new mysqldatabaserrs;
    $dbconn = $auth->connectdb();
    //convert to date string
    $date =date_create_from_format('d/m/Y H:i:s', $dinningtimeparam);
    $date = date_format($date,'Y-m-d H:i:s');
    $diningTime = $date;
    $query = 'update reservation set numguest=:numguest,note=:note,invitationList=:invitationList,dinningtime=:dinningdate,email=:email,phone=:phone where reservationid=:reservationid;';
    $stmt = $dbconn->prepare($query);
    /*bind values to escape*/
    $stmt->bindValue(':reservationid', $reservationIdVal);
    $stmt->bindValue(':numguest', $numberOfGuestsVal);
    $stmt->bindValue(':dinningdate',$diningTime);
    $stmt->bindValue(':note', $noteVal);
    $stmt->bindValue(':invitationList', $invitationListVal);
    $stmt->bindValue(':email', $userEmailVal);
    $stmt->bindValue(':phone', $userPhoneVal);

    $result = $stmt->execute();
    $auth->closeconnection($dbconn);

    return $result;
  }
  /*********************getter ********************/
  function getUserId(){
    return $this->userId;   
  }
  function getRestaurantId(){
    return $this->restaurantid;   
  }
  function getReservationId(){
    return $this->reservationid;   
  }
  function getNumGuest(){
    return $this->numguest;   
  }
  function getNote(){
    return $this->note;   
  }
  function getInvitationList(){
    return $this->invitationList;   
  }
  function getDinningTime(){
    return $this->dinningtime;   
  }
  function getEmail(){
    return $this->email;   
  }
  function getPhone(){
    return $this->phone;   
  }

  /****************************setter*****************************/
  function setUserId($param){
    $this->userId = $param;   
  }
  function setRestaurantId($param){
    $this->restaurantid = $param;   
  }
  function setReservationId($param){
    $this->reservationid = $param;   
  }
  function setNumGuest($param){
    $this->numguest = $param;   
  }
  function setNote($param){
    $this->note = $param;   
  }
  function setInvitationList($param){
    $this->invitationList = $param;   
  }
  function setDinningTime($param){
    $this->dinningtime = $param;   
  }
  function setEmail($param){
    $this->email = $param;   
  }
  function sePhonet($param){
    $this->phone = $param;   
  }

}
?>