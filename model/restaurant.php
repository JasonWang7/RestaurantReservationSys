<?php
error_reporting(0);

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
	private $holidayHours;
	private $likes;
	private $profilePicture;
	private $verified;

	
	/**
	* retrieve all the information about the restaurant
	* @param email
	* @return restaurant obj
	*/
	function selectRestaurantInfo($name)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select restaurantid, address, type, restaurantname, email, phone, features, pricerange, about, website, holidayhour, likes, profilepicture, 
		verified from restaurant where restaurantname=:name;';
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':name', $name);				

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$restaurantObj = new restaurant;
		$restaurantObj->setId($result['restaurantid']);
		$restaurantObj->setAddress($result['address']);
		$restaurantObj->setType($result['type']);
		$restaurantObj->setRestaurantName($result['restaurantname']);
		$restaurantObj->setEmail($result['email']);
		$restaurantObj->setPhone($result['phone']);
		$restaurantObj->setFeatures($result['features']);
		$restaurantObj->setPriceRange($result['pricerange']);
		$restaurantObj->setAbout($result['about']);
		$restaurantObj->setWebsite($result['website']);
		$restaurantObj->setHolidayHours($result['holidayhour']);
		$restaurantObj->setLikes($result['likes']);
		$restaurantObj->setProfilePicture($result['profilepicture']);
		$restaurantObj->setVerified($result['verified']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $restaurantObj;
	}
	
	/**
	* retrieve all restaurants owned by given user
	* @param user ID
	* @return array of owned restaurant name strings
	*/
	function selectOwnedRestaurants($userId)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = 'select ownerid from owner where restaurantname=:name;';
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':name', $name);				

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$restaurantObj = new restaurant;
		$restaurantObj->setId($result['restaurantid']);
		$restaurantObj->setAddress($result['address']);
		$restaurantObj->setType($result['type']);
		$restaurantObj->setRestaurantName($result['restaurantname']);
		$restaurantObj->setEmail($result['email']);
		$restaurantObj->setPhone($result['phone']);
		$restaurantObj->setFeatures($result['features']);
		$restaurantObj->setPriceRange($result['pricerange']);
		$restaurantObj->setAbout($result['about']);
		$restaurantObj->setWebsite($result['website']);
		$restaurantObj->setHolidayHours($result['holidayhour']);
		$restaurantObj->setLikes($result['likes']);
		$restaurantObj->setProfilePicture($result['profilepicture']);
		$restaurantObj->setVerified($result['verified']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $restaurantObj;
	}
	
	/**
	* retrieve all restaurants that match search keyword
	* @param keyword
	* @return array of restaurant strings
	*/
	function selectMatchingRestaurants($keyword)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		$query = "select restaurantname from restaurant where restaurantname like ':keyword%';";
		
		$stmt = $dbconn->prepare($query);

		// bind restaurant values from database to class values
		$stmt->bindValue(':keyword', $keyword);				

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$restaurantObj = new restaurant;
		$restaurantObj->setId($result['restaurantid']);
		$restaurantObj->setAddress($result['address']);
		$restaurantObj->setType($result['type']);
		$restaurantObj->setRestaurantName($result['restaurantname']);
		$restaurantObj->setEmail($result['email']);
		$restaurantObj->setPhone($result['phone']);
		$restaurantObj->setFeatures($result['features']);
		$restaurantObj->setPriceRange($result['pricerange']);
		$restaurantObj->setAbout($result['about']);
		$restaurantObj->setWebsite($result['website']);
		$restaurantObj->setHolidayHours($result['holidayhour']);
		$restaurantObj->setLikes($result['likes']);
		$restaurantObj->setProfilePicture($result['profilepicture']);
		$restaurantObj->setVerified($result['verified']);
		
		mysqldatabaserrs::closeconnection($dbconn);
		
		return $restaurantObj;
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
		
		// bind class values to query values
		$stmt->bindValue(':address',$this->getAddress());	
		$stmt->bindValue(':type',$this->getType());			
		$stmt->bindValue(':restaurantName',$this->getRestaurantName());	
		$stmt->bindValue(':email',$this->getEmail());	
		$stmt->bindValue(':phone',$this->getPhone());			
		$stmt->bindValue(':features',$this->getFeatures());		
		$stmt->bindValue(':priceRange',$this->getPriceRange());			
		$stmt->bindValue(':about',$this->getAbout());		
		$stmt->bindValue(':website',$this->getWebsite());				
		$stmt->bindValue(':holidayHour',$this->getHolidayHours());
		$stmt->bindValue(':likes',$this->getLikes());
		$stmt->bindValue(':profilePicture',$this->getProfilePicture());
		$stmt->bindValue(':verified',$this->getVerified());
		
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
	* remove information in the database corresponding to a given restaurant name and email address
	* @return true on success, false otherwise
	*/
	function removeRestaurantInfo($restaurantName, $email)
	{
		$dbconn = mysqldatabaserrs::connectdb();
		
		$query = "delete from restaurant where restaurantname=:restaurantName and email=:email;";
		$stmt = $dbconn->prepare($query);
		
		// bind class values to query values
		$stmt->bindValue(':restaurantName', $restaurantName);	
		$stmt->bindValue(':email', $email);			
		
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
	
	//getter functions
	function getId()
	{
		return $this->restaurantId;
	}
	
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
	
	function getHolidayHours()
	{
		return $this->holidayHours;
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
	function setId($param)
	{
		$this->restaurantId = $param;	
	}
	
	function setAddress($param)
	{
		$this->address = $param;	
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
	
	function setPriceRange($param)
	{
		$this->priceRange = $param;	
	}
	
	function setAbout($param)
	{
		$this->about = $param;	
	}
	
	function setWebsite($param)
	{
		$this->website = $param;	
	}
	
	function setHolidayHours($param)
	{
		$this->holidayHours = $param;	
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
}
?>