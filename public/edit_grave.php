<?php
 require_once("../includes/session.php");
 require_once("dbConnect.php");
 require_once("../includes/functions.php");
 confirm_logged_in();
 $layout_context = "admin";
 $grave = find_grave_by_id($_GET["graveID"]);

 if (!$grave) {
  redirect_to("manage_graves.php");
 }

if (isset($_POST['submit'])) {
  //Perform update
  $graveID = $_POST["graveID"];
  $firstName = $_POST["firstName"];
  $middleName = $_POST["middleName"];
  $lastName = $_POST["lastName"];
  $birthDate = $_POST["birthDate"];
  $deathDate = $_POST["deathDate"];
  $graveyardID = $_POST["graveyardID"];

  $query = "UPDATE graves SET firstName = '$firstName', middleName = '{$middleName }', lastName = '{$lastName}', birthDate = '{$birthDate}', deathDate = '{$deathDate}', graveyardID = '{$graveyardID}' WHERE graveID = {$graveID} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Grave updated.";
    redirect_to("manage_graves.php");
  } else {
    //Failure
    $_SESSION["message"] = "Grave update failed.";
  }
}
include("../includes/header.php");
?>

<h2>Edit Grave</h2>
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<form action="edit_grave.php?graveID=<?php echo ($grave["graveID"]); ?>" method="post">
  <p>Grave ID:
    <input type="text" name="graveID" value="<?php echo $grave["graveID"] ?>" />
  </p>
  <p>First Name:
    <input type="text" name="firstName" value="<?php echo $grave["firstName"] ?>" />
  </p>
  <p>Middle Name:
    <input type="text" name="middleName" value="<?php echo $grave["middleName"] ?>" />
  </p>
  <p>Last Name:
    <input type="text" name="lastName" value="<?php echo $grave["lastName"] ?>" />
  </p>
  <p>Birthday:
    <input type="text" name="birthDate" value="<?php echo $grave["birthDate"] ?>" />
  </p>
  <p>Death Date:
    <input type="text" name="deathDate" value="<?php echo $grave["deathDate"] ?>" />
  </p>
  <p>Graveyard ID:
    <input type="text" name="graveyardID" value="<?php echo $grave["graveyardID"] ?>" />
  </p>
  <input type="submit" name="submit" value="Edit Grave" />
</form>

<?php include("../includes/footer.php"); ?>
