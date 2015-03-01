<?php
/******************************************************************************************
* File name: addRestaurantHandler.php
* Purpose: 
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 26, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add a Restaurant (Handler)</title>
	</head>
	
	<body>
		<?php
			//text field variables
			$restaurantName = $_POST["restaurantName"];
			$priceRange = $_POST["priceRange"];
			$about = $_POST["about"];
			$website = $_POST["website"];
			$sundayStart = $_POST["sundayStart"];
			$sundayEnd = $_POST["sundayEnd"];
			$mondayStart = $_POST["mondayStart"];
			$mondayEnd = $_POST["mondayEnd"];
			$tuesdayStart = $_POST["tuesdayStart"];
			$tuesdayEnd = $_POST["tuesdayEnd"];
			$wednesdayStart = $_POST["wednesdayStart"];
			$wednesdayEnd = $_POST["wednesdayEnd"];
			$thursdayStart = $_POST["thursdayStart"];
			$thursdayEnd = $_POST["thursdayEnd"];
			$fridayStart = $_POST["fridayStart"];
			$fridayEnd = $_POST["fridayEnd"];
			$saturdayStart = $_POST["saturdayStart"];
			$saturdayEnd = $_POST["saturdayEnd"];
			
			//radio button (restaurant feature) variables
			$african = $_POST["african"];
			$alcoholMenu = $_POST["alcoholMenu"];
			$american = $_POST["american"];
			$buffet = $_POST["buffet"];
			$casualDining = $_POST["casualDining"];
			$chinese = $_POST["chinese"];
			$coffeehouse = $_POST["coffeehouse"];
			$fastFood = $_POST["fastFood"];
			$fineDining = $_POST["fineDining"];
			$french = $_POST["french"];
			$indian = $_POST["indian"];
			$irish = $_POST["irish"];
			$italian = $_POST["italian"];
			$japanese = $_POST["japanese"];
			$kidFriendly = $_POST["kidFriendly"];
			$korean = $_POST["korean"];
			$pub = $_POST["pub"];
			$tableTopCooking = $_POST["tableTopCooking"];
			$vegan = $_POST["vegan"];
		?>
	</body>
</html>