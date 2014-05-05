<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<?php
//Process signup form
if(isset($_POST['submit'])){
	//Validate form fields
	$required_field = array("username", "password");
	validate_presences($required_field);
	
	if(empty($errors)){
		$username = mysql_prep($_POST["username"]);
		$hashed_password = password_encrypt($_POST["password"]);
		
		$query  = "INSERT INTO users (";
		$query .= " username, hashed_password";
		$query .= ") VALUES (";
		$query .= " '{$username}', '{$hashed_password}'";
		$query .= ")";
		$result = mysqli_query($connection, $query);
		
		if ($result) {
		  // Success
		  $_SESSION["msg"] = "User created.";
		  redirect_to("login.php");
		} else {
		  // Failure
		  $_SESSION["msg"] = "User creation failed.";
		}
	}
}
?>

<div id="formField">
  <h2>Lift 4 Days</h2>
  
  <h3>Sign-up</h3>
  <?php echo form_errors($errors); ?>
  <form action="signup.php" method="post">
    <p>Username:
      <input type="text" name="username" value="" />
    </p>
    <p>Password:
      <input type="password" name="password" value="" />
    </p>
    <input type="submit" name="submit" value="Create user" />
  </form>
  <br /><hr />
  <a href="login.php"><button>back</button></a>
</div>
<?php require_once("../includes/footer.php"); ?>