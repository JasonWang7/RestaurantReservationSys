<?php
/******author: Jason Wang*****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
class user{
	private $userid;
	private $username;
	private $useremail;
	private $firstname;
	private $lastname;
	private $password;
	private $phone;
	private $verified;
	private $address;
	private $postcode;
	private $city;
	private $role;
	private $status;
	private $rewardpoint;
	private $likes;
	

	/********retrive user data from database*******/

	/**
	* retrive basic user information like email, username, userid and status
	* @param email
	* @param password
	* @return user obj
	*/
	function selectBasicInfo($email){
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select username,id,email,status from user where email=:email;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':email',$email);				

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$userObj = new user;
		$userObj->setUserName($result['username']);
		$userObj->setUserId($result['id']);
		$userObj->setUserEmail($result['email']);
		$userObj->setStatus($result['status']);
		
		mysqldatabaserrs::closeconnction($dbconn);
		return $userObj;
	}

	/**
	* retrive all the information about the user
	* @param email
	* @return user obj
	* fetch into class. ref: http://w3facility.org/question/php-pdofetch_class-is-mapping-to-all-lowercase-properties-instead-of-camelcase/
	*/
	function selectUserInfo($email){
		$dbconn = connectdb();
		$query = 'select username,id as userid,email as useremail,status, firstname,lastname,passwordHash as password,
					phone,verified,city,role,rewardpoint,likes from user where email=:email;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':useremail',$this->getUserEmail());				

		$stmt->execute();
		$resultObj = $stmt->fetch(PDO::FETCH_CLASS,"user");
		
		closeconnction($dbconn);
		return $resultObj;
	}


	/**********insert user data to datbase********/

	/**
	* inssert new user using its obj values
	* @return true or false
	*/
	function insertUser(){
		$passwordHashed = authentication::encryptPass($this->getPassword());  /*use temp val to hold hashed password*/
		
	
		$dbconn =mysqldatabaserrs::connectdb();
		
		$query = "insert into user (firstname,lastname,email,passwordHash,username,city
					) values(:firstname,:lastname,:useremail,:password,:username,:city);";
		$stmt = $dbconn->prepare($query);
		
		/*bind values to escape*/
		$stmt->bindValue(':username',$this->getUserName());	
		$stmt->bindValue(':useremail',$this->getUserEmail());			
		$stmt->bindValue(':firstname',$this->getFirstName());	
		$stmt->bindValue(':lastname',$this->getLastName());	
		$stmt->bindValue(':username',$this->getUserName());			
		$stmt->bindValue(':password',$passwordHashed);					
		$stmt->bindValue(':city',$this->getCity());
		$err = $stmt->execute();
		
		if($stmt->errorCode() != 0){
			mysqldatabaserrs::closeconnction($dbconn);
			return 'There is error creating your account. Try again.';
		}
		
		//mysqldatabaserrs::closeconnction($dbconn);
		mysqldatabaserrs::closeconnction($dbconn);

	
	
		
		/*
		echo $this->getUserName();	
		echo $this->getUserEmail();			
		echo $this->getFirstName();	
		echo $this->getLastName();	
		echo $this->getUserName();			
		echo $passwordHashed;		
		echo $this->getPhone();			
		echo $this->getAddress();		
		echo $this->getPostcode();				
		echo $this->getCity();
		echo $this->getRole();			
		echo $this->getLikes();*/
		
	}


	/******************update user database*************/
	/**
	* update user information
	* @param useridParam
	* @param newUserObj: a new user object contains new data
	* Note: make sure password is harshed before call this function to update password
	* @return true or false
	*/
	function updateUser($useridParam,$newUserObj){
		$dbconn = connectdb();
		$query = 'update user set firstname=:firstname,lastname=:lastname,email=:useremail,passwordHash=:password,
					phone=:phone,username=:username,city=:city,address=:address,postcode=:postcode,role=:role,
					likes=:likes, status=:status, verified=:verified, rewardpoint=:rewardpoint where id=:userid;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':username',$newUserObj->getUserName());	
		$stmt->bindValue(':useremail',$newUserObj->getUserEmail());			
		$stmt->bindValue(':firstname',$newUserObj->getFirstName());	
		$stmt->bindValue(':lastname',$newUserObj->getLastName());			
		$stmt->bindValue(':password',$newUserObj->getPassword());		
		$stmt->bindValue(':phone',$newUserObj->getPhone());			
		$stmt->bindValue(':address',$newUserObj->getAddress());		
		$stmt->bindValue(':postcode',$newUserObj->getPostcode());				
		$stmt->bindValue(':city',$newUserObj->getCity());
		$stmt->bindValue(':role',$newUserObj->getRole());			
		$stmt->bindValue(':likes',$newUserObj->getLikes());
		$stmt->bindValue(':verified',$newUserObj->getVerified());
		$stmt->bindValue(':status',$newUserObj->getStatus());
		$stmt->bindValue(':rewardpoint',$newUserObj->getRewardpoint());
		$stmt->bindValue(':userid',$newUserObj->getUserId());
		$stmt->execute();
		closeconnction($dbconn);

	}

	/**
	* update specific user information by column name
	* @param useridParam
	* @param columnName: name of column that will be updated
	* @param val: value
	* @return true or false
	*/
	function updateUserByCol($useridParam,$columnName,$val){
		$dbconn = connectdb();
		$tempColName = sanitize($columnName); //sanitize the column name
		$query = 'insert user set '.$tempColName.' =:val where id=:useridParam;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':val',$val);
		$stmt->bindValue(':useridParam',$useridParam);
		$stmt->execute();
		closeconnction($dbconn);
	}


	/*********************getter ********************/

	/**
     * getData: get all the properties of this obj as array
     * @return array contains propertes and their values
     */
	function getData()
	{
		$data = array();
		/****loop through own properties and store into the returning array***/
		foreach( $this as $field => $fdata )
		{
			if( ! is_object( $fdata ) )
			{
				$data[ $field ] = $fdata;
			}
			
		}
		return $data;
	}
	function getUserId(){
		return $this->userid;		
	}
	function getUserName(){
		return $this->username;
	}
	function getUserEmail(){
		return $this->useremail;
	}
	function getFirstName(){
		return $this->firstname;
	}
	function getLastName(){
		return $this->lastname;
	}
	function getPassword(){
		return $this->passwordHash;
	}
	function getPhone(){
		return $this->phone;
	}
	function getVerified(){
		return $this->verified;
	}
	function getAddress(){
		return $this->address;
	}
	function getPostcode(){
		return $this->postcode;
	}
	function getCity(){
		return $this->city;
	}
	function getRole(){
		return $this->role;
	}
	function getStatus(){
		return $this->status;
	}
	function getRewardpoint(){
		return $this->rewardpoint;
	}
	function getLikes(){
		return $this->likes;
	}
	
	/****************************setter*****************************/

	function setUserId($param){
		$this->userid = $param;		
	}
	function setUserName($param){
		$this->username=$param;
	}
	function setUserEmail($param){
		$this->useremail=$param;
	}
	function setFirstName($param){
		$this->firstname=$param;
	}
	function setLastName($param){
		$this->lastname=$param;
	}
	function setPassword($param){
		$this->passwordHash=$param;
	}
	function setPhone($param){
		$this->phone=$param;
	}
	function setVerified($param){
		$this->verified=$param;
	}
	function setAddress($param){
		$this->address=$param;
	}
	function setPostcode($param){
		$this->postcode=$param;
	}
	function setCity($param){
		$this->city=$param;
	}
	function setRole($param){
		$this->role=$param;
	}
	function setStatus($param){
		$this->status=$param;
	}
	function setRewardpoint($param){
		$this->rewardpoint=$param;
	}
	function setLikes($param){
		$this->likes=$param;
	}

}


?>