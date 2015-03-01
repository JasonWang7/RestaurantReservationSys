<!--
    Author: Vince - this is the index page
-->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
include($root."view/include/header.php"); 
include($root ."util/database.class.php");
?>

<div class="row">
  <div class="col-md-12"> 
    <form style="font-size:28px" class="navbar-form navbar-left" role="search">
            Find a Resturant: 
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <div style="font-size:28px" class="navbar-form navbar-right" role="search">
      Or if you can't find one. <a href="addrestaurant">Add a Resturant</a>
    </div>
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
