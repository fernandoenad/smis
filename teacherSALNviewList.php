<?php
session_start();
require('maincore.php');
require('./phptopdfapp/fpdf.php');
// require('./phptopdfapp/wordwrap.php');

$totalRealProperties=0;
$totalPersonalProperties=0;
$totalLiabilities=0;

class PDF extends FPDF{
protected $B;
protected $I;
protected $U;
protected $HREF;
protected $fontList;
protected $issetfont;
protected $issetcolor;
	function Header()
	{
		global $current_school_division;
		global $current_school_district;
		global $current_school_region;
		global $current_school_name;
		global $current_school_address;
		
		// header
		$this->Image('./assets/images/deped_logo.png',20,15,20);
		$this->Image('./assets/images/sanhs_logo.png',170,15,20);
		$this->SetFont('Courier','',10);
		$this->Cell(0,3,"Department of Education",0,1,'C');
		$this->Cell(0,3,$current_school_region,0,1,'C');
		$this->Cell(0,3,"Division of ".$current_school_division,0,1,'C');
		$this->Cell(0,3,"District of ".$current_school_district,0,1,'C');
		$this->SetFont('','B',10);
		$this->Cell(0,3,strtoupper($current_school_name),0,1,'C');
		$this->SetFont('Courier','',10);
		$this->Cell(0,3,$current_school_address,0,1,'C');
		$this->Cell(0,3,"",0,1,'C');

		// sub header
		$this->SetFont('Courier','B',10);
		$this->Cell(0,3,"Summary of List Filers",0,1,'C');
		$this->Cell(0,3,"Statement of Assets, Liabilities, and Networth",0,1,'C');
		$this->SetFont('Courier','I',10);
		$this->Cell(0,3,"Calendar Year ".date("Y"),0,1,'C');
		$this->Cell(0,3,"",0,1,'C');
	}
	
	function WordWrap(&$text, $maxwidth)
	{
		$text = trim($text);
		if ($text==='')
			return 0;
		$space = $this->GetStringWidth(' ');
		$lines = explode("\n", $text);
		$text = '';
		$count = 0;

		foreach ($lines as $line)
		{
			$words = preg_split('/ +/', $line);
			$width = 0;

			foreach ($words as $word)
			{
				$wordwidth = $this->GetStringWidth($word);
				if ($wordwidth > $maxwidth)
				{
					// Word is too long, we cut it
					for($i=0; $i<strlen($word); $i++)
					{
						$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
						if($width + $wordwidth <= $maxwidth)
						{
							$width += $wordwidth;
							$text .= substr($word, $i, 1);
						}
						else
						{
							$width = $wordwidth;
							$text = rtrim($text)."\n".substr($word, $i, 1);
							$count++;
						}
					}
				}
				elseif($width + $wordwidth <= $maxwidth)
				{
					$width += $wordwidth + $space;
					$text .= $word.' ';
				}
				else
				{
					$width = $wordwidth + $space;
					$text = rtrim($text)."\n".$word.' ';
					$count++;
				}
			}
			$text = rtrim($text)."\n";
			$count++;
		}
		$text = rtrim($text);
		return $count;
	}

