<?php 
/****vince****/
error_reporting(0);
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
include($root ."util/database.class.php");
include($root ."model/restaurantOwnership.php");
include($root ."model/businessHour.php");
?>
<?php
	//retrieve restaurant info
    $userObj = new user;
    $auth = new mysqldatabaserrs;
    $dbconn = $auth->connectdb();
    $query = "select * from restaurant where restaurantid=:profileid";

    try {

    $stmt = $dbconn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt ->bindParam(":profileid",$_GET['id']);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
	  $id = $row[0];
      $name = $row[3];
      $phone = $row[5];
      $features = $row[6];
      $price = $row[7];
    }
    $stmt = null;

    }
    catch (PDOException $e) {
      print $e->getMessage();
    }

    $auth->closeconnection($dbconn);
	
	/******************** retrieve restaurant hours info (section written by Rhys Hall) *************************/
	$sundayHoursObj = new businessHour;
	$mondayHoursObj = new businessHour;
	$tuesdayHoursObj = new businessHour;
	$wednesdayHoursObj = new businessHour;
	$thursdayHoursObj = new businessHour;
	$fridayHoursObj = new businessHour;
	$saturdayHoursObj = new businessHour;
	$selector = new businessHour;
    
	$sundayHoursObj = $selector->selectHoursInfo($id, "sunday");
	$mondayHoursObj = $selector->selectHoursInfo($id, "monday");
	$tuesdayHoursObj = $selector->selectHoursInfo($id, "tuesday");
	$wednesdayHoursObj = $selector->selectHoursInfo($id, "wednesday");
	$thursdayHoursObj = $selector->selectHoursInfo($id, "thursday");
	$fridayHoursObj = $selector->selectHoursInfo($id, "friday");
	$saturdayHoursObj = $selector->selectHoursInfo($id, "saturday");
	
	/******************************** ending of section written by Rhys Hall *************************/
?>

<!-------- displays pop-up that displays interface for user to enter ownership info into (section written by Rhys Hall) -------->
<script type="text/javascript">

