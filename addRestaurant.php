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
		<title>
			Add Restaurant
		</title>
		
		<link rel="stylesheet" type="text/css" href="addRestaurant.css">
	</head>
	
	<body>
		<div id="container">
		
			<div id="header">
				<?php
					include 'include/header.php';
				?>
			</div>
			
			<div id="pageName">
				<br>
				<h2 class="white">Add a Restaurant</h3>
			</div>
			
			<div id="content">
				
				<div id="description">
				
					<div id="restaurantName">
						<br><br><br>
						<h4>Restaurant Name:</h4>
						<form>
							<input type="text" name="restaurantName" size=35 maxlength=35>
						</form>
						<br>
					</div>
					
					<div id="features">
						<h4>Features:</h4>
						<form>
							African <input type="radio" name="african"></input> &nbsp
							Alcohol Menu <input type="radio" name="alcoholMenu"></input> &nbsp
							American <input type="radio" name="american"></input> &nbsp
							Buffet <input type="radio" name="buffet"></input> &nbsp
							Casual Dining <input type="radio" name="casualDining"></input> &nbsp <br>
							Chinese <input type="radio" name="chinese"></input> &nbsp
							Coffeehouse <input type="radio" name="coffeehouse"></input> &nbsp
							Fast Food <input type="radio" name="fastFood"></input> &nbsp
							Fine Dining <input type="radio" name="fineDining"></input> &nbsp
							French <input type="radio" name="french"></input> &nbsp <br>
							Indian <input type="radio" name="indian"></input> &nbsp 
							Irish <input type="radio" name="irish"></input> &nbsp
							Italian <input type="radio" name="italian"></input> &nbsp 
							Japanese <input type="radio" name="japenese"></input> &nbsp
							Kid Friendly <input type="radio" name="kidFriendly"> &nbsp <br>
							Korean <input type="radio" name="korean"></input> &nbsp
							Pub <input type="radio" name="pub"></input>&nbsp 
							Tabletop Cooking <input type="radio" name="tabletopCooking"></input> &nbsp
							Vegan <input type="radio" name="vegan"></input> &nbsp
						</form>
						<br>
					</div>
					
					<div id="priceRange">
						<h4>Price Range:</h4>
						<form>
							<input type="text" name="priceRange" size=25 maxlength=25></input>
						</form>
						<br>
					</div>
					
					<div id="hours">
						<h4>Hours:</h4>
						<form>
							Sunday: &nbsp <input type="text" name="sundayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="sundayEnd" size=5 maxlength=4></input>
						</form>
						
						<form>
							Monday: &nbsp <input type="text" name="mondayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="mondayEnd" size=5 maxlength=4></input>
						</form>
						
						<form>
							Tuesday: &nbsp <input type="text" name="tuesdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="tuesdayEnd" size=5 maxlength=4></input>
						</form>
						
						<form>
							Wednesday: &nbsp <input type="text" name="wednesdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="wednesdayEnd" size=5 maxlength=4></input>
						</form>
						
						<form>
							Thursday: &nbsp <input type="text" name="thursdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="thursdayEnd" size=5 maxlength=4></input>
						</form>
						
						<form>
							Friday: &nbsp <input type="text" name="fridayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="fridayEnd" size=5 maxlength=4></input>
						</form>
						
						<form>
							Saturday: &nbsp <input type="text" name="saturdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="saturdayEnd" size=5 maxlength=4></input>
						</form>
						<br>
					</div>
					
				</div>
				
				<div id="photos">
				
				</div>
				
				<div id="menu">
					
				</div>
				
				<div id="rate">
				
				</div>
				
				<div id="about">
					<h4>About:</h4>
					<form>
						<textarea cols="65" rows="8" name="about"></textarea>
					</form>
					<br>
				</div>
				
				<div id="website">
					<h4>Website:</h4>
					<form>
						<input type="text" name="website" size=50 maxlength=100></input>
					</form>
					<br>
				</div>
				
			</div>
			
			<div id="mainButtons">
				<br>
				<form>
					<input type="submit" value="Submit"></input>
				</form>
			</div>
			
			<div id="footer">
				<?php
					include 'include/footer.php';
				?>
			</div>
	</body>

</html>
	