<?php
/******************************************************************************************
* File name: newRestaurants.php
* Purpose: Displays the review as a list
* Author: Jinhai Wang
* Group Name: Centaur Logic
* Created: March 31, 2015
******************************************************************************************/

include($root."view/include/header.php"); 
include_once($root.'model/review.php');
include_once($root.'model/spam.php');
include_once($root.'model/user.php');
$reviewobj = new review;
$userid = $_SESSION['sess_user_id'];
$numoffset=0;
$reviewlist = $reviewobj->listReview(100,$numoffset);
$renderbody="";
$tablehead="";
$tablebody="";
$tableend="";

//echo 'in review tab';
//echo  $id;
//echo '<pre>'.print_r($reviewlist, true).'</pre>'; 
if(count($reviewlist)>0){
	$tablehead ='';
    $tableend = '';  
    foreach($reviewlist as $r){
    	$deletebutton = "";
    	$spambutton="";
    	//check if it is dinner
    	$numdined = 0;
		$numdined = $r->isDinner($r->getUserId(),$r->getRestaurantId());
		$verifiedDinnerImg = "";
		if($numdined>0){
			$verifiedDinnerImg='<img src="/RRS/img/green_checkmark.jpg" alt="Verified Dinner" style="width:10px;height:10px">';
		}
    	//check if it is admin or super admin
    	$userobj = new user;
    	$role = '';
    	$userobj = $userobj->selectUserInfo($_SESSION['sess_useremail']);
    	$role = $userobj->getRole();
    	if($r->getUserId() ==$userid || strpos($role,'admin') == true){
    		$deletebutton = '<b><a href="deletereview?id='.$r->getReviewId().'">Delete Review</a></b> - ';
    	}
    	//check if user mark it as spam
    	$spamobj= new spam;
    	$spamobj->setReviewId($r->getReviewId());
    	$spamobj->setUserId($userid);
    	$spamobj->retrieveVoteSpam();
    	if($spamobj->getVoteValue()<1){
    		$spambutton='<b><a href="markspam?mark=1&id='.$r->getReviewId().'">Mark as Spam</a> ('.$r->getSpam().')</b>';
    	}
    	else{
    		$spambutton='<b><a href="markspam?mark=0&id='.$r->getReviewId().'">Not Spam</a> ('.$r->getSpam().')</b>';
    	}
    	$tablebody = $tablebody.'<div class="review-post" style="padding:10px;">
						          <div class="row">
						            <div class="col-sm-3">'.
						        '<p><b>Name:</b> <a href="profile?id='.$r->getRestaurantId().'">'.$r->getRestaurantName().'</a></p>
					              <p><b>Service:</b> '.$r->getServiceRating().' out of 5</p>
					              <p><b>Food:</b> '.$r->getFoodRating().' out of 5</p>
					              <p><b>Ambience:</b> '.$r->getAmbienceRating().' out of 5</p>'.
					            ' </div>
					            <div class="col-sm-9">
					              <div style="float:right;"><b>Date:</b> '.$r->getReviewTime().'</div>'.
					            '<b>Overall Rating:</b>  '.$r->getOverallExp().' out of 5 '.
					            '<b>By:</b> '.$verifiedDinnerImg.$r->getReviewName().' <small>(who have been there '.$numdined.' time(s))</small>'.
							                '<hr>
							                <p>'.$r->getComment().'</p>
							              <div style="float:right;">'.$deletebutton.$spambutton.'</div>
							              <input type="hidden" name="reviewid" value="'.$r->getReviewId().'" >
							            </div>
							          </div>
							        </div>
							  <hr>';
    }         
    $renderbody=$tablehead.$tablebody.$tableend;
    echo $renderbody;
}
else{
	$renderbody="<h2>This restaurant doesn't have any review yet!</h2>";
	echo $renderbody;
}
include($root."view/include/footer.php");
?>