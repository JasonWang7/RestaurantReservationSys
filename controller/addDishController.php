<?php
/******************************************************************************************
* File name: addDishController.php
* Purpose: Stores all information pertaining to a given signature dish
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: April 11, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add a Dish (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			
			require_once($root.'model/signatureDish.php');
			session_start();
			$dishObj = new signatureDish;

			$dishObj->setRestaurantId($_GET["id"]);
			$dishObj->setDishName($_POST["name"]);
			$dishObj->setPrice($_POST["price"]);
			$dishObj->setRating("");
	
			$result = $dishObj->insertDishInfo();

			//get ownerObj back for id value
			$newOwnerObj = $ownerObj->selectOwnerInfo($_SESSION["sess_user_id"], $_POST["businessNumber"]);
			
			if ($result == 1)
			{
				$ownershipObj->setOwnerId($newOwnerObj->getOwnerId());
				$ownershipObj->setRestaurantId($_SESSION["restaurantId"]);
				$ownershipObj->setVerified(1);
				
				$result = $ownershipObj->insertRestaurantOwnership();
				
				if ($result == 1)
				{
					echo "Successfully added ownership information for the given restaurant.\n";
					echo "Indicated ownership will be viewable upon page refresh.";
					?>
					
					<div id="Dismiss">
						<br><br>
						<a href="JavaScript:window.close()">Close</a>
					</div>
					<?php
				}
			}
			else
			{
				echo "An error has occurred while adding the ownership information. \n";
				?> <br><br> <?php
				echo "\n Ensure that all the required fields are filled out correctly.";
			}
		?>
	</body>
</html>