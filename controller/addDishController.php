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

			
			if ($result == 1)
			{	
				echo "Successfully added dish to the given restaurant.\n";
				echo "New dish information will be viewable upon page refresh.";
				?>
					
				<div id="Dismiss">
					<br><br>
					<a href="JavaScript:window.close()">Close</a>
				</div>
				
				<?php
			}
			
			else
			{
				echo "An error has occurred while adding the dish information. \n";
				?> <br><br> <?php
				echo "\n Ensure that all the required fields are filled out correctly.";
			}
		?>
	</body>
</html>