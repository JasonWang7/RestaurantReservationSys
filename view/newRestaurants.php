<?php
/******************************************************************************************
* File name: newRestaurants.php
* Purpose: Displays the current new restaurants as a list
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 31, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>New Restaurants</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include $root.'/view/include/header.php';
			
			require_once($root.'model/reservation.php');
			require_once($root.'model/restaurant.php');
			
			$restaurantSelector = new restaurant;
			$restaurantList = $restaurantSelector->selectAllRestaurants();
			
			$idCount = count($restaurantList);
			?>
		
		<div id="message">
			<h3>New Restaurants</h3>
			<br><br>
			<p>Displaying all restaurants in order from newest to oldest:</p>
			<br>
		</div>
			
		<div class="row">
			<table class="table table-striped table-hover ">
				<thead>
					<tr>
						<th>#</th>
						<th>Cusine</th>
						<th>Features</th>
						<th>Cost</th>
					</tr>
				</thead>
				<tbody>
				
		<?php
		$upperBound = $idCount-1;
		
			//display restaurants in order from highest Id count to lowest
			//insert sorted Id counts into array
			for ($i = $upperBound; $i >= 0; $i = $i - 1)
			{	
				echo '<tr>' . '<td>' . $restaurantList[$i][0] . '</td><td><a href="/RRS/profile?id=' . $restaurantList[$i][0]
					. '">'. $restaurantList[$i][3] .'</td><td>' .  $restaurantList[$i][6] . "</td><td>" 
					.  $restaurantList[$i][7] . '</td></tr>';
			}
		?>
		
				</tbody>
			</table> 
		</div>
			
		<?php include($root."view/include/footer.php"); ?>
	</body>
</html>