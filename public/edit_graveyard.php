<?php
 require_once("../includes/session.php");
 require_once("dbConnect.php");
 require_once("../includes/functions.php");
 confirm_logged_in();
 $layout_context = "admin";
 $graveyard = find_graveyard_by_id($_GET["graveyardID"]);

 if (!$graveyard) {
  redirect_to("manage_graveyards.php");
 }

if (isset($_POST['submit'])) {
  //Perform update
  $graveyardID = $_POST["graveyardID"];
  $street = $_POST["street"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip= $_POST["zip"];
  $phone = $_POST["phone"];
  $addedBy = $_POST["addedBy"];

  $query = "UPDATE graveyards SET street = '{$street}', city = '{$city}', state = '{$state}', zip = '{$zip}', phone = '{$phone}', addedBy = '{$addedBy}' WHERE graveyardID = {$graveyardID} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Graveyard updated.";
    redirect_to("manage_graveyards.php");
  } else {
    //Failure
    $_SESSION["message"] = "Graveyard update failed.";
  }
}
include("../includes/header.php");
?>

<h2>Edit Graveyards</h2>
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<form action="edit_graveyard.php?graveyardID=<?php echo ($graveyard["graveyardID"]); ?>" method="post">
  <p>Graveyard ID:
    <input type="text" name="graveyardID" value="<?php echo $graveyard["graveyardID"]; ?>" />
  </p>
  <p>Street:
    <input type="text" name="street" value="<?php echo $graveyard["street"]; ?>" />
  </p>
  <p>City:
    <input type="text" name="city" value="<?php echo $graveyard["city"]; ?>" />
  </p>
  <p>State:
    <input type="text" name="state" value="<?php echo $graveyard["state"]; ?>" />
  </p>
  <p>Zip:
    <input type="text" name="zip" value="<?php echo $graveyard["zip"]; ?>" />
  </p>
  <p>Phone:
    <input type="text" name="phone" value="<?php echo $graveyard["phone"];?>" />
  </p>
  <p>Added by:
    <input type="text" name="addedBy" value="<?php echo $graveyard["addedBy"]; ?>" />
  </p>
  <input type="submit" name="submit" value="Edit Graveyard" />
</form>

<?php include("../includes/footer.php"); ?>
