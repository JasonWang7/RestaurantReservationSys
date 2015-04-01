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
	private $userId;
	private $comment;
	private $servicerating;
	private $foodrating;
	private $ambiencerating;
	private $overallexp;
	private $spam;
	private $votes=0;
	private $reviewtime;
	private $restaurantname; //record restaurant name
	private $reviewname;   //record name of user who make review


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
	
	
	/***get review by user******/
	/**
	* retrive the list of review by specifide user id
	* @param $useridParam, offsetNum
	* @return list of review object
	* fetch into class. ref: http://w3facility.org/question/php-pdofetch_class-is-mapping-to-all-lowercase-properties-instead-of-camelcase/
	*/
	function listReviewById($useridParam,$offsetNum){
		//$sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  `id` as userId, `reviewid`,`restaurantid`,`restaurantname`,`comment`,`servicerating`,`foodrating`,`ambiencerating`,`overallexp`,`votes`,`reviewtime`,`spam`,`profilepicture` FROM `view_review_user_restaurant` where `id`=:useridParam order by `reviewtime` desc limit 20 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':useridParam', $useridParam, PDO::PARAM_INT);
		$stmt->bindParam(':offsetNum', $offsetNum, PDO::PARAM_INT);				
		$stmt->execute();

		$revewObj= new review;
		$reviewList = array();
		while($revewObj = $stmt->fetchObject('review')){
			array_push($reviewList,$revewObj);
		}
		$auth->closeconnection($dbconn);
		return $reviewList;
	}
	//get list of newest review made by users
	function listReview($limit,$offsetNum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT `id` as userId, `reviewname`,`reviewid`,`restaurantid`,`restaurantname`,`comment`,`servicerating`,`foodrating`,`ambiencerating`,`overallexp`,`votes`,`reviewtime`,`spam`,`address`,`type`,`email`,`phone`,`features`,`about`,`likes`,`profilepicture`,`verified` FROM `view_review_user_restaurant` order by `reviewtime` desc limit :limits offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetNum, PDO::PARAM_INT);		
		$stmt->bindParam(':limits', $limit, PDO::PARAM_INT);			
		$stmt->execute();

		$revewObj= new review;
		$reviewList = array();
		while($revewObj = $stmt->fetchObject('review')){
			array_push($reviewList,$revewObj);
		}
		$auth->closeconnection($dbconn);
		return $reviewList;

	}

	//get list of newest review made by restaurant id
	function listReviewRestaurant($restid,$offsetNum){
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT `id` as userId, `reviewname`,`reviewid`,`restaurantid`,`restaurantname`,`comment`,`servicerating`,`foodrating`,`ambiencerating`,`overallexp`,`votes`,`reviewtime`,`spam`,`address`,`type`,`email`,`phone`,`features`,`about`,`likes`,`profilepicture`,`verified` FROM `view_review_user_restaurant` where restaurantid=:restaurantid order by `reviewtime` desc limit 100 offset :offsetNum;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':offsetNum', $offsetNum, PDO::PARAM_INT);	
		$stmt->bindParam(':restaurantid', $restid, PDO::PARAM_INT);			
		$stmt->execute();

		$revewObj= new review;
		$reviewList = array();
		while($revewObj = $stmt->fetchObject('review')){
			array_push($reviewList,$revewObj);
		}
		$auth->closeconnection($dbconn);
		return $reviewList;

	}
	//check if it is verified dinner
	function isDinner($useridParam,$restIdParam){

		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT count(`restaurantid`) as numdine FROM `reservation` WHERE `restaurantid`=:restaurantid and `userId`=:userId;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':restaurantid', $restIdParam, PDO::PARAM_INT);	
		$stmt->bindParam(':userId', $useridParam, PDO::PARAM_INT);			
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);		
		$auth->closeconnection($dbconn); 

		return $result['numdine'];

	}

	/*********************getter ********************/
	function getUserId(){
		return $this->userId;		
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
	function getSpam(){
		return $this->spam;
	}
	function getReviewTime(){
		return $this->reviewtime;
	}
	function getReviewName(){
		return $this->reviewname;
	}
	function getRestaurantName(){
		return $this->restaurantname;
	}
	/*********************setter ********************/
	function setUserId($param){
		$this->userId = $param;		
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
	function setSpam($param){
		$this->spam = $param;		
	}
	function setReviewTime($param){
		$this->reviewtime = $param;		
	}
	function setReviewName($param){
		$this->reviewname = $param;		
	}
}



?>