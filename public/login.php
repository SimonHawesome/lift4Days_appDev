<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<?php
$username = "";
//process login form

if (isset($_POST['submit'])) {
	// validations
	$required_fields = array("username", "password");
	validate_presences($required_fields);
	
	if (empty($errors)) {
    // Attempt Login

		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      // Success
		// Mark user as logged in
		$_SESSION["admin_id"] = $found_admin["id"];
		$_SESSION["username"] = $found_admin["username"];
		redirect_to("manage_content.php");
    } else {
      // Failure
      $_SESSION["msg"] = "Username/password not found.";
    }
  }
}else{
	
}
?>

<div id="formField">
  <h2>Lift 4 Days</h2>
  <?php 
	  if(isset($_SESSION["msg"])){
		  echo errorMsg(); 
	  }
  ?>
  <h3>Sign-in</h3>
  <form action="login.php" method="post">
    <p>Username:
      <input type="text" name="username" value="" />
    </p>
    <p>Password:
      <input type="password" name="password" value="" />
    </p>
    <input type="submit" name="submit" value="Sign-In" />
  </form><br /><hr />
  <a href="signup.php"><button>Sign-up</button></a>
  
</div>
<?php require_once("../includes/footer.php"); ?>