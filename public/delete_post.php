<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");

  $ID = $_GET["postID"];
  $query = "DELETE FROM posts WHERE postID = {$ID} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Post Deleted.";
    redirect_to("manage_content.php");
  } else {
    //Failure
    $_SESSION["message"] = "Post deletion failed.";
    redirect_to("manage_content.php");
  }

 ?>
