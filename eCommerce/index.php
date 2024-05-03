<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Shop</title>
  <style>
    
    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    th {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        background-color: #0056b3; 
        color: white;
    }

    td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
  </style>
</head>
<body>
 <div class= "container my-5">
    <h2>List of Products</h2>
    <a class="btn btn-primary" href="create.php" role="button">add product</a>
 </div>   
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Sale</th>
        <th>Seller</th>
        <th>Quantity</th>
        <th>Discription</th>
        <th>Date</th>
        <th>Category</th>
        <th>Controls</th>
        
      </tr>
    </thead>
    <tbody>
    <?php
      include "db_connection.php";
      $sql = "SELECT * FROM products";
      $result = pg_query($dbconn, $sql);
      if(!$result){
          die("invalid query". $dbconn->error);
      }
      while ($row = pg_fetch_assoc($result)) {
          echo "
          <tr>
              <td>$row[id]</td>
              <td>$row[name]</td>
              <td>$row[price]</td>
              <td>$row[sale]</td>
              <td>$row[seller]</td>
              <td>$row[quantity]</td>
              <td>$row[description]</td>
              <td>$row[date]</td>
              <td>$row[category]</td>
              <td>
                  <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                  <br>
                  <a class='btn btn-primary btn-sm' href='delete.php?id=$row[id]'>Delete</a>
              </td>
          </tr>
          ";
      }
?>
      
    </tbody>
  </table>
</body>
</html>
