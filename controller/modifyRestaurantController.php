<?php
/******************************************************************************************
* File name: modifyRestaurantController.php
* Purpose: Modifies restaurant information edited by user
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 28, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Modify Restaurant (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include $root.'/view/include/header.php';
			
			require_once($root.'model/restaurant.php');
			require_once($root.'model/businessHour.php');
			require_once($root.'model/restaurantOwnership.php');
			
			$restaurantObj = new restaurant;
			$sundayHoursObj = new businessHour;
			$mondayHoursObj = new businessHour;
			$tuesdayHoursObj = new businessHour;
			$wednesdayHoursObj = new businessHour;
			$thursdayHoursObj = new businessHour;
			$fridayHoursObj = new businessHour;
			$saturdayHoursObj = new businessHour;
			$ownerObj = new owner;
			$restaurantOwnershipObj = new restaurantOwnership;
			$features = array("african", "alcoholMenu", "american", "buffet", "casualDining", 
			"chinese", "coffeehouse", "fastFood", "fineDining", "french", "indian", "irish",
			"italian", "japanese", "kidFriendly", "korean", "pub", "tableTopCooking", "vegan");
			$featureString = "";
			$result = 0;
			$restaurantName = $_POST["restaurantName"];
			
			/* remove current information about given restaurant */
			
			
			/* Add new information into database */
			//add all strings of features into array
			for($i; $i<19; $i++)
			{
				if (!empty($_POST[$features[$i]]))
				{
					$featureString = $features[$i]." ".$featureString;
				}
			}
			
			$restaurantObj->setAddress($_POST["address"]);
			$restaurantObj->setType("");
			$restaurantObj->setRestaurantName($restaurantName);
			$restaurantObj->setEmail($_POST["email"]);
			$restaurantObj->setPhone($_POST["phone"]);
			$restaurantObj->setFeatures($featureString);
			$restaurantObj->setPriceRange($_POST["priceRange"]);
			$restaurantObj->setAbout($_POST["about"]);
			$restaurantObj->setWebsite($_POST["website"]);
			$restaurantObj->setHolidayHours("");
			$restaurantObj->setLikes("");
			$restaurantObj->setProfilePicture("");
			$restaurantObj->setVerified("");
			
			$result = $restaurantObj->insertRestaurantInfo();
		?>
	</body>
</html>