<?php
session_start();

//deletes all values in the session variables
session_unset();

session_destroy();

header("Location: ../index.php");