	function WriteHTML($html)
	{
		// HTML parser
		$html = str_replace("\n",' ',$html);
		$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				// Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				else
					$this->Write(4,$e);
			}
			else
			{
				// Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else
				{
					// Extract attributes
					$a2 = explode(' ',$e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}

	function OpenTag($tag, $attr)
	{
		// Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF = $attr['HREF'];
		if($tag=='p')
			$this->SetStyle($tag,true);	
		if($tag=='BR')
			$this->Ln(5);
	}

	function CloseTag($tag)
	{
		// Closing tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='p')
			$this->SetStyle($tag,true);		
		if($tag=='A')
			$this->HREF = '';
	}

	function SetStyle($tag, $enable)
	{
		// Modify style and select corresponding font
		$this->$tag += ($enable ? 1 : -1);
		$style = '';
		foreach(array('B', 'I', 'U') as $s)
		{
			if($this->$s>0)
				$style .= $s;
		}
		$this->SetFont('',$style);
	}

	function PutLink($URL, $txt)
	{
		// Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}
	
	function bifcTable($header,$checkBIFC)
	{
		$w = array(47,55,49,45);
		$this->SetFont('','B',8);
		$this->SetFillColor(220,220,220);
		for($i=0;$i<count($header);$i++){			
			$this->Cell($w[$i],5,$header[$i],1,0,'C',true);
		}
		$this->Ln();
		$counter=0;
		$this->SetFont('','',8);
		$this->SetFillColor(255,0,0);
		while($dataBIFC = dbarray($checkBIFC)){
			$dataBIFCdetails = unserialize($dataBIFC['teachSalnDet_details']);
			$this->Cell($w[0],4,$dataBIFCdetails[0],1,0,'L');
			$this->Cell($w[1],4,$dataBIFCdetails[1],1,0,'L');
			$this->Cell($w[2],4,$dataBIFCdetails[2],1,0,'L');
			$this->Cell($w[3],4,date('m-d-Y',strtotime($dataBIFCdetails[3])+8.0*3600),1,1,'L');	
			$counter++;
		}
		if($counter<4){
			while($counter<4){
				$this->Cell(47,4,"",1,0,'L');
				$this->Cell(55,4,"",1,0,'L');
				$this->Cell(49,4,"",1,0,'L');
				$this->Cell(45,4,"",1,1,'L');
				$counter++;
			}
		}
	}	
	
	function relativesTable($header,$checkRelatives)
	{
		$w = array(47,40,40,69);
		$this->SetFont('','B',8);
		$this->SetFillColor(220,220,220);
		for($i=0;$i<count($header);$i++){			
			$this->Cell($w[$i],5,$header[$i],1,0,'C',true);
		}
		$this->Ln();
		$counter=0;
		$this->SetFont('','',8);
		$this->SetFillColor(255,0,0);
		while($dataRelatives = dbarray($checkRelatives)){
			$dataRelativesdetails = unserialize($dataRelatives['teachSalnDet_details']);
			$this->Cell($w[0],4,strtoupper($dataRelativesdetails[0]),1,0,'L');
			$this->Cell($w[1],4,strtoupper($dataRelativesdetails[1]),1,0,'L');
			$this->Cell($w[2],4,strtoupper($dataRelativesdetails[2]),1,0,'L');
			$this->Cell($w[3],4,strtoupper($dataRelativesdetails[3]),1,1,'L');	
			$counter++;
		}
		if($counter<4){
			while($counter<4){
				$this->Cell(47,4,"",1,0,'L');
				$this->Cell(40,4,"",1,0,'L');
				$this->Cell(40,4,"",1,0,'L');
				$this->Cell(69,4,"",1,1,'L');
				$counter++;
			}
		}
	}
	
	function dependentsTable($header,$checkDependents)
	{
		$w = array(5,100,5,50,5,26,5);
		$this->SetFont('','B',9);
		//$this->SetFillColor(220,220,220);
		for($i=0;$i<count($header);$i++){			
			$this->Cell($w[$i],5,$header[$i],0,0,'C',false);
		}
		$this->Ln();
		$counter=0;
		$this->SetFont('','',8);
		//$this->SetFillColor(255,0,0);
		while($dataDependents = dbarray($checkDependents)){
			$this->Cell($w[0],4,"",0,0,'L');
			$this->Cell($w[1],4,mb_convert_encoding(strtoupper($dataDependents['teachCont_fname']." ".$dataDependents['teachCont_mname']." ".$dataDependents['teachCont_lname']." ".$dataDependents['teachCont_xname']),'ISO-8859-1', 'UTF-8'),'B',0,'L');
			$this->Cell($w[2],4,"",0,0,'L');
			$this->Cell($w[3],4,date('F d, Y',strtotime($dataDependents['teachCont_bdate'])+8.0*3600),'B',0,'L');
			$this->Cell($w[4],4,"",0,0,'L');
			$date1 = strtotime((date("Y")-1)."-12-31");
			$date2 = strtotime($dataDependents['teachCont_bdate']);
			$time_difference = $date1 - $date2;
			$seconds_per_year = 60*60*24*365;
			$years = (int) ($time_difference / $seconds_per_year);
			$this->Cell($w[5],4,$years,'B',0,'L');
			$this->Cell($w[6],4,"",0,1,'L');
			$counter++;
		}
		if($counter<4){
			while($counter<4){
				$this->Cell(5,4,"",0,0,'L');
				$this->Cell(100,4,"N/A",'B',0,'C');
				$this->Cell(5,4,"",0,0,'L');
				$this->Cell(50,4,"N/A",'B',0,'C');
				$this->Cell(5,4,"",0,0,'L');
				$this->Cell(26,4,"N/A",'B',0,'C');
				$this->Cell(5,4,"",0,1,'L');
				$counter++;
			}
		}
	}
	
	function realPropertiesTable($header,$checkRealProperties)
	{
		global $totalRealProperties;
		$w = array(30,23,39,23,23,12,20,25);
		$this->SetFont('','B',9);
		$this->SetFillColor(220,220,220);
		$this->Cell(30,5,"DESCRIPTION",1,0,'C',true);
		$this->Cell(23,5,"KIND",1,0,'C',true);
		$this->Cell(39,5,"LOCATION",1,0,'C',true);
		$this->SetFont('','B',6);
		$this->Cell(23,5,"ASSESSED VALUE",1,0,'C',true);
		$this->Cell(23,5,"MARKET VALUE",1,0,'C',true);
		$this->SetFont('','B',9);
		$this->Cell(12,5,"YEAR",1,0,'C',true);
		$this->Cell(20,5,"MODE",1,0,'C',true);
		$this->Cell(25,5,"COST",1,1,'C',true);
		
		$counter=0;
		$this->SetFont('','',8);
		//$this->SetFillColor(255,0,0);
		while($dataRealProperties = dbarray($checkRealProperties)){
			$realPropertiesDetails = unserialize($dataRealProperties['teachSalnDet_details']);
			$totalRealProperties = $totalRealProperties + $dataRealProperties['teachSalnDet_cost'];
			$this->Cell($w[0],4,$realPropertiesDetails[0],1,0,'L');
			$this->SetFont('','',6);
			$this->Cell($w[1],4,$realPropertiesDetails[1],1,0,'L');
			$this->SetFont('','',6);
			$this->Cell($w[2],4,$realPropertiesDetails[2],1,0,'L');
			$this->SetFont('','',8);
			$this->Cell($w[3],4,number_format($realPropertiesDetails[3],2),1,0,'R');
			$this->Cell($w[4],4,number_format($realPropertiesDetails[4],2),1,0,'R');
			$this->Cell($w[5],4,$realPropertiesDetails[5],1,0,'R');
			$this->SetFont('','',6);
			$this->Cell($w[6],4,$realPropertiesDetails[6],1,0,'L');
			$this->SetFont('','',8);
			$this->Cell($w[7],4,number_format($dataRealProperties['teachSalnDet_cost'],2),1,1,'R');			
			$counter++;
		}
		
		if($counter<4){
			while($counter<=4){
				$this->Cell(30,4,"",1,0,'C',false);
				$this->Cell(23,4,"",1,0,'C',false);
				$this->Cell(39,4,"",1,0,'C',false);
				$this->Cell(23,4,"",1,0,'C',false);
				$this->Cell(23,4,"",1,0,'C',false);
				$this->Cell(12,4,"",1,0,'C',false);
				$this->Cell(20,4,"",1,0,'C',false);
				$this->Cell(25,4,"",1,1,'C',false);
				$counter++;
			}
		}
	}
	
	function personalPropertiesTable($header,$checkPersonalProperties)
	{
		global $totalPersonalProperties;
		$w = array(125,30,40);
		$this->SetFont('','B',9);
		$this->SetFillColor(220,220,220);
		$this->Cell(125,5,"DESCRIPTION",1,0,'C',true);
		$this->Cell(30,5,"YEAR ACQUIRED",1,0,'C',true);
		$this->Cell(40,5,"COST",1,1,'C',true);

		
		$counter=0;
		$this->SetFont('','',8);
		//$this->SetFillColor(255,0,0);
		while($dataPersonalProperties = dbarray($checkPersonalProperties)){
			$PersonalPropertiesDetails = unserialize($dataPersonalProperties['teachSalnDet_details']);
			$totalPersonalProperties = $totalPersonalProperties + $dataPersonalProperties['teachSalnDet_cost'];
			$this->Cell($w[0],4,$PersonalPropertiesDetails[0],1,0,'L');
			$this->Cell($w[1],4,$PersonalPropertiesDetails[1],1,0,'R');
			$this->Cell($w[2],4,number_format($dataPersonalProperties['teachSalnDet_cost'],2),1,1,'R');			
			$counter++;
		}
		
		if($counter<4){
			while($counter<=4){
				$this->Cell(125,4,"",1,0,'C',false);
				$this->Cell(30,4,"",1,0,'C',false);
				$this->Cell(40,4,"",1,1,'C',false);
				$counter++;
			}
		}
	}
	
	function liabilitiesTable($header,$checkLiabilities)
	{
		global $totalLiabilities;
		$w = array(55,100,40);
		$this->SetFont('','B',9);
		$this->SetFillColor(220,220,220);
		$this->Cell(55,5,"NATURE",1,0,'C',true);
		$this->Cell(100,5,"NAME OF CREDITORS",1,0,'C',true);
		$this->Cell(40,5,"OUTSTANDING BALANCE",1,1,'C',true);

		
		$counter=0;
		$this->SetFont('','',8);
		//$this->SetFillColor(255,0,0);
		while($dataLiabilities = dbarray($checkLiabilities)){
			$LiabilitiesProperties = unserialize($dataLiabilities['teachSalnDet_details']);
			$totalLiabilities = $totalLiabilities + $dataLiabilities['teachSalnDet_cost'];
			$this->Cell($w[0],4,$LiabilitiesProperties[0],1,0,'L');
			$this->Cell($w[1],4,$LiabilitiesProperties[1],1,0,'L');
			$this->Cell($w[2],4,number_format($dataLiabilities['teachSalnDet_cost'],2),1,1,'R');			
			$counter++;
		}
		
		if($counter<4){
			while($counter<=4){
				$this->Cell(55,4,"",1,0,'C',false);
				$this->Cell(100,4,"",1,0,'C',false);
				$this->Cell(40,4,"",1,1,'C',false);
				$counter++;
			}
		}
	}
}



//create a FPDF object
$pdf = new PDF('P','mm','Legal');
$pdf->SetTopMargin(15);


//set document properties
$pdf->SetAuthor('Fernando B. Enad');
$pdf->SetTitle('SALN List');

//set font for the entire document
$pdf->SetFont('Courier','',8);
$pdf->SetTextColor(50,60,100);

//first page
$pdf->AddPage(); 
//$pdf->SetDisplayMode(real,'default');


// table header
$pdf->SetFont('Courier','B',10);
$pdf->SetFillColor(220,220,220);
$pdf->Cell(10,5,"#",1,0,'C',true);
$pdf->Cell(30,5,"Lastname",1,0,'C',true);
$pdf->Cell(30,5,"Firstname",1,0,'C',true);
$pdf->Cell(30,5,"Middlename",1,0,'C',true);
$pdf->Cell(30,5,"TIN",1,0,'C',true);
$pdf->Cell(30,5,"POSITION",1,0,'C',true);
$pdf->Cell(30,5,"NET WORTH",1,1,'C',true);

// table contents
$i=1;
$countSALN=0;
$checkSALN = dbquery("select * from teacher where teach_status='1' order by teach_lname asc, teach_fname asc");
while ($dataSALN = dbarray($checkSALN)){
	$checkSALN2 = dbquery("select * from teachsaln where (teachSaln_teach_no='".$dataSALN['teach_no']."' and teachSaln_issueyear='".$_GET['year']."' and teachSaln_status='3')");
	$countSALN2 = dbrows($checkSALN2);
	$dataSALN2 = dbarray($checkSALN2);
	$dataSALN2 = (isset($dataSALN2) ? $dataSALN2 : array("teachSaln_status"=>""));
	$countSALN = $countSALN+($countSALN2==0?0:$countSALN2);
	$pdf->SetFont('Courier','',9);
	$pdf->Cell(10,3.5,$i,1,0,'R');
	$pdf->Cell(30,3.5,mb_convert_encoding(strtoupper($dataSALN['teach_lname']),'ISO-8859-1', 'UTF-8'),1,0,'L');
	$pdf->Cell(30,3.5,mb_convert_encoding(strtoupper($dataSALN['teach_fname']." ".$dataSALN['teach_xname']),'ISO-8859-1', 'UTF-8'),1,0,'L');
	$pdf->Cell(30,3.5,mb_convert_encoding(strtoupper($dataSALN['teach_mname']),'ISO-8859-1', 'UTF-8'),1,0,'L');
	$pdf->Cell(30,3.5,$dataSALN['teach_tin'],1,0,'C');
	$checkSALN3 = dbquery("select * from  teacherappointments where (teacherappointments_teach_no='".$dataSALN['teach_no']."' and teacherappointments_active='1')");
	$dataSALN3 = dbarray($checkSALN3);
	$dataSALN3 = (isset($dataSALN3) ? $dataSALN3 : array("teacherappointments_position"=>""));
	$pdf->Cell(30,3.5,$dataSALN3['teacherappointments_position'],1,0,'C');
	$pdf->Cell(30,3.5,($dataSALN2['teachSaln_status']==3?number_format($dataSALN2['teachSaln_networth'],2):"-"),1,1,'R');
	$i++;
}
$pdf->Cell(0,3,"",0,1,'C');

// table end		
$pdf->Cell(10,4,"",0,0,'C');
$pdf->Cell(50,4,"Total Number of Filers:",0,0,'C');
$pdf->Cell(25,4,$countSALN,'B',1,'C');
$pdf->Cell(10,4,"",0,0,'C');
$pdf->Cell(75,4,"Total Number of Personnel Complement:",0,0,'C');
$pdf->Cell(25,4,$i-1,'B',1,'C');
$pdf->Cell(0,3,"",0,1,'C');

// footer
$pdf->Cell(10,8,"",'',0,'C');
$pdf->Cell(70,8,"",'B',0,'C');
$pdf->Cell(30,8,"",'',0,'C');
$pdf->Cell(70,8,"",'B',0,'C');
$pdf->Cell(10,8,"",'',1,'C');

$pdf->Cell(10,4,"",'',0,'C');
$pdf->Cell(70,4,"Person In-charge of SALN",'',0,'C');
$pdf->Cell(30,4,"",'',0,'C');
$pdf->Cell(70,4,"Head of Agency",'',0,'C');
$pdf->Cell(10,4,"",'',1,'C');
$pdf->Cell(0,3,"",0,1,'C');

$pdf->Cell(10,4,"",'',0,'L');
$pdf->Cell(30,4,"Position:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(30,4,"",'',0,'L');
$pdf->Cell(30,4,"Position:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(10,4,"",'',1,'L');

$pdf->Cell(10,4,"",'',0,'L');
$pdf->Cell(30,4,"Email Address:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(30,4,"",'',0,'L');
$pdf->Cell(30,4,"Email Address:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(10,4,"",'',1,'L');

$pdf->Cell(10,4,"",'',0,'L');
$pdf->Cell(30,4,"Contact No.:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(30,4,"",'',0,'L');
$pdf->Cell(30,4,"Contact No.:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(10,4,"",'',1,'L');
$pdf->Cell(0,3,"",0,1,'C');

$pdf->Cell(10,4,"",'',0,'L');
$pdf->Cell(30,4,"Date:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(30,4,"",'',0,'L');
$pdf->Cell(30,4,"Date:",'',0,'L');
$pdf->Cell(40,4,"",'B',0,'L');
$pdf->Cell(10,4,"",'',1,'L');

//second page
$pdf->AddPage(); 
//$pdf->SetDisplayMode(real,'default');
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(15);

$pdf->SetFont('Courier','B',20);
$pdf->Cell(0,15," C E R T I F I C A T I O N 	",'',1,'C');

$pdf->Cell(0,3,"",0,1,'C');
$pdf->Cell(0,3,"",0,1,'C');
$pdf->SetFont('Courier','',12);
$text = "        This is to certify that the SALNs submitted/ included in the Summary List of Filers were reviewed and found compliant by the Review and Compliance Committee of this Office.<br><br>        Further, the review were made in accordance with the review and compliance procedure in filing and submission of SALNs pursuant to CSC Memorandum Circular No. 10, s. 2006 (as amended by CSC Resolution No. 1300455 promulgated on March 04, 2013).<br><br>        Issued on _____________, ________.";
$pdf->WriteHTML($text);
$pdf->Cell(0,30,"",'',1,'C');


$pdf->Cell(55,4,"",'',0,'C');
$pdf->Cell(75,4,"Name and Signature",'T',0,'C');
$pdf->Cell(55,4,"",'',1,'C');

$pdf->Cell(0,4,"Chairperson",'',1,'C');
$pdf->Cell(0,20,"",'',1,'C');

$pdf->Cell(75,4,"Name and Signature",'T',0,'C');
$pdf->Cell(35,4,"",'',0,'C');
$pdf->Cell(75,4,"Name and Signature",'T',1,'C');

$pdf->Cell(75,4,"Member",'',0,'C');
$pdf->Cell(35,4,"",'',0,'C');
$pdf->Cell(75,4,"Member",'',1,'C');

$pdf->Output();
//$pdf->Output('saln.pdf','D');
?>
