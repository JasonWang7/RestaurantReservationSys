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
			
			$restaurantObj = new restaurant;
			$hoursSelector = new businessHour;
			$sundayHoursObj = new businessHour;
			$mondayHoursObj = new businessHour;
			$tuesdayHoursObj = new businessHour;
			$wednesdayHoursObj = new businessHour;
			$thursdayHoursObj = new businessHour;
			$fridayHoursObj = new businessHour;
			$saturdayHoursObj = new businessHour;
			$id = $_GET["id"];
			$features = array("african", "alcoholMenu", "american", "buffet", "casualDining", 
			"chinese", "coffeehouse", "fastFood", "fineDining", "french", "indian", "irish",
			"italian", "japanese", "kidFriendly", "korean", "pub", "tableTopCooking", "vegan");
			$featureString = "";
			$result1 = 0;
			$result2 = 0;
			
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
			
			$result1 = $restaurantObj->updateRestaurantInfo($id);
			
			$sundayHoursObj->setRestaurantId($id);
			$sundayHoursObj->setDay("Sunday");
			$sundayHoursObj->setStartHour($_POST["sundayStart"]);
			$sundayHoursObj->setEndHour($_POST["sundayEnd"]);
			$mondayHoursObj->setRestaurantId($id);
			$mondayHoursObj->setDay("Monday");
			$mondayHoursObj->setStartHour($_POST["mondayStart"]);
			$mondayHoursObj->setEndHour($_POST["mondayEnd"]);
			$tuesdayHoursObj->setRestaurantId($id);
			$tuesdayHoursObj->setDay("Tuesday");
			$tuesdayHoursObj->setStartHour($_POST["tuesdayStart"]);
			$tuesdayHoursObj->setEndHour($_POST["tuesdayEnd"]);
			$wednesdayHoursObj->setRestaurantId($id);
			$wednesdayHoursObj->setDay("Wednesday");
			$wednesdayHoursObj->setStartHour($_POST["wednesdayStart"]);
			$wednesdayHoursObj->setEndHour($_POST["wednesdayEnd"]);
			$thursdayHoursObj->setRestaurantId($id);
			$thursdayHoursObj->setDay("Thursday");
			$thursdayHoursObj->setStartHour($_POST["thursdayStart"]);
			$thursdayHoursObj->setEndHour($_POST["thursdayEnd"]);
			$fridayHoursObj->setRestaurantId($id);
			$fridayHoursObj->setDay("Friday");
			$fridayHoursObj->setStartHour($_POST["fridayStart"]);
			$fridayHoursObj->setEndHour($_POST["fridayEnd"]);
			$saturdayHoursObj->setRestaurantId($id);
			$saturdayHoursObj->setDay("Saturday");
			$saturdayHoursObj->setStartHour($_POST["saturdayStart"]);
			$saturdayHoursObj->setEndHour($_POST["saturdayEnd"]);
			
			$result2 = $hoursSelector->removeHoursInfo($id);
			$result2 = $sundayHoursObj->insertHoursInfo();
			$result2 = $mondayHoursObj->insertHoursInfo();
			$result2 = $tuesdayHoursObj->insertHoursInfo();
			$result2 = $wednesdayHoursObj->insertHoursInfo();
			$result2 = $thursdayHoursObj->insertHoursInfo();
			$result2 = $fridayHoursObj->insertHoursInfo();
			$result2 = $saturdayHoursObj->insertHoursInfo();
			
			if (($result1 == 1) && ($result2 == 1))
			{
				echo "Successfully modified the given restaurant."?>
				<br><?php
				echo "The updated information can now be viewed.";
			}
			else
			{
				echo "An error has occurred while modifying the restaurant. \n";
				?> <br><br> <?php
				echo "\n Ensure that all the required fields are filled out.";
			}
		?>
		
		<br><br><br>
		<div id="back">
			&nbsp &nbsp &nbsp <a href="/RRS/view/account.php"><button type="button" value="back" height=35 width=100>Back</button>
		</div>
	</body>
</html>