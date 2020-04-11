<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My PHP Website H10002515</title>

    <!-- Latest dependencies -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- My custom css -->
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <!-- Navigation -->
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-light ">
        <div class="container-fluid sticky-top">
          <a class="navbar-brand" href="#">
            <img class="logo" src="img/programmer_128.png" alt="logo">
            <label style="padding-left: 20px;">Sticky Notes</label>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="about.php">About Developer</a></li>
              <!-- <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>-->
              <?php
              if (isset($_SESSION['userId']))
              {
                echo '<form action="includes/logout.inc.php" method="post">
                  <button type="submit" name="logout-submit" class="btn btn-link">Logout</button>
                </form>';
              }
               ?>
            </ul>
          </div>
        </div>
      </nav>

    </header>
