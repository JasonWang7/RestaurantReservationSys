<?php include("include/header.php"); ?>
<div class="row">
  <div class="col-12">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#menu" data-toggle="tab" aria-expanded="false">Account Details</a></li>
      <li class=""><a href="#reviews" data-toggle="tab" aria-expanded="true">Reservations</a></li>
      <li class=""><a href="#events" data-toggle="tab" aria-expanded="true">Likes</a></li>
      <li class=""><a href="#about" data-toggle="tab" aria-expanded="true">Reviews</a></li>
      <li class=""><a href="#rateadish" data-toggle="tab" aria-expanded="true">Reward</a></li>
      <li class=""><a href="#rateadish" data-toggle="tab" aria-expanded="true">Bills</a></li>
      <li class=""><a href="deleteacc.php">Delete Account</a></li>
    </ul>
    <div id="myTabContent" class="tab-content" style="margin-left:20px;">
      <div class="tab-pane fade active in" id="menu">
        <div class="row">
        <div class="col-md-12">
          <h3>Account Details:</h3>
            <div class="row">
              <div class="col-md-12"><h2>Username: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>First Name: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Last Name: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Email: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>City: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Password: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Confirm Password: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Address: <input type="text" name="box"></h2></div>
            </div>
            <div class="row">
              <div class="col-md-12"><h2>Credit Card: <input type="text" name="box"></h2></div>
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
  </div>
</div>
<?php include("include/footer.php"); ?>