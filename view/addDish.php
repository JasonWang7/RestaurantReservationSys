<?php
/******************************************************************************************
* File name: addDish.php
* Purpose: Acts as interface for adding new signature dish on a given restaurant's 
* menu
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: April 10, 2015
******************************************************************************************/
?>

<html>

	<head>
		<title>Add Dish</title>
		
		<link rel="stylesheet" type="text/css" href="/RRS/css/addDish.css">
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
				<h2 class="white">Add a Dish</h2>
			</div>
			
			<div id="instructions">
				<div id="instructionsText">
					<p>*** Fill out information pertaining to each dish category then click "Submit"</p>
				</div>
			</div>
			
			<!--main content of page-->
			<div id="content" style="background-color:#fff;">
				<form action="/RRS/addDishController?id=<?php echo $_GET["id"] ?>" method="post">
				
					<!--all components of page where user enters data-->
					<div id="input">
						<div id="name">
							<div id="nameText">
								<h4 class="white">Name</h4>
							</div>
							<input type="text" name="name" size=35 maxlength=35>
						</div>
						
						<div id="price">
							<div id="priceText">
								<h4 class="white">Price</h4>
							</div>
							<input type="text" name="pricee" size=35 maxlength=35>
						</div>
					</div>
					
					<!--buttons that user clicks on to submit, cancel or preview info-->
					<div id="buttons">
						<div id="submit">
							<input id="submitButton" type="submit" value="Submit"></input>	
						</div>
					</div>
					
					<div id="footer">
						<?php
							include 'include/footer.php';
						?>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
			
			