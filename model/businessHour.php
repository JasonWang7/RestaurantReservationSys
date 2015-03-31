<?php
/******************************************************************************************
* File name: businessHour.php
* Purpose: Provides business hour class functionality that contains several methods 
* in handling business hour data
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 28, 2015
******************************************************************************************/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class businessHour
{
	private $restaurantId;
	private $day;
	private $startHour;
	private $endHour;
	
	/**
	* retrieve all the business hour information about a given restaurant
	* @param restaurantId day
	* @return restaurant obj
	*/
	function selectHoursInfo($id, $day)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select restaurantid, day, starhour, end from businesshour where restaurantid=:id and day=:day;';
		
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':day', $day);		

		$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$businessHourObj = new businessHour;
		$businessHourObj->setRestaurantId($result['restaurantid']);
		$businessHourObj->setDay($result['day']);
		$businessHourObj->setStartHour($result['starhour']);
		$businessHourObj->setEndHour($result['end']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $businessHourObj;
	}
	
	/**
	* insert new information regarding a given restaurant's hours for a 
	* given day
	* @return true on success, false otherwise
	*/
	function insertHoursInfo()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = "insert into businesshour(restaurantid, day, starhour, end) 
					values(:restaurantId, :day, :startHour, :endHour);";
		$stmt = $dbconn->prepare($query);
		
		// bind business hour values from database to class values
		$stmt->bindValue(':restaurantId',$this->getRestaurantId());
		$stmt->bindValue(':day',$this->getDay());	
		$stmt->bindValue(':startHour',$this->getStartHour());			
		$stmt->bindValue(':endHour',$this->getEndHour());	
		
		if ($stmt->execute())
		{
			mysqldatabaserrs::closeconnection($dbconn);
			return 1;
		}
		else
		{
			/*$arr = $stmt->errorInfo();
			print_r($arr);*/
			return 0;
		}
	}
	
	/**
	* remove business hour information in the database corresponding to a given 
	* restaurant Id
	* @return 1 on success, 0 otherwise
	*/
	function removeHoursInfo($restaurantId)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "delete from businesshour where restaurantid=:restaurantId;";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':restaurantId', $restaurantId);		
		
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
	
	//getter methods
	function getRestaurantId()
	{
		return $this->restaurantId;
	}
	
	function getDay()
	{
		return $this->day;
	}
	
	function getStartHour()
	{
		return $this->startHour;
	}
	
	function getEndHour()
	{
		return $this->endHour;
	}
	
	//setter methods
	function setRestaurantId($param)
	{
		$this->restaurantId = $param;	
	}
	
	function setDay($param)
	{
		$this->day = $param;	
	}
	
	function setStartHour($param)
	{
		$this->startHour = $param;	
	}
	
	function setEndHour($param)
	{
		$this->endHour = $param;	
	}
}
?>