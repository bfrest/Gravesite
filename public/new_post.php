<?php
 require_once("../includes/session.php");
 require_once("dbConnect.php");
 require_once("../includes/functions.php");
 confirm_logged_in();
 $layout_context = "admin";
 include("../includes/header.php");
?>
<h2>Create Post</h2>
<?php echo message(); ?>
		<?php $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
<form action="create_post.php" method="post" name="createPost">
  <p> User ID:
    <input type="text" name="userID" value="" />
  </p>
  <p> Post:
    <input type="text" name="postText" value="" />
  </p>
  <input  type="submit" name="submit" value="Create Post"/>

</form>

<?php include("../includes/footer.php"); ?>
