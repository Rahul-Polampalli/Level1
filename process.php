<?php
	require_once('/classes/Database.class.php');
	require_once('/classes/Export.class.php');
	
	$db = new Database();
	
	$arr = array();
	$type = $_GET['type'];
	
	if($type == 'insert'){
		$name = $_GET['codeName'];
		$blood = $_GET['bloodColor'];
		$antennas = $_GET['antennas'];
		$legs = $_GET['legs'];
		$home = $_GET['homePlanet'];
		
		if($db -> insert($name, $blood, $antennas, $legs, $home))
			$arr['status'] = 'success';
		else
			$arr['status'] = 'faliure';
			
		echo json_encode($arr);
	}
?>