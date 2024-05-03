<?php
$server_name = "localhost";
$user_name = "postgres";
$password = "";
$db_name = "onlineshop";

$dbconn = pg_connect("host=$server_name dbname=$db_name user=$user_name password=$password");

if (!$dbconn) {
    echo "Unable to connect to database.";
    exit;
}
//echo "connected";
?>