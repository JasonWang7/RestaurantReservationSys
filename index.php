<!--
    Author: Vince - this is the index page (front end stuff)
-->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
include($root ."util/database.class.php");
?>
<script>
$(document).ready(function(){
    $("#show").click(function(){
      if ( $( "#advanced" ).is( ":hidden" ) ) {
          $( "#advanced" ).slideDown( "slow" );
        } else {
          $( "#advanced" ).slideUp();
        }
    });
});
</script>
<div class="row">
  <div class="col-md-12"> 
    <form style="font-size:24px" method="post" action="/RRS/controller/searchResultsController.php">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-7">
            <div class="input-group">
              <input name="searchQuery" type="textbox" placeholder="Search for Restaurants..." class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" id="addressSearch">Search</button>
              </span>
            </div>
            </div>
          <div class="col-sm-5">
             <a id="show">Advanced Search</a> - <a href="addrestaurant">Add a Restaurant</a>
          </div>
        </div>
      </div>
      <div class="bg-danger" id="advanced" style="font-size: 14px; display:none;">
          <div class="col-md-13" style="padding:10px;">
            <div class="form-group">
              <label class="control-label"><b>Features:</b> </label>
              <div class="col-md-13">
                African <input type="checkbox" name="african"> &nbsp;
                Alcohol Menu <input type="checkbox" name="alcoholMenu"> &nbsp;
                American <input type="checkbox" name="american"> &nbsp;
                Buffet <input type="checkbox" name="buffet"> &nbsp;
                Casual Dining <input type="checkbox" name="casualDining"> &nbsp;
                Chinese <input type="checkbox" name="chinese"> &nbsp;
                Coffeehouse <input type="checkbox" name="coffeehouse"> &nbsp;
                Fast Food <input type="checkbox" name="fastFood"> &nbsp;
                Fine Dining <input type="checkbox" name="fineDining"> &nbsp;
                French <input type="checkbox" name="french"> &nbsp; 
                Indian <input type="checkbox" name="indian"> &nbsp; 
                Irish <input type="checkbox" name="irish"> &nbsp;
                Italian <input type="checkbox" name="italian"> &nbsp; 
                Japanese <input type="checkbox" name="japanese"> &nbsp;
                Kid Friendly <input type="checkbox" name="kidFriendly"> &nbsp;
                Korean <input type="checkbox" name="korean"> &nbsp;
                Pub <input type="checkbox" name="pub">&nbsp; 
                Tabletop Cooking <input type="checkbox" name="tabletopCooking"> &nbsp;
                Vegan <input type="checkbox" name="vegan"> &nbsp;
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label class="control-label"><b>Price Range:</b> </label>
                <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Enter max price">
              </div>
                            <div class="col-md-4">
                <label class="control-label"><b>Rating:</b> </label>
                  <select class="form-control">
                    <option></option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
              </div>
                            <div class="col-md-4">
                <label class="control-label"><b>Type:</b> </label>
                  <select class="form-control">
                    <option></option>
                    <option>Popular</option>
                    <option>New</option>
                  </select>
              </div>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>
<p><p>
<div class="row">
  <div class="col-md-12"> 
    <div class="jumbotron">
    <div class="row">
      <div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; height:180px;">"This dining place is good...." by Test Guy<p>on <a href="#">Bob Diner</a></div>
      <div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; height:180px;">"This dining place is good...." by Test Guy<p>on <a href="#">Bob Diner</a></div>
      <div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; height:180px;">"This dining place is good...." by Test Guy<p>on <a href="#">Bob Diner</a></div>
      <div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; height:180px;">"This dining place is good...." by Test Guy<p>on <a href="#">Bob Diner</a></div>
      <div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; height:180px;">"This dining place is good...." by Test Guy<p>on <a href="#">Bob Diner</a></div>
      <div class="well col-md-2" style="font-size:18px; background-color:#eee; margin:8px; text-align:middle; width:50px; height:180px;"><a href="#">></a></div>
    </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="btn-group btn-group-justified">
    <a href="#" class="btn btn-primary">Popular Restaurants</a>
    <a href="#" class="btn btn-primary">New Restaurants</a>
    <a href="#" class="btn btn-primary">Events</a>
    <a href="#" class="btn btn-primary">Reviews</a>
  </div>
</div>
<hr>
<div class="row">
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Cusine</th>
      <th>Features</th>
      <th>Cost</th>
    </tr>
  </thead>
  <tbody>
    <?php
      
      $dbconn = mysqldatabaserrs::connectdb();
    $query = "select * from restaurant";
    try {

    $stmt = $dbconn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
      $data = '<tr>' . '<td>' . $row[0] . '</td><td><a href="profile?id=' . $row[0] . '">'.$row[3].'</td><td>' . $row[6] . "</td><td>" . $row[7] . '</td></tr>';
      echo $data . '</a>';
    }
    $stmt = null;

    }
    catch (PDOException $e) {
      print $e->getMessage();
    }

    mysqldatabaserrs::closeconnection($dbconn);
    ?>
  </tbody>
</table> 
</div>
<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/footer.php"); ?>
