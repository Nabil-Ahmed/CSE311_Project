<?php
	
	require ('config/db.php');
	include_once ('includes/query.php');

	// Check for login variable


	// Setting login variable to 0 // No user logged in
	
	
	$result = mysqli_query($conn, $availableShopIDQuery);

	// Fetching Data
	$availableShopIDs = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Free Result
	mysqli_free_result($result);
	
	

	/*

	$allShopsQuery = "SELECT * FROM shop";
	$result = mysqli_query($conn, $allShopsQuery);

    $rowsReturned = mysqli_num_rows($result);

    $newShopID = $rowsReturned + 1;
	
	*/
	// Message and alert variables
	$message = '';
	$messageClass = '';

	

	// Sanitizing user data
	function sanitizeData($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

	// Checking if the submit button was clicked
	if (filter_has_var(INPUT_POST, 'submit'))
	{
		// Sanitizing data if input contains HTML special characters
		$email = sanitizeData($_POST['email']);
		$name = sanitizeData($_POST['name']);
		$contact = sanitizeData($_POST['contact']);
		$password = sanitizeData($_POST['password']);
		$confirmPassword = sanitizeData($_POST['confirmPassword']);
		$shopID = sanitizeData($_POST['shopID']);
		

		

		// Checking individual input boxes for empty and matching passwords
		// Setting appropiate message and alert vars
		if(empty($email))
		{
			$message = "Please provide an email!";
			$messageClass = "alert-dismissible alert-danger";
		}
		else if (empty($name))
		{
			$message = "Please provide a name!";
			$messageClass = "alert-dismissible alert-danger";
		}
		else if (empty($password))
		{
			$message = "Please provide a password!";
			$messageClass = "alert-dismissible alert-danger";
		}
		else if ($password !== $confirmPassword)
		{
			$message = "Oh Snap! Your passwords don't match";
			$messageClass = "alert-dismissible alert-danger";
		}
		else if (!isset($_POST['checkbox']))
		{
			$message = "You're almost there, please check the acknowledgement field! :D";
			$messageClass = "alert alert-dismissible alert-warning";
		}

		else
		{
			// Hashing password before storing in the database, using default encryption, algorithm complexity: 12
			$password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

			// Sanitizing input for inserting into DB
			$email = mysqli_real_escape_string($conn, $email);
			$name = mysqli_real_escape_string($conn, $name);
			$contact = mysqli_real_escape_string($conn, $contact);
			$password = mysqli_real_escape_string($conn, $password);
			$shopID = mysqli_real_escape_string($conn, $shopID);
			
			$insertUserQuery = "
				INSERT INTO shopkeeper(skEmail, skPassword, skName, skContact, shopID) 
				VALUES('$email', '$password', '$name', '$contact', '$shopID')";
				
			if(mysqli_query($conn, $insertUserQuery))
			{
				// Updating session variables to current user's name
				$_SESSION['isLoggedIn'] = 0;
				$_SESSION['name'] = 'Guest';
				$message = "Registered! Click on your name, "."<a href='login.php'>".$name."</a>". " to login! =)";
				$messageClass = "alert alert-dismissible alert-success";
			}
			else
			{
				$message = "Oh no! Something went wrong! =( Please try again?";
				$messageClass = "alert-dismissible alert-danger";
				echo mysqli_error($conn);
			}

			// Close Connection
			mysqli_close($conn);
		}
		
	}
?>

<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<title>Sign Up</title>
	</head>
	<body>

		<div class="container">
		  <h1 class="display-3">Hello, kind soul!</h1>
		  <p class="lead"><h1>Signup and become a shopkeeper? =D</h1></p>
		  <hr class="my-4">
		  <p class="text-success">You can make people happy by giving discounts! ^^</p>
		  <!--
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		  </p>
		  -->
		  <br>
		  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			  <fieldset>
			    <legend>Already have an account? =)</legend>
			    <a class="btn btn-primary btn-lg" href="login.php">Login</a>
			    <br>
			    <div class="alert <?php echo $messageClass ?>">
				  <h3><strong><?php echo $message; ?></strong></h3>
				</div>

			    <div class="form-group">
			      <label for="exampleInputEmail1">Email address *</label>
			      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
			      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			    </div>
			    
			    <div class="form-group">
			      <label for="exampleInputEmail1">Name</label>
			      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
			    </div>

			    <div class="form-group">
			      <label for="exampleInputPassword1">Password *</label>
			      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
			    </div>

			    <div class="form-group">
			      <label for="exampleInputPassword1">Confirm Password *</label>
			      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Re-type Password" name="confirmPassword" value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : ''; ?>">
			    </div>

			    <div class="form-group">
			      <label for="exampleInputEmail1">Contact</label>
			      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Number" name="contact" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>">
			    </div>

			    <div class="form-group">
				  <label for="exampleSelect1">Available Shop IDs *</label>
				  <select class="form-control" id="exampleSelect1" name="shopID">
				  	<?php foreach($availableShopIDs as $availableShopID): ?>
				  		<option><?php echo $availableShopID['shopID']; ?></option>
				  	<?php endforeach; ?>
				  </select>
				</div>
				
			    <fieldset class="form-group">
			      <legend>Please check the little box :D</legend>
			      <div class="form-check">
			        <label class="form-check-label">
			          <input class="form-check-input" type="checkbox" value="" checked="<?php echo isset($_POST['checkbox']) ? 'yes' : ''; ?>" name="checkbox">
			          I'm gonna become a shopkeeper! ^_^
			        </label>
			      </div>
			    </fieldset>
			  </fieldset>
			  <input type="submit" class="btn btn-primary btn-lg" name="submit">
			</form>
		</div>
	</body>
</html>