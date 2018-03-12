<?php
require_once("../includes/session.php");
require_once("dbConnect.php");
require_once("../includes/functions.php");
confirm_logged_in();
$layout_context = "admin";
include("../includes/header.php");
?>

    <!-- Admin Area -->
    <section id="manageContent">
      <h2>Welcome <?php echo htmlentities($_SESSION["username"]); ?></h2>
      <?php echo message(); ?>
      <ul>
       <li><a href="manage_admins.php">Manage Admins</a></li>
       <li><a href="manage_content.php">Manage Content</a></li>
       <li><a href="manage_graveyards.php">Manage Graveyards</a></li>
       <li><a href="manage_graves.php">Manage Graves</a></li>
       <li><a href="logout.php">logout</a></li>
      </ul>

    </section>

    <?php include("../includes/footer.php"); ?>
