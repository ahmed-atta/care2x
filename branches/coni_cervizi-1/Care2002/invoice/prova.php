<?php

define('FPDF_FONTPATH','font/');
require('ref_radio.php');
//require('PDF_Label.php');

$pdf = new PDF_Label('L7163', 'mm', 1, 2);
//$pdf = new INVOICE( 'P', 'mm', 'A4' );
			                $pdf->Open();
			                $pdf->AddPage();
			                 $pdf->Add_PDF_Label(sprintf("%s\n%s\n%s\n%s, %s, %s", "Laurent $i", 'Immeuble Titi', 'av. fragonard', '06000', 'Nizza', 'FRANCE'));
//$pdf->Cell(190,5,"CONCLUSIONI ",$border=0,$ln=0,$align='L');			
			$pdf->Output();
?>
 