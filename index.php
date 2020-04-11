<?php require "header.php"; ?>

<main>
  <div class="wrapper-main">
    <section>
      <?php
        if (isset($_SESSION['userId'])) {

          require "notes.php";

        }
        else {
          $loginform = <<<here
                <div id="login">
                    <div class="container">
                        <div id="login-row" class="row justify-content-center align-items-center">
                            <div id="login-column" class="col-md-6">
                                <div id="login-box" class="col-md-12">
                                    <form id="login-form" class="form" action="includes/login.inc.php" method="post">
                                        <h3 class="text-center text-secondary">Login</h3>
here;
          echo $loginform;

          //Use GET method to grab data from URL
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<p class="font-weight-bold text-danger text-center">Fill in all the fields!</p>';
            }
            else if ($_GET['error'] == "sqlerror") {
              echo '<p class="font-weight-bold text-danger text-center">Database error. Contact developer!</p>';
            }
            else if ($_GET['error'] == "wrongpwd") {
              echo '<p class="font-weight-bold text-danger text-center">Incorrect password!</p>';
            }
            else if ($_GET['error'] == "errorlogin") {
              echo '<p class="font-weight-bold text-danger text-center">Undefined error. Contact developer!</p>';
            }
            else if ($_GET['error'] == "nouser") {
              echo '<p class="font-weight-bold text-danger text-center">User account does not exists!</p>';
            }
          }

          $loginform = <<<here
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="mailuid" placeholder="Username/Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="pwd" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group d-flex justify-content-between">
                                             <button type="submit" class="btn btn-secondary btn-md custom-btn-login" name="login-submit">Login</button>
                                             <a href="signup.php" class="text-secondary text-md-right my-auto">Signup Here</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
here;
          echo $loginform;

        }

       ?>
    </section>
  </div>
</main>


<?php require "footer.php"; ?>
