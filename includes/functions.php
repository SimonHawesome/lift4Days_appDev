<?php

function redirect_to($new_location){
	header("Location: " . $new_location);
	exit;	
}

function mysql_prep($string){
	global $connection;
	
	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}

function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
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

function password_encrypt($password){
	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	$salt_length = 22; 					// Blowfish salts should be 22-characters or more
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
}

function generate_salt($length) {
	// Not 100% unique, not 100% random, but good enough for a salt
	// MD5 returns 32 characters
	$unique_random_string = md5(uniqid(mt_rand(), true));
	
	// Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);
	
	// But not '+' which is valid in base64 encoding
	$modified_base64_string = str_replace('+', '.', $base64_string);
	
	// Truncate string to the correct length
	$salt = substr($modified_base64_string, 0, $length);
	
	return $salt;
}

function find_user_by_username($username) {
	global $connection;
	
	$safe_username = mysqli_real_escape_string($connection, $username);
	
	$query  = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	$user_set = mysqli_query($connection, $query);
	confirm_query($user_set);
	if($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}

function password_check($password, $existing_hash) {
	// existing hash contains format and salt at start
  $hash = crypt($password, $existing_hash);
  if ($hash === $existing_hash) {
	return true;
  } else {
	return false;
  }
}

function attempt_login($username, $password) {
	$user = find_user_by_username($username);
	if ($user) {
		// found admin, now check password
		if (password_check($password, $user["hashed_password"])) {
			// password matches
			return $user;
		} else {
			// password does not match
			return false;
		}
	} else {
		// admin not found
		return false;
	}
}

function logged_in() {
	return isset($_SESSION['admin_id']);
}

function confirm_logged_in() {
	if (!logged_in()) {
		redirect_to("login.php");
	}
}

function get_workouts(){
	global $connection;
	
	$query = "SELECT * FROM muscle_groups";
	$all_workouts = mysqli_query($connection, $query);
	confirm_query($all_workouts);
	/*return $all_workouts;*/
	
	$output  = "<div id='muscleGroupContainer'>";
	while($muscleGroups = mysqli_fetch_assoc($all_workouts)){
		$output .= "<div class='muscleGroups' ";
		$output .= "id='";
		$output .= $muscleGroups["muscle_group"];
		$output .= "'>";
		$output .= ucfirst(htmlentities($muscleGroups["muscle_group"]));
		$output .= "</div>";
	}
	$output .= "</div>";
	return $output;
}

function get_related_workouts($muscle_group){
	global $connection;	
	
	$query  = "SELECT * ";
	$query .= "FROM exercises ";
	$query .= "WHERE muscle_group = '{$muscle_group}'";
	
	$all_related_workouts = mysqli_query($connection, $query);
	confirm_query($all_related_workouts);
	return $all_related_workouts;
}

function append_workouts($muscle_group){
	
	$all_related_workouts = get_related_workouts($muscle_group);
	$output  = "<form method='POST' action='log_workout.php'>";
    $output .= "<select name='exerciseChoice'>";
	while($workout = mysqli_fetch_assoc($all_related_workouts)){
		
		/*$select_value = trim($workout, " ");*/
		
		$output .= "<option ";
		$output .= "value='";
		$output .= $workout["type"];
		$output .= "'>";
		$output .= $workout["type"];
		$output .= "</option></br>";
	}
	$output .= "</select><input type='submit' name='submit_set' value='continue' /></form></br>";
	$output .= "<a href='log_workout.php'>back</a>";
	mysqli_free_result($all_related_workouts);
	return $output;
}

function create_workout_form($admin, $muscle_group){
	
}
?>
