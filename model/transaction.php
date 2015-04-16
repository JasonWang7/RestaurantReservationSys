<?php
/********Author: Jason Wang************/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class transaction{
	private $restaurantid;
	private $reservationid;
	private $tansactionid;
	private $userId;
	private $amount;
	private $transactiontime;
	private $desicription;
	private $firstname;
	private $lastname;
	private $userphone;
	private $useremail;
	private $restaurantname;
	private $email; //restaurant email
	private $phone; //restaurant phone

	function insertTransction($amountParam,$descriptionParam){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'INSERT INTO `reservationtransaction` (`restaurantid`, `reservationid`, `userId`, `amount`, `desicription`)
				 VALUES (:restaurantid,:reservationid,:userId,:amount,:desicription)';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':restaurantid',$this->getRestaurantId());
		$stmt->bindValue(':reservationid',$this->getReservationId());
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->bindValue(':amount',$amountParam);
		$stmt->bindValue(':desicription',$descriptionParam);
		$stmt->execute();
		
		$affectedRowCount = $stmt->rowCount();		
		$auth->closeconnection($dbconn);
		if($affectedRowCount>0){
			
			return true;
		}
		else{
			return false;
		}
	}
	//get list of transaction by user id
	function listTransactionByUserId($useridParam,$offsetNum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  * FROM `view_transaction_user_restaurant` where `userId`=:useridParam order by `transactiontime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':useridParam', $useridParam, PDO::PARAM_INT);
		$stmt->bindParam(':offsetNum', $offsetNum, PDO::PARAM_INT);				
		$stmt->execute();

		$transactionObj= new transaction;
		$transactionList = array();
		while($transactionObj = $stmt->fetchObject('transaction')){
			array_push($transactionList,$transactionObj);
		}
		$auth->closeconnection($dbconn);
		return $transactionList;
	}
	//get list of transaction by owner id
	function listTransactionByOnwerId($useridParam,$offsetNum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$transactionList = array();
		
		$query = 'select ownerid from owner where userId = :useridParam;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':useridParam', $useridParam, PDO::PARAM_INT);		
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$ownerIdList = array();
		foreach($result as $r){
			$ownerId = $r['ownerid'];
			$query = 'select restaurantid from restaurantownership where ownerid = :ownerid;';
			$stmt = $dbconn->prepare($query);
			/*bind values to escape*/
			$stmt->bindParam(':ownerid', $ownerId, PDO::PARAM_INT);			
			$stmt->execute();
			$results = $stmt->fetchAll();
			$ownerIdList = array_merge($ownerIdList,$results);
		}
		//echo '<pre>'.print_r($ownerIdList, true).'</pre>';
		if(count($ownerIdList)>0){
			foreach($ownerIdList as $restid){
				$query = 'SELECT  * FROM `view_transaction_user_restaurant` where `restaurantid`=:restidParam order by `transactiontime` desc;';
				$stmt = $dbconn->prepare($query);
				/*bind values to escape*/
				$stmt->bindParam(':restidParam', $restid['restaurantid'], PDO::PARAM_INT);	
				$stmt->execute();
				$transactionObj= new transaction;
				while($transactionObj = $stmt->fetchObject('transaction')){
					array_push($transactionList,$transactionObj);
				}
			}
		}
		//echo '<pre>'.print_r($transactionList, true).'</pre>';
		/*
		echo '<pre>'.print_r($result, true).'</pre>';
		if($result['ownerid']!=''&&$result['ownerid']>0){
			$ownerId = $result['ownerid'];
			$query = 'select restaurantid from restaurantownership where ownerid = :ownerid;';
			$stmt = $dbconn->prepare($query);
			
			$stmt->bindParam(':ownerid', $ownerId, PDO::PARAM_INT);			
			$stmt->execute();
			$results = $stmt->fetchAll();
			echo '<pre>'.print_r($results, true).'</pre>';
			if(count($results)>0){
				foreach($results as $restid){
					$query = 'SELECT  * FROM `view_transaction_user_restaurant` where `restaurantid`=:restidParam order by `transactiontime` desc;';
					$stmt = $dbconn->prepare($query);
					
					$stmt->bindParam(':restidParam', $restid['restaurantid'], PDO::PARAM_INT);	
					$stmt->execute();
					$transactionObj= new transaction;
					while($transactionObj = $stmt->fetchObject('transaction')){
						array_push($transactionList,$transactionObj);
					}
				}
				
			}
		}*/
		//sort array by time
		usort($transactionList, function($a, $b) {
		  $ad = new DateTime($a->getTransactionTime());
		  $bd = new DateTime($b->getTransactionTime());

		  if ($ad == $bd) {
		    return 0;
		  }

		  return $ad < $bd ? 1 : -1;
		});
		
		$auth->closeconnection($dbconn);
		return $transactionList;
	}
	
	
	//get list of transaction by owner id
	function listTransactionByOnwerIdold($useridParam,$offsetNum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$transactionList = array();
		
		$query = 'select ownerid from owner where userId = :useridParam;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':useridParam', $useridParam, PDO::PARAM_INT);		
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


		echo '<pre>'.print_r($result, true).'</pre>';
		if($result['ownerid']!=''&&$result['ownerid']>0){
			$ownerId = $result['ownerid'];
			$query = 'select restaurantid from restaurantownership where ownerid = :ownerid;';
			$stmt = $dbconn->prepare($query);
			/*bind values to escape*/
			$stmt->bindParam(':ownerid', $ownerId, PDO::PARAM_INT);			
			$stmt->execute();
			$results = $stmt->fetchAll();
			echo '<pre>'.print_r($results, true).'</pre>';
			if(count($results)>0){
				foreach($results as $restid){
					$query = 'SELECT  * FROM `view_transaction_user_restaurant` where `restaurantid`=:restidParam order by `transactiontime` desc;';
					$stmt = $dbconn->prepare($query);
					/*bind values to escape*/
					$stmt->bindParam(':restidParam', $restid['restaurantid'], PDO::PARAM_INT);	
					$stmt->execute();
					$transactionObj= new transaction;
					while($transactionObj = $stmt->fetchObject('transaction')){
						array_push($transactionList,$transactionObj);
					}
				}
				
			}
		}

		
		$auth->closeconnection($dbconn);
		return $transactionList;
	}


	//get list of transaction by restaurant id
	function listTransactionByRestId($restidParam,$offsetNum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  * FROM `view_transaction_user_restaurant` where `restaurantid`=:restidParam order by `transactiontime` desc limit 30 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':restidParam', $restidParam, PDO::PARAM_INT);
		$stmt->bindParam(':offsetNum', $offsetNum, PDO::PARAM_INT);				
		$stmt->execute();

		$transactionObj= new transaction;
		$transactionList = array();
		while($transactionObj = $stmt->fetchObject('transaction')){
			array_push($transactionList,$transactionObj);
		}
		$auth->closeconnection($dbconn);
		return $transactionList;
	}
	//get list of transaction order by ttransaction time
	function listTransaction($limit,$offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  * FROM `view_transaction_user_restaurant` order by `transactiontime` desc limit :limits offset :offsetnum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':limits', $limit, PDO::PARAM_INT);
		$stmt->bindParam(':offsetnum', $offsetnum, PDO::PARAM_INT);				
		$stmt->execute();

		$transactionObj= new transaction;
		$transactionList = array();
		while($transactionObj = $stmt->fetchObject('transaction')){
			array_push($transactionList,$transactionObj);
		}
		$auth->closeconnection($dbconn);
		return $transactionList;
	}


	/*********************getter ********************/
	function getRestaurantId(){
		return $this->restaurantid;		
	}
	function getReservationId(){
		return $this->reservationid;		
	}
	function getTansactionId(){
		return $this->tansactionid;		
	}
	function getUserId(){
		return $this->userId;		
	}
	function getAmount(){
		return $this->amount;		
	}
	function getTransactionTime(){
		return $this->transactiontime;		
	}
	function getDesicription(){
		return $this->desicription;		
	}
	function getFirstName(){
		return $this->firstname;		
	}
	function getLastName(){
		return $this->lastname;		
	}
	function getUserPhone(){
		return $this->userphone;		
	}
	function getUserEmail(){
		return $this->useremail;		
	}
	function getRestuarantEmail(){
		return $this->email;		
	}
	function getRestaurantName(){
		return $this->restaurantname;		
	}
	function getRestaurantPhone(){
		return $this->phone;		
	}

	/*********************setter ********************/
	function setRestaurantId($param){
		$this->restaurantid= $param;		
	}
	function setReservationId($param){
		$this->reservationid= $param;		
	}
	function setTansactionId($param){
		$this->tansactionid= $param;		
	}
	function setUserId($param){
		$this->userId= $param;		
	}
	function setAmount($param){
		$this->amount= $param;		
	}
	function setTransactionTime($param){
		$this->transactiontime= $param;		
	}
	function setDesicription($param){
		$this->desicription= $param;		
	}
	function setFirstName($param){
		$this->firstnam=$param;		
	}
	function setLastName($param){
		$this->lastname=$param;		
	}
	function setUserPhone($param){
		$this->userphone=$param;		
	}
	function setUserEmail($param){
		$this->useremail=$param;		
	}
	function setRestuarantEmail($param){
		$this->email=$param;		
	}
	function setRestaurantName($param){
		$this->restaurantname=$param;		
	}
	function setRestaurantPhone($param){
		$this->phone=$param;		
	}

}


?>