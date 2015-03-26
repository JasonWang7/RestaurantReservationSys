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
			
			require_once($root.'model/restaurant.php');
			require_once($root.'model/businessHour.php');
			require_once($root.'model/restaurantOwnership.php');
			require_once($root.'model/user.php');
			
			$restaurantObj = new restaurant;
			$newRestaurantObj = new restaurant;
			$sundayHoursObj = new businessHour;
			$mondayHoursObj = new businessHour;
			$tuesdayHoursObj = new businessHour;
			$wednesdayHoursObj = new businessHour;
			$thursdayHoursObj = new businessHour;
			$fridayHoursObj = new businessHour;
			$saturdayHoursObj = new businessHour;
			$userObj = new user;
			$newUserObj = new user;
			$restaurantOwnershipObj = new restaurantOwnership;
			$features = array("african", "alcoholMenu", "american", "buffet", "casualDining", 
			"chinese", "coffeehouse", "fastFood", "fineDining", "french", "indian", "irish",
			"italian", "japanese", "kidFriendly", "korean", "pub", "tableTopCooking", "vegan");
			$featureString = "";
			$i = 0;
			$result = 0;
			
			//add all strings of features into array
			for($i; $i<19; $i++)
			{
				if (!empty($_POST[$features[$i]]))
				{
					$featureString = $features[$i]." ".$featureString;
				}
			}
			
			//insert restaurant attributes into database
			$restaurantObj->setAddress($_POST["address"]);
			$restaurantObj->setType("");
			$restaurantObj->setRestaurantName($_POST["restaurantName"]);
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
			
			// insert restaurant hours into database if previous insert is successful
			if ($result == 1)
			{	
				//retrieve id of previously inserted restaurant
				$restaurantName = $restaurantObj->getRestaurantName();
				$newRestaurantObj = $restaurantObj->selectRestaurantInfo($restaurantName);
				
				//assign values to days-of-week objects
				$sundayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$sundayHoursObj->setDay("Sunday");
				$sundayHoursObj->setStartHour($_POST["sundayStart"]);
				$sundayHoursObj->setEndHour($_POST["sundayEnd"]);
				$mondayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$mondayHoursObj->setDay("Monday");
				$mondayHoursObj->setStartHour($_POST["mondayStart"]);
				$mondayHoursObj->setEndHour($_POST["mondayEnd"]);
				$tuesdayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$tuesdayHoursObj->setDay("Tuesday");
				$tuesdayHoursObj->setStartHour($_POST["tuesdayStart"]);
				$tuesdayHoursObj->setEndHour($_POST["tuesdayEnd"]);
				$wednesdayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$wednesdayHoursObj->setDay("Wednesday");
				$wednesdayHoursObj->setStartHour($_POST["wednesdayStart"]);
				$wednesdayHoursObj->setEndHour($_POST["wednesdayEnd"]);
				$thursdayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$thursdayHoursObj->setDay("Thursday");
				$thursdayHoursObj->setStartHour($_POST["thursdayStart"]);
				$thursdayHoursObj->setEndHour($_POST["thursdayEnd"]);
				$fridayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$fridayHoursObj->setDay("Friday");
				$fridayHoursObj->setStartHour($_POST["fridayStart"]);
				$fridayHoursObj->setEndHour($_POST["fridayEnd"]);
				$saturdayHoursObj->setRestaurantId($newRestaurantObj->getId());
				$saturdayHoursObj->setDay("Saturday");
				$saturdayHoursObj->setStartHour($_POST["saturdayStart"]);
				$saturdayHoursObj->setEndHour($_POST["saturdayEnd"]);
		
				//insert each day of week object info into database
				$result = $sundayHoursObj->insertHoursInfo();
				$result = $mondayHoursObj->insertHoursInfo();
				$result = $tuesdayHoursObj->insertHoursInfo();
				$result = $wednesdayHoursObj->insertHoursInfo();
				$result = $thursdayHoursObj->insertHoursInfo();
				$result = $fridayHoursObj->insertHoursInfo();
				$result = $saturdayHoursObj->insertHoursInfo();
				
				if ($result == 1)
				{
					echo "Successfully created new restaurant.\nIt can now be viewed on the home page."
				}
				else
				{
					echo "An error has occurred while creating the restaurant. \n";
					?> <br><br> <?php
					echo "\n Ensure that all the required fields are filled out.";
				}
			}	
			}
			else
			{
				echo "An error has occurred while creating the restaurant. \n";
				?> <br><br> <?php
				echo "\n Ensure that all the required fields are filled out.";
			}
			
			include $root.'/view/include/footer.php';
		?>
	</body>
</html>