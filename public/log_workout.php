<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<h3>Choose a muscle group</h3>
<select name="exerciseChoice">
    <option value="none">- Select -</option>
    <option value="arms">Arms</option>
    <option value="chest">Chest</option>
    <option value="back">Back</option>
    <option value="legs">Legs</option>
    <option value="shoulders">Shoulders</option>
</select>


<?php require_once("../includes/footer.php"); ?>