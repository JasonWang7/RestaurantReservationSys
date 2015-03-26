<?php
/******************************************************************************************
* File name: addRestaurantOwner.php
* Purpose: Provides an interface for adding ownership information for a given 
* restaurant
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 26, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Add Owner</title>
		
		<link rel="stylesheet" type="text/css" href="/RRS/css/addRestaurant.css">
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
				<h2 class="white">Add Ownership Information</h2>
			</div>
			
			<!--main content of page-->
			<div id="content">
			
				<form action="/RRS/controller/addOwnerController.php" method="post">
				
					<div id="instructions">
						<div id="instructionsText">
							<p>*** Fill out information pertaining to each restaurant ownership category then click "Submit"</p>
						</div>
					</div>
					
					<!--all components of page where user enters data-->
					<div id="input">
						
						<div id="businessNumber">
							<div id="businessNumberText">
								<h4 class="white">Restaurant Name</h4>
							</div>
							<input type="text" name="businessNumber" size=35 maxlength=35>
						</div>
						
						<div id="businessPhone">
							<div id="businessPhoneText">
								<h4 class="white">Restaurant Name</h4>
							</div>
							<input type="text" name="businessNumber" size=35 maxlength=35>
						</div>
						
						<!--buttons that user clicks on to submit, cancel or preview info-->
						<div id="buttons">
							<div id="submit">
								<input id="submitButton" type="submit" value="Submit"></input>	
							</div>
						</div>
					</div>
				</form>
			</div>	
			
			<div id="footer">
				<?php
					include 'include/footer.php';
				?>
			</div>
		</div>
	</body>
</html>