<?php
include "db_connection.php";
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM products WHERE id = '$id'";
    $result  = pg_query($dbconn, $sql);
}
header(""Location: index.php"");
exit();
?>