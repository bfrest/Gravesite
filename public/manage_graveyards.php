<?php
require_once("../includes/session.php");
require_once("dbConnect.php");
require_once("../includes/functions.php");
confirm_logged_in();
$layout_context = "admin";
include("../includes/header.php");
$graveyard_set = find_all_graveyards();
?>

    <!-- Manage Content -->
    <section id="manageContent">
      <h2>Manage Graveyards</h2>
      <?php echo message(); ?>
      <table>
        <tr>
          <th style="text-align: left; width: 200px;">GraveyardID</th>
          <th style="text-align: left;">Street</th>
          <th style="text-align: left;">City</th>
          <th style="text-align: left;">State</th>
          <th style="text-align: left;">Zip</th>
          <th style="text-align: left;">Phone</th>
          <th style="text-align: left;">Added by</th>
        </tr>
        <?php while($yard = mysqli_fetch_assoc($graveyard_set)){ ?>
        <tr>
          <td> <?php echo htmlentities($yard["graveyardID"]);?> </td>
          <td> <?php echo htmlentities($yard["street"]);?> </td>
          <td> <?php echo htmlentities($yard["city"]);?> </td>
          <td> <?php echo htmlentities($yard["state"]);?> </td>
          <td> <?php echo htmlentities($yard["zip"]);?> </td>
          <td> <?php echo htmlentities($yard["phone"]);?> </td>
          <td> <?php echo htmlentities($yard["addedBy"]);?> </td>
          <td><a href="edit_graveyard.php?graveyardID=<?php echo urlencode($yard["graveyardID"]);?>">Edit</td>
          <td><a href="delete_graveyard.php?graveyardID=<?php echo urlencode($yard["graveyardID"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
        </tr>
      <?php } ?>
      </table>
      <br />
      <a href="new_graveyard.php">Add new graveyard</a>
      <br />
      <a href="admin.php">Cancel</a>
    </section>

<?php include("../includes/footer.php"); ?>
