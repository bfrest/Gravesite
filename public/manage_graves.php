<?php
 require_once("../includes/session.php");
 require_once("dbConnect.php");
 require_once("../includes/functions.php");
 confirm_logged_in();
 $layout_context = "admin";
 include("../includes/header.php");
 $grave_set = find_all_graves();
?>
    <!-- Manage Graves -->
    <section id="manageContent">
        <h2>Manage Graves</h2>
        <div>
          <?php echo message();  ?>
        </div>
        <table>
          <tr>
            <th style="text-align: left;">Grave ID</th>
            <th  style="text-align: left;">firstName</th>
            <th  style="text-align: left;">middleName</th>
            <th  style="text-align: left;">lastName</th>
            <th  style="text-align: left;">birthDate</th>
            <th  style="text-align: left;">deathDate</th>
            <th  style="text-align: left;">graveyardID</th>
            <th  style="text-align: left;">Photo</th>
          </tr>
          <?php while($grave = mysqli_fetch_assoc($grave_set)){ ?>
          <tr>
            <td> <?php echo htmlentities($grave["graveID"]);?> </td>
            <td> <?php echo htmlentities($grave["firstName"]);?> </td>
            <td> <?php echo htmlentities($grave["middleName"]);?> </td>
            <td> <?php echo htmlentities($grave["lastName"]);?> </td>
            <td> <?php echo htmlentities($grave["birthDate"]);?> </td>
            <td> <?php echo htmlentities($grave["deathDate"]);?> </td>
            <td> <?php echo htmlentities($grave["graveyardID"]);?> </td>
            <td> <img class="gravePhoto" src="<?php echo $grave["photo"]; ?>"</td>
            <td><a href="edit_grave.php?graveID=<?php echo urlencode($grave["graveID"]);?>">Edit<td>
            <td><a href="delete_grave.php?graveID=<?php echo urlencode($grave["graveID"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
          </tr>
        <?php } ?>
        </table>
        <br />
        <a href="new_grave.php">Add new grave</a>
    </section>

<?php include("../includes/footer.php"); ?>
