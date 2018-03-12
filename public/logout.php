<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");

// V1: simp'e logout
// session_start()
$_SESSION["admin_id"] = null;
$_SESSION["username"] = null;
redirect_to("index.php");
?>
