<?php
/**********this is view  for review tab**********
author: Vince, jason wang
*/
include_once($root.'model/review.php');
include_once($root.'model/spam.php');
include_once($root.'model/user.php');
$reviewobj = new review;
$userid = $_SESSION['sess_user_id'];
$numoffset=0;
if(isset($_GET["id"])){
	$numoffset=$_GET["id"];
}
$reviewlist = $reviewobj->listReview(5,$numoffset);
$numdined = 0;


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
	$tablehead ='<div class="jumbotron">
    			<div class="row">';
    $tableend = ' </div>
    			</div>';  
    foreach($reviewlist as $r){
    	$deletebutton = "";
    	$spambutton="";
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
    	$tablebody = $tablebody.'<div class="well col-md-2" style="font-size:13px; background-color:#eee; margin:8px; text-align:middle; height:180px;">"'.
    							$r->getComment().'" by '.$r->getReviewName().' <b>on</b><p> <a style="font-size: 14px;" href=profile?id='.$r->getRestaurantId().'>'.$r->getRestaurantName().'</a></div>';
    }
    $tablebody = $tablebody.'<div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; width:50px; height:180px;">'.
    							'<a href="#">></a></div>';         
    $renderbody=$tablehead.$tablebody.$tableend;
    echo $renderbody;
}
else{
	$renderbody="";
	echo $renderbody;
}






?>





      
      
      
   