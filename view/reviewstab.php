<?php
/**********this is view  for review tab**********
author: Vince, jason wang
*/
include_once($root.'model/review.php');
include_once($root.'model/user.php');
$reviewobj = new review;
$userid = $_SESSION['sess_user_id'];
$restid = $id;
$reviewlist = $reviewobj->listReviewRestaurant($restid,0);
$numdined = 0;
$numdined = $reviewobj->isDinner($userid,$restid);

$renderbody="";
$tablehead="";
$tablebody="";
$tableend="";
$verifiedDinnerImg = "";
if($numdined>0){
	$verifiedDinnerImg='<img src="/RRS/img/green_checkmark.jpg" alt="Verified Dinner" style="width:10px;height:10px">';
}
//echo 'in review tab';
//echo  $id;
//echo '<pre>'.print_r($reviewlist, true).'</pre>'; 
if(count($reviewlist)>0){
	$tablehead ='';
    $tableend = '';  
    foreach($reviewlist as $r){
    	$deletebutton = "";
    	//check if it is admin or super admin
    	$userobj = new user;
    	$role = '';
    	$userobj = $userobj->selectUserInfo($_SESSION['sess_useremail']);
    	$role = $userobj->getRole();
    	if($r->getUserId() ==$userid || strpos($role,'admin') == true){
    		$deletebutton = '<b><a href="#">Delete Review</a></b> - ';
    	}

    	$tablebody = $tablebody.'<div class="review-post" style="padding:10px;">
						          <div class="row">
						            <div class="col-sm-3">'.
						        '<p><b>Name:</b> '.$r->getRestaurantName().'</p>
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
							              <div style="float:right;">'.$deletebutton.'<b><a href="#">Mark as Spam</a></b></div>
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






?>