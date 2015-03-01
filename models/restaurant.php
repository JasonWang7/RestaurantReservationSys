<?php
/******************************************************************************************
* File name: restaurant.php
* Purpose: 
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 28, 2015
******************************************************************************************/

$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/RRS/authentication.class.php');
require_once($root.'/RRS/database.class.php');

class restaurant
{
	//text field variables
	private $restaurantName;
	private $priceRange;
	private $about;
	private $website;
	private $sundayStart;
	private $sundayEnd;
	private $mondayStart;
	private $mondayEnd;
	private $tuesdayStart;
	private $tuesdayEnd;
	private $wednesdayStart;
	private $wednesdayEnd;
	private $thursdayStart;
	private $thursdayEnd;
	private $fridayStart;
	private $fridayEnd;
	private $saturdayStart;
	private $saturdayEnd;
			
	//radio button (restaurant feature) variables
	private $african;
	private $alcoholMenu;
	private $american;
	private $buffet;
	private $casualDining;
	private $chinese;
	private $coffeehouse;
	private $fastFood;
	private $fineDining;
	private $french;
	private $indian;
	private $irish;
	private $italian;
	private $japanese;
	private $kidFriendly;
	private $korean;
	private $pub;
	private $tableTopCooking;
	private $vegan;
	
	
	/**
	* retrieve all the information about a given restaurant
	* @param email
	* @return restaurant obj
	*/
	function selectRestaurantInfo($email)
	{
		
	}
	
	
	/**
	* insert new information corresponding to a given restaurant into the database system
	* @return true on success, false otherwise
	*/
	function insertRestaurantInfo()
	{
		
	}
	
	//getter functions
	function getRestaurantName()
	{
		return $this->restaurantName;		
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
	
	function getSundayStart()
	{
		return $this->sundayStart;
	}
	
	function getSundayEnd()
	{
		return $this->sundayEnd;
	}
	
	function getMondayEnd()
	{
		return $this->mondayEnd;
	}
	
	function getTuesdayStart()
	{
		return $this->tuesdayStart;
	}
	
	function getTuesdayEnd()
	{
		return $this->tuesdayEnd;
	}
	
	function getWednesdayStart()
	{
		return $this->wednesdayEnd;
	}
	
	function getWednesdayEnd()
	{
		return $this->wednesdayEnd;
	}
	
	function getThursdayStart()
	{
		return $this->thursdayEnd;
	}
	
	function getThursdayEnd()
	{
		return $this->thursdayEnd;
	}
	
	function getFridayStart()
	{
		return $this->getFridayEnd;
	}
	
	function getSaturdayStart()
	{
		return $this->saturdayStart;
	}
	
	function getSaturdayEnd()
	{
		return $this->saturdayEnd;
	}
	
	function getAfrican()
	{
		return $this->african;
	}
	
	function getAlcoholMenu()
	{
		return $this->alcoholMenu;
	}
	
	function getAmerican()
	{
		return $this->american;
	}
	
	function getBuffet()
	{
		return $this->buffet;
	}
	
	function getCasualDining()
	{
		return $this->casualDining;
	}
	
	function getChinese()
	{
		return $this->chinese;
	}
	
	function getCoffeehouse()
	{
		return $this->coffeehouse;
	}
	
	function getFastFood()
	{
		return $this->fastFood;
	}
	
	function getFineDining()
	{
		return $this->fineDining;
	}
	
	function getFrench()
	{
		return $this->french;
	}
	
	function getIndian()
	{
		return $this->indian;
	}
	
	function getIrish()
	{
		return $this->irish;
	}
	
	function getItalian()
	{
		return $this->italian;
	}
	
	function getJapanese()
	{
		return $this->japanese;
	}
	
	function getKidFriendly()
	{
		return $this->kidFriendly;
	}
	
	function getKorean()
	{
		return $this->korean;
	}
	
	function getPub()
	{
		return $this->pub;
	}
	
	function getTableTopCooking()
	{
		return $this->tableTopCooking;
	}
	
	function getVegan()
	{
		return $this->vegan;
	}
	
	
	//setters
	
	function setRestaurantName($param)
	{
		$this->restaurantName = $param;	
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
	
	function setSundayStart($param)
	{
		$this-> = $param;	
	}
	
	function setSundayEnd($param)
	{
		$this-> = $param;	
	}
	
	function setMondayStart($param)
	{
		$this->mondayStart = $param;	
	}
	
	function setMondayEnd($param)
	{
		$this->mondayEnd = $param;	
	}
	
	function setTuesdayStart($param)
	{
		$this->tuesdayStart = $param;	
	}
	
	function setTuesdayEnd($param)
	{
		$this->tuesdayEnd = $param;	
	}
	
	function setWednesdayStart($param)
	{
		$this->setWednesdayStart = $param;	
	}
	
	function setWednesdayEnd($param)
	{
		$this->wednesdayEnd = $param;	
	}
	
	function setThursdayStart($param)
	{
		$this->thursdayStart = $param;	
	}
	
	function setThursdayEnd($param)
	{
		$this->thursdayEnd = $param;	
	}
	
	function setFridayStart($param)
	{
		$this->fridayStart = $param;	
	}
	
	function setFridayEnd($param)
	{
		$this->fridayEnd = $param;	
	}
	
	function setSaturdayStart($param)
	{
		$this->saturdayStart = $param;	
	}
	
	function setSaturdayEnd($param)
	{
		$this->saturdayEnd = $param;	
	}
	
	function setAfrican($param)
	{
		$this->african = $param;	
	}
	
	function setAlcoholMenu($param)
	{
		$this->alcoholMenu = $param;	
	}
	
	function setAmerican($param)
	{
		$this->american = $param;	
	}
	
	function setBuffet($param)
	{
		$this->buffet = $param;	
	}
	
	function setCasualDining($param)
	{
		$this->casualDining = $param;	
	}
	
	function setChinese($param)
	{
		$this->chinese = $param;	
	}
	
	function setCoffeeHouse($param)
	{
		$this->coffeehouse = $param;	
	}
	
	function setFastFood($param)
	{
		$this->fastFood = $param;	
	}
	
	function setFineDining($param)
	{
		$this->fineDining = $param;	
	}
	
	function setFrench($param)
	{
		$this->french = $param;	
	}
	
	function setIndian($param)
	{
		$this->indian = $param;	
	}
	
	function setIrish($param)
	{
		$this->irish = $param;	
	}
	
	function setItalian($param)
	{
		$this->italian = $param;	
	}
	
	function setJapanese($param)
	{
		$this->japanese = $param;	
	}
	
	function setKidFriendly($param)
	{
		$this->kidFriendly = $param;	
	}
	
	function setKorean($param)
	{
		$this->korean = $param;	
	}
	
	function setPub($param)
	{
		$this->pub = $param;	
	}
	
	function setTableTopCooking($param)
	{
		$this->tableTopCooking = $param;	
	}
	
	function setVegan($param)
	{
		$this->vegan = $param;	
	}
}