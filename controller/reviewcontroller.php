<?php
/*****jinhai Wang****/

$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'model/user.php');
require_once($root.'model/review.php');
date_default_timezone_set('America/Toronto');


session_start();
$reviewobj = new review;
$servicerating = $_POST['servicerating'];
$foodrating = $_POST['foodrating'];
$ambiencerating = $_POST['ambiencerating'];
$overallexp = $_POST['overallexp'];
$comment = $_POST['comment'];
$restaurantid = $_POST['restaurantid'];
$userid = $_SESSION['sess_user_id'];
$reviewobj->setUserId($userid);
$reviewobj->setRestaurantId($restaurantid);
$reviewobj->setComment($comment);
$reviewobj->setServiceRating($servicerating);
$reviewobj->setFoodRating($foodrating);
$reviewobj->setAmbienceRating($ambiencerating);
$reviewobj->setOverallExp($overallexp);
$reviewdate = date('Y-m-d H:i:s');
$reviewobj->setReviewTime($reviewdate);

$reviewobj->insertReview();


if($reviewobj->getReviewId()>0){
	
	header('Location: /RRS/profile?id='.$restaurantid);	
}
header('Location: /RRS/profile?id='.$restaurantid);	


?>