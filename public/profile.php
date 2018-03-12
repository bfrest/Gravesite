<?php
require_once("../includes/session.php");
require_once("dbConnect.php");
require_once("../includes/functions.php");
confirm_logged_in();
$layout_context = "admin";
include("../includes/header.php");
$current_admin = find_admin_by_username($_SESSION["username"]);
?>

    <!-- Admin Area -->
    <section id="manageContent">
      <h2>Manage Profile</h2>
      <?php echo message(); ?>
      <table style="margin-left:10px;">
        <tr>
          <th style="text-align: left; width: 200px;">Username</th>
        </tr>
        <tr>
          <td style="text-align: left;"><?php echo htmlentities($_SESSION["username"]); ?></td>
          <td><a href="edit_admin.php?id=<?php echo urlencode($current_admin["id"]);?>">Edit profile</a></td>
        </tr>
      </table>
      <br />
      <br />
      <br />

    </section>

<?php include("../includes/footer.php"); ?>
