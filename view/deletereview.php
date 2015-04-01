<!-- Jinhai Wang created this page -->
<?php 
ob_start();
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include("include/header.php");
include($root.'model/review.php');
if(isset($_GET["id"])){

  $reviewobj = new review;
  $reviewobj->deleteReview($_GET["id"]);
  
  
}
$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
header('Location: '.$previous);


 ?>

<?php include("include/footer.php"); ?>
