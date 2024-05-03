<?php
include "db_connection.php";
$id = "";
$errorMsg = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"])) {
        header("Location: index.php");
        exit();
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = pg_query($dbconn, $sql);
    $row = pg_fetch_assoc($result);

    if (!$row) {
        header("Location: index.php");
        exit();
    }
    $name = $row['name'];
    $price = $row['price'];
    $sale = $row['sale'];
    $seller = $row['seller'];
    $quantity = $row['quantity'];
    $description = $row['description'];
    $category = $row['category'];
} else {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $sale = htmlspecialchars($_POST['sale']);
    $seller = htmlspecialchars($_POST['seller']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $description = htmlspecialchars($_POST['description']);
    $category = htmlspecialchars($_POST['category']);

    if (empty($name) || empty($price) || empty($seller) || empty($quantity) || empty($description)) {
        $errorMsg = "Please fill all the required fields";
    } else {
        $sql = "UPDATE products 
                SET name = '$name', price = $price, sale = $sale, seller = '$seller', 
                quantity = $quantity, description = '$description', category = '$category' 
                WHERE id = $id";
        $result = pg_query($dbconn, $sql);

        if ($result) {
            $successMsg = "Product updated successfully";
            header("Location: index.php");
            exit();
        } else {
            $errorMsg = "Error: " . pg_last_error($dbconn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <?php
    if (!empty($errorMsg)) {
        echo "<div>Error: $errorMsg</div>";
    }
    ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Enter product">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="<?php echo $price; ?>" placeholder="Enter Price">
        </div>
        <div class="form-group">
            <label for="sale">Sale</label>
            <input type="text" name="sale" id="sale" value="<?php echo $sale; ?>" placeholder="Enter Sale">
        </div>
        <div class="form-group">
            <label for="seller">Seller</label>
            <input type="text" name="seller" id="seller" value="<?php echo $seller; ?>" placeholder="Enter Seller">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" placeholder="Enter Quantity">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"><?php echo $description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Choose Category</label>
            <select name="category" id="category">
                <option value="">Select a Category</option>
                <option value="clothing" <?php if ($category == 'clothing') echo 'selected'; ?>>Clothing</option>
                <option value="electronics" <?php if ($category == 'electronics') echo 'selected'; ?>>Electronics</option>
                <option value="others" <?php if ($category == 'others') echo 'selected'; ?>>Others</option>
            </select>
        </div>
        <?php
        if (!empty($successMsg)) {
            echo "<div>$successMsg</div>";
        }
        ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

