<?php
session_start();
require('../maincore.php');
require('../phptopdfapp/fpdf.php');

class PDF extends FPDF{
	function Header()
	{
	}
}

$pdf = new PDF('L','mm','Letter');
$checkStudent = dbquery("SELECT * FROM studenroll inner join student on enrol_stud_no=stud_no inner join section on enrol_section=section_name WHERE (enrol_level='12' AND section_sy='2017'  AND (enrol_status1='ENROLLED' or enrol_status1='PROMOTED')) order by enrol_section asc, stud_gender desc, stud_lname asc, stud_fname asc");
$CountStudent = dbrows($checkStudent);
while($dataStudent = dbarray($checkStudent)){
	$pdf->AddPage();
	$pdf->SetFont('Courier','B',40);
	$pdf->Cell(0,130,mb_convert_encoding($dataStudent['stud_fname']." ".($dataStudent['stud_mname']=="-"?"":substr($dataStudent['stud_mname'],0,1).".")." ".$dataStudent['stud_lname']." ".$dataStudent['stud_xname'],'ISO-8859-1', 'UTF-8'),0,1,'C');	
	$pdf->SetFont('Courier','I',30);
	$pdf->Cell(0,-105,$dataStudent['enrol_track']." - ".$dataStudent['enrol_strand'],0,0,'C');	
}
$pdf->Output();
?>
