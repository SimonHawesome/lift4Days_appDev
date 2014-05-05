<?php

//start the session
session_start();

//set functions to output session variable values

function errorMsg(){
	if (isset($_SESSION["msg"])){
		$output  = "<div class=\"msg\">";
		$output .= htmlentities($_SESSION["msg"]);
		$output .= "</div>";
		
		//clear message after use
		$_SESSION["msg"] = null;
		
		return $output;
	}
}

?>