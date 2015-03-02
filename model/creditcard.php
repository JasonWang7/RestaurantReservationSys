<?php
/******author: Jason Wang*****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class creditcard{
	private $cardnum;
	private $name;
	private $address;
	private $cv;
	private $expiredate;
	private $userid;
	
	
 	/**
	* retrive cardit card info
	* @param userid
	* @return card obj
	*/
	function selectBasicInfo($userid){
		$userObj = new user;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'select cardNum,name,address,cv,expireddate,userid from creditcardinfo where userid=:userid;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':userid',$userid);				
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$cardObj = new creditcard;
		$cardObj->setUserId($result['userid']);
		$cardObj->setCardNum($result['cardNum']);
		$cardObj->setAddress($result['address']);
		$cardObj->setCV($result['cv']);
		$cardObj->setName($result['name']);
		$cardObj->setExpireDate($result['expireddate']);
		$auth->closeconnection($dbconn);
		return $cardObj;
	}

	/**
	* delete user 
	* @param useridParam
	* @param newUserObj: a new user object contains new data
	* Note: make sure password is harshed before call this function to update password
	* @return true or false
	*/
	function deleteCreditCard($useridParam){
		$userObj = new user;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
	
		$query = 'delete from creditcardinfo where userId =:userid;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':userid',$useridParam);	
		$stmt->execute();

		$auth->closeconnection($dbconn);

	}



	/******getter****/
	function getUserId(){
		return $this->userid;		
	}
	function getCardNum(){
		return $this->cardnum;
	}
	function getAddress(){
		return $this->address;
	}
	function getCV(){
		return $this->cv;
	}
	function getName(){
		return $this->name;
	}
	function getExpireDate(){
		return $this->expiredate;
	}

	/*********setter********/
	function setUserId($param){
		$this->userid = $param;		
	}
	function setCardNum($param){
		$this->cardnum = $param;
	}
	function setAddress($param){
		$this->address = $param;
	}
	function setCV($param){
		$this->cv = $param;
	}
	function setName($param){
		$this->name = $param;
	}
	function setExpireDate($param){
		$this->expiredate = $param;
	}

}

?>