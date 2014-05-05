<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>
<?php confirm_logged_in(); ?>

<?php 
	if(isset($_SESSION["msg"])){
	  echo errorMsg(); 
	  echo "</br>";
	}
?>

<a href="">Log Workout</a><br />
<br />
<a href="">View logged workouts</a><br />
<br />
<a href="edit_user.php">Update user info</a><br />
<br />
<a href="logout.php">Logout</a>

<?php require_once("../includes/footer.php"); ?>