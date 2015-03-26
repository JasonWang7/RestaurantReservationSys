<?php
/******************************************************************************************
* File name: addRestaurantController.php
* Purpose: Stores all information pertaining to a given restaurant owner into a 
* database
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 26, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add an Owner (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include $root.'/view/include/header.php';
			
			require_once($root.'model/restaurant.php');
			require_once($root.'model/businessHour.php');
			require_once($root.'model/restaurantOwnership.php');
			require_once($root.'model/user.php');
			
			//
			
			include $root.'/view/include/footer.php';
		?>
	</body>
</html>