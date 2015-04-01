<!--
    Author: jinhai wang
-->
<?php 
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';

require_once($root ."model/review.php");
require_once($root.'util/authentication.class.php');



$reviewobj = new review;
$servicerating = $_POST['servicerating'];
$foodrating = $_POST['foodrating'];
$ambiencerating = $_POST['ambiencerating'];
$overallexp = $_POST['overallexp'];
$comment = $_POST['comment'];
$reviewid = $_POST['reviewid'];
$userid = $_SESSION['sess_user_id'];

$reviewobj->setUserId($userid);
$reviewobj->setComment($comment);
$reviewobj->setServiceRating($servicerating);
$reviewobj->setFoodRating($foodrating);
$reviewobj->setAmbienceRating($ambiencerating);
$reviewobj->setOverallExp($overallexp);
$reviewobj->setReviewId($reviewid);

$reviewobj->updateReview($reviewobj);

header('Location: /RRS/account');	
?>
