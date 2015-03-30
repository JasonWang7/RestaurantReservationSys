<?php
/*****testing file for review****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
require_once($root.'model/review.php');
$reviewobj = new review;
$reviewobj->setUserId(65);
$reviewobj->setRestaurantId(2);
$reviewobj->setReviewId(0);
$reviewobj->setComment("Test comment");
$reviewobj->setServiceRating(5);
$reviewobj->setFoodRating(5);
$reviewobj->setAmbienceRating(5);
$reviewobj->setOverallExp(5);
$reviewobj->setVotes(0);
$reviewobj->setReviewTime(date("Y-m-d H:i:s"));
$reviewobj->insertReview();
echo "inserted new review with review id:".$reviewobj->getReviewId();
$reviewobj->setComment("Test Update comment");
echo '<pre>'.print_r($reviewobj, true).'</pre>'; 
$reviewobj->updateReview($reviewobj);
$reviewobj->deleteReview(2);
$x = $reviewobj->listReviewById(65,5);
//echo $x;
echo '<pre>'.print_r($x, true).'</pre>'; 
echo 'shit';


?>