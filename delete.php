<?php
  
    require ('config/db.php');
    include_once ('includes/query.php');

    $result = mysqli_query($conn, $allProducts);

    $rowsReturned = mysqli_num_rows($result);

    $newProductID = $rowsReturned + 1;

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

    /*
    if(isset($_POST['submit']))
    {
        echo 'Yes!!';
        echo $_POST['productCount'];
        <?php echo isset($_POST['shopID']) ? $_POST['shopID'] : ''; ?>
    }
    
    */

    if (filter_has_var(INPUT_POST, 'submit'))
    {
        $productName = sanitizeData($_POST['productName']);
        $productID = sanitizeData($_POST['productID']);
        $shopID = sanitizeData($_POST['shopID']);


        //var_dump($_POST);
        if(empty($productName))
        {
            $message = "Please provide a name!";
            $messageClass = "alert-dismissible alert-danger";
        }
        else if (empty($productID))
        {
            $message = "Please provide a valid product's ID!";
            $messageClass = "alert-dismissible alert-danger";
        }
        else if (empty($shopID))
        {
            $message = "Please provide your Shop's ID!";
            $messageClass = "alert-dismissible alert-danger";
        }

        else
        {

            $productName = mysqli_real_escape_string($conn, $productName);
            $productID = mysqli_real_escape_string($conn, $productID);
            $shopID = mysqli_real_escape_string($conn, $shopID);


            $message = "You'll be deleting product: $productID, $productName from shop: $shopID";
            $messageClass = "alert alert-dismissible alert-warning";
          
            $deleteProductQuery = "DELETE FROM product
                WHERE productID = {$productID} AND shopID = {$shopID}";

            $deletePriceQuery = "DELETE FROM price
                WHERE productID = {$productID} AND shopID = {$shopID}";

            $deleteInventoryQuery = "DELETE FROM inventory
                WHERE productID = {$productID} AND shopID = {$shopID}";
                      
            if (mysqli_query($conn, $deleteProductQuery) && mysqli_query($conn, $deletePriceQuery) 
                && mysqli_query($conn, $deleteInventoryQuery))
            {
                if(mysqli_affected_rows($conn) == 0)
                {
                    $message = "No such product ID or shop ID asscociated found!";
                    $messageClass = "alert alert-dismissible alert-warning";
                }
                else
                {
                    $message = "Succesfully deleted!";
                    $messageClass = "alert alert-dismissible alert-success";
                }
                
            }
            else
            {
                $message = "Oh no! Something went wrong! =( Please try again?";
                $messageClass = "alert-dismissible alert-danger";
            }

            

            // Close connection
            mysqli_close($conn);   
        }
    }

    

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <title>Crud</title>
  </head>
  <body>

    <?php include ('includes/header.php'); ?>

    <div class="container" style="width: 550px">
        <div class="alert <?php echo $messageClass ?>">
          <h3><strong><?php echo $message; ?></strong></h3>
        </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <fieldset>
            <h1>Remove Product</h1>

              <div class="form-group" style="width: 300px">
                <label class="col-form-label col-form-label-lg" for="inputLarge">Name *</label>
                <input class="form-control form-control-lg" type="text" placeholder="Name" id="inputLarge" name="productName" value="<?php echo isset($_POST['productName']) ? $_POST['productName'] : ''; ?>">
              </div>

            <div style="width: 150px">

              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Product ID *</label>
                <input type="text" class="form-control" placeholder="Product ID" id="inputDefault" name="productID" value="">
                <p class="text-info"><strong>Make sure you're giving a valid ID: </strong></p>
              </div>

              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Shop ID *</label>
                <input type="text" class="form-control" placeholder="Shop ID" id="inputDefault" name="shopID" value="<?php echo $_SESSION['shopID']; ?>">
                <p class="text-success"><strong>You're shop ID is: <?php echo $_SESSION['shopID']; ?></strong></p>
              </div>
            </div>
          </fieldset>
        <input type="submit" class="btn btn-primary btn-lg" name="submit">
      </form>
    </div>
  </body>
</html>