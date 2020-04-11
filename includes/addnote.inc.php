<?php
if (isset($_POST['add-note'])) {
  require 'dbh.inc.php';

  $userID = $_POST['userId'];
  $title = $_POST['title'];
  $details = $_POST['details'];
  $state = $_POST['state'];

  if($state == "todo")
  {
    $state = 1;
  }
  else if($state == "doing")
  {
    $state = 2;
  }
  else {
    header("Location: ../index.php?error=invalidstate");
    exit();
  }

  if(empty($title))
  {
    $title = "My Note";
  }

  if (empty($details))
  {
    $details = "My Details";
  }

  //Use ? placeholder to avoid SQL injection
  $sql = "INSERT INTO notes (userId, title, details, state) VALUES (?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql))
  {
    header("Location: ../index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "issi", $userID, $title, $details, $state);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?add=success");
    exit();
  }

}
else {
  header("Location: ../index.php?error=unknown");
  exit();

}
