<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/header.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php
// 1. Check which muscle group was selected
if(isset($_POST["submit"])){
	$muscle_group = $_POST["exerciseChoice"];	
	
	// 2. Append all exercises relating to muscle group key
	echo append_workouts($muscle_group);
	
	unset($_POST["submit"]);
	
	echo "<a href='#'>Back</a>";
}else{?>
<h3>Choose a muscle group</h3>
<div class="muscleGroup">Arms</div>
<div class="muscleGroup">Legs</div>
<div class="muscleGroup">Chest</div>
<div class="muscleGroup">Back</div>
<div class="muscleGroup">Shoulders</div>
<?php } ?>

<?php require_once("../includes/footer.php"); ?>