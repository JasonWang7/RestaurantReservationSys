<?php
/* Based off of Jason's user.php code*/
/* Written by Vincent Tieu */

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class Reservation{
  private $restaurantId;
  private $reservationId;
  private $userId;
  private $numberOfGuests;
  private $note;
  private $invitationList;
  private $diningTime;
  private $userEmail;
  private $userPhone;


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
  * inssert new reservation into database
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
  function updateReservation($reservationIdVal,$numberOfGuestsVal,$noteVal,$invitationListVal,$$userEmailVal,$userPhoneVal,$dinningtimeparam)
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

}
?>