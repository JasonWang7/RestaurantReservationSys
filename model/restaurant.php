<?php
/******************************************************************************************
* File name: restaurant.php
* Purpose: Provides restaurant class functionality that contains several methods in 
* handling restaurant data
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 28, 2015
******************************************************************************************/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');

class restaurant
{
	private $restaurantId;
	private $address;
	private $type;
	private $restaurantName;
	private $email;
	private $phone;
	private $features;
	private $priceRange;
	private $about;
	private $website;
	private $holidayHour;
	private $likes;
	private $profilePicture;
	private $verified;

	
	/**
	* retrieve all the information about the restaurant
	* @param email
	* @return restaurant obj
	*/
	function selectRestaurantInfo($email)
	{
		$dbconn = connectdb();
		$query = 'select address, restaurantid as restaurantId, type, restaurantname as restaurantName, 
					email, phone, features, pricerange as priceRange, about, website, holidayhour as holidayHour,
					likes, profilepicture as profilePicture, verified from restaurant where email=:email;';
		$stmt = $dbconn->prepare($query);

		/*bind values to escape*/
		$stmt->bindValue(':email',$this->getUserEmail());				

		$stmt->execute();
		$resultObj = $stmt->fetch(PDO::FETCH_CLASS,"restaurant");
		
		closeconnction($dbconn);
		return $resultObj;
	}
	
	
	/**
	* insert new information corresponding to a given restaurant into the database system
	* @return true on success, false otherwise
	*/
	function insertRestaurantInfo()
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = "insert into restaurant(address, type, restaurantname, email, phone, features, pricerange,
					about, website, holidayhour, likes, profilepicture, verified) 
					values(:address,:type,:restaurantName,:email,:phone,:features,:priceRange,
					:about,:website,:holidayHour,:likes, :profilePicture, :verified);";
		$stmt = $dbconn->prepare($query);
		
		/*bind values to escape*/
		$stmt->bindValue(':address',$this->getAddress());	
		$stmt->bindValue(':type',$this->getType());			
		$stmt->bindValue(':restaurantName',$this->getRestaurantName());	
		$stmt->bindValue(':email',$this->getEmail());	
		$stmt->bindValue(':phone',$this->getPhone());			
		$stmt->bindValue(':features',$this->getFeatures);		
		$stmt->bindValue(':priceRange',$this->getPriceRange());			
		$stmt->bindValue(':about',$this->getAbout());		
		$stmt->bindValue(':website',$this->getWebsite());				
		$stmt->bindValue(':city',$this->getCity());
		$stmt->bindValue(':role',$this->getRole());			
		$stmt->bindValue(':likes',$this->getLikes());

		$stmt->execute();
		mysqldatabaserrs::closeconnction($dbconn);
	}
	
	//getter functions
	function getAddress()
	{
		return $this->address;
	}
	
	function getType()
	{
		return $this->type;
	}
	
	function getRestaurantName()
	{
		return $this->restaurantName;		
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function getPhone()
	{
		return $this->phone;
	}
	
	function getFeatures()
	{
		return $this->features;
	}
	
	function getPriceRange()
	{
		return $this->priceRange;
	}
	
	function getAbout()
	{
		return $this->about;
	}
	
	function getWebsite()
	{
		return $this->website;
	}
	
	function getHolidayHour()
	{
		return $this->holidayHour;
	}
	
	function getLikes()
	{
		return $this->likes;
	}
	
	function getProfilePicture()
	{
		return $this->profilePicture;
	}
	
	function getVerified()
	{
		return $this->verified;
	}
	
	
	//setter functions
	function setAddress($param)
	{
		$this->addressName = $param;	
	}
	
	function setType($param)
	{
		$this->type = $param;	
	}
	
	function setRestaurantName($param)
	{
		$this->restaurantName = $param;	
	}
	
	function setEmail($param)
	{
		$this->email = $param;	
	}
	
	function setPhone($param)
	{
		$this->phone = $param;	
	}
	
	function setFeatures($param)
	{
		$this->features = $param;	
	}
	
	function setAbout($param)
	{
		$this->about = $param;	
	}
	
	function setWebsite($param)
	{
		$this->website = $param;	
	}
	
	function setHolidayHour($param)
	{
		$this->holidayHour = $param;	
	}
	
	function setLikes($param)
	{
		$this->likes = $param;	
	}
	
	function setProfilePicture($param)
	{
		$this->profilePicture = $param;	
	}
	
	function setVerified($param)
	{
		$this->verified = $param;	
	}
?>