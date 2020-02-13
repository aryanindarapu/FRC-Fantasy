<?php
	$data = $_POST["data"];
	
	$fp = fopen('/FRC Fantasy/databases/teamData.json','w');
	fwrite($fp, $data);
	fclose($fp);
?>