<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>
<?php confirm_logged_in(); ?>

<?php
//append all workouts relating to $date, $exercise and $admin_id

$exercise = $_GET['workout'];
$date = date('Y-m-d');
$admin_id = $_SESSION["admin_id"];

echo show_workout_summary($exercise, $date, $admin_id);

?>




<?php require_once("../includes/footer.php"); ?>