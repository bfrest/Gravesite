<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");
  confirm_logged_in();
  $layout_context = "admin";
  require_once("../includes/validation_functions.php");

  if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    //$required_fields = array("street", "city", "state", "zip", "phone", "addedBy");
    //validate_presences($required_fields);

    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $phone = $_POST["phone"];
    $addedBy = $_POST["addedBy"];

    if(!empty($errors)) {
      $_SESSION["errors"] = $errors;
      redirect_to("new_graveyard.php");
    }
    // Perform create
    $query = "INSERT INTO graveyards (";
    $query .= " street, city, state, zip, phone, addedBy";
    $query .= ") VALUES (";
    $query .= " '{$street}', '{$city}', '{$state}', '{$zip}', '{$phone}', '{$addedBy}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Graveyard created.";
      redirect_to("manage_graveyards.php");
    } else {
      // Failure
      $_SESSION["message"] = "Graveyard creation failed.";
      redirect_to("new_graveyard.php");
    }

  }

include("../includes/header.php");
?>

<div id="main">
  <h2>Create Graveyard</h2>
  <?php echo message(); ?>
  <?php echo form_errors($errors); ?>
  <form action="new_graveyard.php" method="post">
    <p>Street:
      <input type="text" name="street" value="" />
    </p>
    <p>City:
      <input type="text" name="city" value="" />
    </p>
    <p>State:
      <input type="text" name="state" value="" />
    </p>
    <p>Zip:
      <input type="text" name="zip" value="" />
    </p>
    <p>Phone:
      <input type="text" name="phone" value="" />
    </p>
    <p>Added by:
      <input type="text" name="addedBy" value="" />
    </p>
    <input type="submit" name="submit" value="Create Graveyard" />
  </form>
  <br />
  <a href="manage_graveyards.php">Cancel</a>
  </div>

<?php include("../includes/footer.php"); ?>
