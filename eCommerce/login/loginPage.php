<?php
include "../db_connection.php"; 

if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to fetch user data by username
    $sql = "SELECT * FROM customers WHERE user_name = $1";

    // Use prepared statements to prevent SQL injection
    $stmt = pg_prepare($conn, "select_query", $sql);

    // Execute the statement
    $result = pg_execute($conn, "select_query", array($username));

    // Check if a row was returned
    if (pg_num_rows($result) > 0) {
        // Fetch user data
        $row = pg_fetch_assoc($result);
        $stored_password = $row['password'];

        // Verify the password
        if (password_verify($password, $stored_password)) {
            // Password is correct, user is authenticated
            echo "Login successful!";
            // Redirect the user to their dashboard or another page
            // header("Location: dashboard.php");
            // exit;
        } else {
            // Incorrect password
            echo "Incorrect password!";
        }
    } else {
        // User not found
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginPage.css">
</head>
<body>
<div class="container">
    <form action="login.php" method="post">
        <h2>Login</h2>
        <div class="form-control">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit">Login</button>
    </form>
</div>
</body>
</html>
