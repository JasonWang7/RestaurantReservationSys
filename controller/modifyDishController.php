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
		<title>Modify Dishes (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include $root.'/view/include/header.php';
			
			require_once($root.'model/signatureDish.php');
			
			$dishSelector = new signatureDish;
			$restaurantId = $_POST["id"];
			
			$upperBound = (count($_POST)/3) -1;
			
			$result1 = $dishSelector->removeDishInfo($restaurantId);
			
			for ($i = 0; $i < $upperBound; $i++)
			{
				$dishObj = new signatureDish;
				
				$dishObj->setRestaurantId($restaurantId);
				$dishObj->setDishName($_POST["dishName" . ($i+1)]); 
				$dishObj->setPrice($_POST["price" . ($i+1)]);
				$dishObj->setRating($_POST["rating" . ($i+1)]);
				
				$result2 = $dishObj->insertDishInfo();
			}

			if (($result1 == 1) && ($result2 == 1))
			{
				echo "Any changes will be updated upon refresh."; ?>
				<br><br> <?php
			}
			
			else
			{
				echo "An error has occurred while editing the dishes. \n";
				?> <br><br> <?php
				echo "\n Please make sure that you have entered valid ratings.";
			}
		?>
		
		<br><br><br>
		<div id="back">
			&nbsp &nbsp &nbsp <a href="/RRS/account"><button type="button" value="back" height=35 width=100>Back</button>
		</div>
	</body>
</html>