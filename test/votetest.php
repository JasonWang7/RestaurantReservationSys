<?php
/*****testing file for review****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
require_once($root.'model/vote.php');
/****how to add review****/
date_default_timezone_set('America/Toronto');
$voteobj = new vote;
$voteobj->setUserId(7);
$voteobj->setReviewId(3);
$voteobj->setVoteValue(1);
$voteobj->insertVoteReview();

$voteobj->retrieveVote();
echo "inserted new review with review id:".$voteobj->getReviewId().' '.$voteobj->getVoteValue();


/*****how to update review*******/
$voteobj->voteReview(0);
$voteobj->retrieveVote();
echo '<br>update vote to '.$voteobj->getVoteValue().' '.$voteobj->getUpdateTime(); 

echo '<pre>'.print_r($voteobj, true).'</pre>'; 
echo 'shit';


?>