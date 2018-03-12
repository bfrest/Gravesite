<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");

  $ID = $_GET["graveyardID"];
  $query = "DELETE FROM graveyards WHERE graveyardID = {$ID} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Graveyard Deleted.";
    redirect_to("manage_graveyards.php");
  } else {
    //Failure
    $_SESSION["message"] = "Graveyard deletion failed.";
    redirect_to("manage_graveyards.php");
  }

 ?>
