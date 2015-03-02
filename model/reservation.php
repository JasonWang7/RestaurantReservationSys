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
  function insertReservation($restaurantid, $userid, $numguest, $note, $invitationList, $dinningtime, $datetime, $email, $phone)
  {
    //The insertion is messed up here because reservationID is suppose to be NULL and auto increment.. this table isn't created correctly.
    $dbconn =mysqldatabaserrs::connectdb();
    $query = "insert into reservation (restaurantid, userId, numguest, note, invitationList, dinningtime, email, phone) values(:restaurantid,:userId,:numguest,:note,:invitationList,:dinningtime,:email,:phone);";
    $stmt = $dbconn->prepare($query);
    
    /*bind values to escape*/
    $stmt->bindValue(':restaurantid', $restaurantid); 
    $stmt->bindValue(':userId',$userid);     
    $stmt->bindValue(':numguest',$numguest); 
    $stmt->bindValue(':note',$note);
    $stmt->bindValue (':datetime',$datetime);
    $stmt->bindValue(':invitationList',$invitationList);     
    $stmt->bindValue(':dinningtime',$dinningtime);    
    $stmt->bindValue(':email',$email);  
    $stmt->bindValue(':phone',$phone);  

    $stmt->execute();
    mysqldatabaserrs::closeconnction($dbconn);


    return true;
  }

?>