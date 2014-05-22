<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if(isset($_GET["muscle"])){
	$get_muscle = $_GET["muscle"];
}

if(isset($_GET["muscle"])){
	// 2. Display all workouts corresponding with muscle group
	if($get_muscle == "arms"){
		echo append_workouts($get_muscle);	
	}else if($get_muscle == "chest"){
		echo append_workouts($get_muscle);
	}else if($get_muscle == "back"){
		echo append_workouts($get_muscle);	
	}else if($get_muscle == "legs"){
		echo append_workouts($get_muscle);	
	}else if($get_muscle == "shoulders"){
		echo append_workouts($get_muscle);	
	}
	//create variable for set position
	$_SESSION['setPos'] = 0;
}else if(isset($_POST["exerciseChoice"]) || isset($_GET["workout"])){
	// 3. Display form fields for chosen muscle group
	
	if(isset($_POST["exerciseChoice"])){
		$workout = str_replace(' ', '', $_POST["exerciseChoice"]);
	}else if(isset($_GET["workout"])){
		$workout = $_GET["workout"];
	}
	
	echo form_errors($errors);
	
	$admin = $_SESSION["admin_id"];
	$date = date('Y-m-d');
	
	// 4. Process signup form
	if(isset($_POST['submit'])){
		
		if($_SESSION['setPos'] >= 0){
			$_SESSION['setPos'] ++;	
		}
		
		//Validate form fields
		$required_field = array("reps", "weight");
		validate_presences($required_field);
		
		//set form value variables
		$reps = $_POST["reps"];
		$weight = $_POST["weight"];
		$notes = $_POST["notes"];
		$setPos = $_SESSION['setPos'];
		
		
		if(empty($errors)){
			
			$query  = "INSERT INTO exercise_logs (";
			$query .= " muscle_group, admin_id, date, sets, reps, weight, notes ";
			$query .= ") VALUES (";
			$query .= " '{$workout}', {$admin}, '{$date}', {$setPos}, {$reps}, {$weight}, '{$notes}' ";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			
			if ($result) {
			  // Success
			  $_SESSION["msg"] = "Set Updated.";
			  redirect_to("log_workout.php?workout=" . $workout);
			} else {
				
			    // Failure
			    $_SESSION["msg"] = "Set update failed.";
			}
		}
	}
	
?>
<?php echo form_errors($errors); ?> <?php echo errorMsg(); ?>
<form action="log_workout.php?workout=<?php echo $workout; ?>" method="POST">
  <p>Admin: <?php echo $admin; ?></p>
  <p>Workout: <?php echo $workout; ?></p>
  <p>Date: <?php echo $date; ?></p>
  <p>Set:<?php echo $_SESSION['setPos'] + 1; ?></p>
  <p>Reps:
    <input type="text" name="reps" value="" />
  </p>
  <p>Weight:
    <input type="text" name="weight" value="" />
  </p>
  <p>Notes:
    <input type="text" name="notes" value="" />
  </p>
  <input type="submit" name="submit" value="Submit set" />
</form>
<a href='log_workout.php'>back</a>
<?php
}else{
	// 1. Display all Muscle Groups in separate divs
	echo get_workouts();
}
?>

<!--container for submission button-->
<div id="get"></div>
<?php require_once("../includes/footer.php"); ?>