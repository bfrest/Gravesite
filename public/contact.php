<?php
  require_once("../includes/functions.php");
  include("../includes/header.php");
?>
<!--contact image -->
<div class="contactImg"></div>
<!--end contact image -->
<!--Contact form-->
<h3 class="underline contactCenter">Contact Us</h3>
<p class="w3-center" id="messageUs">Send us a message and we will get back to you as soon as we can</p>

<form class="contactForm" name="contactForm" action="">
  <div id="contactStyle">

    <div class="firstInput">
      <input class="fullName" name="fullName" placeholder="Full Name" minlength="3" required>
      <input class="phone" name="phone" placeholder="Phone Number" minlength="9" required>
    </div>
    <!--end firstInput-->

    <div class="secondInput">
      <input class="subject" name="subject" placeholder="Subject" minlength="3" required>
      <input type="email" name="email" placeholder="Email" required />
    </div>
    <!--end secondInput -->

    <div class="clear"><!--clear float:left--></div>
  </div>
  <!--end contactStyle-->

  <p id="messageP">Message (optional)</p>
  <div class="messageArea">
      <textarea> </textarea>
  </div>
  <!--end texarea-->
  <input id="contactSubmit" type="submit" value="submit" name="submit"></input>

</form>
		<script src="js/jquery-3.1.1.js">

		</script>
		<script src="js/jquery.validate.js"></script>
		<script src="js/form_validation.js"></script>

<?php include("../includes/footer.php"); ?>
