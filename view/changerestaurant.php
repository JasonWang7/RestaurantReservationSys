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
			$featureList = explode(" ", $features);
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
	  
      <form class="form-horizontal" role="form" action="/RRS/controller/modifyRestaurantController.php?id=" <?php echo htmlspecialchars($restaurantId) ?> method="post">  
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
			  <?php if (in_array("african", $featureList)) : ?>
				African <input type="checkbox" name="african" checked> &nbsp; 
			  <?php else : ?>
				African <input type="checkbox" name="african"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("alcoholMenu", $featureList)) : ?>
				Alcohol Menu <input type="checkbox" name="alcoholMenu" checked> &nbsp; 
			  <?php else : ?>
				Alcohol Menu <input type="checkbox" name="alcoholMenu"> &nbsp; 
			  <?php endif; ?>	

			  <?php if (in_array("american", $featureList)) : ?>
				American <input type="checkbox" name="american" checked> &nbsp; 
			  <?php else : ?>
				American <input type="checkbox" name="american"> &nbsp; 
			  <?php endif; ?>	

			  <?php if (in_array("buffet", $featureList)) : ?>
				Buffet <input type="checkbox" name="buffet" checked> &nbsp; 
			  <?php else : ?>
				Buffet <input type="checkbox" name="buffet"> &nbsp; 
			  <?php endif; ?>	
 
			  <?php if (in_array("casualDining", $featureList)) : ?>
				Casual Dining <input type="checkbox" name="casualDining" checked> &nbsp; 
			  <?php else : ?>
				Casual Dining <input type="checkbox" name="casualDining"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("chinese", $featureList)) : ?>
				Chinese <input type="checkbox" name="chinese" checked> &nbsp; 
			  <?php else : ?>
				Chinese <input type="checkbox" name="chinese"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("coffeehouse", $featureList)) : ?>
				Coffeehouse <input type="checkbox" name="coffeehouse" checked> &nbsp; 
			  <?php else : ?>
				Coffeehouse <input type="checkbox" name="coffeehouse"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("fastFood", $featureList)) : ?>
				Fast Food <input type="checkbox" name="fastFood" checked> &nbsp; 
			  <?php else : ?>
				Fast Food <input type="checkbox" name="fastFood"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("fineDining", $featureList)) : ?>
				Fine Dining <input type="checkbox" name="fineDining" checked> &nbsp; 
			  <?php else : ?>
				Fine Dining <input type="checkbox" name="fineDining"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("french", $featureList)) : ?>
				French <input type="checkbox" name="french" checked> &nbsp; 
			  <?php else : ?>
				French <input type="checkbox" name="french"> &nbsp; 
			  <?php endif; ?>	
              
			  <?php if (in_array("indian", $featureList)) : ?>
				Indian <input type="checkbox" name="indian" checked> &nbsp; 
			  <?php else : ?>
				Indian <input type="checkbox" name="indian"> &nbsp; 
			  <?php endif; ?>	
			  
              <?php if (in_array("irish", $featureList)) : ?>
				Irish <input type="checkbox" name="irish" checked> &nbsp; 
			  <?php else : ?>
				Irish <input type="checkbox" name="irish"> &nbsp; 
			  <?php endif; ?>	
              
			  <?php if (in_array("italian", $featureList)) : ?>
				Italian <input type="checkbox" name="italian" checked> &nbsp; 
			  <?php else : ?>
				Italian <input type="checkbox" name="italian"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("japanese", $featureList)) : ?>
				Japanese <input type="checkbox" name="japanese" checked> &nbsp; 
			  <?php else : ?>
				Japanese <input type="checkbox" name="japanese"> &nbsp; 
			  <?php endif; ?>	
			  
			  <?php if (in_array("kidFriendly", $featureList)) : ?>
				Kid Friendly <input type="checkbox" name="kidFriendly" checked> &nbsp; 
			  <?php else : ?>
				Kid Friendly <input type="checkbox" name="kidFriendly"> &nbsp; 
			  <?php endif; ?>	
              
			  <?php if (in_array("korean", $featureList)) : ?>
				Korean <input type="checkbox" name="korean" checked> &nbsp; 
			  <?php else : ?>
				Korean <input type="checkbox" name="korean"> &nbsp; 
			  <?php endif; ?>	
              
			  <?php if (in_array("pub", $featureList)) : ?>
				Pub <input type="checkbox" name="pub" checked> &nbsp; 
			  <?php else : ?>
				Pub <input type="checkbox" name="pub"> &nbsp; 
			  <?php endif; ?>	
			  
              <?php if (in_array("tabletopCooking", $featureList)) : ?>
				Tabletop Cooking <input type="checkbox" name="tabletopCooking" checked> &nbsp; 
			  <?php else : ?>
				Table Top Cooking <input type="checkbox" name="tabletopCooking"> &nbsp; 
			  <?php endif; ?>	
              
			  <?php if (in_array("vegan", $featureList)) : ?>
				Vegan <input type="checkbox" name="vegan" checked> &nbsp; 
			  <?php else : ?>
				Vegan <input type="checkbox" name="vegan"> &nbsp; 
			  <?php endif; ?>	
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
