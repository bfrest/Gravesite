<?php
require_once("../includes/session.php");
require_once("dbConnect.php");
require_once("../includes/functions.php");
confirm_logged_in();
$layout_context = "admin";
include("../includes/header.php");
$admin_set = find_all_admins();
?>

    <!-- Manage Content -->
    <section id="manageContent">
      <h2>Manage Admins</h2>
      <?php echo message(); ?>
      <table>
        <tr>
          <th style="text-align: left; width: 200px;">User ID</th>
          <th colspan="2" style="text-align: left;">Username</th>
          <th colspan="2" style="text-align: left;">pass</th>
        </tr>
        <?php while($admin = mysqli_fetch_assoc($admin_set)){ ?>
        <tr>
          <td> <?php echo htmlentities($admin["id"]);?> </td>
          <td> <?php echo htmlentities($admin["username"]);?> </td>
          <td> <?php echo htmlentities($admin["hashed_password"]);?> </td>
          <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>">Edit</td>
          <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
        </tr>
      <?php } ?>
      </table>
      <br />
      <a href="new_admin.php">Add new admin</a>
      <br />
      <a href="logout.php">logout</a>
    </section>

<?php include("../includes/footer.php"); ?>
