<?php

	require ('config/db.php');
	include_once ('includes/query.php');

	

	// Using $_GET superglobal to recieve productID parameter
	if (isset($_GET['searchProduct']))
	{	
		$searchedProductName = $_GET['searchProduct'];

		$searchedProductQuery = "
			SELECT shop.shopName, price.price, product.productID, product.productName, product.productType, product.productModel, product.productColor
			FROM shop 
			INNER JOIN price
			ON shop.shopID = price.shopID
			INNER JOIN product
			ON price.productID  =product.productID
			INNER JOIN inventory 
			ON product.productID = inventory.productID AND product.productName LIKE"."'%".$searchedProductName."%'".
			"ORDER BY price.price";
	}


	// Get Result 
	$result = mysqli_query($conn, $searchedProductQuery);

	// Fetching Data
	$searchResults = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$rowsReturned = mysqli_num_rows($result);

	// Message and alert variables
	$message = '';
	$messageClass = '';

	// Message and alert variables updated if a results are found
	if ($rowsReturned > 0)
	{
		$message = "Yaay, we found something you might be interested in =)";
		$messageClass = "alert-success";
	}
	// Message and alert variables to show error if no results are found
	else
	{
		$message = "Oh, snap! =( Could you be a little more specific and try again?";
		$messageClass = "alert-dismissible alert-warning";
	}

	// Free Result
	mysqli_free_result($result);

	//

	// Close Connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title>Products</title>
	</head>
	<body>

		<?php include ('includes/header.php'); ?>
		<h1>Search Results</h1>
			<div class="alert <?php echo $messageClass ?>">
				<h3><strong><?php echo $message; ?></strong></h3>
			</div>
			<?php if($rowsReturned > 0): ?>
				<table class="table table-hover">
					<thead>
					    <tr class="table-info">
					      <th scope="col">Shop Name</th>
					      <th scope="col">Product ID</th>
					      <th scope="col">Product Name</th>
					      <th scope="col">Product Type</th>
					      <th scope="col">Product Model</th>
					      <th scope="col">Product Color</th>
					      <th scope="col">Product Price</th>
					    </tr>
				    </thead>
					<?php foreach ($searchResults as $searchResult): ?>
						  <tbody>
						    <tr class="table-info">
						      <td><?php echo $searchResult['shopName']; ?></td>
						      <td><?php echo $searchResult['productID']; ?></td>
						      <td><a href="selectedProduct.php?productID=<?php echo $searchResult['productID']; ?>"><?php echo $searchResult['productName']; ?></a></td>
						      <td><?php echo $searchResult['productType']; ?></td>
						      <td><?php echo $searchResult['productModel']; ?></td>
						      <td><?php echo $searchResult['productColor']; ?></td>
						      <td><?php echo $searchResult['price']; ?></td>
						    </tr>
						  </tbody>
					<?php endforeach; ?>
				</table>
			<?php endif; ?>
	</body>
</html>