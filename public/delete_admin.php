<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");

  $id = $_GET["id"];
  $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Admin Deleted.";
    redirect_to("manage_admins.php");
  } else {
    //Failure
    $_SESSION["message"] = "Admin deletion failed.";
    redirect_to("manage_admins.php");
  }

 ?>
