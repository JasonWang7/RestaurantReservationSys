<?php
/******************************************************************************************
* File name: signatureDish.php
* Purpose: Provides signature dish class functionality that contains several methods in 
* handling signature dish data
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: April 14, 2015
******************************************************************************************/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class signatureDish
{
	private $restaurantId;
	private $dishName;
	private $price;
	private $rating;
	
	
	/**
	* retrieve all signature dishes corresponding to a given restaurant Id
	* @param restaurantId
	* @return array of signature dish data
	*/
	function selectAllDishes($restaurantId)
	{
		$i = 1;
		
		$dbconn = mysqldatabaserrs::connectdb();
		$query = "select * from signaturedish where restaurantid=:restaurantId;";
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':restaurantId', $restaurantId);		

		$stmt->execute();
		
		$result = $stmt->fetchAll();
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $result;
	}
	
	/**
	* insert new information corresponding to a given signature dish into the database system
	* @return 1 on success, 0 otherwise
	*/
	function insertDishInfo()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "insert into signaturedish(restaurantid, dishname, price, rating) 
			values (:restaurantId, :dishName, :price, :rating)";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':restaurantId',$this->getRestaurantId());
		$stmt->bindValue(':dishName',$this->getDishName());	
		$stmt->bindValue(':price',$this->getPrice());	
		$stmt->bindValue(':rating',$this->getRating());			
		
		if ($stmt->execute())
		{
			mysqldatabaserrs::closeconnection($dbconn);
			
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	/**
	* remove signature dish information in the database corresponding to a given 
	* restaurant Id and dish name
	* @return 1 on success, 0 otherwise
	*/
	function removeDishInfo($restaurantId, $dishName)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "delete from signaturedish where restaurantid=:restaurantId and dishname=:dishName;";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':restaurantId', $restaurantId);	
		$stmt->bindValue(':dishName', $dishName);		
		
		if ($stmt->execute())
		{
			mysqldatabaserrs::closeconnection($dbconn);
			
			return 1;
		}
		else
		{
			/*$arr = $stmt->errorInfo();
			print_r($arr);*/
			
			mysqldatabaserrs::closeconnection($dbconn);
			
			return 0;
		}
	}
	
	//getter functions
	function getRestaurantId()
	{
		return $this->restaurantId;
	}
	
	function getDishName()
	{
		return $this->dishName;
	}
	
	function getPrice()
	{
		return $this->price;
	}
	
	function getRating()
	{
		return $this->rating;
	}
	
	//setter methods
	function setRestaurantId($param)
	{
		$this->restaurantId = $param;	
	}
	
	function setDishName($param)
	{
		$this->dishName = $param;	
	}
	
	function setRestaurantId($param)
	{
		$this->restaurantId = $param;	
	}
	
	function setPrice($param)
	{
		$this->price = $param;	
	}
	
	function setRating($param)
	{
		$this->rating = $param;	
	}
}