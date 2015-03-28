<!-- Vincent Tieu created this page -->
<!-- Temp this code based off of Rhy's since it contains all the info needed -->
<?php include("include/header.php"); ?>
<div class="row">
  <div class="col-12">  
    <div class="jumbotron">

      <form class="form-horizontal" role="form">
        <fieldset>
          <div class="form-group">
            <label class="col-sm-3 control-label">Restaurant Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="NAME_HERE" id="NAME_HERE" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Address </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="NAME_HERE" id="NAME_HERE" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="NAME_HERE" id="NAME_HERE" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Phone Number</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="NAME_HERE" id="NAME_HERE" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Price Range</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="NAME_HERE" id="NAME_HERE" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Website URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="NAME_HERE" id="NAME_HERE" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">About</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="5" id="comment"></textarea>
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
            
              Sunday: &nbsp; <input type="text" name="sundayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="sundayEnd" size="5" maxlength="4">
              <br><br>
              Monday: &nbsp; <input type="text" name="mondayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="mondayEnd" size="5" maxlength="4">
              <br><br>
              Tuesday: &nbsp; <input type="text" name="tuesdayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="tuesdayEnd" size="5" maxlength="4">
              <br><br>
              Wednesday: &nbsp; <input type="text" name="wednesdayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="wednesdayEnd" size="5" maxlength="4">
              <br><br>
              Thursday: &nbsp; <input type="text" name="thursdayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="thursdayEnd" size="5" maxlength="4">
              <br><br>
              Friday: &nbsp; <input type="text" name="fridayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="fridayEnd" size="5" maxlength="4">
              <br><br>
              Saturday: &nbsp; <input type="text" name="saturdayStart" size="5" maxlength="4"> &nbsp;
              to &nbsp; <input type="text" name="saturdayEnd" size="5" maxlength="4">         
            </div>
            </div>

          </div>
        <button class="btn btn-info" style="float:right;" id="submitbtn" value="submit" type="submit"><i class="icon-hand-right"></i>Submit Changes</button>

        </fieldset>
      </form>
  </div>
</div>
<?php include("include/footer.php"); ?>
