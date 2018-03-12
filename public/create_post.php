<?php
  require_once("dbConnect.php");
  require_once("../includes/functions.php");
  require_once("../includes/validation_functions.php");
  require_once("../includes/session.php");

  if (isset($_POST['submit'])) {
    //process the form
    $userID = $_POST["userID"];
    $postText = $_POST["postText"];

    $required_fields = array("userID", "postText");
	  validate_presences($required_fields);

    if(!empty($errors)) {
      $_SESSION["errors"] = $errors;
      redirect_to("new_post.php");
    }

    $query = "INSERT INTO posts (";
    $query .= " userID, postText";
    $query .= ") VALUES (";
    $query .= " {$userID}, '{$postText}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Post created.";
      redirect_to("manage_content.php");
    } else {
      // Failure
      $_SESSION["message"] = "Post creation failed.";
      redirect_to("new_post.php");
    }

  } else {
    //This is probably a GET request
    redirect_to("new_post.php");
  }

 ?>
