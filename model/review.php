<?php
/**
 * review model
 * @author Jinhai Wang
 * Date: Mar 20, 2015
 */
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class review {
	private $restaurantid;
	private $reviewid;
	private $userid;
	private $comment;
	private $servicerating;
	private $foodrating;
	private $ambiencerating;
	private $overallexp;
	private $votes;
	private $reviewtime;


	function insertReview(){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'INSERT INTO `review`(`restaurantid`, `userId`, `comment`, `servicerating`, `foodrating`, `ambiencerating`, `overallexp`, `reviewtime`) VALUES 
				(:restaurantid,:userId,:comment,:servicerating,:foodrating,:ambiencerating,:overallexp,:reviewtime);';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':restaurantid',$this->getRestaurantId());
		$stmt->bindValue(':userId',$this->getUserId());
		$stmt->bindValue(':comment',$this->getComment());
		$stmt->bindValue(':servicerating',$this->getServiceRating());
		$stmt->bindValue(':foodrating',$this->getFoodRating());
		$stmt->bindValue(':ambiencerating',$this->getAmbienceRating());
		$stmt->bindValue(':overallexp',$this->getOverallExp());
		$stmt->bindValue(':reviewtime',$this->getReviewTime());

		$stmt->execute();
		$insertedID = $dbconn->lastInsertId();
		if($insertedID!=0){
			$this->setReviewId($insertedID);
		}
		$auth->closeconnection($dbconn);
	}

	function updateReview($reivewObj){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();	
		$query =  'UPDATE `review` SET `comment`=:comment,`servicerating`=:servicerating,`foodrating`=:foodrating,`ambiencerating`=:ambiencerating,`overallexp`=:overallexp,`votes`=:votes
				 WHERE `reviewid`=:reviewid;';
		$stmt = $dbconn->prepare($query);
		/*bind values to escape*/
		$stmt->bindValue(':reviewid',$reivewObj->getReviewId());
		$stmt->bindValue(':comment',$reivewObj->getComment());
		$stmt->bindValue(':servicerating',$reivewObj->getServiceRating());
		$stmt->bindValue(':foodrating',$reivewObj->getFoodRating());
		$stmt->bindValue(':ambiencerating',$reivewObj->getAmbienceRating());
		$stmt->bindValue(':overallexp',$reivewObj->getOverallExp());
		$stmt->bindValue(':votes',$reivewObj->getVotes());
		$stmt->execute();
		$auth->closeconnection($dbconn);
	}

	function deleteReview($deleteID){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
	
		$query = 'DELETE FROM `review` WHERE `reviewid`=:reviewid;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':reviewid',$deleteID);
		$stmt->execute();
		$auth->closeconnection($dbconn);
	}
	
	/*
	function voteReview($val,$reviewIdParam){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();	
		$squery =  'UPDATE `reviewvote` SET votes=votes+1
				 WHERE `reviewid`=:reviewid;';
		$stmt = $dbconn->prepare($query);

		$stmt->bindValue(':reviewid',$reviewIdParam);
		$stmt->bindValue(':votes',$reivewObj->getVotes());
		$stmt->execute();
		$auth->closeconnection($dbconn);
	}

	function voteSpam($val){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();	
		$squery =  'UPDATE `review` SET votes=votes+1
				 WHERE `reviewid`=:reviewid;';
		$stmt = $dbconn->prepare($query);
		$stmt->bindValue(':reviewid',$reivewObj->getReviewId());
		$stmt->bindValue(':comment',$reivewObj->getComment());
		$stmt->bindValue(':overallexp',$reivewObj->getOverallExp());
		$stmt->bindValue(':votes',$reivewObj->getVotes());
		$stmt->execute();
		$auth->closeconnection($dbconn);
	}
	*/

	function listReviewById($useridParam,$offsetNum){
		//$sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT * FROM `review` where `reviewid`=:reviewid order by updatetime limit 10 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':reviewid',$useridParam);		
		$stmt->bindValue(':offsetNum',$offsetNum);			

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$userObj = new user;
		$userObj->setUserName($result['username']);
		$auth->closeconnection($dbconn);
		return $userObj;
	}
	//get list of new review
	function listReview($offsetNume){


	}
	/*********************getter ********************/
	function getUserId(){
		return $this->userid;		
	}
	function getRestaurantId(){
		return $this->restaurantid;
	}
	function getReviewId(){
		return $this->reviewid;
	}
	function getComment(){
		return $this->comment;
	}
	function getServiceRating(){
		return $this->servicerating;
	}
	function getFoodRating(){
		return $this->foodrating;
	}
	function getAmbienceRating(){
		return $this->ambiencerating;
	}
	function getOverallExp(){
		return $this->overallexp;
	}
	function getVotes(){
		return $this->votes;
	}
	function getReviewTime(){
		return $this->reviewtime;
	}
	/*********************setter ********************/
	function setUserId($param){
		$this->userid = $param;		
	}
	function setRestaurantId($param){
		$this->restaurantid = $param;		
	}
	function setReviewId($param){
		$this->reviewid = $param;		
	}
	function setComment($param){
		$this->comment = $param;		
	}
	function setServiceRating($param){
		$this->servicerating = $param;		
	}
	function setFoodRating($param){
		$this->foodrating = $param;		
	}
	function setAmbienceRating($param){
		$this->ambiencerating = $param;		
	}
	function setOverallExp($param){
		$this->overallexp = $param;		
	}
	function setVotes($param){
		$this->votes = $param;		
	}
	function setReviewTime($param){
		$this->reviewtime = $param;		
	}
}



?>