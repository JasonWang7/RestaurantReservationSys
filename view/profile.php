<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
include($root ."util/database.class.php");
?>
<?php
    $dbconn = mysqldatabaserrs::connectdb();
    $query = "select * from restaurant where restaurantid=:profileid";

    try {

    $stmt = $dbconn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt ->bindParam(":profileid",$_GET['id']);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
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

    mysqldatabaserrs::closeconnection($dbconn);
?>

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
        </div>
      </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-9">
    <h3>Hours of Operation:</h3>
      <div class="row">
        <div class="col-md-2">Monday: <p>1pm - 10pm</div>
        <div class="col-md-2">Monday: <p>1pm - 10pm</div>
        <div class="col-md-2">Monday: <p>1pm - 10pm</div>
        <div class="col-md-2">Monday: <p>1pm - 10pm</div>
        <div class="col-md-2">Monday: <p>1pm - 10pm</div>
        <div class="col-md-2">Monday: <p>1pm - 10pm</div>
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
    <p>RAte here here</p>
  </div>
</div>

<div class="modal fade" id="bookmodal" tabindex="-1" role="dialog" aria-labelledby="bookmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label">Book Table at _________</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <h3>Date: </h3><input type="text" name="box">
          </div>
          <div class="col-md-4">
            <h3>Time:</h3><input type="text" name="box">
          </div>
          <div class="col-md-4">
            <h3># of Guests: </h3><input type="text" name="box">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Special Request / Note:</h3>
            <textarea style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;">Let us know your special requests / notes.</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Your Phone Number:</h3><input type="text" name="box">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Your Email Address:</h3>    <input type="text" name="box">  
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3>Enter your email addresses for your guests. Please separate them with the character ";" (no quotes)</h3>
            <textarea style="overflow: hidden; word-wrap: break-word; resize: horizontal; width:100%; height: 100px;">Let us know your special requests / notes.</textarea>
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

<div class="modal fade" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="reviewmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label">Review for _________</h4>
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