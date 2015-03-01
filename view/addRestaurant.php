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
		
		<link rel="stylesheet" type="text/css" href="css/addRestaurant.css">
	</head>
	
	<body>
		<!-- container represents whole page -->
		<div id="container">
		
			<div id="header">
				<?php
					include 'include/header.php';
				?>
			</div>
			
			<!--title-->
			<div id="pageName">
				<h2 class="white">Add a Restaurant</h3>
			</div>
			
			<!--main content of page-->
			<div id="content">
				<form action="addRestaurantHandler.php" method="post">
				
					<div id="instructions">
						<p>***Fill out information pertaining to each restaurant category then click "Submit" when finished</p>
					</div>
				
					<!--all components of page where user enters data-->
					<div id="input">
					
						<div id="restaurantName">
							<h4 class="blue">Restaurant Name:</h4>
								<input type="text" name="restaurantName" size=35 maxlength=35>
						</div>
					
						<!--features of restaurant separated into radiobuttons-->
						<div id="features">
							<h4 class="blue">Features:</h4>
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
								Japanese <input type="radio" name="japanese"></input> &nbsp
								Kid Friendly <input type="radio" name="kidFriendly"> &nbsp <br>
								Korean <input type="radio" name="korean"></input> &nbsp
								Pub <input type="radio" name="pub"></input>&nbsp 
								Tabletop Cooking <input type="radio" name="tabletopCooking"></input> &nbsp
								Vegan <input type="radio" name="vegan"></input> &nbsp
						</div>
					
						<!--approximate price range of dining at restaurant-->
						<div id="priceRange">
							<h4 class="blue">Price Range:</h4>
							<input type="text" name="priceRange" size=25 maxlength=25></input>
						</div>
					
						<!--hours corresponding to each day of the week-->
						<div id="hours">
							<h4 class="blue">Hours:</h4>
						
							Sunday: &nbsp <input type="text" name="sundayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="sundayEnd" size=5 maxlength=4></input>
							<br><br>
							Monday: &nbsp <input type="text" name="mondayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="mondayEnd" size=5 maxlength=4></input>
							<br><br>
							Tuesday: &nbsp <input type="text" name="tuesdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="tuesdayEnd" size=5 maxlength=4></input>
							<br><br>
							Wednesday: &nbsp <input type="text" name="wednesdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="wednesdayEnd" size=5 maxlength=4></input>
							<br><br>
							Thursday: &nbsp <input type="text" name="thursdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="thursdayEnd" size=5 maxlength=4></input>
							<br><br>
							Friday: &nbsp <input type="text" name="fridayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="fridayEnd" size=5 maxlength=4></input>
							<br><br>
							Saturday: &nbsp <input type="text" name="saturdayStart" size=5 maxlength=4></input> &nbsp
							to &nbsp <input type="text" name="saturdayEnd" size=5 maxlength=4></input>					
						</div>	
				
						<div id="photos">
				
						</div>
				
						<div id="menu">
					
						</div>
				
						<div id="rate">
				
						</div>
				
						<!--Basic description of the restaurant-->
						<div id="about">
							<h4 class="blue">About:</h4>
							<textarea cols="65" rows="8" name="about"></textarea>
						</div>
				
						<!--link to restaurant website (if owner currently has one)-->
						<div id="website">
							<h4 class="blue">Website:</h4>
							<input type="text" name="website" size=50 maxlength=100></input>
						</div>		
					</div>
					
					<!--buttons that user clicks on to submit, cancel or preview info-->
					<div id="buttons">
						<div id="submit">
							<input id="submitButton" type="submit" value="Submit"></input>	
						</div>
					</div>
				</form>
			
			<div id="footer">
				<?php
					include 'include/footer.php';
				?>
			</div>
	</body>

</html>