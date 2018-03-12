<?php
  $layout_context = "public";
  $currentPage = getUrl();
?>

<div class="navbar">
    <nav>
        <ul>
          <li> <a class="<?php if ($currentPage == "index.php") { echo "highlighted";} ?>" href="index.php">Home</a></li>
          <li> <a class="<?php if ($currentPage == "about.php") { echo "highlighted";} ?>" href="about.php">About</a></li>
          <li> <a class="<?php if ($currentPage == "blog.php") { echo "highlighted";} ?>" href="blog.php">Blog</a></li>
          <li> <a class="<?php if ($currentPage == "contact.php") { echo "highlighted";} ?>" href="contact.php">Contact</a></li>
          <li> <a class="<?php if ($currentPage == "faq.php") { echo "highlighted";} ?>" href="faq.php">FAQ</a></li>
          <?php if (logged_in()) { echo "<li><a href=\"profile.php\">Profile</a></li>";} ?>
          <?php if (logged_in()) { echo "<li><a href=\"admin.php\">Admin</a></li>";} ?>
          <?php if (!logged_in()) { echo "<li><a href=\"#openModal\">login</a></li>"; }
          else { echo "<li> <a href=\"logout.php\">Logout</a></li>";}?>
        </ul>
    </nav>
    <div id="openModal" class="modalDialog">
        <div><a href="#close" title="Close" class="close">X</a>
            <!-- content for modal -->
            <div class="login">
                <h2>Sign in</h2>
                <?php //echo message(); ?>
                <?php echo form_errors($errors); ?>
                <form action="login.php" method="post">
                  <p>Username:
                    <input type="text" name="username" value="" />
                  </p>
                  <p>Password:
                    <input type="password" name="hashed_password" value="" />
                  </p>
                  <input type="submit" name="submit" value="Submit" />
                </form>
                <!-- end form -->
            </div>
            <!-- end login -->
        </div>
        <!-- end close -->
    </div>
    <!-- end openModal -->
</div>
<!-- end navbar -->
