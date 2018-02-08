<?php

	require ('config/db.php');
	include_once ('includes/query.php');

	$selectedShopID = mysqli_real_escape_string($conn, $_GET['shopID']);

	$selectedShopQuery = "
		SELECT shop.shopID, shop.shopName, shop.shopType, shop.shopAddress, shop.shopImage, shopkeeper.skName, shopkeeper.skContact, shopkeeper.skEmail, review.rating
		FROM shopkeeper
		INNER JOIN shop
		ON shopkeeper.shopID = shop.shopID
		INNER JOIN review
		ON shop.shopID = review.shopID AND shop.shopID LIKE '".$selectedShopID."'";

	

	// Get Result 
	$result = mysqli_query($conn, $selectedShopQuery);

	// Fetching Data
	$selectedShop = mysqli_fetch_assoc($result);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title><?php echo $selectedShop['shopName']; ?></title>
	</head>
	<body>
		<?php include_once ('includes/header.php'); ?>
		<br>
		<div class="card text-white bg-primary mb-3" style="width:800px; margin:0 auto;">
		  <div class="card-header"><?php echo $selectedShop['shopType']; ?></div>
		  <div class="card-body">
		    <h4 class="card-title"><?php echo $selectedShop['shopName']; ?></h4>
		    <img style="height: 300px; width: 80%; display: block;" src="<?php echo $selectedShop['shopImage']; ?>" alt="Card image">
		    <p class="card-text">
		    	<?php 
		    		echo "Address: ".$selectedShop['shopAddress'].
		    		"<br>".
		    		"Rating: ".$selectedShop['rating'].
		    		"<br>".
		    		"<h2>Owner: ".$selectedShop['skName']."</h2>".
		    		"<h5>Contact: ".$selectedShop['skEmail']."</h5>";
		    	?>
		    </p>
		    <a class="btn btn-success" href="viewProducts.php?shopID=<?php echo $selectedShop['shopID']; ?>">View Products</a>
		    <br>
		    <a class="btn btn-info" href="shops.php">Back</a>
		  </div>
		</div>
	</body>
</html>