<?php
/******************************************************************************************
* File name: owner.php
* Purpose: Provides restaurant class functionality that contains several methods in 
* handling owner data
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 26, 2015
******************************************************************************************/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class owner
{
	private $ownerId;
	private $userId;
	private $businessNumber;
	private $businessPhone;
	private $verified;
	
	/**
	* retrieve all information about owner corresponding to given user id and business number
	* @param userId
	* @return owner obj
	*/
	function selectOwnerInfo($userId, $businessNumber)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select ownerid, userId, businessnumber, businessphone, verified from owner where userId=:userId and businessnumber=:businessNumber;';
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':userId', $userId);	
		$stmt->bindValue(':businessNumber', $businessNumber);

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$ownerObj = new owner;
		$ownerObj->setOwnerId($result['ownerid']);
		$ownerObj->setUserId($result['userId']);
		$ownerObj->setBusinessNumber($result['businessnumber']);
		$ownerObj->setBusinessPhone($result['businessphone']);
		$ownerObj->setVerified($result['verified']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $ownerObj;
	}
	
	/**
	* retrieve all owner Ids corresponding to given user id
	* @param userId
	* @return integer array of owner Ids- with index 1 being the length
	*/
	function isOwnersInfo($userId)
	{
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT  ownerid FROM `owner` where userId=:userId;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);			
		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result['ownerid']>0){
			return $result['ownerid'];
		}
		$auth->closeconnection($dbconn);
		return 0;
	}

	/**
	* retrieve all owner Ids corresponding to given user id
	* @param userId
	* @return integer array of owner Ids- with index 1 being the length
	*/
	function selectOwnersInfo($userId)
	{
		$ownerIdList = array_fill(1, 500, -1);
		$i = 2;
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select ownerid from owner where userId=:userId;';
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':userId', $userId);	

		$stmt->execute();
		
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ownerIdList[$i] = $row[ownerid];
			$i = $i + 1;
		}
		
		$ownerIdList[1] = $i-2;
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $ownerIdList;
	}
	
	/**
	* insert new information corresponding to a given owner
	* into the database system
	* @return true on success, false otherwise
	*/
	function insertOwner()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "insert into owner(userId, businessnumber, businessphone, verified) 
					values(:userId, :businessNumber, :businessPhone, :verified);";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values	
		$stmt->bindValue(':userId',$this->getUserId());	
		$stmt->bindValue(':businessNumber',$this->getBusinessNumber());	
		$stmt->bindValue(':businessPhone',$this->getBusinessPhone());	
		$stmt->bindValue(':verified',$this->getVerified());	
		
		if ($stmt->execute())
		{
			mysqldatabaserrs::closeconnection($dbconn);
			
			return 1;
		}
		else
		{
			$arr = $stmt->errorInfo();
			print_r($arr);
			return 0;
		}
	}
	
	/**
	* remove owner information in the database corresponding to a given 
	* restaurant Id
	* @return 1 on success, 0 otherwise
	*/
	function removeOwnerInfo($ownerId)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "delete from owner where ownerid=:ownerId;";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':ownerId', $ownerId);		
		
		if ($stmt->execute())
		{
			mysqldatabaserrs::closeconnection($dbconn);
			
			return 1;
		}
		else
		{
			$arr = $stmt->errorInfo();
			print_r($arr);
			
			mysqldatabaserrs::closeconnection($dbconn);
			
			return 0;
		}
	}
	//check if user is the restaurant's owner
	function isRestaurantOwner($restidParam,$userIdParam)
	{
		$auth = new mysqldatabaserrs;
		$dbconn = $auth->connectdb();
		$query = 'SELECT `ownerid` FROM `view_owner_ownership` WHERE `userId`=:userIdParam and `restaurantid`=:restidParam;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindParam(':userIdParam', $userIdParam, PDO::PARAM_INT);	
		$stmt->bindParam(':restidParam', $restidParam, PDO::PARAM_INT);			
		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($result['ownerid']>0){
			$auth->closeconnection($dbconn);
			return $result['ownerid'];
		}
		$auth->closeconnection($dbconn);
		return 0;
	}
	

	//getter functions
	function getOwnerId()
	{
		return $this->ownerId;
	}

	function getUserId()
	{
		return $this->userId;
	}
	
	function getBusinessNumber()
	{
		return $this->businessNumber;
	}
	
	function getBusinessPhone()
	{
		return $this->businessPhone;
	}
	
	function getVerified()
	{
		return $this->verified;
	}
	
	//setter functions
	function setOwnerId($param)
	{
		$this->ownerId = $param;	
	}
	
	function setUserId($param)
	{
		$this->userId = $param;	
	}
	
	function setBusinessNumber($param)
	{
		$this->businessNumber = $param;	
	}
	
	function setBusinessPhone($param)
	{
		$this->businessPhone = $param;	
	}
	
	function setVerified($param)
	{
		$this->verified = $param;	
	}
}