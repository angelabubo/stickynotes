<?php require "header.php"; ?>

  <main>
    <div class="signup">
      <section>
        <div id="signup">
            <div class="container">
                <div id="signup-row" class="row justify-content-center align-items-center">
                    <div id="signup-column" class="col-md-6">
                        <div id="signup-box" class="col-md-12">
                            <form id="signup-form" class="form" action="includes/signup.inc.php" method="post">
                                <h3 class="text-center text-secondary">Signup</h3>
                                    <?php
                                      //Use GET method to grab data from URL
                                      if (isset($_GET['error'])) {
                                        if ($_GET['error'] == "emptyfields") {
                                          echo '<p class="font-weight-bold text-danger text-center">Fill in all the fields!</p>';
                                        }
                                        else if ($_GET['error'] == "invaliduidmail") {
                                          echo '<p class="font-weight-bold text-danger text-center">Invalid username and e-mail!</p>';
                                        }
                                        else if ($_GET['error'] == "invaliduid") {
                                          echo '<p class="font-weight-bold text-danger text-center">Invalid username!</p>';
                                        }
                                        else if ($_GET['error'] == "invalidmail") {
                                          echo '<p class="font-weight-bold text-danger text-center">Invalid e-mail!</p>';
                                        }
                                        else if ($_GET['error'] == "passwordcheck") {
                                          echo '<p class="font-weight-bold text-danger text-center">Your passwords did not match!</p>';
                                        }
                                        else if ($_GET['error'] == "usertaken") {
                                          echo '<p class="font-weight-bold text-danger text-center">Username is already taken!</p>';
                                        }
                                      }
                                      else if (isset($_GET['signup']) && ($_GET['signup'] == "success")) {
                                        echo '<p class="text-success text-center">Signup successful!';
                                        echo '<a class="nav-link text-secondary" href="index.php">Back to Login</a></p>';
                                      }
                                     ?>

                                 <div class="form-group">
                                     <input type="text" class="form-control" name="uid" placeholder="Username" value="<?php if (isset($_GET['uid'])) {echo $_GET['uid'];}?>">

                                 </div>
                                 <div class="form-group">
                                     <input type="text" class="form-control" name="mail" placeholder="E-mail" value="<?php if (isset($_GET['mail'])) {echo $_GET['mail'];}?>">
                                 </div>
                                 <div class="form-group">
                                     <input type="password" class="form-control" name="pwd" placeholder="Password">
                                 </div>
                                 <div class="form-group">
                                     <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm password">
                                 </div>

                                 <div class="form-group text-center">
                                     <button type="submit" class="btn btn-primary btn-block" name="signup-submit">Signup</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
      </section>

    </div>
  </main>

<?php require "footer.php"; ?>
