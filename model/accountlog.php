<?php
/******author: Jason Wang*****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class accountlog{
	private $activitytime;
	private $activity;
	private $clientip;
	private $activityindex;
	private $userid;


	//$_SERVER['REMOTE_ADDR']
	function insertActivity(){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'INSERT INTO `accountlog`(`userid`, `activity`, `clientip`) VALUES 
				(:userid,:activity,:clientip);';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':userid',$this->getUserId());
		$stmt->bindValue(':activity',$this->getActivity());
		$stmt->bindValue(':clientip',$this->getClientIp());
		$stmt->execute();
		$insertedID = $dbconn->lastInsertId();
		if($insertedID!=0){
			$this->setActivityIndex($insertedID);
		}
		$auth->closeconnection($dbconn);
	}
	function retriveListActivity($offsetnum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `accountlog` order by `activitytime` desc limit 20 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetnum, PDO::PARAM_INT);				
		$stmt->execute();

		$logObj= new accountlog;
		$logList = array();
		while($logObj = $stmt->fetchObject('accountlog')){
			array_push($logList,$logObj);
		}
		$auth->closeconnection($dbconn);
		return $logList;
	}
	function getIpAddress(){
		$ip=$_SERVER['REMOTE_ADDR'];
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {               // check ip from share internet
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   // to check ip is pass from proxy
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		$ips = explode(",", $ip);
		$usrIp = $ips[0];
		return $usrIp ;

	}
	/*********************getter ********************/
	function getActivityTime(){
		return $this->activitytime;		
	}
	function getActivity(){
		return $this->activity;		
	}
	function getClientIp(){
		return $this->clientip;		
	}
	function getActivityIndex(){
		return $this->activityindex;		
	}
	function getUserId(){
		return $this->userid;		
	}
	

	/*********************setter ********************/
	function setActivityTime($param){
		$this->activitytime= $param;		
	}
	function setActivity($param){
		$this->activity= $param;	
	}
	function setClientIp($param){
		$this->clientip= $param;	
	}
	function setActivityIndex($param){
		$this->activityindex= $param;		
	}
	function setUserId($param){
		$this->userid= $param;	
	}
}

?>