<?php

	require ('config/db.php');
	include_once ('includes/query.php');

	$allProductsInShop = mysqli_real_escape_string($conn, $_GET['shopID']);

	$viewProductsQuery = "
			SELECT product.productID, product.productName, product.productType, product.productModel, product.productColor, product.productImage, price.price, shop.shopName, shop.shopAddress, shop.shopID, inventory.productCount
			FROM product
			INNER JOIN price
			ON product.productID = price.productID
			INNER JOIN shop
			ON product.shopID = shop.shopID
			INNER JOIN inventory
			ON product.productID = inventory.productID
			WHERE shop.shopID ='".$allProductsInShop."'";



	

	// Get Result 
	$result = mysqli_query($conn, $viewProductsQuery);

	$rows = mysqli_num_rows($result);

	// Fetching Data
	$productsInShop = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//var_dump($productsInShop);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title><?php //echo $productsInShop['shopName']; ?></title>
	</head>
	<body>
		<?php include_once ('includes/header.php'); ?>
		<br>
		<?php foreach ($productsInShop as $product): ?>

			<div class="card text-white bg-primary mb-3" style="width:800px; margin:0 auto;">
			  <div class="card-header"><?php echo $product['productType']; ?></div>
			  <div class="card-body">
			    <h4 class="card-title"><?php echo $product['productName']; ?></h4>
			    <img style="height: 300px; width: 80%; display: block;" src="<?php echo $product['productImage']; ?>" alt="Card image">
			    <p class="card-text">
			    	<?php 

				    	$model;
				    	$color;
				    	if ($product['productModel'] != 'N/A')
				    	{
				    		$model = "Model: ".$product['productModel'];
				    	}
				    	else
				    	{
				    		$model = "";
				    	}

				    	if ($product['productColor'] != 'N/A')
				    	{
				    		$color = "Color: ".$product['productColor'];
				    	}
				    	else
				    	{
				    		$color = "";
				    	}
				    	echo 
				    		$model.
				    		"<br>".
				    		$color.
				    		"<br>".
				    		"Price: ".$product['price'].
				    		"<br>".
				    		"Available at: ".$product['shopName'].
				    		"<br>".
				    		"Stock: ".$product['productCount'];
			    	?>
			    </p>
			    <a class="btn btn-info" href="selectedShop.php?shopID=<?php echo $product['shopID']; ?>">Back</a>
			  </div>
			</div>
		<?php endforeach; ?>
	</body>
</html>