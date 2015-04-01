<?php
/**********this is view  for review tab**********
author: Vince, jason wang
*/
include_once($root.'model/review.php');
$reviewobj = new review;
$userid = $_SESSION['sess_user_id'];
$reviewlist = $reviewobj->listReviewById($userid,0);
$renderbody="";
$tablehead="";
$tablebody="";
$tableend="";
//echo 'in review tab';
//echo $userid;
//echo '<pre>'.print_r($reviewlist, true).'</pre>'; 
if(count($reviewlist)>0){
	$tablehead ='<div class="row">
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>Review #</th>
                <th>Restaurant Name</th>
                <th>Comment</th>
                <th>Overall Rating</th>
                <th>Time Reviewed</th>
                <th>Edit/View</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>';
    $tableend = ' </tbody>
          </table> 
          </div>';  
    foreach($reviewlist as $r){
    	$tablebody = $tablebody.'<tr>' . '<td>' .$r->getReviewId() . '</td><td><a href="profile?id=' . $r->getRestaurantId(). '">'.$r->getRestaurantName().'</td><td>' .$r->getComment(). "</td><td>" . $r->getOverallExp() .
                '</td><td><a class="btn btn-default" href="#"  data-toggle="modal" data-target="#reviewmodal'.$r->getReviewId().'">View</a></td>'.'<td><a class="btn btn-primary" href="cancel?id='.$r->getReviewId().'" >Delete</a></td>'.'</tr>'.'</a>'.
                '<div class="modal fade" id="reviewmodal'.$r->getReviewId().'" tabindex="-1" role="dialog" aria-labelledby="reviewmodal'.$r->getReviewId().'" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="label">Reservation at ' . $row[9] .'</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <form id="booktable" name="booktable" ACTION="view/modifyreservation.php" METHOD=post>
                                          
                        <div class="col-md-4">
                          <h3>Date: </h3><input  type="text" value="'. explode(" ", $dtime)[0] .'" name="datetime" id="datepicker1">
                        </div>
                        <div class="col-md-4">
                          <h3>Time:</h3><input type="text" value="'.explode(" ", $dtime)[1] .'" name="dinningtime">
                          
                        </div>
                        <div class="col-md-4">
                          <h3># of Guests: </h3><input type="text" name="numguest" value="'. $row[3].'">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Special Request / Note:</h3>
                          <textarea name="note" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let us know your special requests / notes.">'.$row[4].'</textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Your Phone Number:</h3><input type="text" name="phone" value="'.$row[11].'">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Your Email Address:</h3>    <input type="text" name="email" value="'.$row[7].'" >  
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Enter your email addresses for your guests. Please separate them with the character ";" (no quotes)</h3>
                          <textarea name="invitationList" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let us know your special requests / notes.">'.$row[5].'</textarea>
                          <input type="hidden" name="reservationid" value="'.$row[0].'" >
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                ';
    }         
    $renderbody=$tablehead.$tablebody.$tableend;
    echo $renderbody;
}
else{
	$renderbody="<h2>You haven't made any review yet!</h2>";
	echo $renderbody;
}





 
           



?>