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
			$sundayHoursObj = new businessHour;
			$mondayHoursObj = new businessHour;
			$tuesdayHoursObj = new businessHour;
			$wednesdayHoursObj = new businessHour;
			$thursdayHoursObj = new businessHour;
			$fridayHoursObj = new businessHour;
			$saturdayHoursObj = new businessHour;
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
			
			$sundayHourObj->setDay("Sunday");
			$sundayHourObj->setStartHour($_POST["sundayStart"]);
			$sundayHourObj->setEndHour($_POST["sundayEnd"]);
			$mondayHourObj->setDay("Monday");
			$mondayHourObj->setStartHour($_POST["mondayStart"]);
			$mondayHourObj->setEndHour($_POST["mondayEnd"]);
			$tuesdayHourObj->setDay("Tuesday");
			$tuesdayHourObj->setStartHour($_POST["tuesdayStart"]);
			$tuesdayHourObj->setEndHour($_POST["tuesdayEnd"]);
			$wednesdayHourObj->setDay("Wednesday");
			$wednesdayHourObj->setStartHour($_POST["wednesdayStart"]);
			$wednesdayHourObj->setEndHour($_POST["wednesdayEnd"]);
			$thursdayHourObj->setDay("Thursday");
			$thursdayHourObj->setStartHour($_POST["thursdayStart"]);
			$thursdayHourObj->setEndHour($_POST["thursdayEnd"]);
			$fridayHourObj->setDay("Friday");
			$fridayHourObj->setStartHour($_POST["fridayStart"]);
			$fridayHourObj->setEndHour($_POST["fridayEnd"]);
			$saturdayHourObj->setDay("Saturday");
			$saturdayHourObj->setStartHour($_POST["saturdayStart"]);
			$saturdayHourObj->setEndHour($_POST["saturdayEnd"]);
		?>
	</body>
</html>