<?php
include "../db_connection.php";
if(isset($_POST['submit'])){
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO customers (user_name, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($dbconn, $sql, array($user_name, $email, $hashed_password));

    if ($result) {
        echo "Registration is successful!";
    } else {
        echo "Error: " . $sql . "<br>" . pg_last_error($dbconn);
    }
      
    pg_close($dbconn);
}
?>
<!DOCTYPE html>
<html lang = "en">

    <meta charset = "UTF-8">
    <meta name = "viewport" contnent="width=device-width, initial-scale=1.0">

    <title>Your Store</title>

    <head>
        <link rel="stylesheet" href="registrationPage.css">
    </head>

    <body>
     <div class="container">
        <form action="" method="post"> <!-- Change the action attribute to point to the PHP script -->
            <h2>Register</h2>
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-control">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit" name="submit">Register</button> 
        </form>
     </div>
    </body>
</html>
