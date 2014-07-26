<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . '/lib/tcpdf/tcpdf.php');
	require_once('Database.class.php');
	
	class Export
	{
		public $table = NULL;
		public $returnArr = NULL;
		
		public static function generateAliensPdf($arr , $structure)
		{
			try
			{
				$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Rahul Polampalli');
				$pdf->SetSubject('Aliens Data');

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// set some language-dependent strings (optional)
				if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
					require_once(dirname(__FILE__).'/lang/eng.php');
					$pdf->setLanguageArray($l);
				}

				// set default font subsetting mode
				$pdf->setFontSubsetting(true);
				
				// Set font
				$pdf->SetFont('times', '', 12, '', true);

				// Add a page
				$pdf->AddPage();

				$pdf->SetFillColor(112,138,144);
				$pdf->SetTextColor(255);
				$pdf->SetDrawColor(64, 134, 170);
				$pdf->SetLineWidth(0.3);
			 
				//width array
				$w = array(35,35,40,70,30);
				$i = 0;
				
				// Start the table
				$table = "<table>";
			 
				// The header
				$table .= "<tr>";
				
				// Take the keys from the first row as the headings
				foreach (array_keys($structure) as $heading) {
					if(!is_numeric($heading))
					{
						$table.= $pdf->Cell($w[$i], 7, $heading, 1, 0, 'C', 1);
						$i++;
					}
				}
				$table .= "</tr>";
				$cols = array_values($structure);
				$pdf->Ln();
				
				$pdf->SetTextColor(0);
				
				// Data
				$bool = false;
				foreach($arr as $row)
				{
					$i = 0;
					if($bool)
					{
						$pdf->SetFillColor(255, 255, 255);
						$bool = false;
					}
					else
					{
						$pdf->SetFillColor(248,248,248);
						$bool = true;
					}
					$table .= "<tr>";
					while($i < sizeOf($cols))
					{
						$table.= $pdf->Cell($w[$i],0, $row[$cols[$i]], 1, 0, 'L', 1);
						$i++;
					}
					$table.= $pdf->Ln();
					$table .= "</tr>";
				}
				
				$table .= '</table>';
				//ends here
				
				// set text shadow effect
				$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
			
				// Close and output PDF document
				$fileName = "Aliens-list.pdf";
				$pdf->Output($fileName, 'I');	
			}
			catch(Exception $e)
			{
				return $e->getMessage() . ", " . $e->getCode();
			}
		}
		
		public static function getAliensData()
		{
			$db = new Database();
			
			$dataArr = $db->fetchAll();
			
			$structureArr = array(
				'Code Name' => 'codename'
				,'Blood Color' => 'bloodcolor'
				,'No of Antennas' => 'antennas'
				,'No of Legs' => 'legs'
				,'Home Planet' => 'homeplanet'
			);
			return array($dataArr, $structureArr);
		}
		
		public static function exportFunction()
		{
			$arr = self::getAliensData();
			$pdfObj = self::generateAliensPdf($arr[0], $arr[1]);
			return($pdfObj);
		}
	}
?>