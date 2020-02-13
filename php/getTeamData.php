<?php
	$team = $_POST["team"];

	$string = file_get_contents("../databases/teamData.json");
	$json_a = json_decode($string, true);\

	$jsonIterator = new RecursiveIteratorIterator(
		new RecursiveArrayIterator(json_decode($json, TRUE)),
		RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
		if(is_array($val) && $key == $team) {
			echo json_encode($val);
		}
	}
?>
