<?php
/**
 * vote model
 * @author Jinhai Wang
 * Date: Mar 27, 2015
 */
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class vote{

	private $reviewid;
	private $userId;
	private $votevalue;
	private $updatetime;


	function insertVoteReview(){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();	
		$query =  'INSERT INTO `reviewvote`(`reviewid`, `userId`, `votevalue`) VALUES (:reviewid,:userId,:votevalue);';
		$stmt = $dbconn->prepare($query);

		$stmt->bindValue(':reviewid',$this->getReviewId());
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->bindValue(':votevalue',$this->getVoteValue());
		$stmt->execute();
		$auth->closeconnection($dbconn);
	}

	function voteReview($val){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();	
		$query =  'UPDATE `reviewvote` SET votevalue=:val
				 WHERE `reviewid`=:reviewid and `userId`=:userId;';
		$stmt = $dbconn->prepare($query);

		$stmt->bindValue(':reviewid',$this->getReviewId());				
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->bindValue(':val',$val);
		$stmt->execute();
		$auth->closeconnection($dbconn);
	}

	function retrieveVote(){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'select votevalue,updatetime from reviewvote where `reviewid`=:reviewid and `userId`=:userId;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':reviewid',$this->getReviewId());				
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->setVoteValue($result['votevalue']);
		$this->setUpdateTime($result['updatetime']);
		$auth->closeconnection($dbconn);
	}
	
	/*********************getter ********************/
	function getReviewId(){
		return $this->reviewid;		
	}
	function getUserId(){
		return $this->userId;		
	}
	function getVoteValue(){
		return $this->votevalue;		
	}
	function getUpdateTime(){
		return $this->updatetime;		
	}

	/*********************setter ********************/
	function setReviewId($param){
		$this->reviewid = $param;	
	}
	function setUserId($param){
		$this->userId = $param;	
	}
	function setVoteValue($param){
		$this->votevalue = $param;	
	}
	function setUpdateTime($param){
		$this->updatetime = $param;	
	}
}
?>