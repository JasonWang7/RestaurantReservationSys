<?php
/******************************************************************************************
* File name: deletePrompt.php
* Purpose: Displays a confirmation as to whether the user is certain they want to 
* delete the given restaurant
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 28, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Confirm Deletion</title>
	</head>
	
	</body>
		<div id="question">
			<br>
			
			<?php
				$id = $_GET['id'];
			
				echo "Are you sure you want to delete" . $id . "?";
			?>
		</div>
		
		<form action="/RRS/controller/addRestaurantController.php" method="post">
			<br><br>
			
			<div id = "buttons">
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <button type="submit" value="Yes" height=35 width=75>Yes</button>
				&nbsp &nbsp &nbsp &nbsp
				
				<a href="JavaScript:window.close()"><button type="button" value="No" height=35 width=75>No</button>
			</div>
		</form>
	</body>
</html>