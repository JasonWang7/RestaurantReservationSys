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
	* retrieve all information about owner corresponding to given user id
	* @param userId
	* @return owner obj
	*/
	function selectOwnerInfo($userId)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select ownerid, userId, businessnumber, businessphone, verified from owner where userId=:userId;';
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':userId', $userId);				

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$ownerObj = new owner;
		$ownerObj->setOwnerId($result['ownerid']);
		$ownerObj->setUserId($result['userId']);
		$ownerObj->setBusinessNumber($result['businessnumber']);
		$ownerObj->setBusinessPhone($result['businessphone']);
		$ownerObj->setVerified($result['verified']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $restaurantOwnershipObj;
	}
	
	/**
	* insert new information corresponding to a given owner
	* into the database system
	* @return true on success, false otherwise
	*/
	function insertOwner()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "insert into owner(ownerid, userId, businessnumber, businessphone, verified) 
					values(:ownerId, :userId, :businessNumber, :businessPhone, :verified);";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':ownerId',$this->getOwnerId());	
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