<?php
/******************************************************************************************
* File name: viewDish.php
* Purpose: Acts as interface for viewing/editing signature dishes corresponding
* to a given restaurant's menu
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: April 12, 2015
******************************************************************************************/
?>

<?php include("include/header.php"); ?>

    <div class="page">
	  <?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			
			require_once($root.'model/restaurant.php');
			require_once($root.'model/signatureDish.php');
			$restaurantId = $_GET["id"];
			$restaurantSelector = new restaurant;
			$dishSelector = new signatureDish;
			
			$restaurantName = $restaurantSelector->selectRestaurantName($restaurantId);
			
			$dishes = $dishSelector->selectAllDishes($restaurantId);
	  ?> 
	<?php 
		$count = count($dishes); ?>
	
		<div name="title">
            <h4><?php echo htmlspecialchars("Dishes on Menu for " . $restaurantName);?></h4>
        </div>
		<br><br><br>
	<?php
		for ($i = 0; $i < $count; $i++)
		{?>
      <form class="form-horizontal" role="form" action="/RRS/controller/modifyDishController.php?id=<?php echo htmlspecialchars($restaurantId) ?>" method="post">  
          <div class="form-group">
            <label class="col-sm-3 control-label">Dish Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="<?php echo "dishName" . htmlspecialchars($i+1)?>" size="50" maxlength="50" value="<?php echo htmlspecialchars($dishes[$i][1]); ?>" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Price</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="price" value="<?php echo htmlspecialchars($dishes[$i][2]); ?>" size="15" maxlength="15" placeholder="">
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-3 control-label">Rating</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="rating" readonly value="<?php echo htmlspecialchars($dishes[$i][3]) . "/5"; ?>" size="15" maxlength="15" placeholder="">
            </div>
			<br><br><br><br><br>
          </div>
		<?php } ?>

        <button class="btn btn-info" style="float:right;" id="submitbtn" value="submit" type="submit"><i class="icon-hand-right"></i>Confirm</button>
	</div>
	<br><br><br>
<?php include("include/footer.php"); ?>