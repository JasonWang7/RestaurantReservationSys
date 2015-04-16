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
			$dishObj = new signatureDish;
			$restaurantId = $_GET["id"];
			
			echo $_POST["dishName2"];
			
			/*
			$dishObj->setDishName($_POST["dishName"]);
			$dishObj->setPrice($_POST["price"]);

			if (($result1 == 1) && ($result2 == 1))
			{
				echo "Any changes will be updated upon refresh."; ?>
				<br><br> <?php
			}
			
			else
			{
				echo "An error has occurred while editing the dishes. \n";
				?> <br><br> <?php
				echo "\n Please try again.";
			}*/
		?>
		
		<br><br><br>
		<div id="back">
			&nbsp &nbsp &nbsp <a href="/RRS/account"><button type="button" value="back" height=35 width=100>Back</button>
		</div>
	</body>
</html>