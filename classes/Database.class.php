<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.db.php');

	class Database
	{
		public $data = array();
		public $result = Null;

		function Database(){
			mysql_connect(DB_HOST, DB_USER, DB_PASS);
			mysql_select_db(DB_NAME);
		}
		
		function insert($name, $blood, $antennas, $legs, $home){//registration
			if(mysql_query("INSERT INTO registration values(0,'$name','$blood','$antennas','$legs',     '$home')"))
				return true;
			else
				return false;
		}
		
		function fetchAll(){
			$row = array();
			$query = 'SELECT * FROM registration';
				
			$result = mysql_query($query);
			
			$i= 0;
			while($data = mysql_fetch_array($result))
			{
				$row[$i] = $data; 
				$i++;
			}
			return $row;
		}
	}
?>