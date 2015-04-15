<!--
    Author: Vince,Jinhai Wang, Rhys Hall - this is the owner managing panel page
-->
<?php 
      ob_start();
      $root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
      include_once("include/header.php");
      include_once($root.'model/accountlog.php');
      include_once($root.'model/user.php');
      include_once($root.'model/restaurant.php');
      include_once($root.'model/owner.php');
      include_once($root.'model/restaurantOwnership.php');
      require_once($root.'model/creditcard.php');
      //include_once($root.'controller/creditcardcontroller.php'); ?>
    
<script type="text/javascript">
function deletePromptPopUp(url) 
{
  popUp = window.open(url,'Delete Prompt','height=300,width=550,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

</script>
    
<?php 
  if(isset($_SESSION['sess_user_id'])){
      $userinfo = new user;
      $userobj = $userinfo->selectUserInfo($_SESSION['sess_useremail']);
      $cardinfo = new creditcard;
      $creditcardobj = $cardinfo->selectCardInfo($_SESSION['sess_user_id']);
    
      //echo '<pre>'.print_r($userobj, true).'</pre>';   
      //echo '<pre>'.print_r($creditcardobj, true).'</pre>';   
      if(isset($_GET["save"])){
        //save account
        $usertemp = new user;
        $usertemp->setUserId($_SESSION['sess_user_id']);
        $usertemp->setUserName($_SESSION['sess_username']);
        $usertemp->setUserEmail($_SESSION['sess_useremail']);
        $usertemp->setFirstName($_POST["firstname"]);
        $usertemp->setLastName($_POST["lastname"]);
        $usertemp->setPassword($_POST["password1"]);
        $usertemp->setCity($_POST["city"]);
        $userobj-> updateUser($_SESSION['sess_user_id'],$usertemp);
        header('Location: /RRS/account');
      }
      else if(isset($_GET["reservation"])){
        //show reservation list tab
      }
      else if(isset($_GET["credit"])){
        //show credit card list tab
        if($userobj->getVerified()==1){ //if it verified then just update 
          //update
        }
        else{ //insert the new credit card
          $cardObj = new creditcard;
          //$cardObj->setUserId($_POST['userid']);
          $cardObj->setCardNum($_POST['cardNum']);    
          $cardObj->setUserId($_SESSION['sess_user_id']);
          $cardObj->setAddress($_POST['address']);
          $cardObj->setCV($_POST['cv']);
          $cardObj->setName($_POST['name']);
          $cardObj->setCardType($_POST['cardtype']);
          $cardObj->setExpireDate($_POST['expireddate']);
         
          if($cardObj->luhn_checksum($cardObj->getCardNum())&&$cardObj->cv_check($cardObj->getCV())&&$cardObj->exp_date_check($cardObj->getExpireDate())){
            $cardObj->insertCardInfo($cardObj);
            
          }
          $creditcardobj = $creditcardobj->insertCardInfo($creditcardobj);
          $userobj->setVerified(1);
          $userobj->setVerifyUser($userobj->getUserId(),1); //update user talbe user is credit card verified
        } 
      }
  }
  else{
    header('Location: /RRS/');
  } 
?>
<div class="row">
  <div class="col-12">
    <h3>Restaurant Owner Panel</h3>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#restaurants" data-toggle="tab" aria-expanded="true">My Restaurants</a></li>
      <li class=""><a href="#reservations" data-toggle="tab" aria-expanded="true">Approve Reservation</a></li>   
      <li class=""><a href="#attendance" data-toggle="tab" aria-expanded="false">Attendance</a></li>
       <li class=""><a href="#transaction" data-toggle="tab" aria-expanded="true">Transaction</a></li>
      <li class=""><a href="#event" data-toggle="tab" aria-expanded="true">Event</a></li>
    </ul>
    <div id="myTabContent" class="tab-content" style="margin-left:20px;">
        <div class="tab-pane fade <?php if(isset($_GET['reservation'])==false){ echo 'active in'; } ?>" id="restaurants">
            <div class="row">
                <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>Restaurant Name</th>
            <?php 
              $ownerSelector = new owner;
              $ownershipSelector = new restaurantOwnership;
              $restaurantSelector = new restaurant;
              $i = 1;
              $restaurantIdList = array_fill(1, 500, -1);
              $restaurantNameList = array_fill(1, 500, -1);
              
              $ownerIdList = $ownerSelector->selectOwnersInfo($_SESSION['sess_user_id']);
              $numOwned = $ownerIdList[1];
              
              while ($i <= $numOwned)
              {
                $restaurantIdList[$i] = $ownershipSelector->selectRestaurantId($ownerIdList[$i+1]);
                $i = $i + 1;
              }
              
              $i = 1;
              
              while ($i <= $numOwned)
              {
                $restaurantNameList[$i] = $restaurantSelector->selectRestaurantName($restaurantIdList[$i]);
                $i = $i + 1;
              }
            ?>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Edit</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
            <?php 
              $i = 1;
              
              while ($i <= $numOwned)
              { 
                $deleteButton = "<a class=\"btn btn-primary\" href=\"JavaScript:deletePromptPopUp('/RRS/deletePrompt?id=" . $restaurantIdList[$i] . "');\">";
                
                echo '<tr>' . '<td>' . $restaurantNameList[$i] . '</td><td></td><td></td><td></td><td><a class="btn btn-info" href="/RRS/changeRestaurant?id=' . $restaurantIdList[$i] . '"' .
                "</td><td>" . $deleteButton . "</td></tr>";

                $i = $i + 1;
              } 
            ?>
                </tbody>
              </table> 
              </div>
        </div>
        <div class="tab-pane fade" id="attendance">
          
        </div>
        <div class="tab-pane fade  <?php if(isset($_GET['reservation'])){ echo 'active in'; } ?> " id="reservations">
          <div class="row">
              <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>Reservation #</th>
                  <th>Restaurant</th>
                  <th>Time</th>
                  <th>Customer Name</th>
                  <th># Guests</th>
                  <th>Status</th>
                  <th>Reason</th>
                  <th>View</th>
                  <th>Reject/Accept</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  
                $auth = new mysqldatabaserrs;
                $dbconn = $auth->connectdb();
                $query = "select * from view_reservation_restaurant where userId=:userId order by dinningtime desc";
                try {

                $stmt = $dbconn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindValue(':userId',$_SESSION['sess_user_id']);
                $stmt->execute();
                
                while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                {
                 
                  $dd = date_create_from_format('Y-m-d H:i:s', $row[7]);
                  $dtime = date_format($dd,'d/m/Y H:i:s');
                  if($row[13]=="Accepted"){
                      
                      $statusval='<td>'.'<span class="glyphicon glyphicon-ok"></span> '. $row[13] .'</td>';
                  }
                  else{
                      
                      if($row[13]=="Reviewing"){
                        $statusval='<td>'.'<span class="glyphicon glyphicon-eye-open"></span> '. $row[13] .'</td>';
                      }
                      else{
                        $statusval='<td>'.'<span class="glyphicon glyphicon-remove-sign"></span> '. $row[13] .'</td>';
                      }
                  }
                  date_default_timezone_set('America/Toronto'); 
                 
                  $dt = new DateTime();
                  //check if datetime expired
                
                  if($dd>$dt ){
                      $actionbtn='<div class="btn-group">
                              <a class="btn btn-success" href="acceptreservation?id='.$row[0].'" >Accept</a>
                              <button type="button" class="btn btn-primary" href="#"  data-toggle="modal" data-target="#approvereservationmodal'.$row[0].'">Reject</button>
                            </div>';
                  }
                  else if($dd<$dt ){
                      $actionbtn='<div class="btn-group">
                              <button type="button" class="btn btn-success disabled" href="#" >Accept</button>
                              <button type="button" class="btn btn-primary disabled" href="#"  data-toggle="modal" data-target="#approvereservationmodal'.$row[0].'">Reject</button>
                            </div>';  
                  }
                 
                  $data = '<tr>' . '<td>' . $row[0] . '</td><td><a href="profile?id=' . $row[2] . '">'.$row[10].'</td><td>' .$dtime. "</td>".
                  '<td>'.$row[14].' '.$row[15] .'</td>'.
                  "<td>" . $row[3] .
                  '</td>'.$statusval.
                  '<td>'.$row[5] .'</td>'.
                  '<td><a class="btn btn-info" href="#"  data-toggle="modal" data-target="#viewreservationmodal'.$row[0].'">View</a></td>'.
                 

                  '<td>'.$actionbtn.'</td>'.'</tr>';
                  echo $data . '</a>';

                  echo '
                  <div class="modal fade" id="viewreservationmodal'.$row[0].'" tabindex="-1" role="dialog" aria-labelledby="viewreservationmodal'.$row[0].'" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="label">Reservation at ' . $row[10] .'</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <form id="booktable" name="booktable" ACTION="modifyreservation" METHOD=post>
                                            
                          <div class="col-md-4">
                            <h3>Date: </h3><input  type="text" value="'. explode(" ", $dtime)[0] .'" name="datetime" id="datepicker1" disabled>
                          </div>
                          <div class="col-md-4">
                            <h3>Time:</h3><input type="text" value="'.explode(" ", $dtime)[1] .'" name="dinningtime" disabled>
                            
                          </div>
                          <div class="col-md-4">
                            <h3># of Guests: </h3><input type="text" name="numguest" value="'. $row[3].'" disabled>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Special Request / Note:</h3>
                            <textarea name="note" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let us know your special requests / notes." disabled>'.$row[4].'</textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Phone Number:</h3><input type="text" name="phone" value="'.$row[9].'" disabled>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Email Address:</h3>    <input type="text" name="email" value="'.$row[8].'" disabled>  
                          </div>
                        </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                  ';
                  echo '<div class="modal fade" id="approvereservationmodal'.$row[0].'" tabindex="-2" role="dialog" aria-labelledby="approvereservationmodal'.$row[0].'" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="label">Reject the reservation at ' . $row[10] .'</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <form id="rejectreservation" name="rejectreservation" ACTION="rejectreservation" METHOD=post>
                                            
                          <div class="col-md-4">
                            <h3>Date: </h3><input  type="text" value="'. explode(" ", $dtime)[0] .'" name="datetime" id="datepicker1" disabled>
                          </div>
                          <div class="col-md-4">
                            <h3>Time:</h3><input type="text" value="'.explode(" ", $dtime)[1] .'" name="dinningtime" disabled>
                            
                          </div>
                          <div class="col-md-4">
                            <h3># of Guests: </h3><input type="text" name="numguest" value="'. $row[3].'" disabled>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Special Request / Note:</h3>
                            <textarea name="note" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let us know your special requests / notes." disabled>'.$row[4].'</textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Customer Phone:</h3><input type="text" name="phone" value="'.$row[9].'" disabled>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Reason (give any extra information to user):</h3>
                            <textarea name="reason" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let user know the reason that reservation is rejected or just extra information for user.">'.$row[5].'</textarea>
                            <input type="hidden" name="reservationid" value="'.$row[0].'" >
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button  type="submit" class="btn btn-primary" ">Confirm</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>';
                }
                $stmt = null;

                }
                catch (PDOException $e) {
                  print $e->getMessage();
                }

                $auth->closeconnection($dbconn);
                ?>
              </tbody>
            </table> 
            </div>
        </div>          
        <div class="tab-pane fade" id="event">
          <p>Events here</p>
        </div>
        <div class="tab-pane fade" id="transaction">
          <?php include("ownertransactiontab.php") ?>
        </div>               
                    
                      
    </div>
  </div>
</div>

<?php include("include/footer.php"); ?>