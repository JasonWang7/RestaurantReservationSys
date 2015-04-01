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
                '</td><td>'.$r->getReviewTime().'</td><td><a class="btn btn-default" href="#"  data-toggle="modal" data-target="#reviewmodal'.$r->getReviewId().'">View</a></td>'.'<td><a class="btn btn-primary" href="deletereview?id='.$r->getReviewId().'" >Delete</a></td>'.'</tr>'.'</a>'.
                '<div class="modal fade" id="reviewmodal'.$r->getReviewId().'" tabindex="-1" role="dialog" aria-labelledby="reviewmodal'.$r->getReviewId().'" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <form id="review" name="review" ACTION="modifyreview" METHOD=post>
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="label">Review for '.$r->getRestaurantName().'</h4>
				      </div>

				      <div class="modal-body">
				        
				        <div class="row">
				          <div class="col-md-12">
				            <h3>Service:       
				              <select class="form-control" id="servicerating" name="servicerating" >';
							  if($r->getServiceRating()==1){
							  		$ops = '<option selected="selected">1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getServiceRating()==2){
							  		$ops = '<option>1</option>
							  		<option selected="selected">2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getServiceRating()==3){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option selected="selected">3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getServiceRating()==4){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option selected="selected">4</option>
					              	<option>5</option>';

							  }
							  else if($r->getServiceRating()==5){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option selected="selected">5</option>';
							  }
				              $tablebody=$tablebody.$ops;
				              $ops='';
				             
				            $tablebody=$tablebody.'</select>
				        </h3>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col-md-12">
				            <h3>Food:               
				            <select class="form-control" id="foodrating" name="foodrating" >';
				            if($r->getFoodRating()==1){
							  		$ops = '<option selected="selected">1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getFoodRating()==2){
							  		$ops = '<option>1</option>
							  		<option selected="selected">2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getFoodRating()==3){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option selected="selected">3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getFoodRating()==4){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option selected="selected">4</option>
					              	<option>5</option>';

							  }
							  else if($r->getFoodRating()==5){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option selected="selected">5</option>';
							  }
				              $tablebody=$tablebody.$ops;
				              $ops='';
				              
				            $tablebody=$tablebody.'</select></h3>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col-md-12">
				            <h3>Ambience:               
				            <select class="form-control" id="ambiencerating" name="ambiencerating" >';
				              if($r->getAmbienceRating()==1){
							  		$ops = '<option selected="selected">1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getAmbienceRating()==2){
							  		$ops = '<option>1</option>
							  		<option selected="selected">2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getAmbienceRating()==3){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option selected="selected">3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getAmbienceRating()==4){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option selected="selected">4</option>
					              	<option>5</option>';

							  }
							  else if($r->getAmbienceRating()==5){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option selected="selected">5</option>';
							  }
				              $tablebody=$tablebody.$ops;
				              $ops='';
				              
				            $tablebody=$tablebody.'</select></h3>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col-md-12">
				            <h3>Overall Experience:               
				            <select class="form-control" id="overallexp" name="overallexp" >';
				              if($r->getOverallExp()==1){
							  		$ops = '<option selected="selected">1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getOverallExp()==2){
							  		$ops = '<option>1</option>
							  		<option selected="selected">2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getOverallExp()==3){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option selected="selected">3</option>
					              	<option>4</option>
					              	<option>5</option>';
							  }
							  else if($r->getOverallExp()==4){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option selected="selected">4</option>
					              	<option>5</option>';

							  }
							  else if($r->getOverallExp()==5){
							  		$ops = '<option>1</option>
							  		<option>2</option>
					              	<option>3</option>
					              	<option>4</option>
					              	<option selected="selected">5</option>';
							  }
				              $tablebody=$tablebody.$ops;
				              $ops='';
				              
				            $tablebody=$tablebody.'</select></h3>      
				          </div>
				        </div>
				        <div class="row">
				          <div class="col-md-12">
				            <h3>Comments:</h3>
				            <textarea id="comment" name="comment" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;">'.$r->getComment().'</textarea>
				            <input type="hidden" name="reviewid" value='.$r->getReviewId().' >
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