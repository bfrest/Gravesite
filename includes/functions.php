<?php
  function getUrl() {
    $query = $_SERVER['PHP_SELF'];
    $path = pathinfo( $query );
    $currentUrl = $path['basename'];
    return $currentUrl;
  }

  function redirect_to ($new_location) {
    header ("Location: " . $new_location);
    exit;
  }

  function mysql_prep($string) {
		global $connection;

		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

  function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed");
		}
	}

  function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

  function find_all_posts() {
    global $connection;

    $query = "SELECT * FROM posts ORDER BY userID ASC";
    $post_set = mysqli_query($connection, $query);
    confirm_query($post_set);
    return $post_set;
  }

  function find_post_by_id($postId) {
    global $connection;

    $query = "SELECT * FROM posts WHERE postId = {$postId} LIMIT 1";
    $post_set = mysqli_query($connection, $query);
    confirm_query($post_set);
    if ($post = mysqli_fetch_assoc($post_set)) {
      return $post;
    } else {
      return null;
    }
  }

  function find_all_admins() {
  global $connection;

  $query = "SELECT * FROM admins ORDER BY id ASC";
  $post_set = mysqli_query($connection, $query);
  confirm_query($post_set);
  return $post_set;
}

  function find_admin_by_id($id) {
  global $connection;

  $query = "SELECT * FROM admins WHERE id = {$id} LIMIT 1";
  $admin_set = mysqli_query($connection, $query);
  confirm_query($admin_set);
  if ($admin = mysqli_fetch_assoc($admin_set)) {
    return $admin;
  } else {
    return null;
  }
}

  function find_admin_by_username($username) {
  global $connection;

  $query = "SELECT * FROM admins WHERE username = '{$username}' LIMIT 1";
  $admin_set = mysqli_query($connection, $query);
  confirm_query($admin_set);
  if ($admin = mysqli_fetch_assoc($admin_set)) {
    return $admin;
  } else {
    return null;
  }
}

function find_all_graveyards() {
  global $connection;

  $query = "SELECT * FROM graveyards";
  $graveyard_set = mysqli_query($connection, $query);
  confirm_query($graveyard_set);
  return $graveyard_set;
}

function find_graveyard_by_id($id) {
 global $connection;

 $query = "SELECT * FROM graveyards WHERE graveyardID = {$id} LIMIT 1";
 $graveyard_set = mysqli_query($connection, $query);
 confirm_query($graveyard_set);
 if ($graveyard = mysqli_fetch_assoc($graveyard_set)) {
   return $graveyard;
 } else {
    return null;
 }

}

function find_all_graves() {
  global $connection;

  $query = "SELECT * FROM graves";
  $grave_set = mysqli_query($connection, $query);
  confirm_query($grave_set);
  return $grave_set;
}

function find_grave_by_id($id) {
 global $connection;

 $query = "SELECT * FROM graves WHERE graveID = {$id} LIMIT 1";
 $grave_set = mysqli_query($connection, $query);
 confirm_query($grave_set);
 if ($grave = mysqli_fetch_assoc($grave_set)) {
   return $grave;
 } else {
    return null;
 }

}

  function password_encrypt($password) {
  $hash_format = "$2y$10$"; // Tells PHP to use blowfish with a cost of 10
  $salt_length = 22;        // Blowfish salts should be 22-characters or more
  $salt = generate_salt($salt_length);
  $format_and_salt = $hash_format . $salt;
  $hash = crypt($password, $format_and_salt);
  return $hash;
}

  function generate_salt($length) {
  // Not 100% unique , not 100% random, but good enough for a salt_length
  // MD5 returns 32 characters
  $unique_random_string = md5(uniqid(mt_rand(), true));

  // Valid characters for a salt are [a-z A-Z 0-9./]
  $base64_string = base64_encode($unique_random_string);

  // But not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+', '.', $base64_string);

  // Truncate string to the correct length
  $salt = substr($modified_base64_string, 0, $length);

  return $salt;
}

  function password_check($password, $existing_hash) {
   // Existing hash contains format and salt at start
   $hash = crypt($password, $existing_hash);
   $hash = substr("$hash", 0, -31);
   if ($hash === $existing_hash) {
     return true;
   } else {
     return false;
   }
 }

  function attempt_login($username, $password) {
   $admin = find_admin_by_username($username);
   if ($admin) {
     // Found admin, now check password
     $newHash = substr($admin["hashed_password"], 0, -31);

     if (password_check($password, $newHash)) {
       // Password matches
       return $admin;
     } else {
       // Password does not matches
       return false;
     }
   } else {
     // Admin not Found
     return false;
   }
 }

 function logged_in() {
   return isset($_SESSION["admin_id"]);
 }

 function confirm_logged_in() {
   if(!logged_in()) {
     redirect_to("login.php");
   }
 }

  ?>
