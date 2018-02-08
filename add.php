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
        $productModel = sanitizeData($_POST['productModel']);
        $productType = sanitizeData($_POST['productType']);
        $productColor = sanitizeData($_POST['productColor']);
        $productImage = sanitizeData($_POST['productImage']);
        $productPrice = sanitizeData($_POST['productPrice']);
        $productCount = sanitizeData($_POST['productCount']);
        $productID = sanitizeData($_POST['productID']);
        $shopID = sanitizeData($_POST['shopID']);


        //var_dump($_POST);
        if(empty($productName))
        {
            $message = "Please provide a name!";
            $messageClass = "alert-dismissible alert-danger";
        }
        else if (empty($productPrice))
        {
            $message = "Please provide a price!";
            $messageClass = "alert-dismissible alert-danger";
        }
        else if (empty($productID))
        {
            $message = "Please provide the product's ID!";
            $messageClass = "alert-dismissible alert-danger";
        }
        else if (empty($shopID))
        {
            $message = "Please provide the Shop's ID!";
            $messageClass = "alert-dismissible alert-danger";
        }

        else
        {

            $productName = mysqli_real_escape_string($conn, $productName);
            $productModel = mysqli_real_escape_string($conn, $productModel);
            $productType = mysqli_real_escape_string($conn, $productType);
            $productColor = mysqli_real_escape_string($conn, $productColor);
            $productImage = mysqli_real_escape_string($conn, $productImage);
            $productPrice = mysqli_real_escape_string($conn, $productPrice);
            $productCount = mysqli_real_escape_string($conn, $productCount);
            $productID = mysqli_real_escape_string($conn, $productID);
            $shopID = mysqli_real_escape_string($conn, $shopID);

            // Simultaneous inserts into three tables

            $insertProduct = "
                INSERT INTO product(productID, productName, productType, productModel, productColor, productImage, shopID)
                VALUES('$productID', '$productName', '$productType', '$productModel', '$productColor', 
                '$productImage', '$shopID')";

            $insertPrice = "
                INSERT INTO price(price, productID, shopID)
                VALUES('$productPrice', '$productID', '$shopID')";

            $insertInventory = "
                INSERT INTO inventory(productCount, shopID, productID)
                VALUES('$productCount', '$shopID', '$productID')";

            if (mysqli_query($conn, $insertProduct) && mysqli_query($conn, $insertPrice) && 
                mysqli_query($conn, $insertInventory))
            {
                $message = "Product<a href=selectedProduct.php?productID=$productID>$productName</a>inserted successfully!";
                $messageClass = "alert-dismissible alert-success";
            }
            else
            {
                $message = "Oh no! Something went wrong! =( Please try again?";
                $messageClass = "alert-dismissible alert-danger";
                //echo mysqli_error($conn);
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
            <h1>New Product</h1>
            <div class="form-group">
              <label class="col-form-label col-form-label-lg" for="inputLarge">Name *</label>
              <input class="form-control form-control-lg" type="text" placeholder="Name" id="inputLarge" name="productName" value="<?php echo isset($_POST['productName']) ? $_POST['productName'] : ''; ?>">
            </div>

            <div class="form-group">
              <label class="col-form-label" for="inputDefault">Model</label>
              <input type="text" class="form-control" placeholder="Model" id="inputDefault" name="productModel" value="<?php echo isset($_POST['productModel']) ? $_POST['productModel'] : ''; ?>">
            </div>

            <div class="form-group">
              <label class="col-form-label" for="inputDefault">Type</label>
              <input type="text" class="form-control" placeholder="Type" id="inputDefault" name="productType" value="<?php echo isset($_POST['productType']) ? $_POST['productType'] : ''; ?>">
            </div>

            <div class="form-group">
              <label class="col-form-label" for="inputDefault">Color</label>
              <input type="text" class="form-control" placeholder="Color" id="inputDefault" name="productColor" value="<?php echo isset($_POST['productColor']) ? $_POST['productColor'] : ''; ?>">
            </div>

            <div class="form-group">
              <label class="col-form-label" for="inputDefault">Image</label>
              <input type="text" class="form-control" placeholder="Image link" id="inputDefault" name="productImage" value="<?php echo isset($_POST['productImage']) ? $_POST['productImage'] : ''; ?>">
            </div>

            <div class="form-group">
              <label class="control-label">Price *</label>
              <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                <div class="input-group">
                  <div class="input-group-addon">$</div>
                  <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount" name="productPrice" value="<?php echo isset($_POST['productPrice']) ? $_POST['productPrice'] : ''; ?>">
                  <div class="input-group-addon">.00</div>
                </div>
              </div>
            </div>

            <div style="width: 150px">

              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Product Inventory</label>
                <input type="text" class="form-control" placeholder="Product ID" id="inputDefault" name="productCount" value="<?php echo isset($_POST['productCount']) ? $_POST['productCount'] : ''; ?>">
              </div>
              

              
              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Product ID *</label>
                <input type="text" class="form-control" placeholder="Product ID" id="inputDefault" name="productID" value="<?php echo $newProductID; ?>">
                <p class="text-info"><strong>You're product's ID: <?php echo $newProductID; ?></strong></p>
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