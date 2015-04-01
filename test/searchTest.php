<?php
	$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';		
	require_once($root.'model/restaurant.php');
	
	$selector = new restaurant;
	$restaurantList = $selector->selectMatchingRestaurants("kink");
	
	print_r($restaurantList);
?>