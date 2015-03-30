<?php
/*****testing file for review****/
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
require_once($root.'util/authentication.class.php');
require_once($root.'util/database.class.php');
require_once($root.'model/spam.php');
/****how to add review****/
date_default_timezone_set('America/Toronto');
$spamobj = new spam;
$spamobj->setUserId(7);
$spamobj->setReviewId(3);
$spamobj->setVoteValue(1);
$spamobj->insertVoteSpam();

$spamobj->retrieveVoteSpam();
echo "inserted new review with review id:".$spamobj->getReviewId().' '.$spamobj->getVoteValue();


/*****how to update review*******/
$spamobj->voteSpam(0);
$spamobj->retrieveVoteSpam();
echo '<br>update vote to '.$spamobj->getVoteValue().' '.$spamobj->getUpdateTime(); 

echo '<pre>'.print_r($spamobj, true).'</pre>'; 
echo 'shit';


?>