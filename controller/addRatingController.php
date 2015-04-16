<?php
/******************************************************************************************
* File name: addRatingController.php
* Purpose: Adds information corresponding to a user's rating to the database
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: April 14, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add Rating (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include $root.'/view/include/header.php';
			
			require_once($root.'model/signatureDish.php');
			
			$dishSelector = new signatureDish;
			$restaurantId = $_POST["restaurantId"];

			$upperBound = (count($_POST))/4;
			
			$result1 = $dishSelector->removeDishInfo($restaurantId);
			
			for ($i = 1; $i <= $upperBound; $i++)
			{
				$oldRating = $_POST["oldRating" . $i];
				
				$dishObj = new signatureDish;
				
				$dishObj->setRestaurantId($restaurantId);
				$dishObj->setDishName($_POST["dishName" . $i]); 
				$dishObj->setPrice($_POST["price" . $i]);
				
				$newRating = $_POST["rating" . $i];
				
				if ((intval($newRating) >= 1) && (intval($newRating) <= 5))
				{
					$dishObj->setRating($newRating);
				}
				else
				{
					$dishObj->setRating($oldRating);
				}
					
				$result2 = $dishObj->insertDishInfo();
			}
			
			if (($result1 == 1) && ($result2 == 1))
			{
				echo "Your ratings have been added.";?>
				<br><br>
				<?php echo "Thank you for your vote.";	
			}
			
			else
			{
				echo "Unable to add new rating at this time.";?>
				<br><br>
				<?php echo "Please try again later.";	
			}
		?>
		
		<br><br><br>
		<div id="back">
			&nbsp &nbsp &nbsp <a href="/RRS/"><button type="button" value="back" height=35 width=100>Back</button>
		</div>
	</body>
</html>