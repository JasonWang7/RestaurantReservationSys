<?php
/******************************************************************************************
* File name: searchResultsController.php
* Purpose: Displays all results to page that match user's search query
* Author: Rhys Hall
* Group Name: Centaur Logic
* Created: March 28, 2015
******************************************************************************************/
?>

<html>
	<head>
		<title>Search Results (Controller)</title>
	</head>
	
	<body>
		<?php
			$root = $_SERVER['DOCUMENT_ROOT'].'/RRS/';
			include($root."view/include/header.php"); 
			require_once($root.'model/restaurant.php');
			
			$searchQuery = $_POST["searchQuery"];
			$restaurantSelector = new restaurant;
			$features = array("african", "alcoholMenu", "american", "buffet", "casualDining", 
			"chinese", "coffeehouse", "fastFood", "fineDining", "french", "indian", "irish",
			"italian", "japanese", "kidFriendly", "korean", "pub", "tableTopCooking", "vegan");
			$featureList = array();
			$index = 0;
			
			$restaurantMatches = $restaurantSelector->selectMatchingRestaurants($searchQuery);
			
			//add all strings of features into array
			for($i = 0; $i < 19; $i++)
			{
				if (!empty($_POST[$features[$i]]))
				{
					$featureList[$index] = $features[$i];
					$index++;
				}
			}
			
			$matchCount = count($restaurantMatches);
			$featureCount = count($featureList);
			
			for ($i = 0; $i < $matchCount; $i++)
			{
				for ($j = 0; $j < $featureCount; $j++)
				{
					if (strstr($restaurantMatches[$i]["features"], $featureList[$j]) == false)
					{
						unset($restaurantMatches[$i]);
					}
				}
			}
			
			$index = 0;
			$temp = array();
			
			for ($i = 0; $i < $matchCount; $i++)
			{
				if (!empty($restaurantMatches[$i]))
				{
					$temp[$index] = $restaurantMatches[$i];
					$index++;
				}
			}
			
			$restaurantMatches = $temp;
			$priceRange = $_POST["priceRange"];
			$matchCount = count($restaurantMatches);
			
			if (strcmp($priceRange, "") != 0)
			{
				$priceRangeLength = strlen($priceRange);
				
				//parse min and max values of price range 
				for ($i = 0; $i < $priceRangeLength; $i++)
				{
					if ($priceRange[$i] == '$')
					{
						$i++;
						$min = "";
						
						break;
					}
				}
				
				while ((is_numeric(strval($priceRange[$i])) == 1) && ($i < $priceRangeLength))
				{
					$min = $min . $priceRange[$i];
					$i++;
				}
						
				for ($j = $i; $j < $priceRangeLength; $j++)
				{
					if ($priceRange[$j] == '$')
					{
						$j++;
						$max = "";
						
						break;
					}
				}
												
				while ((is_numeric($priceRange[$j]) == TRUE) && ($j < $priceRangeLength))
				{
					$max = $max . strval($priceRange[$j]);
					$j++;
				}
				
				//select restaurants with matching features
				for ($i = 0; $i < $matchCount; $i++)
				{
					$matchPriceRange = $restaurantMatches[$i]["pricerange"];
					$priceRangeLength = strlen($matchPriceRange);
				
					//parse min and max values of price range 
					for ($j = 0; $j < $priceRangeLength; $j++)
					{
						if ($matchPriceRange[$j] == '$')
						{
							$j++;
							$matchMin = "";
						
							break;
						}
					}
					
					while ((is_numeric(strval($matchPriceRange[$j])) == 1) && ($j < $priceRangeLength))
					{
						$matchMin = $matchMin . $matchPriceRange[$j];
						$j++;
					}
						
					for ($j = $j; $j < $priceRangeLength; $j++)
					{
						if ($priceRange[$j] == '$')
						{
							$j++;
							$matchMax = "";
						
							break;
						}
					}
												
					while ((is_numeric($priceRange[$j]) == TRUE) && ($j < $priceRangeLength))
					{
						$matchMax = $matchMax . strval($matchPriceRange[$j]);
						$j++;
					}
					
					if (($matchMin < $min) || ($matchMax > $max))
					{
						unset($restaurantMatches[$i]);
					}
				}
			}
			
			$index = 0;
			$temp = array();
			
			for ($i = 0; $i < $matchCount; $i++)
			{
				if (!empty($restaurantMatches[$i]))
				{
					$temp[$index] = $restaurantMatches[$i];
					$index++;
				}
			}
			
			$restaurantMatches = $temp;
			$matchCount = count($restaurantMatches);
			
			
		?>
			
			<?php if($matchCount == 0) : ?>
				<div id="message1">
					<p>There are no search results for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
					<br><br>
				</div>
			
			<?php else : ?>
				<div id="message2">
					<p>Displaying all search results for "<?php echo htmlspecialchars($searchQuery); ?>":</p>
					<br><br>
				</div>
			<?php endif; ?>	
			
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
					<tbody><?php
			
					for ($i = 0; $i < $matchCount; $i = $i + 1)
					{
						echo '<tr>' . '<td>' . $restaurantMatches[$i]["restaurantid"] . '</td><td><a href="/RRS/profile?id=' . $restaurantMatches[$i]["restaurantid"] 
							. '">'. $restaurantMatches[$i]["restaurantname"] .'</td><td>' .  $restaurantMatches[$i]["features"] . "</td><td>" 
							.  $restaurantMatches[$i]["pricerange"] . '</td></tr>';
					}?>
			
					</tbody>
				</table> 
			</div>
			
			<?php include($root."view/include/footer.php"); ?>
	</body>
		
</html>