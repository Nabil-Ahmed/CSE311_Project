<?php
	require ('config/db.php');
	include_once ('includes/query.php');

	// Get Result 
	$result = mysqli_query($conn, $allShops);
	
	// Fetching Data
	$shops = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title>Shops</title>
	</head>
	<body>
		<?php include ('includes/header.php'); ?>
		<h1>Shops</h1>
		<div class="">
			<table class="table table-hover">
				<thead>
				    <tr class="table-info">
				      <th scope="col">ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Type</th>
				      <th scope="col">Address</th>
				    </tr>
			    </thead>
			<?php foreach ($shops as $shop): ?>
				  <tbody>
				    <tr class="table-info">
				      <!--<th scope="row">Info</th> -->
				      <td><?php echo $shop['shopID']; ?></td>
				      <td><a href="selectedShop.php?shopID=<?php echo $shop['shopID']; ?>"><?php echo $shop['shopName']; ?></a></td>
				      <td><?php echo $shop['shopType']; ?></td>
				      <td><?php echo $shop['shopAddress']; ?></td>
				    </tr>
				  </tbody>
			<?php endforeach; ?>
			</table> 
		</div>
	</body>
</html>