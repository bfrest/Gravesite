<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");
  confirm_logged_in();
  $layout_context = "admin";
  include("../includes/header.php");
?>
<div id="main">
  <h2>Create Admin</h2>
  <?php echo message(); ?>
  <?php //echo form_errors($errors); ?>
  <form action="create_admin.php" method="post">
    <p>Username:
      <input type="text" name="username" value="" />
    </p>
    <p>Password:
      <input type="password" name="hashed_password" value="" />
    </p>
    <input type="submit" name="submit" value="Create Admin" />
  </form>
  <br />
  <a href="manage_admins.php">Cancel</a>
  </div>

<?php include("../includes/footer.php"); ?>
