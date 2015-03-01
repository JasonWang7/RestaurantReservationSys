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
	
	
	//getter methods
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
	
	
	//setter methods
	function setSundayStart($param)
	{
		$this->sundayStart = $param;	
	}
	
	function setSundayEnd($param)
	{
		$this->sundayEnd = $param;	
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
}
?>