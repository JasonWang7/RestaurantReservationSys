<?php
/******************************************************************************************
* File name: addRestaurantController.php
* Purpose: Stores all information pertaining to a given restaurant owner into a 
* database
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 26, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add an Owner (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			
			require_once($root.'model/restaurant.php');
			require_once($root.'model/owner.php');
			require_once($root.'model/restaurantOwnership.php');
			require_once($root.'model/user.php');
			session_start();
			$ownerObj = new owner; 
			$newOwnerObj = new owner;
			$ownershipObj = new restaurantOwnership;

			$ownerObj->setUserId($_SESSION["sess_user_id"]);
			$ownerObj->setBusinessNumber($_POST["businessNumber"]);
			$ownerObj->setBusinessPhone($_POST["businessPhone"]);
			$ownerObj->setVerified(1);
	
			$result = $ownerObj->insertOwner();

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