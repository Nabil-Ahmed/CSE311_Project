<?php
	require ('config/db.php');
	include_once ('includes/query.php');

	if(isset($_GET['isLoggedIn']))
	{
		$_SESSION['isLoggedIn'] = $_GET['isLoggedIn'];
		$_SESSION['name'] = 'Guest';
	}

	
	// Message and alert variables
	$message = '';
	$messageClass = '';

	function sanitizeData($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

	if (filter_has_var(INPUT_POST, 'submit'))
	{
		// Sanitizing data if input contains HTML special characters
		$email = sanitizeData($_POST['email']);
		$password = sanitizeData($_POST['password']);

		if(empty($email))
		{
			$message = "Please provide your email!";
			$messageClass = "alert-dismissible alert-danger";
		}
		else if (empty($password))
		{
			$message = "Please provide your password!";
			$messageClass = "alert-dismissible alert-danger";
		}
		else
		{

			$checkUserQuery = "SELECT skEmail, skName, skPassword, shopID
				FROM shopkeeper
				WHERE skEmail = '$email'";

			$result = mysqli_query($conn, $checkUserQuery);

			$resultsReturned = mysqli_num_rows($result);

			$returnedUser = mysqli_fetch_assoc($result);

			if (!$resultsReturned || !(password_verify($password, $returnedUser['skPassword'])))
			{
				$message = "Username or password incorrect! =(";
				$messageClass = "alert-dismissible alert-danger";
			}
			else
			{
				$_SESSION['isLoggedIn'] = 1;
				$_SESSION['name'] = $returnedUser['skName'];
				$_SESSION['shopID'] = $returnedUser['shopID'];

				//$message = "Yaay!";
				//$messageClass = "alert-dismissible alert-success";

				// Close Connection
				mysqli_close($conn);

				sleep(2);

				header('Location: index.php');
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
		<title>Login</title>
	</head>
	<body>

		<div class="container">
		  <h1 class="display-3">Hello, kind soul!</h1>
		  <p class="lead"><h1>Sign in, and browse your shop! =D</h1></p>
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
			    <legend>Login below, or if you want to sign up for a new account? =)</legend>
			    <a class="btn btn-primary btn-lg" href="signup.php">Signup</a>
			    <a class="btn btn-primary btn-lg" href="index.php">Browse as Guest?</a>
			    <br><br>
			    <div class="alert <?php echo $messageClass ?>">
				  <h3><strong><?php echo $message; ?></strong></h3>
				</div>

			    <div class="form-group">
			      <label for="exampleInputEmail1">Email address *</label>
			      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
			      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			    </div>

			    <div class="form-group">
			      <label for="exampleInputPassword1">Password *</label>
			      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
			    </div>
			  </fieldset>
			  <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Login">
			</form>
		</div>
	</body>
</html>