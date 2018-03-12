<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");
  require_once("../includes/validation_functions.php");

  if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    $required_fields = array("username", "hashed_password");
    validate_presences($required_fields);

    $username = $_POST["username"];
    $hashed_password = password_encrypt($_POST["hashed_password"]);


    // Perform create
    $query = "INSERT INTO admins (";
    $query .= " username, hashed_password";
    $query .= ") VALUES (";
    $query .= " '{$username}', '{$hashed_password}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Admin created.";
      redirect_to("manage_admins.php");
    } else {
      // Failure
      $_SESSION["message"] = "Admin creation failed!";
      redirect_to("new_admin.php");
    }

  } else {
    //This is probably a GET request
    redirect_to("new_admin.php");
  }

 ?>
