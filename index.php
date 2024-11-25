<?php
  include "db_connect.php";

  $erru = $errp = $erre = $erra = $errd = "";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    $password = mysqli_real_escape_string($conn, trim($_POST["password"]));
    $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
    $age = mysqli_real_escape_string($conn, trim($_POST["age"]));
    $address = mysqli_real_escape_string($conn, trim($_POST["address"]));

    if(empty($username) || strlen($username) < 5) {
      $erru = "Username Must Be 5 Characters Above";
    }
    if(empty($password) || strlen($password) < 8) {
      $errp = "Passsword Must Be 8 Characters Above";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $erre = "Invalid Format";
    }
    if(empty($age)) {
      $erra = "Age Must Be Filled";
    }
    if(empty($address) || strlen($address) < 20) {
      $errd = "Address Must Be 20 Characters";
    }

    if(empty($erru) && empty($errp) && empty($erre) && empty($erra) && empty($errd)) {
      $passwordhashed = password_hash($password, PASSWORD_DEFAULT);

      $sqlInsert = mysqli_prepare($conn, "INSERT INTO `sample`(`username`, `password`, `email`, `address`, `age`) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($sqlInsert, "ssssi", $username, $passwordhashed , $email, $address, $age);
      $sqlExecute = mysqli_stmt_execute($sqlInsert);
      
      if($sqlInsert) {
        echo "Inserted Successfully!";
        header("Location: read.php");
        exit();
      }

      }
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

<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    form h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      font-size: 12px;
      margin-top: -8px;
      margin-bottom: 10px;
      display: block;
    }

    textarea {
      resize: none;
    }

    @media (max-width: 600px) {
      form {
        padding: 20px;
      }

      input, textarea {
        font-size: 12px;
      }

      input[type="submit"] {
        font-size: 14px;
      }
    }
  </style>

  <form method="post">
    <input type="text" name="username" placeholder="Enter Username" >
    <span style="color: red;"><?php  echo $erru ?></span>
    <br>
    <input type="password" name="password" placeholder="Enter Password" >
    <span style="color: red;"><?php  echo $errp ?></span>
    <br>
    <input type="email" name="email" placeholder="Enter Email" >
    <span style="color: red;"><?php  echo $erre ?></span>
    <br>
    <input type="number" name="age" placeholder="Enter Age" >
    <span style="color: red;"><?php  echo $erra ?></span>
    <br>
    <textarea name="address" id="" cols="30" rows="10"></textarea >
    <span style="color: red;"><?php  echo $errd ?></span>
    <input type="submit" value="Submit">
  </form>
  
</body>
</html>