

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

    <div class="container" style="width: 600px">
      <div class="list-group">
        <a href="delete.php" class="list-group-item list-group-item-action flex-column align-items-start active">
          <div class="d-flex w-100 justify-content-between">
            <h1 class="mb-1">Delete Products</h1>
            <p class="text-info"><small><?php echo "Current User: ".$_SESSION['name'];?></small></p>
          </div>
          <h3><p class="text-danger">Deleting products will also remove price and inventory values from Database</p></h3>
          <p class="text-warning"><small>You've been warned!</small></p>
        </a>
        <a href="add.php" class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h1 class="mb-1">Add Products</h1>
          </div>
          <h3><p class="text-success">Add products along with price and inventory for your shop</p></h3>
          <p class="text-info"><small>Add products! =)</small></p>
        </a>
      </div>
    </div>

  </body>
</html>