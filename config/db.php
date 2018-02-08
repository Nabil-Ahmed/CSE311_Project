<?php

	//include ('../includes/config.php');
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	//Create Database connection
	$conn = mysqli_connect('localhost', 'root', 'dipanzan', 'newmarket');

	if (mysqli_connect_errno())
		// Connection Failed
		echo '<h1>Failed to Connect to MySQL<br><h1>';


	

?>