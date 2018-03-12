<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");
  $layout_context = "public";

  $username = "";
  if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    $required_fields = array("Username", "hashed_password");
	  //validate_presences($required_fields);

    if(empty($errors)) {
      // Attempt Login
      $username = $_POST["username"];
      $hashed_password = $_POST["hashed_password"];

      $found_admin = attempt_login($username, $hashed_password);

    if ($found_admin) {
      // Success
      // Mark user as logged in
      $_SESSION["admin_id"] = $found_admin["id"];
      $_SESSION["username"] = $found_admin["username"];
      $_SESSION["message"] = "Welcome Admin!";
      redirect_to("admin.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username Password didn't match.";
      redirect_to("index.php#openModal");
    }
  }

  } else {
    //This is probably a GET request
  }
 ?>
