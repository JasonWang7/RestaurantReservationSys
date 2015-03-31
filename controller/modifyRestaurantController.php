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
			$result = 0;

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
			
			$result = $restaurantObj->updateRestaurantInfo($_GET["id"]);
			
			$result = $sundayHoursObj->updateHoursInfo($_GET["id"]);
			$result = $mondayHoursObj->updateHoursInfo($_GET["id"]);
			$result = $tuesdayHoursObj->updateHoursInfo($_GET["id"]);
			$result = $wednesdayHoursObj->updateHoursInfo($_GET["id"]);
			$result = $thursdayHoursObj->updateHoursInfo($_GET["id"]);
			$result = $fridayHoursObj->updateHoursInfo($_GET["id"]);
			$result = $saturdayHoursObj->updateHoursInfo($_GET["id"]);
			
			if ($result == 1)
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
			&nbsp &nbsp &nbsp &nbsp <a class="btn btn-warning" href="/RRS/view/account.php">
		</div>
	</body>
</html>