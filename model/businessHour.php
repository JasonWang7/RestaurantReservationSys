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
	private $day;
	private $startHour;
	private $endHour;
	
	/**
	* retrieve all the business hour information about a given restaurant
	* @param email
	* @return restaurant obj
	*/
	function selectRestaurantInfo($name)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select address, restaurantid as restaurantId, type, restaurantname, 
					email, phone, features, pricerange as priceRange, about, website, holidayhour as holidayHour,
					likes, profilepicture as profilePicture, verified from restaurant where restaurantname=:name;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':name',$this->getRestaurantName());				

		$stmt->execute();
		$resultObj = $stmt->fetch(PDO::FETCH_CLASS,"restaurant");
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $resultObj;
	}
	
	/**
	* insert new information regarding a given restaurant's hours for a 
	* given day
	* @return true on success, false otherwise
	*/
	function insertHoursInfo()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = "insert into businesshour(day, starhour, end) 
					values(:day, :startHour, :endHour);";
		$stmt = $dbconn->prepare($query);
		
		/*bind values to escape*/
		$stmt->bindValue(':day',$this->getDay());	
		$stmt->bindValue(':startHour',$this->getStartHour());			
		$stmt->bindValue(':endHour',$this->getEndHour());	
		
		$stmt->execute();
		mysqldatabaserrs::closeconnection($dbconn);
	}
	
	//getter methods
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