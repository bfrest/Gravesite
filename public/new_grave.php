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

    $target_dir = "uploads/";
    $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $birthDate = $_POST["birthDate"];
    $deathDate = $_POST["deathDate"];
    $graveyardID = $_POST["graveyardID"];
    $photoPath = $target_file;

    if(!empty($errors)) {
      $_SESSION["errors"] = $errors;
      redirect_to("new_grave.php");
    }
    // Perform create
    $query = "INSERT INTO graves (";
    $query .= " firstName, middleName, lastName, birthDate, deathDate, graveyardID, photo";
    $query .= ") VALUES (";
    $query .= " '{$firstName}', '{$middleName}', '{$lastName}', '{$birthDate}', '{$deathDate}', '{$graveyardID}', '{$target_file}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Grave created.";
      redirect_to("manage_graves.php");
    } else {
      // Failure
      $_SESSION["message"] = "Grave creation failed.";
      redirect_to("new_grave.php");
    }

  }

include("includes/header.php");
?>

<div id="main">
  <h2>Create Grave</h2>
  <?php echo message(); ?>
  <?php echo form_errors($errors); ?>
  <form action="new_grave.php" method="post" enctype="multipart/form-data">
    <p>First Name:
      <input type="text" name="firstName" value="" />
    </p>
    <p>Middle Name:
      <input type="text" name="middleName" value="" />
    </p>
    <p>Last Name:
      <input type="text" name="lastName" value="" />
    </p>
    <p>Birthday:
      <input type="text" name="birthDate" value="" />
    </p>
    <p>Death Date:
      <input type="text" name="deathDate" value="" />
    </p>
    <p>Graveyard ID:
      <input type="text" name="graveyardID" value="" />
    </p>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br />
    <br />
    <input type="submit" name="submit" value="Create Grave" />
  </form>
  <br />
  <a href="manage_graves.php">Cancel</a>
  </div>

<?php include("../includes/footer.php"); ?>
