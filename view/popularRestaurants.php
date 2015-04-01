<?php
/******************************************************************************************
* File name: popularRestaurants.php
* Purpose: Displays the current popular restaurants as a list
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 30, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Popular Restaurants</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include $root.'/view/include/header.php';
			
			require_once($root.'model/reservation.php');
			require_once($root.'model/restaurant.php');
			
			$reservationSelector = new Reservation;
			$restaurantSelector = new restaurant;
			$sortedIdList = array();
			$restaurantIdList = $reservationSelector->selectOrderedIdCount();
			
			$idCount = count($restaurantIdList);
			$upperBound = $idCount - 1;

			//sort Ids by Id count
			for ($a = 0; $a < $upperBound; $a = $a + 1)
			{
				for ($i = 0; $i < $upperBound; $i = $i + 1)
				{
					if ($restaurantIdList[$i+1][1] > $restaurantIdList[$i][1])
					{
						$temp = $restaurantIdList[$i+1][0];
						$restaurantIdList[$i+1][0] = $restaurantIdList[$i][0];
						$restaurantIdList[$i][0] = $temp;
						
						$temp = $restaurantIdList[$i+1][1];
						$restaurantIdList[$i+1][1] = $restaurantIdList[$i][1];
						$restaurantIdList[$i][1] = $temp;
					}
				}
			}?>
		
		<div id="message">
			<h3>Popular Restaurants</h3>
			<br><br>
			<p>Displaying restaurants in order from most popular to least popular:</p>
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
		
			//display restaurants in order from highest Id count to lowest
			//insert sorted Id counts into array
			for ($i = 0; $i < $idCount; $i = $i + 1)
			{
				$restaurantObj = new restaurant;
				$restaurantObj = $restaurantSelector->selectRestaurantInfoById($restaurantIdList[$i][0]);
				
				echo '<tr>' . '<td>' . $restaurantObj->getId() . '</td><td><a href="/RRS/profile?id=' . $restaurantObj->getId() 
					. '">'. $restaurantObj->getRestaurantName() .'</td><td>' .  $restaurantObj->getFeatures() . "</td><td>" 
					.  $restaurantObj->getPriceRange() . '</td></tr>';
			}
		?>
		
				</tbody>
			</table> 
		</div>
			
		<?php include($root."view/include/footer.php"); ?>
	</body>
</html>