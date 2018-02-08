<?php
	require ('config/db.php');
	include_once ('includes/query.php');

	// Get Result 
	$result = mysqli_query($conn, $allShopkeepers);
	
	// Fetching Data
	$shopkeepers = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//var_dump($products);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title>Shopkeepers</title>
	</head>
	<body>
		<?php include ('includes/header.php'); ?>
		<h1>Shopkeepers</h1>
		<div class="">
			<table class="table table-hover">
				<thead>
				    <tr class="table-info">
				      <th scope="col">ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
				      <th scope="col">Contact</th>
				      <th scop="col">Shop ID</th>
				    </tr>
			    </thead>
			<?php foreach ($shopkeepers as $shopkeeper): ?>
				  <tbody>
				    <tr class="table-info">
				      <td><?php echo $shopkeeper['skID']; ?></td>
				      <td><?php echo $shopkeeper['skName']; ?></td>
				      <td><?php echo $shopkeeper['skEmail']; ?></td>
				      <td><?php echo $shopkeeper['skContact']; ?></td>
				      <td><?php echo $shopkeeper['shopID']; ?></td>
				    </tr>
				  </tbody>
			<?php endforeach; ?>
			</table> 
		</div>
	</body>
</html>