<?php
  include "db_connect.php";

  if(isset($_GET["id"])) {
    $id = intval($_GET['id']);

    $sqldel = mysqli_prepare($conn, "DELETE FROM `sample` WHERE id = ?");
    mysqli_stmt_bind_param($sqldel, "i", $id);
    $del_execute = mysqli_stmt_execute($sqldel);
    if($sqldel) {
        echo "Deleted";
        header("Location: read.php");
        exit();
    }
  }


?>

 