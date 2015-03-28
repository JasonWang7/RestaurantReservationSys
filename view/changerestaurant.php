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
              <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Address </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Phone Number</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Price Range</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Features</label>
            <div class="col-sm-6">
                  <label class="checkbox-inline">
                    <input type="checkbox" value="">Option 1
                  </label>
                  <label class="checkbox-inline">
                    <input type="checkbox" value="">Option 2
                  </label>
                  <label class="checkbox-inline">
                    <input type="checkbox" value="">Option 3
                  </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Hours</label>
            <div class="col-sm-6">
              <div id="hours">
              <div id="hoursText">
                <h4 class="white">Hours</h4>
              </div>
            
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
          <div class="form-group">
            <label class="col-sm-3 control-label">About</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Website URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
            </div>
          </div>

        </fieldset>
      </form>
            <div id="restaurantName">
              <div id="restaurantNameText">
                <h4 class="white">Restaurant Name</h4>
              </div>
              <input type="text" name="restaurantName" size="35" maxlength="35" style="cursor: auto; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            </div>
            
            <div id="address">
              <div id="addressText">
                <h4 class="white">Address</h4>
              </div>
              <input type="text" name="address" size="35" maxlength="35">
            </div>
            
            <div id="email">
              <div id="emailText">
                <h4 class="white">Email</h4>
              </div>
              <input type="text" name="email" size="35" maxlength="35">
            </div>
            
            <div id="phone">
              <div id="phoneText">
                <h4 class="white">Phone Number</h4>
              </div>
              <input type="text" name="phone" size="25" maxlength="25">
            </div>
          
            <!--features of restaurant separated into radio buttons-->
            <div id="features">
              <div id="featuresText">
                <h4 class="white">Features</h4>
              </div>
              
              African <input type="radio" name="african"> &nbsp;
              Alcohol Menu <input type="radio" name="alcoholMenu"> &nbsp;
              American <input type="radio" name="american"> &nbsp;
              Buffet <input type="radio" name="buffet"> &nbsp;
              Casual Dining <input type="radio" name="casualDining"> &nbsp; <br>
              Chinese <input type="radio" name="chinese"> &nbsp;
              Coffeehouse <input type="radio" name="coffeehouse"> &nbsp;
              Fast Food <input type="radio" name="fastFood"> &nbsp;
              Fine Dining <input type="radio" name="fineDining"> &nbsp;
              French <input type="radio" name="french"> &nbsp; <br>
              Indian <input type="radio" name="indian"> &nbsp; 
              Irish <input type="radio" name="irish"> &nbsp;
              Italian <input type="radio" name="italian"> &nbsp; 
              Japanese <input type="radio" name="japanese"> &nbsp;
              Kid Friendly <input type="radio" name="kidFriendly"> &nbsp; <br>
              Korean <input type="radio" name="korean"> &nbsp;
              Pub <input type="radio" name="pub">&nbsp; 
              Tabletop Cooking <input type="radio" name="tabletopCooking"> &nbsp;
              Vegan <input type="radio" name="vegan"> &nbsp;
            </div>
          
            <!--approximate price range of dining at restaurant-->
            <div id="priceRange">
              <div id="priceRangeText">
                <h4 class="white">Price Range</h4>
              </div>
              <input type="text" name="priceRange" size="25" maxlength="25">
            </div>
          
            <!--hours corresponding to each day of the week-->
            <div id="hours">
              <div id="hoursText">
                <h4 class="white">Hours</h4>
              </div>
            
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
        
            <div id="photos">
        
            </div>
        
            <div id="menu">
          
            </div>
        
            <div id="rate">
        
            </div>
        
            <!--Basic description of the restaurant-->
            <div id="about">
              <div id="aboutText">
                <h4 class="white">About (O)</h4>
              </div>
              <textarea cols="65" rows="8" name="about"></textarea>
            </div>
        
            <!--link to restaurant website (if owner currently has one)-->
            <div id="website">
              <div id="websiteText">
                <h4 class="white">Website (O)</h4>
              </div>
              <input type="text" name="website" size="50" maxlength="100">
            </div>    
          </div>    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>
