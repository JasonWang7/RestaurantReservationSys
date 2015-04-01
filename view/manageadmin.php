<?php 
/*****vince, jinhai wang****/
include($root."view/include/header.php");
include_once($root.'model/transaction.php');
$transactionobj = new transaction;
$userid = $_SESSION['sess_user_id'];
$transactionlist = $transactionobj->listTransaction(100,0);
$renderbody="";
$tablehead='';
$tablebody="";
$tableend="";
if(count($transactionlist)>0){
  $tablehead='<div class="row">
            <div class="col-12">  
              <h3>Admin Panel</h3>
              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>Transaction #</th>
                    <th>Restaurant Name</th>
                    <th>Reservation Id</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Transaction Time</th>
                    <th><th>
                  </tr>
                </thead>
                <tbody>';
    $tableend = ' </tbody>
              </table>';  
    foreach($transactionlist as $r){
      $tablebody = $tablebody.'<tr>' . '<td>' .$r->getTansactionId() . '</td><td><a href="profile?id=' . $r->getRestaurantId(). '">'.$r->getRestaurantName().'</td><td>' .$r->getReservationId(). "</td><td>" . $r->getAmount() .
                '</td><td>'.$r->getDesicription().'</td>'.
                '<td>'.$r->getTransactionTime().'</td>'.
                '<td><a class="btn btn-default" href="#" data-toggle="modal" data-target="#viewreservationmodal195">Refund</a></td></tr>';
    }         
    $renderbody=$tablehead.$tablebody.$tableend;
    echo $renderbody;
}
else{
  $renderbody="<h2>There is no transaction yet!</h2>";
  echo $renderbody;
}

 ?>
     
<?php include("include/footer.php"); ?>