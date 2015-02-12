<html lang="en">
	<head>
		
		<title>
			Restaurant Reservation
		</title>
	</head>
	<body>
			<?php session_start(); ?>
            
            <?php
	            if(isset($_SESSION['sess_username'])){
	            	echo "<h2>Welcome ".$_SESSION['sess_username'].'!</h2>';
				    echo "you logged in as ", $_SESSION['sess_username'];
				    echo "<br/><a href='logout.php'>logout</a>";
				}
				else{
					echo 'Welcome!';
					echo "<br/><a href='logintest.php'>login</a>";
					echo "<br/><a href='register.php'>sign up</a>";
				}
			?>
	</body>
</html>