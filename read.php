<?php
  include "db_connect.php";

  $sql = mysqli_query($conn, "SELECT * FROM `sample`");

  if(mysqli_num_rows($sql) > 0 ) {
    echo "<table>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Age</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>";
  }

  while($row = mysqli_fetch_assoc($sql)) {
    echo "  <tr>
            <td>{$row["id"]}</td>
            <td>{$row["username"]}</td>
            <td>{$row["email"]}</td>
            <td>{$row["age"]}</td>
            <td>{$row["address"]}</td>
            <td>
              <a href='delete.php?id={$row['id']}'>Delete</a> |
              <a href='update.php?id={$row['id']}'>Update</a> 
            </td>
            </tr>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

    <a href="index.php">Add More</a>
<style>

  a {
    padding: 10px 15px;
    border-radius: 10px;
    cursor: pointer;
    border: 1px solid #000;
    outline: none;
    text-decoration: none;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 20px;
  }

  table {
    width: 100%;
    max-width: 1200px;
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
  }

  th, td {
    padding: 15px;
    text-align: left;
  }

  th {
    background-color: #4CAF50;
    color: white;
    text-transform: uppercase;
    font-size: 14px;
  }

  tr {
    border-bottom: 1px solid #ddd;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #f1f1f1;
  }

  td a {
    text-decoration: none;
    color: #f44336;
    font-weight: bold;
    transition: color 0.3s ease;
  }

  td a:hover {
    color: #d32f2f;
  }

  @media (max-width: 768px) {
    table {
      width: 100%;
      font-size: 14px;
    }

    th, td {
      padding: 10px;
    }
  }
</style>

</body>
</html>