
<?php
/******************************************************************************************
* File name: restaurant.php
* Purpose: Provides restaurant class functionality that contains several methods in 
* handling restaurant ownership data
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 28, 2015
******************************************************************************************/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class restaurantOwnership
{
	private $ownerId;
	private $restaurantId;
	private $verified;
	
	
	/**
	* retrieve all information about restaurant ownership corresponding to given owner id
	* @param ownerId
	* @return restaurantOwnership obj
	*/
	function selectRestaurantOwnership($ownerId)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select ownerid, restaurantid, verified from restaurantownership where ownerid=:ownerId;';
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':ownerId', $ownerId);				

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$restaurantOwnershipObj = new restaurantOwnership;
		$restaurantOwnershipObj->setOwnerId($result['ownerid']);
		$restaurantOwnershipObj->setRestaurantId($result['restaurantid']);
		$restaurantOwnershipObj->setVerified($result['verified']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $restaurantOwnershipObj;
	}
	
	/**
	* insert new information corresponding to a given restaurant ownership 
	* into the database system
	* @return true on success, false otherwise
	*/
	function insertRestaurantOwnership()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "insert into restaurantownership(ownerid, restaurantid, verified) 
					values(:ownerId, :restaurantId, :verified);";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':ownerId',$this->getOwnerId());	
		$stmt->bindValue(':restaurantId',$this->getRestaurantId());	
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
	
	function getRestaurantId()
	{
		return $this->restaurantId;
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
	
	function setRestaurantId($param)
	{
		$this->restaurantId = $param;	
	}
	
	function setVerified($param)
	{
		$this->verified = $param;	
	}
}