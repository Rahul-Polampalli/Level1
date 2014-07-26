<?php
	require_once('/classes/Database.class.php');
	require_once('/lib/PHPWord.php');
	
	$db = new Database();
			
	$fileName ="Aliens-List.docx";

	if($db->fetchAll())
	{
		$data = $db->fetchAll();
	}
	else
	{
		echo "Error query failure.";
		return;
	}

	$tabHead = array(
		'Code Name' => 3000
		,'Blood Color'=> 2000
		,'No of Antennas' => 1750
		,'No of Legs' => 1750
		,'Home Planet' => 2500
	);

	// New Word Document:
	$phpword = new PHPWord();
	$phpword->addFontStyle('customStyle', array('name'=>'Calibri', 'size'=>12, 'color'=>'365F91'));
	
	$section = $phpword->createSection(array('orientation' => 'landscape'));

	//styles
	/******* Font Styles **********/
	$tableData = array('italic'=> false, 'bold' => false, 'size' => 11, 'name'=> 'Calibri', 'color' => '000000');
	$tableHead = array('italic'=> false, 'bold' => true, 'size' => 11, 'name'=> 'Calibri', 'color' => '365F91');
	$tableCaption = array('italic'=> false, 'bold' => false, 'size' => 12, 'name'=> 'Calibri', 'color' => '000000');
	
	/******* Table Styles **********/
	$lineSpacing = array('spacing'=>0, 'spaceBefore' => 50, 'spaceAfter' => 100, 'valign' => 'center');
	$tableContentRight = array_merge($lineSpacing, array('align' => 'right'));
	$tableContentCenter = array_merge($lineSpacing, array('align' => 'center'));
	$tableContentLeft = array_merge($lineSpacing, array('align' => 'left'));
	
	$phpword->addParagraphStyle('pStyle1', array('align' => 'left', 'spacing'=>0, 'spaceBefore' => 50, 'spaceAfter' => 50, 'valign' => 'center'));
	

	$styleTable = array('borderSize'=>6, 'borderColor'=>'365F91', 'cellMarginLeft'=>50);
	$tableFirstRow = array('borderBottomSize'=>8, 'borderBottomColor'=>'365F91', 'bgColor'=>'B8CCE4');
	
	$headTable = $section->addTable();
	$headTable->addRow();
	$headTable->addCell(16000)->addText('List of Aliens', $tableCaption, $tableContentCenter);
	
	$phpword->addTableStyle('tStyle1', $styleTable, $tableFirstRow);
	$table = $section->addTable('tStyle1');
	$table->addRow();
	
	foreach($tabHead as $key => $val)
	{
		$table->addCell($val,1)->addText($key, $tableHead, $tableContentLeft);
	}
	
	foreach($data as $row)
	{
		$table->addRow();
		$table->addCell(3000)->addText($row[1], $tableData, $tableContentLeft);
		$table->addCell(2000)->addText($row[2], $tableData, $tableContentLeft);
		$table->addCell(1750)->addText($row[3], $tableData, $tableContentLeft);
		$table->addCell(1750)->addText($row[4], $tableData, $tableContentLeft);
		$table->addCell(2500)->addText($row[5], $tableData, $tableContentLeft);
	}

	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($phpword, 'Word2007');
	$objWriter->save($fileName);

	// Download the file:
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . $fileName);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($fileName));
	ob_clean();
	flush();
	$status = readfile($fileName);
	unlink($fileName);
	exit;
?>