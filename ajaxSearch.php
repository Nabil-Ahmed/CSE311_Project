<?php

	require ('config/db.php');
	include_once ('includes/query.php');

	// Query string for ajax search sent from search bar
	

	// Similar values from database in array

	$searches = [];
	$searchDBQuery = "SELECT productName
		FROM product

	";

	$productsFromDB = mysqli_query($conn, $searchDBQuery);

	$productResultsFromDB = mysqli_fetch_all($productsFromDB, MYSQLI_ASSOC);

	for ($i = 0; $i < count($productResultsFromDB); $i++)
	{
		$searches[$i] = $productResultsFromDB[$i]['productName'];
	}

	//var_dump($searches);
	// Get query string from ajax request
	$q = $_REQUEST['q'];

	$suggestion = "";

	if ($q !== "")
	{
		$q = strtolower($q);
		$length = strlen($q);

		for ($i = 0; $i < count($searches); $i++)
		{
			if (stristr($q, substr($searches[$i], 0, $length)))
			{
				if ($suggestion === "")
				{
					$suggestion = $searches[$i];
				}
				else
				{
					$suggestion .= ", $searches[$i]";
				}
			}
		}
	}

	echo $suggestion === "" ? "No Suggestion" : $suggestion;

?>