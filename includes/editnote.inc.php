<?php
if (isset($_POST['save-note'])) {
  require 'dbh.inc.php';

  $userID = $_POST['userId'];
  $noteID = $_POST['noteId'];
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
  else if($state == "done")
  {
    $state = 3;
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
  $sql = "UPDATE notes SET title = ?, details = ?, state = ? WHERE id = ? AND userId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql))
  {
    header("Location: ../index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "ssiii", $title, $details, $state, $noteID, $userID);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?update=success");
    exit();
  }

}

else if (isset($_POST['delete-note'])) {
  require 'dbh.inc.php';

  $noteID = $_POST['noteId'];

  //Use ? placeholder to avoid SQL injection
  $sql = "DELETE FROM notes WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql))
  {
    header("Location: ../index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "i", $noteID);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?delete=success");
    exit();
  }
}

else {
  header("Location: ../index.php?error=unknown");
  exit();

}
