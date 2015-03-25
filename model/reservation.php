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
    //$query = "INSERT INTO `reservation` (`restaurantid`, `userId`, `numguest`, `note`, `invitationList`, `dinningtime`, `email`, `phone`) VALUES (':restaurantid',  ':userId', ':numguest', ':note', ':invitationList', '2015-03-02 00:00:00', ':email', ':phone');";
    $query = 'INSERT INTO reservation (restaurantid, userId, numguest, note, invitationList, dinningtime, email, phone) VALUES (:restaurantid,  :userId, :numguest, :note, :invitationList, "2015-03-02 00:00:00", :email, :phone);';
    $stmt = $dbconn->prepare($query);
    /*bind values to escape*/
    $stmt->bindValue(':restaurantid', $restaurantidparam);
    $stmt->bindValue(':userId', $useridparam);
    $stmt->bindValue(':numguest', $numguestparam);
    $stmt->bindValue(':note', $noteparam);
    $stmt->bindValue(':invitationList', $invitationListparam);
    $stmt->bindValue(':dinningtime', $dinningtimeparam);
    $stmt->bindValue(':email', $emailparam);
    $stmt->bindValue(':phone', $phoneparam);

    $result = $stmt->execute();
    echo $result;
    $auth->closeconnection($dbconn);

    return $result;
  }
}
?>