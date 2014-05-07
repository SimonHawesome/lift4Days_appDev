// JavaScript Document

$(document).ready(function(){
	var muscle_group_id = "";

	$(".muscleGroups").click(function(){
		if(this.id == "arms"){
			muscle_group_id = "arms";
		}else if(this.id == "chest"){
			muscle_group_id = "chest";
		}else if(this.id == "back"){
			muscle_group_id = "back";
		}else if(this.id == "legs"){
			muscle_group_id = "legs";
		}else if(this.id == "shoulders"){
			muscle_group_id = "shoulders";
		}
		window.location.href ="log_workout.php?muscle="+muscle_group_id;
	});
	
	$("#check").click(function(){
		alert(muscle_group_id);
	});
});