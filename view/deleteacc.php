<!-- Vincent Tieu, Jinhai Wang created this page -->
<?php 
  $root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
  include("include/header.php");
  include($root.'model/user.php');
  include($root.'model/creditcard.php'); 
  if(isset($_GET["delete"])){

  	  $userinfo = new user;
	  $isdelted = $userinfo->deleteUser($_SESSION['sess_user_id']);
	  $cardinfo = new creditcard;
	  $creditcarddelte = $cardinfo->deleteCreditCard($_SESSION['sess_user_id']);
	  
	  if (isset($_SESSION['sess_username'])) {
		   session_destroy();
		   header('Location: /RRS/');
	  } 
  }
  
  


?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h2>Are you sure you want to delete your account?</h2>
      <p>Please proceed by clicking Delete or closing the window to Cancel..</p>
      <p><a class="btn btn-primary btn-lg" href ="deleteacc?delete=true">Delete Account</a></p>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>