<footer>
  <div class="navbar">
      <nav>
          <ul>
            <li> <a class="<?php if ($currentPage == "index.php") { echo "active";} ?>" href="index.php">Home</a></li>
            <li> <a class="<?php if ($currentPage == "about.php") { echo "active";} ?>" href="about.php">About</a></li>
            <li> <a class="<?php if ($currentPage == "blog.php") { echo "active";} ?>" href="blog.php">Blog</a></li>
            <li> <a class="<?php if ($currentPage == "contact.php") { echo "active";} ?>" href="contact.php">Contact</a></li>
            <li> <a class="<?php if ($currentPage == "faq.php") { echo "active";} ?>" href="faq.php">FAQ</a></li>
            <?php if (logged_in()) { echo "<li><a href=\"profile.php\">Profile</a></li>";} ?>
            <?php if (!logged_in()) { echo "<li><a href=\"#openModal\">login</a></li>"; }
            else { echo "<li> <a href=\"logout.php\">Logout</a></li>";}?>
          </ul>
      </nav>
      <div id="openModal" class="modalDialog">
          <div><a href="#close" title="Close" class="close">X</a>
              <!-- content for modal -->
              <div class="login">
                  <h2>Sign in</h2>
                  <form action="login.php" method="post">
                    <p>Username:
                      <input type="text" name="username" value="<?php //echo htmlentities($username);?>" />
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  

  </script>

</footer>
</div>
</body>

</html>
