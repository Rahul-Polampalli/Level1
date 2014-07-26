<?php
	require_once('classes/Database.class.php');
	require_once('classes/Export.class.php');
	
	$path = Export::exportFunction();
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$path);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($path));
	$status = readfile($path);
	unlink($path);
?>