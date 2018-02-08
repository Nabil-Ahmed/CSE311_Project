<?php

	require ('config/db.php');
	include_once ('includes/query.php');

	$selectedProductID = mysqli_real_escape_string($conn, $_GET['productID']);

	$selectedProductQuery = "
		SELECT product.productType, product.productName, product.productImage, product.productModel, product.productColor, 
		shop.shopName, product.productID, price.price 
		FROM product 
		INNER JOIN price 
		ON product.productID = price.productID 
		INNER JOIN shop 
		ON price.shopID = shop.shopID
		WHERE product.productID = ".$selectedProductID;

	

	// Get Result 
	$result = mysqli_query($conn, $selectedProductQuery);

	// Fetching Data
	$selectedProduct = mysqli_fetch_assoc($result);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title><?php echo $selectedProduct['productName']; ?></title>
	</head>
	<body>
		<?php include_once ('includes/header.php'); ?>
		<br>
		<div class="card text-white bg-primary mb-3" style="width:800px; margin:0 auto;">
		  <div class="card-header"><?php echo $selectedProduct['productType']; ?></div>
		  <div class="card-body">
		    <h4 class="card-title"><?php echo $selectedProduct['productName']; ?></h4>
		    <img style="height: 300px; width: 80%; display: block;" src="<?php echo $selectedProduct['productImage']; ?>" alt="Card image">
		    <p class="card-text">
		    	<?php 

			    	$model;
			    	$color;
			    	if ($selectedProduct['productModel'] != 'N/A')
			    	{
			    		$model = "Model: ".$selectedProduct['productModel'];
			    	}
			    	else
			    	{
			    		$model = "";
			    	}

			    	if ($selectedProduct['productColor'] != 'N/A')
			    	{
			    		$color = "Color: ".$selectedProduct['productColor'];
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
			    		"Price: ".$selectedProduct['price'].
			    		"<br>".
			    		"Available at: ".$selectedProduct['shopName'];
		    	?>
		    </p>
		    <a class="btn btn-info" href="products.php">Back</a>
		  </div>
		</div>
	</body>
</html>