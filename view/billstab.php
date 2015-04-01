<?php
/**********this is view  for review tab**********
author: Vince, jason wang
*/
include_once($root.'model/transaction.php');
$transactionobj = new transaction;
$userid = $_SESSION['sess_user_id'];
$transactionlist = $transactionobj->listTransactionByUserId($userid,0);
$renderbody="";
$tablehead="";
$tablebody="";
$tableend="";
//echo 'in review tab';
//echo $userid;
//echo '<pre>'.print_r($reviewlist, true).'</pre>'; 
if(count($transactionlist)>0){
	$tablehead ='<div class="row">
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>Transaction #</th>
                <th>Restaurant Name</th>
                <th>Reservation Id</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Transaction Time</th>
               
              </tr>
            </thead>
            <tbody>';
    $tableend = ' </tbody>
          </table> 
          </div>';  
    foreach($transactionlist as $r){
    	$tablebody = $tablebody.'<tr>' . '<td>' .$r->getTansactionId() . '</td><td><a href="profile?id=' . $r->getRestaurantId(). '">'.$r->getRestaurantName().'</td><td>' .$r->getReservationId(). "</td><td>" . $r->getAmount() .
                '</td><td>'.$r->getDesicription().'</td>'.
                '<td>'.$r->getTransactionTime().'</td>';
    }         
    $renderbody=$tablehead.$tablebody.$tableend;
    echo $renderbody;
}
else{
	$renderbody="<h2>You haven't made any review yet!</h2>";
	echo $renderbody;
}





 
           



?>