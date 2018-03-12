<?php
 require_once("../includes/session.php");
 require_once("dbConnect.php");
 require_once("../includes/functions.php");
 confirm_logged_in();
 require_once("../includes/validation_functions.php");
 $layout_context = "admin";

 $post = find_post_by_id($_GET["postID"]);

if (!$post) {
  redirect_to("manage_content.php");
}

if (isset($_POST['submit'])) {
  //Perform update
  $postID = $_POST["postID"];
  $userID = $_POST["userID"];
  $postText = $_POST["postText"];

  $query = "UPDATE posts SET userID = '{$userID}', postText = '{$postText}' WHERE postID = {$postID} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    //Success
    $_SESSION["message"] = "Post updated.";
    redirect_to("manage_content.php");
  } else {
    //Failure
    $_SESSION["message"] = "Post update failed.";
  }
}
 include("../includes/header.php");
?>

<h2>Edit Post</h2>
<form action="edit_post.php?postID=<?php echo ($post["postID"]);?>" method="post">
  <p> User ID:
    <input type="text" name="userID" value="<?php echo $post["userID"]; ?>" />
  </p>
  <p> Post:
    <input type="text" name="postText" value="<?php echo $post["postText"]; ?>" />
  </p>
  <p> Post ID:
    <input type="text" name="postID" value="<?php echo $post["postID"]; ?>" />
  </p>
  <input type="submit" name="submit" value="Edit Post"/>
  <br />
  <br />
  <a href="manage_content.php">Cancel</a>

</form>

<?php include("../includes/footer.php"); ?>
