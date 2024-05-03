<?php
include "db_connection.php";
$errorMsg="";
$successMsg="";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    // Sanitizing form data helps prevent security vulnerabilities like XSS attacks.
    // htmlspecialchars() is used to convert special characters to HTML entities.
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $sale = htmlspecialchars($_POST['sale']);
    $seller = htmlspecialchars($_POST['seller']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $description = htmlspecialchars($_POST['description']);
    $category = htmlspecialchars($_POST['category']);

do{
    if(empty($name)||empty($price)||empty($seller)||empty($quantity)||empty($description)){
        $errorMsg="Please, fill the required fields";
        break;
    }
    //add product to db
    $sql = "INSERT INTO products (name, price, sale, seller, quantity, discrition, category) 
    VALUES ('$name', $price, $sale, '$seller', $quantity, '$description', '$category')";

    $result = pg_query($dbconn, $sql);

    if(!$result) {
      $errorMsg =  "invalid query".$dbconn->error;
      break;
    }
    
    $name = "";
    $price = "";
    $sale = "";
    $seller = "";
    $quantity = "";
    $description = "";
    $category = "";

    

}

while(false);



    // Redirect to index page after successful submission
    // header() is used to send a raw HTTP header.
    // Location header is set to redirect the user to 'index.php' page.
    header("Location: index.php");
    exit(); // Make sure to terminate the script after the redirect
    // This ensures that no further code is executed after the redirect header.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Form</title>
  <link rel="stylesheet" href="create.css">
</head>
<body>
    <?php
    if(!empty($errorMsg)){
        echo $errorMsg;
    }
    ?>
  <form method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" placeholder="Enter product">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input type="number" name="price" id="price" placeholder="Enter Price">
    </div>
    <div class="form-group">
      <label for="sale">Sale</label>
      <input type="text" name="sale" id="sale" placeholder="Enter Sale">
    </div>
    <div class="form-group">
      <label for="seller">Seller</label>
      <input type="text" name="seller" id="seller" placeholder="Enter Seller">
    </div>
    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"></textarea>
    </div>
    <div class="form-group">
      <label for="category">Choose Category</label>
      <select name="category" id="category">
        <option value="">Select a Category</option>
        <option value="clothing">Clothing</option>
        <option value="electronics">Electronics</option>
        <option value="others">Others</option>
      </select>
    </div>
    <?php
    if(!empty($successMsg)){
        echo $successMsg;
        header("Location: index.php");
        exit();
    }
    ?>
    <button type="submit">Submit</button>
  </form>
</body>
</html>
