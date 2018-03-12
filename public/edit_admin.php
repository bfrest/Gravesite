<?php
 require_once("../includes/session.php");
 require_once("dbConnect.php");
 require_once("../includes/functions.php");
 confirm_logged_in();
 $layout_context = "admin";

$admin = find_admin_by_id($_GET["id"]);

if (!$admin) {
  redirect_to("manage_admins.php");
}

if (isset($_POST['submit'])) {
  //Perform update
  $id = $admin["id"];
  $username = $_POST["username"];
  $password = password_encrypt($_POST["hashed_password"]);

  $query = "UPDATE admins SET username = '{$username}', hashed_password = '{$password}' WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Admin updated.";
    redirect_to("manage_admins.php");
  } else {
    //Failure
    $_SESSION["message"] = "Admin update failed.";
  }
}
include("../includes/header.php");
?>

<h2>Edit Admin</h2>
<form action="edit_admin.php?id=<?php echo ($admin["id"]);?>" method="post">
  <p> Username:
    <input type="text" name="username" value="<?php echo $admin["username"]; ?>" />
  </p>
  <p> password:
    <input type="text" name="hashed_password" value="<?php echo $admin["hashed_password"]; ?>" />
  </p>
  <input type="submit" name="submit" value="Edit Admin"/>
  <br />
  <br />
  <a href="manage_admins.php">Cancel</a>
</form>

<?php include("../includes/footer.php"); ?>