function loginRequiredPopup(url) 
{
	popUp = window.open(url,'Ownership Information','height=350,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

function ownerInfoPopup(url) 
{
	popUp = window.open(url,'Ownership Information','height=600,width=700,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>
<!--------------------------------- Ending of section written by Rhys Hall -------------------------------------------->

<!-- Vincent Tieu created this page -->
<!-- some things such as the tabbed pages are from the http://bootswatch.com/simplex/ examples -->

<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
      <div class="row">
        <div class="col-md-3">
          PHOTO HERE
        </div>
        <div class="col-md-9">
                <div class="row">
                  <h2><?php echo $name; ?></h2>
                  <h3>Phone: <?php echo $phone; ?> / Rating: 5 out of 5</h3>
                </div>
                <div class="row">
                  <div class="btn-group btn-group-justified">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#bookmodal">Book Table</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#reviewmodal">Review</a>
                    <a href="#" class="btn btn-primary">Subscribe</a>
                    <a href="#" class="btn btn-primary">Favourite</a>
                  </div>
                </div>
                <div class="row">
                  <h3><?php echo $features; ?></h3>
                </div>
                <div class="row">
                  <h3>Price Range: <?php echo $price; ?></h3>
                </div>
                <div class="row">
                  <h3>Payment Methods: Credit card, Cash</h3>
                </div>
				
				<!-------- takes appropriate action for given restaurant's ownership (section written by Rhys Hall)-------->
				<?php 
					$_SESSION["restaurantId"] = $id;

					$selector = new restaurantOwnership;
					$ownershipObj = new restaurantOwnership;
					
					$ownershipObj = $selector->selectRestaurantOwnership($id);
				?>
				<!-- if ownership not present for given restaurant --->
				<?php if (is_null($ownershipObj->getOwnerId())) : ?>
					<!-- if user not logged in --->
					<?php if (is_null($_SESSION['sess_username'])) : ?>
						<!-- prompt user to log in -->
						<div class="row" style=font-size:120%>
							<br>
							<a href="JavaScript:loginRequiredPopup('/RRS/view/loginRequired.php');">Own this restaurant? Click here to verify ownership</a>
						</div>
					<!-- else, allow user to enter ownership info -->
					<?php else : ?>
						<div class="row" style=font-size:120%>
							<br>
							<a href="JavaScript:ownerInfoPopup('/RRS/view/addRestaurantOwner.php');">Own this restaurant? Click here to verify ownership</a>
						</div>
					<?php endif; ?>	
				<!-- else, display green check-mark for ownership indication --> 
				<?php else : ?>
					<br>
					<img src="/RRS/img/green_checkmark.jpg" alt="Ownership Declared" style="width:20px;height:20px">
				<?php endif; ?>	
				<!------------------------ Ending of section written by Rhys Hall ----------------------------->
        </div>
      </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-9">
    <h3>Hours of Operation:</h3>
      <div class="row">
        <div class="col-md-2">Sunday: <p><?php echo $sundayHoursObj->getStartHour() . " - " . $sundayHoursObj->getEndHour();?></div>
        <div class="col-md-2">Monday: <p><?php echo $mondayHoursObj->getStartHour() . " - " . $mondayHoursObj->getEndHour();?></div>
        <div class="col-md-2">Tuesday: <p><?php echo $tuesdayHoursObj->getStartHour() . " - " . $tuesdayHoursObj->getEndHour();?></div>
        <div class="col-md-2">Wednesday: <p><?php echo $wednesdayHoursObj->getStartHour() . " - " . $wednesdayHoursObj->getEndHour();?></div>
        <div class="col-md-2">Thursday: <p><?php echo $thursdayHoursObj->getStartHour() . " - " . $thursdayHoursObj->getEndHour();?></div>
        <div class="col-md-2">Friday: <p><?php echo $fridayHoursObj->getStartHour() . " - " . $fridayHoursObj->getEndHour();?></div>
		<div class="col-md-2">Saturday: <p><?php echo $saturdayHoursObj->getStartHour() . " - " . $saturdayHoursObj->getEndHour();?></div>
      </div>
  </div>
</div>
<hr>
<ul class="nav nav-tabs">
  <li class="active"><a href="#menu" data-toggle="tab" aria-expanded="false">Menu</a></li>
  <li class=""><a href="#reviews" data-toggle="tab" aria-expanded="true">Reviews</a></li>
  <li class=""><a href="#events" data-toggle="tab" aria-expanded="true">Events</a></li>
  <li class=""><a href="#about" data-toggle="tab" aria-expanded="true">About</a></li>
  <li class=""><a href="#rateadish" data-toggle="tab" aria-expanded="true">Rate A Dish</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="menu">
    <div class="row">
    <div class="col-md-9">
      <h3>Photo Menu:</h3>
        <div class="row">
          <div class="col-md-2">IMAGE HERE</div>
          <div class="col-md-2">IMAGE HERE</div>
          <div class="col-md-2">IMAGE HERE</div>
        </div>
    </div>
</div>  
  </div>
  <div class="tab-pane fade" id="reviews">
    <p>Reviews Here</p>
  </div>
  <div class="tab-pane fade" id="events">
    <p>Events here</p>
  </div>
  <div class="tab-pane fade" id="about">
    <p>About here</p>
  </div>
  <div class="tab-pane fade" id="rateadish">
    <p>RAte here</p>
  </div>
</div>

<?php if (is_null($ownershipObj->getOwnerId()) == FALSE) : ?>
<div class="modal fade" id="bookmodal" tabindex="-1" role="dialog" aria-labelledby="bookmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label">Book Table at <?php echo $name; ?></h4>
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
<?php else : ?>
<div class="modal fade" id="bookmodal" tabindex="-1" role="dialog" aria-labelledby="bookmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label">Booking Denied for <?php echo $name; ?></h4>
      </div>
      <div class="modal-body">
	    <h4>Cannot book a table at a restaurant that does not have a verified ownership</h4>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	</div>
  </div>
</div>
<?php endif; ?>	

<div class="modal fade" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="reviewmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label">Review for <?php echo $name; ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h3>Service:</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Food:</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Ambience:</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Overall Experience:</h3>      
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Comments:</h3>
            <textarea style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;">Tell us what you thought about this experience.</textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<?php include("include/footer.php"); ?>