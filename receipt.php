<?php
require('./phptopdfapp/fpdf.php');

class PDF extends FPDF
{
function receiptHeader(){
	$this->Image('./assets/img/sanhs_logo.png',2,8,8);
	$this->SetFont('Arial','B',8);
	$this->Cell(0,0,'San Agustin National High School',0,0,'L');
	$this->SetFont('Arial','',8);
	$this->Ln(3);
	$this->SetLeftMargin(10);
	$this->Cell(0,0,'San Agustin, Sagbayan, Bohol',0,0,'L');
	$this->Ln(3);
	$this->SetFont('Arial','B',8);
	$this->Cell(0,0,'TEMPORARY RECEIPT',0,0,'L');
	$this->Ln(5);
	$this->SetFont('Arial','',8);
	$this->Cell(0,0,'Date:__________________',0,0,'L');	
	$this->Ln(3);
	$this->SetLeftMargin(0);
	$this->SetFont('Arial','',8);
	$this->Cell(0,0,'Name:__________________',0,0,'L');	
}

function receiptPayor(){

	
}
}


$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$pdf->SetMargins(1,1);
$pdf->receiptHeader();
$pdf->Output();
?>