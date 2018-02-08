<?php
	require ('config/db.php');
	include_once ('includes/query.php');
?>

<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title>Home</title>
	</head>
	<body>
		<?php include_once ('includes/header.php'); ?>
		<div class="jumbotron">
		  <h1 class="display-3">Welcome to the Online Market! =)</h1>
		  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
		  <hr class="my-4">
		  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		  </p>
		</div>
	</body>
</html>