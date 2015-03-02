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
			include $root.'/view/include/header.php';

			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			require_once($root.'model/restaurant.php');
			require_once($root.'model/businessHour.php');
			
			$restaurantObj = new restaurant;
			$finalRestaurantObj = new restaurant;
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
			
			if ($result == true)
			{
				$restaurantInfo = restaurant::selectRestaurantInfo($restaurantObj->getRestaurantId());
				
				echo "The restaurant has successfully been created";
			}
			
			else
			{
				
			}
			
			$sundayHoursObj->setDay("Sunday");
			$sundayHoursObj->setStartHour($_POST["sundayStart"]);
			$sundayHoursObj->setEndHour($_POST["sundayEnd"]);
			$mondayHoursObj->setDay("Monday");
			$mondayHoursObj->setStartHour($_POST["mondayStart"]);
			$mondayHoursObj->setEndHour($_POST["mondayEnd"]);
			$tuesdayHoursObj->setDay("Tuesday");
			$tuesdayHoursObj->setStartHour($_POST["tuesdayStart"]);
			$tuesdayHoursObj->setEndHour($_POST["tuesdayEnd"]);
			$wednesdayHoursObj->setDay("Wednesday");
			$wednesdayHoursObj->setStartHour($_POST["wednesdayStart"]);
			$wednesdayHoursObj->setEndHour($_POST["wednesdayEnd"]);
			$thursdayHoursObj->setDay("Thursday");
			$thursdayHoursObj->setStartHour($_POST["thursdayStart"]);
			$thursdayHoursObj->setEndHour($_POST["thursdayEnd"]);
			$fridayHoursObj->setDay("Friday");
			$fridayHoursObj->setStartHour($_POST["fridayStart"]);
			$fridayHoursObj->setEndHour($_POST["fridayEnd"]);
			$saturdayHoursObj->setDay("Saturday");
			$saturdayHoursObj->setStartHour($_POST["saturdayStart"]);
			$saturdayHoursObj->setEndHour($_POST["saturdayEnd"]);
		?>
	</body>
</html>