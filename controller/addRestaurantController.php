<?php
/******************************************************************************************
* File name: addRestaurantController.php
* Purpose: Stores all information pertaining to a given restaurant into a database
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 26, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add a Restaurant (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			require_once($root.'model/restaurant.php');
			require_once($root.'model/businessHour.php');
			
			$restaurantObj = new restaurant;
			$businessHourObj = new businessHour;
			$features = array("african", "alcoholMenu", "american", "buffet", "casualDining", 
			"chinese", "coffeehouse", "fastFood", "fineDining", "french", "indian", "irish",
			"italian", "japanese", "kidFriendly", "korean", "pub", "tableTopCooking", "vegan");
			$featureString = "";
			$i = 0;
			
			for($i; $i<19; $i++)
			{
				if (!empty($_POST[$features[$i]]))
				{
					$featureString = $features[$i]." ".$featureString;
				}
			}
			
			//text field variables
			$restaurantObj->setAddress($_POST["address"]);
			$restaurantObj->setType("");
			$restaurantObj->setRestaurantName($_POST["restaurantName"]);
			$restaurantObj->setEmail($_POST["email"]);
			$restaurantObj->setPhone($_POST["phone"]);
			$restaurantObj->setFeatures($featureString);
			$restaurantObj->setPriceRange($_POST["priceRange"]);
			$restaurantObj->setAbout($_POST["about"]);
			$restaurantObj->setWebsite($_POST["website"]);
			$restaurantObj->setHolidayHour("");
			$restaurantObj->setLikes("");
			$restaurantObj->setProfilePicture("");
			$restaurantObj->setVerified("");
			
			$result = $restaurantObj->insertRestaurantInfo();
			
			$businessHourObj->setSundayStart($_POST["sundayStart"]);
			$businessHourObj->setSundayEnd($_POST["sundayEnd"]);
			$businessHourObj->setMondayStart($_POST["mondayStart"]);
			$businessHourObj->setMondayEnd($_POST["mondayEnd"]);
			$businessHourObj->setTuesdayStart($_POST["tuesdayStart"]);
			$businessHourObj->setTuesdayEnd($_POST["tuesdayEnd"]);
			$businessHourObj->setWednesdayStart($_POST["wednesdayStart"]);
			$businessHourObj->setWednesdayEnd($_POST["wednesdayEnd"]);
			$businessHourObj->setThursdayStart($_POST["thursdayStart"]);
			$businessHourObj->setThursdayEnd($_POST["thursdayEnd"]);
			$businessHourObj->setFridayStart($_POST["fridayStart"]);
			$businessHourObj->setFridayEnd($_POST["fridayEnd"]);
			$businessHourObj->setSaturdayStart($_POST["saturdayStart"]);
			$businessHourObj->setSaturdayEnd($_POST["saturdayEnd"]);
		?>
	</body>
</html>