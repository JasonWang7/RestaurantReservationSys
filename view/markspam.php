<!-- Jinhai Wang created this page -->
<?php 
ob_start();
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include("include/header.php");
include($root.'model/spam.php');
if(isset($_GET["id"])&&isset($_GET["mark"])){
	$spamobj = new spam;
	$spamobj->setReviewId($_GET["id"]);
	$spamobj->setUserId($_SESSION['sess_user_id']);
	$result = $spamobj->retrieveVoteSpam();
	//echo '<pre>'.print_r($spamobj, true).'</pre>'; 
	if($result==0){ //insert new one
		$spamobj->setVoteValue($_GET["mark"]);
		//echo '<pre>'.print_r($spamobj, true).'</pre>'; 
		$spamobj->insertVoteSpam();
		//echo '<pre>'.print_r($spamobj, true).'</pre>'; 
	}
	else{ //else just update
		$spamobj->voteSpam($_GET["mark"]);
	}
	
  
}

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
      $previous = $_SERVER['HTTP_REFERER'];
}
header('Location: '.$previous);


 ?>

<?php include("include/footer.php"); ?>
