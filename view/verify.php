<!--
    Author: Vince,jinhai wang
-->
<?php 
	ob_start();
	$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
  	include("include/header.php");
  	include($root.'model/user.php'); 
	$userobj = new user;
	$activationcode="";
	if(isset($_POST['call_parts'])){
		if($_POST['call_parts']>1&&$_POST['call_parts'][1]!=""){
			$activationcode = $_POST['call_parts'][1];
			$isexist = $userobj->checkActivationCode($activationcode);
			if($isexist){
				$userobj->activateUser($activationcode);
			}
			else{
				//go back to home
				header('Location: /RRS/');				
			}
		}
		else{
			//go back to home
			header('Location: /RRS/');
		}
	}
	else{
		//go back to home
		header('Location: /RRS/');
	}
	
?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <h1>Your account has been activated.</h1>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>
<?php
ob_end_flush();
?>