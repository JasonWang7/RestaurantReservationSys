<?php
/******************************************************************************************
* File name: deleteRestaurantController.php
* Purpose: Removes restaurant information from database corresponding to given 
* restaurant ID
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 29, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Delete Restaurant (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include_once($root.'model/restaurant.php');
			
			session_start();
		
			$restaurantId = $_SESSION["restaurantId"];
			$restaurantSelector = new restaurant;
			$result = 0;
			
			$result = $restaurantSelector->removeRestaurantInfo($restaurantId);
			
			if ($result == 1)
			{
				echo "Restaurant successfully deleted.";?>
				<br><br><?php
				echo "All information pertaining to the restaurant will be removed after refresh.";
			}
			else
			{
				echo "Unable to remove information about the given restaurant.";?>
				<br><br><?php
				echo "Please try again later then contact the admin if the error still occurs.";?>
				<br><br><?php
				echo "Sorry for any inconveniance.";
			}
		?>
		
		<br><br><br>
		
		<div id="close">
			<a href="JavaScript:window.close()"><button type="button" value="close" height=35 width=75>Dismiss</button>
		</div>
	</body>
</html>
