<?php

	require ('config/db.php');
	include_once ('includes/query.php');

	// Get Result 
	$result = mysqli_query($conn, $allProducts);

	// Fetching Data
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Free Result
	mysqli_free_result($result);

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
		<h1>Products</h1>
		<div>
			<table class="table table-hover">
				<thead>
				    <tr class="table-info">
				      <th scope="col">ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Model</th>
				      <th scope="col">Type</th>
				      <th scope="col">Color</th>
				      <th scope="col">Price</th>
				    </tr>
			    </thead>

				<?php foreach ($products as $product): ?>
				    <tbody>
					    <tr class="table-info">
					    	<td><?php echo $product['productID']; ?></td>
					    	<td><a href="selectedProduct.php?productID=<?php echo $product['productID']; ?>"><?php echo $product['productName']; ?></a></td>
					    	<td><?php echo $product['productModel']; ?></td>
					    	<td><?php echo $product['productType']; ?></td>
					    	<td><?php echo $product['productColor']; ?></td>
					    	<td><?php echo $product['price']; ?></td>
					    </tr>
				  </tbody>
				<?php endforeach; ?>
			</table> 
		</div>
	</body>
</html>