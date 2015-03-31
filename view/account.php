<!--
    Author: Vince,Jinhai Wang, Rhys Hall - this is the account page
-->
<?php 
      ob_start();
      $root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
      include_once("include/header.php");
      include_once($root.'model/user.php');
	  include_once($root.'model/restaurant.php');
	  include_once($root.'model/owner.php');
	  include_once($root.'model/restaurantOwnership.php');
      include_once($root.'controller/creditcardcontroller.php'); ?>
	  
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
          $creditcardobj = addCreditcard();
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
    <ul class="nav nav-tabs">
      <li class="active"><a href="#account" data-toggle="tab" aria-expanded="false">Account Details</a></li>
      <li class=""><a href="#reservations" data-toggle="tab" aria-expanded="true">Reservations</a></li>
	  <li class=""><a href="#restaurants" data-toggle="tab" aria-expanded="true">My Restaurants</a></li>
      <li class=""><a href="#events" data-toggle="tab" aria-expanded="true">Likes</a></li>
      <li class=""><a href="#about" data-toggle="tab" aria-expanded="true">Reviews</a></li>
      <li class=""><a href="#rateadish" data-toggle="tab" aria-expanded="true">Reward</a></li>
      <li class=""><a href="#history" data-toggle="tab" aria-expanded="true">History</a></li>
      <li class=""><a href="#bills" data-toggle="tab" aria-expanded="true">Bills</a></li>
      <li class=""><a href="#creditcard" data-toggle="tab" aria-expanded="true">Credit Card</a></li>
      <li class=""><a href="deleteacc">Delete Account</a></li>
    </ul>
    <div id="myTabContent" class="tab-content" style="margin-left:20px;">
      <div class="tab-pane fade <?php if(isset($_GET['reservation'])==false){ echo 'active in'; } ?> "id="account">
        <div class="row">
        <div class="col-md-12">
          <form action="account?save=true" method="post">
          <h3>Account Details:</h3>
            <div class="row">
              <div class="col-md-12"><h2>User ID: <input type="text" name="userid" readonly value="<?php echo $userobj->getUserId(); ?>" ></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>User Name: <input type="text" name="username" readonly value="<?php echo $userobj->getUserName(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>First Name: <input type="text" name="firstname" value="<?php echo $userobj->getFirstName(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Last Name: <input type="text" name="lastname" value="<?php echo $userobj->getLastName(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Email: <input type="text" name="email" value="<?php echo $userobj->getUserEmail(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>City: <input type="text" name="city" value="<?php echo $userobj->getCity(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Password: <input type="password" name="password1" value="<?php echo $userobj->getPassword(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Confirm Password: <input type="password" name="password2" value="<?php echo $userobj->getPassword(); ?>"></h2></div>
            </div>
           
            <div class="row">
                <button class="btn btn-info" id="btn-signup" type="submit"><i class="icon-hand-right"></i> &nbsp; Save</button>
               
            </div>
          </form>
        </div>
    </div>  
      </div>
      <div class="tab-pane fade  <?php if(isset($_GET['reservation'])){ echo 'active in'; } ?> " id="reservations">
        <p>Below is the list of reservation:</p>
        <div class="row">
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>Reservation #</th>
                <th>Restaurant</th>
                <th>Time</th>
                <th># Guests</th>
                <th>Change/View</th>
                <th>Cancel</th>
              </tr>
            </thead>
            <tbody>
              <?php
                
              $auth = new mysqldatabaserrs;
              $dbconn = $auth->connectdb();
              $query = "select * from view_reservation_restaurant where userId=:userId";
              try {

              $stmt = $dbconn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
              $stmt->bindValue(':userId',$_SESSION['sess_user_id']);
              $stmt->execute();
              
              while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
              {
                $data = '<tr>' . '<td>' . $row[0] . '</td><td><a href="profile?id=' . $row[2] . '">'.$row[9].'</td><td>' . $row[6] . "</td><td>" . $row[3] .
                '</td><td><a class="btn btn-default" onclick="changeRes("'.$row[0]. '", "' . $row[2] . '", "' . $row[9] . '", "' . $row[6] . '", "' . $row[3] . '");" href="#"  data-toggle="modal" data-target="#viewreservationmodal">View</a></td>'.'<td><a class="btn btn-primary" href="cancel?id='.$row[0].'" >Cancel</a></td>'.'</tr>';
                echo $data . '</a>';
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
	  
	  <div class="tab-pane fade" id="restaurants">
        <p>Displaying all currently owned restaurants:</p>
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
						$deleteButton = "<a class=\"btn btn-primary\" href=\"JavaScript:deletePromptPopUp('/RRS/view/deletePrompt.php?id=" . $restaurantIdList[$i] . "');\">";
						
						echo '<tr>' . '<td>' . $restaurantNameList[$i] . '</td><td></td><td></td><td></td><td><a class="btn btn-info" href="/RRS/view/changerestaurant.php?id=' . $restaurantIdList[$i] . '"' .
						"</td><td>" . $deleteButton . "</td></tr>";

						$i = $i + 1;
					} 
				?>
            </tbody>
          </table> 
          </div>
      </div>


      <div class="tab-pane fade" id="events">
        <p>Events here</p>
      </div>
      <div class="tab-pane fade" id="about">
        <p>About here</p>
      </div>
      <div class="tab-pane fade" id="rateadish">
        <p>RAte here here</p>
      </div>
      <div class="tab-pane fade" id="bills">
        <p>Billing Information</p>
      </div>
      <div class="tab-pane fade" id="history">
        <div class="table-responsive">
        <table class="table table-bordered"> 
        <tr class="row">
          <td class="field-label col-md-3 active">
            <label>Date</label>
          </td>
          <td class="col-md-9">
            <label>Activity Information</label>
          </td>
        </tr>
        <tr class="row">
          <td class="field-label col-md-3 active">
              10/10/2010 - 10:10 PM
          </td>
          <td class="col-md-9">
            Account Logged On
          </td>
        </tr>
      </table>
      </div>
      </div>
      <div class="tab-pane fade" id="creditcard">
        <form action="account?credit=true" method="post">
        <h2>Credit Card Information</h2>
            <div class="row">
              <div class="row">
              <div class="col-md-12"><h2>Verified: <?php if($userobj->getVerified()==1){ echo "Yes";}else{echo "No";} ?> </h2></div>
            </div>
              <div class="col-md-12"><h2>Credit Card Type:
              <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="cardtype" value="Mastercard"> Mastercard
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" value="Visa"> Visa
                </label>
                <script type="text/javascript">
                   document.querySelector("input[value='Mastercard']").checked = true;
                </script>
                
            </div>
            </h2></div>

            </div>
            <div class="row">
              <div class="col-md-12"><h2>Name: <input type="text" name="name" value="<?php echo $creditcardobj->getName(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Address: <input type="text" name="address" value="<?php echo $creditcardobj->getAddress(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Credit Card: <input type="text" name="cardNum" value="<?php echo $creditcardobj->getCardNum(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Expired Date: <input type="text" name="expireddate" value="<?php echo $creditcardobj->getExpireDate(); ?>"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>CVV: <input type="password" name="cv" value="<?php echo $creditcardobj->getCV(); ?>"></h2></div>
            </div>
             <div class="row">
                <button class="btn btn-info" id="btn-signup" type="submit"><i class="icon-hand-right"></i> &nbsp; save</button>
               
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="viewreservationmodal" tabindex="-1" role="dialog" aria-labelledby="viewreservationmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label">Reservation at <?php echo $name; ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <form id="booktable" name="booktable" ACTION="view/verifyreservation.php" METHOD=post>
                            
          <div class="col-md-4">
            <h3>Date: </h3><input  type="text" placeholder="dd/mm/yyyy" name="datetime" id="datepicker1">
            <!-- Load jQuery and bootstrap datepicker scripts -->
          
            <script src="http://localhost/RRS/css/bootstrap/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript">
                // When the document is ready
                $(document).ready(function () {
                    
                    $('#datepicker1').datepicker({
                        format: "dd/mm/yyyy"
                    });  
                
                });
            </script>
          </div>
          <div class="col-md-4">
            <h3>Time:</h3><input type="text" placeholder="hh:mm" name="dinningtime">
            
          </div>
          <div class="col-md-4">
            <h3># of Guests: </h3><input type="text" name="numguest">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Special Request / Note:</h3>
            <textarea name="note" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let us know your special requests / notes."></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Your Phone Number:</h3><input type="text" name="phone">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Your Email Address:</h3>    <input type="text" name="email">  
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Enter your email addresses for your guests. Please separate them with the character ";" (no quotes)</h3>
            <textarea name="invitationList" style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;" placeholder="Let us know your special requests / notes."></textarea>
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
<?php include("include/footer.php"); ?>