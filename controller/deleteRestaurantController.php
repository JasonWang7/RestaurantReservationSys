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
		
		<?php
			session_start();
		
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			
			include_once($root.'model/restaurantOwnership.php');
			include_once($root.'model/owner.php');
			include_once($root.'model/businessHour.php');
			include_once($root.'model/restaurant.php');
		?>
	</head>
	
	<body>
		<?php
			$restaurantId = $_SESSION["restaurantId"];
			$ownershipObj = new restaurantOwnership;
			$ownershipSelector = new restaurantOwnership;
			$ownerSelector = new owner;
			$businessHourSelector = new businessHour;
			$restaurantSelector = new restaurant;
			$result = 0;
			$ownerId = -1;

			$ownershipObj = $ownershipSelector->selectRestaurantOwnership($restaurantId);
			$ownerId = $ownershipObj->getOwnerId();
			
			$result = $ownershipSelector->removeOwnershipInfo($restaurantId);
			$result = $ownerSelector->removeOwnerInfo($ownerId);
			$result = $businessHourSelector->removeHoursInfo($restaurantId);
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
