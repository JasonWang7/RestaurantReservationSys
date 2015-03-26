<?php
/******author: Jason Wang*****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class creditcard{
	private $cardnum ="";
	private $name="";
	private $address="";
	private $cv="";
	private $expiredate="";
	private $userid="";
	private $cardtype="";
	
	//code implemented based on luhn algorithm ref:http://en.wikipedia.org/wiki/Luhn_algorithm
	function luhn_checksum($cardnumber){
		$cardnumber=preg_replace('/\D/', '', $cardnumber);  //regex to take non digit character off
		$digitlength = strlen($cardnumber);
		$digitparity=$digitlength % 2;
		$totalsum=0;
		for ($i=0; $i<$digitlength; $i++) {
			$digit=$cardnumber[$i];
			if ($i % 2 == $digitparity) {
		      $digit=$digit*2;
		      // If the sum is two digits, add them together (in effect)
		      if ($digit > 9) {
		        $digit-=9;
		      }
		    }
		    $totalsum+=$digit;
		}
		if($totalsum % 10 == 0){
			return true;
		}
		return false;
	}

	function cv_check($cvv){
		return preg_match("/^[0-9]{3,4}$/",$cvv);
	}

	function exp_date_check($edate){
		
		return preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/",$edate);
	}

	/**
	* insert cardit card info
	* @param userid
	* @return card obj
	*/
	function insertCardInfo($creditcard){
		$userObj = new user;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'INSERT INTO `creditcardinfo`(`cardNum`, `cardtype`,`name`, `address`, `cv`, `expireddate`, `userId`) VALUES (:cardNum,:cardtype,:name,:address,:cvv,:expireddate,:userId)';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':cardNum',$creditcard->getCardNum());	
		$stmt->bindValue(':name',$creditcard->getName());
		$stmt->bindValue(':address',$creditcard->getAddress());
		$stmt->bindValue(':cvv',$creditcard->getCV());
		$stmt->bindValue(':cardtype',$creditcard->getCardType());
		$stmt->bindValue(':expireddate',$creditcard->getExpireDate()); 
		$stmt->bindValue(':userId',$creditcard->getUserId());			
		$stmt->execute();
		$auth->closeconnection($dbconn);
		return $creditcard;
	}

 	/**
	* retrive cardit card info
	* @param userid
	* @return card obj
	*/
	function selectCardInfo($userid){
		$userObj = new user;
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'select cardtype,cardNum,name,address,cv,expireddate,userid from creditcardinfo where userid=:userid;';
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
		$cardObj->setCardType($result['cardtype']);
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
	function getCardType(){
		return $this->cardtype;		
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
	function setCardType($param){
		$this->cardtype =$param;		
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