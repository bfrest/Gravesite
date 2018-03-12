<?php
require_once("../includes/session.php");
require_once("dbConnect.php");
require_once("../includes/functions.php");
confirm_logged_in();
$layout_context = "admin";
include("../includes/header.php");
$post_set = find_all_posts();
?>
    <!-- Manage Content -->
    <section id="manageContent">
        <h2>Manage Content</h2>
        <div>
          <?php echo message();  ?>
        </div>
        <table>
          <tr>
            <th style="text-align: left; width: 200px;">User ID</th>
            <th colspan="2" style="text-align: left;">Post Content</th>
            <th colspan="2" style="text-align: left;">Actions</th>
          </tr>
          <?php while($post = mysqli_fetch_assoc($post_set)){ ?>
          <tr>
            <td> <?php echo htmlentities($post["userID"]);?> </td>
            <td> <?php echo htmlentities($post["postText"]);?> </td>
            <td><a href="edit_post.php?postID=<?php echo urlencode($post["postID"]);?>">Edit</td>
            <td><a href="delete_post.php?postID=<?php echo urlencode($post["postID"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
          </tr>
        <?php } ?>
        </table>
        <br />
        <a href="new_post.php">Add new post</a>
    </section>

<?php include("../includes/footer.php"); ?>
