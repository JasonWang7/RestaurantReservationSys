<!-- Vincent Tieu created this page -->
<!-- Temp this code based off of Rhys' since it contains all the info needed -->
<?php include("include/header.php"); ?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">
	  <div class="title" style="padding: 0px 0px 0px 350px;">
	    <p>Modify Restaurant</p>
	  </div>
	  
	  <?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			
			require_once($root.'model/restaurant.php');
			require_once($root.'model/businessHour.php');
			$restaurantId = $_GET["id"];
			$restaurantSelector = new restaurant;
			$restaurantObj = new restaurant;
			$hoursSelector = new businessHour;
			$sundayHoursObj = new businessHour;
			$mondayHoursObj = new businessHour;
			$tuesdayHoursObj = new businessHour;
			$wednesdayHoursObj = new businessHour;
			$thursdayHoursObj = new businessHour;
			$fridayHoursObj = new businessHour;
			$saturdayHoursObj = new businessHour;
			$restaurantName = $restaurantSelector->selectRestaurantName($restaurantId);
			
			$restaurantObj = $restaurantSelector->selectRestaurantInfo($restaurantName);
			
			$sundayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "sunday");
			$mondayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "monday");
			$tuesdayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "tuesday");
			$wednesdayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "wednesday");
			$thursdayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "thursday");
			$fridayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "friday");
			$saturdayHoursObj = $hoursSelector->selectHoursInfo($restaurantId, "saturday");
			
			$address = $restaurantObj->getAddress();
			$email = $restaurantObj->getEmail();
			$phone = $restaurantObj->getPhone();
			$features = $restaurantObj->getFeatures();
			$priceRange = $restaurantObj->getPriceRange();
			$about = $restaurantObj->getAbout();
			$website = $restaurantObj->getWebsite();
			
			$sundayStart = $sundayHoursObj->getStartHour();
			$sundayEnd = $sundayHoursObj->getEndHour();
			$mondayStart = $mondayHoursObj->getStartHour();
			$mondayEnd = $mondayHoursObj->getEndHour();
			$tuesdayStart = $tuesdayHoursObj->getStartHour();
			$tuesdayEnd = $tuesdayHoursObj->getEndHour();
			$wednesdayStart = $wednesdayHoursObj->getStartHour();
			$wednesdayEnd = $wednesdayHoursObj->getEndHour();
			$thursdayStart = $thursdayHoursObj->getStartHour();
			$thursdayEnd = $thursdayHoursObj->getEndHour();
			$fridayStart = $fridayHoursObj->getStartHour();
			$fridayEnd = $fridayHoursObj->getEndHour();
			$saturdayStart = $saturdayHoursObj->getStartHour();
			$saturdayEnd = $saturdayHoursObj->getEndHour();
	  ?> 
	  
      <form class="form-horizontal" role="form" action="/RRS/controller/addRestaurantController.php" method="post">  
        <fieldset>
          <div class="form-group">
            <label class="col-sm-3 control-label">Restaurant Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="restaurantName" value="<?php echo htmlspecialchars($restaurantName); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Address </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Phone Number</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Price Range</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="priceRange" value="<?php echo htmlspecialchars($priceRange); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Website URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="website" value="<?php echo htmlspecialchars($website); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">About</label>
            <div class="col-sm-6">
              <textarea class="form-control" name="about" rows="5" value="comment"><?php echo htmlspecialchars($about); ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Features</label>
            <div class="col-sm-6">
              African <input type="checkbox" name="african"> &nbsp;
              Alcohol Menu <input type="checkbox" name="alcoholMenu"> &nbsp;
              American <input type="checkbox" name="american"> &nbsp;
              Buffet <input type="checkbox" name="buffet"> &nbsp;
              Casual Dining <input type="checkbox" name="casualDining"> &nbsp; <br>
              Chinese <input type="checkbox" name="chinese"> &nbsp;
              Coffeehouse <input type="checkbox" name="coffeehouse"> &nbsp;
              Fast Food <input type="checkbox" name="fastFood"> &nbsp;
              Fine Dining <input type="checkbox" name="fineDining"> &nbsp;
              French <input type="checkbox" name="french"> &nbsp; <br>
              Indian <input type="checkbox" name="indian"> &nbsp; 
              Irish <input type="checkbox" name="irish"> &nbsp;
              Italian <input type="checkbox" name="italian"> &nbsp; 
              Japanese <input type="checkbox" name="japanese"> &nbsp;
              Kid Friendly <input type="checkbox" name="kidFriendly"> &nbsp; <br>
              Korean <input type="checkbox" name="korean"> &nbsp;
              Pub <input type="checkbox" name="pub">&nbsp; 
              Tabletop Cooking <input type="checkbox" name="tabletopCooking"> &nbsp;
              Vegan <input type="checkbox" name="vegan"> &nbsp;
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Hours</label>
            <div class="col-sm-6">
              <div id="hours">
            
              Sunday: &nbsp; <input type="text" name="sundayStart" value="<?php echo htmlspecialchars($sundayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="sundayEnd" value="<?php echo htmlspecialchars($sundayEnd); ?>" size="5" maxlength="4">
              <br><br>
              Monday: &nbsp; <input type="text" name="mondayStart" value="<?php echo htmlspecialchars($mondayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="mondayEnd" value="<?php echo htmlspecialchars($mondayEnd); ?>" size="5" maxlength="4">
              <br><br>
              Tuesday: &nbsp; <input type="text" name="tuesdayStart" value="<?php echo htmlspecialchars($tuesdayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="tuesdayEnd" value="<?php echo htmlspecialchars($tuesdayEnd); ?>" size="5" maxlength="4">
              <br><br>
              Wednesday: &nbsp; <input type="text" name="wednesdayStart" value="<?php echo htmlspecialchars($wednesdayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="wednesdayEnd" value="1""<?php echo htmlspecialchars($wednesdayEnd); ?>" size="5" maxlength="4">
              <br><br>
              Thursday: &nbsp; <input type="text" name="thursdayStart" value="<?php echo htmlspecialchars($thursdayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="thursdayEnd" value="<?php echo htmlspecialchars($thursdayEnd); ?>" size="5" maxlength="4">
              <br><br>
              Friday: &nbsp; <input type="text" name="fridayStart" value="<?php echo htmlspecialchars($fridayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="fridayEnd" value="<?php echo htmlspecialchars($fridayEnd); ?>" size="5" maxlength="4">
              <br><br>
              Saturday: &nbsp; <input type="text" name="saturdayStart" value="<?php echo htmlspecialchars($saturdayStart); ?>" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="saturdayEnd" value="<?php echo htmlspecialchars($saturdayEnd); ?>" size="5" maxlength="4">         
            </div>
            </div>

          </div>
        <button class="btn btn-info" style="float:right;" id="submitbtn" value="submit" type="submit"><i class="icon-hand-right"></i>Submit Changes</button>

        </fieldset>
      </form>
  </div>
</div>
<?php include("include/footer.php"); ?>
