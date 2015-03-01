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

class restaurant{
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
	
	function saturdayEnd()
	{
		return $this->saturdayEnd;
	}
}