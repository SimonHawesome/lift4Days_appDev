<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  //Validate form fields
	$required_field = array("username", "password");
	validate_presences($required_field);
	
	if(empty($errors)){
		
		$id = $_SESSION["admin_id"];
		$username = mysql_prep($_POST["username"]);
		$hashed_password = password_encrypt($_POST["password"]);
		
		$query  = "UPDATE users SET ";
		$query .= "username = '{$username}', ";
		$query .= "hashed_password = '{$hashed_password}' ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		
		if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["msg"] = "User updated.";
      redirect_to("manage_content.php");
    } else {
      // Failure
      $_SESSION["msg"] = "User update failed.";
    }
	}
  
}


?>
<h3>Edit your Info</h3>
<?php echo form_errors($errors); ?>
<form action="edit_user.php" method="post">
  <p>Username:
    <input type="text" name="username" value="<?php echo htmlentities($_SESSION["username"]); ?>" />
  </p>
  <p>Password:
    <input type="password" name="password" value="" />
  </p>
  <input type="submit" name="submit" value="Submit" />
</form>
<br />
<hr />
<a href="signup.php">
<button>Sign-up</button>
</a>
<?php require_once("../includes/footer.php"); ?>