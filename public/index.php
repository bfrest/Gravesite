<?php
  require_once("../includes/session.php");
  require_once("dbConnect.php");
  require_once("../includes/functions.php");
  require_once("../includes/validation_functions.php");


  if(isset($_POST["submit"])) {

    $ancestor_search = $_POST["ancestor_search"];

    $query = "SELECT * FROM graves WHERE lastName LIKE '%$ancestor_search%'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
    } else {
      // Failure
      $_SESSION["message"] = "Sorry, we couldn't find any matches.";
      redirect_to("index.php");
    }

  }

  include("../includes/header.php");
  $grave_set = find_all_graves();
?>
<!-- ======== hero ======= -->
<section id="hero">
    <h1>Welcome to the gravesite</h1>
    <div class="search">
        <form action="index.php" method="post">
            <input type="search" name="ancestor_search" placeholder="Find your ancestor">
            <input type="submit" name="submit" value="Search" />
        </form>
    </div>
    <!-- end search -->
</section>
    <!-- end hero -->

<br />
<?php echo message();?>

<table>
  <tbody>
    <tr>
      <th style="text-align: left;">Picture</th>
      <th style="text-align: left;">First Name</th>
      <th style="text-align: left;">Middle Name</th>
      <th style="text-align: left;">Last Name</th>
      <th style="text-align: left;">Birth Date</th>
      <th style="text-align: left;">Death Date</th>
    </tr>
    <?php while ($grave = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><img class="gravePhoto" src="<?php echo $grave["photo"]; ?>"></td>
      <td><?php echo htmlentities($grave["firstName"]); ?></td>
      <td><?php echo htmlentities($grave["middleName"]); ?></td>
      <td><?php echo htmlentities($grave["lastName"]); ?></td>
      <td><?php echo htmlentities($grave["birthDate"]); ?></td>
      <td><?php echo htmlentities($grave["deathDate"]); ?></td>
    </tr>
   <?php  } //end of while $grave loop ?>
  </tbody>
</table>

<?php include("../includes/footer.php"); ?>
