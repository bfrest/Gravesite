<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");

  $ID = $_GET["graveID"];
  $query = "DELETE FROM graves WHERE graveID = {$ID} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Grave Deleted.";
    redirect_to("manage_graves.php");
  } else {
    //Failure
    $_SESSION["message"] = "Grave deletion failed.";
    redirect_to("manage_graves.php");
  }

 ?>
