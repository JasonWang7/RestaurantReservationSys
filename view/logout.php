<?php 
session_start();
if (isset($_SESSION['sess_username'])) {
   session_destroy();
   echo "<br> you are logged out successfully!";
} 
   echo "<br/><a href='logintest.php'>login</a>";
 ?>