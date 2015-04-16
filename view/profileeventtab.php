<?php
/**********this is view  for review tab**********
author: Vince, jason wang
*/
include_once($root.'model/event.php');
$eventobj = new event;
$userid = $_SESSION['sess_user_id'];
$eventlist = $eventobj->retriveListEventByrestaurantId($_GET["id"],0);
$renderbody="";
$tablehead="";
$tablebody="";
$tableend="";
//echo 'in review tab';
//echo $userid;
//echo '<pre>'.print_r($reviewlist, true).'</pre>'; 
if(count($reviewlist)>0){
	$tablehead ='';
    $tableend = '';  
    foreach($eventlist as $ev){
    	$tablebody = $tablebody.'<div class="row" style="padding:10px;"><hr><div class="col-md-2" style="floating:right;">'.
        '<p>'.'<img src="'.$ev->getEventPictureUrl().'" alt="Event Image" height="170" width="170">'.'</p>'.      
      '</div>
      <div class="col-md-2">
        <p><h4>Event:</h4> '.$ev->getEventName().'</p>'.
      '</div>
      <div class="col-md-2">
        <p><h4>Time:</h4>'.$ev->getEventTime().' - '.$ev->getEventEndTime().'</p>'.
      '</div>
      <div class="col-md-4">
        <p><h4>Description:</h4> '.$ev->getEventDiscription().'</p>'.
      '</div>
      <div class="col-md-2">
        <a class="btn btn-success" href="#">Book Event</a>
       	<br />
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modifyeventmodal">Modify</a>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modifyeventmodal">Delete</a>
      </div></div>';
    }         
    $renderbody=$tablehead.$tablebody.$tableend;
    echo $renderbody;
}
else{
	$renderbody="<h2>There currently aren't any events</h2>";
	echo $renderbody;
}





 
           



?>