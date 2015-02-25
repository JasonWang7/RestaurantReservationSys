<?php
/******************************************************************************************
* File name: addRestaurant.php
* Purpose: Acts as interface for adding new restaurant that can be reserved
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: February 24, 2015
******************************************************************************************/
?>

<html>

	<head>
		<title>Add Restaurant</title>
	</head>
	
	<body>
		<div id="container">
		
			<div id="header">
				<?php
					include 'include/header.php';
				?>
			</div>
			
			<div id="content">
			
				<div id="description">
				
					<div id="restaurantName">
						<h4>Restaurant Name:</h4>
						<form>
							<input type="text" name="restaurantName" size=35 maxlength=35>
						</form>
						<br>
					</div>
					
					<div id="features">
						<h4>Features:</h4>
						<form>
							African:<input type="radio" name="African"> &nbsp
							Alcohol Menu:<input type="radio" name="Alcohol Menu"> &nbsp
							American:<input type="radio" name="American"> &nbsp
							Buffet:<input type="radio" name="Buffet"> &nbsp
							Casual Dining:<input type="radio" name="Casual Dining"> &nbsp <br>
							Chinese:<input type="radio" name="Chinese"> &nbsp
							Coffeehouse:<input type="radio" name="Coffeehouse"> &nbsp
							Fast Food:<input type="radio" name="Fast Food"> &nbsp
							Fine Dining:<input type="radio" name="Fine Dining"> &nbsp
							Indian:<input type="radio" name="Indian"> &nbsp <br>
							Irish:<input type="radio" name="Irish"> &nbsp
							Italian:<input type="radio" name="Italian"> &nbsp 
							Kid Friendly:<input type="radio" name="kidFriendly"> &nbsp
							Korean:<input type="radio" name="Korean"> &nbsp
							Pub:<input type="radio" name="Pub"> &nbsp <br>
							Tabletop Cooking:<input type="radio" name="Tabletop Cooking"> &nbsp
							Vegan:<input type="radio" name="Vegan"> &nbsp
						</form>
						<br>
					</div>
					
					<div id="priceRange">
						<h4>Price Range:</h4>
						<form>
							<input type="text" name="priceRange" size=25 maxlength=25>
						</form>
						<br>
					</div>
					
					<div id="hours">
						<h4>Hours:</h4>
						<form>
							Sunday: &nbsp <input type="text" name="sundayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="sundayEnd" size=5 maxlength=4>
						</form>
						
						<form>
							Monday: &nbsp <input type="text" name="mondayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="mondayEnd" size=5 maxlength=4>
						</form>
						
						<form>
							Tuesday: &nbsp <input type="text" name="tuesdayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="tuesdayEnd" size=5 maxlength=4>
						</form>
						
						<form>
							Wednesday: &nbsp <input type="text" name="wednesdayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="wednesdayEnd" size=5 maxlength=4>
						</form>
						
						<form>
							Thursday: &nbsp <input type="text" name="thursdayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="thursdayEnd" size=5 maxlength=4>
						</form>
						
						<form>
							Friday: &nbsp <input type="text" name="fridayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="fridayEnd" size=5 maxlength=4>
						</form>
						
						<form>
							Saturday: &nbsp <input type="text" name="saturdayStart" size=5 maxlength=4> &nbsp
							to &nbsp <input type="text" name="saturdayEnd" size=5 maxlength=4>
						</form>
					</div>
					
				</div>
				
				<div id="photos">
				
				</div>
				
				<div id="menu">
				
				</div>
				
				<div id="rate">
				
				</div>
				
				<div id="about">
				
				</div>
				
				<div id="website">
				
				</div>
				
			</div>
			
			<div id="mainButtons">
			
			</div>
			
			<div id="footer">
				<?php
					include 'include/footer.php';
				?>
			</div>
	</body>

</html>
	