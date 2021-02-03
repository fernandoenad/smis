<?php
session_start();
require_once("maincore.php");
require_once("phptopdfapp/code128.php");

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
		while($dataBIFC = $checkBIFC->fetch_assoc()){
			$dataBIFCdetails = unserialize($dataBIFC['teachSalnDet_details']);
			$this->Cell($w[0],4,strtoupper($dataBIFCdetails[0]),1,0,'L');
			$this->Cell($w[1],4,strtoupper($dataBIFCdetails[1]),1,0,'L');
			$this->Cell($w[2],4,strtoupper($dataBIFCdetails[2]),1,0,'L');
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
		while($dataRelatives = $checkRelatives->fetch_assoc()){
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
	
	function dependentsTable($header,$checkDependents,$teachSaln_no)
	{
		global $conn;
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
		$checkSALNdet = $conn->query("select * from teachsaln where teachSaln_no='".$teachSaln_no."'");
		$dataSALN = $checkSALNdet->fetch_assoc();
		while($dataDependents = $checkDependents->fetch_assoc()){
			$this->Cell($w[0],4,"",0,0,'L');
			$this->Cell($w[1],4,mb_convert_encoding(strtoupper($dataDependents['teachCont_fname']." ".$dataDependents['teachCont_mname']." ".$dataDependents['teachCont_lname']." ".$dataDependents['teachCont_xname']),'ISO-8859-1', 'UTF-8'),'B',0,'L');
			$this->Cell($w[2],4,"",0,0,'L');
			$this->Cell($w[3],4,date('F d, Y',strtotime($dataDependents['teachCont_bdate'])+8.0*3600),'B',0,'L');
			$this->Cell($w[4],4,"",0,0,'L');
			$date1 = strtotime(($dataSALN['teachSaln_issueyear'])."-12-31");
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
		while($dataRealProperties = $checkRealProperties->fetch_assoc()){
			$realPropertiesDetails = unserialize($dataRealProperties['teachSalnDet_details']);
			$totalRealProperties = $totalRealProperties + $dataRealProperties['teachSalnDet_cost'];
			$this->Cell($w[0],4,strtoupper($realPropertiesDetails[0]),1,0,'L');
			$this->SetFont('','',6);
			$this->Cell($w[1],4,strtoupper($realPropertiesDetails[1]),1,0,'L');
			$this->SetFont('','',6);
			$this->Cell($w[2],4,strtoupper($realPropertiesDetails[2]),1,0,'L');
			$this->SetFont('','',8);
			$this->Cell($w[3],4,number_format($realPropertiesDetails[3],2),1,0,'R');
			$this->Cell($w[4],4,number_format($realPropertiesDetails[4],2),1,0,'R');
			$this->Cell($w[5],4,strtoupper($realPropertiesDetails[5]),1,0,'R');
			$this->SetFont('','',6);
			$this->Cell($w[6],4,strtoupper($realPropertiesDetails[6]),1,0,'L');
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
		while($dataPersonalProperties = $checkPersonalProperties->fetch_assoc()){
			if(isset($dataPersonalProperties['teachSalnDet_details'])){
				$PersonalPropertiesDetails = unserialize($dataPersonalProperties['teachSalnDet_details']);
				$totalPersonalProperties = $totalPersonalProperties + $dataPersonalProperties['teachSalnDet_cost'];
				$this->Cell($w[0],4,strtoupper($PersonalPropertiesDetails[0]),1,0,'L');
				$this->Cell($w[1],4,strtoupper($PersonalPropertiesDetails[1]),1,0,'R');
				$this->Cell($w[2],4,number_format($dataPersonalProperties['teachSalnDet_cost'],2),1,1,'R');			
				$counter++;
			}
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
		while($dataLiabilities = $checkLiabilities->fetch_assoc()){
			$LiabilitiesProperties = unserialize($dataLiabilities['teachSalnDet_details']);
			$totalLiabilities = $totalLiabilities + $dataLiabilities['teachSalnDet_cost'];
			$this->Cell($w[0],4,strtoupper($LiabilitiesProperties[0]),1,0,'L');
			$this->Cell($w[1],4,strtoupper($LiabilitiesProperties[1]),1,0,'L');
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
$pdf = new PDF('P','mm','Letter');

//set document properties
$pdf->SetAuthor('Fernando B. Enad');
$pdf->SetTitle('SALN - Statement of Assets, Liabilities, and Net Worth');

//set font for the entire document
$pdf->SetFont('Courier','B',12);
$pdf->SetTextColor(50,60,100);

//set up a page
$pdf->AddPage(); 
//$pdf->SetDisplayMode(fullpage,'default');


$pdf->SetFont('','',6);
$pdf->Cell(155,2,"",0,0,'R');
$pdf->Cell(0,2,"Revised as of January 2015",0,1,'L');
$pdf->Cell(155,2,"",0,0,'R');
$pdf->Cell(0,2,"Per CSC Resolution No. 1500088",0,1,'L');
$pdf->Cell(155,2,"",0,0,'R');
$pdf->Cell(0,2,"Promulgated on January 23, 2015",0,1,'L');

$pdf->Cell(0,2,"",0,1,'R');

$pdf->SetFont('','B',12);
$pdf->Cell(0,5,"SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH",0,1,'C');

$pdf->SetFont('','',10);
$checkSALN = $conn->query("select * from teachsaln where teachSaln_no='".$_GET['teachSaln_no']."'");
$dataSALN = $checkSALN->fetch_assoc();
$pdf->Cell(0,3,"As of December 31, ".($dataSALN['teachSaln_issueyear']),0,1,'C');

$pdf->SetFont('','',8);
$pdf->Cell(0,3,"(Required by R.A. 6713)",0,1,'C');

$pdf->SetFont('','I',6);
$pdf->Cell(0,3,"",0,1,'C');
$pdf->Cell(0,3,"Note: Husband and wife who are both public officials and employees may file the required statements jointly or separately.",0,1,'C');

$checkSALN = $conn->query("select * from teachsaln inner join teacher on teachSaln_teach_no=teach_no where teachSaln_no='".$_GET['teachSaln_no']."'");
$dataSALN = $checkSALN->fetch_assoc();
$pdf->SetFont('','IB',8);
$pdf->Cell(30,3,"",0,0,'L');
$pdf->Cell(45,3,($dataSALN['teachSaln_filetype']==1?"[X]":"[ ]")." Joint Filing",0,0,'C');
$pdf->Cell(45,3,($dataSALN['teachSaln_filetype']==2?"[X]":"[ ]")." Separate Filing",0,0,'C');
$pdf->Cell(45,3,($dataSALN['teachSaln_filetype']==3?"[X]":"[ ]")." Not Applicable",0,0,'C');
$pdf->Cell(30,3,"",0,1,'L');


$pdf->Cell(0,4,"",0,1,'C');
$pdf->SetFont('','B',8);
$pdf->Cell(25,4,"DECLARANT:",0,0,'L');
$pdf->SetFont('','B',10);
$pdf->Cell(30,4,strtoupper($dataSALN['teach_lname']),'B',0,'L');
$pdf->Cell(30,4,strtoupper($dataSALN['teach_fname'])." ".strtoupper($dataSALN['teach_xname']),'B',0,'L');
$pdf->Cell(10,4,strtoupper(($dataSALN['teach_mname']==""?"":substr($dataSALN['teach_mname'],0,1).".")),'B',0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(8,4,"",0,0,'L');
$checkPosition = $conn->query("select * from teacherappointments inner join dropdowns on teacherappointments_position=field_name where (teacherappointments_teach_no='".$dataSALN['teach_no']."' and teacherappointments_active='1')");
$dataPosition = $checkPosition->fetch_assoc();
$pdf->Cell(30,4,"POSITION:",0,0,'L');
$pdf->Cell(63,4,strtoupper(substr($dataPosition['field_ext'],2)),'B',1,'L');

$pdf->SetFont('','I',6);
$pdf->Cell(25,4,"",0,0,'L');
$pdf->Cell(30,4,"Family Name",0,0,'L');
$pdf->Cell(30,4,"First Name",0,0,'L');
$pdf->Cell(10,4,"M.I.",0,0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"AGENCY/OFFICE:",0,0,'L');
$pdf->Cell(63,4,strtoupper($current_school_name),'B',1,'L');

$pdf->SetFont('','B',8);
$pdf->Cell(25,4,"ADDRESS:",0,0,'L');
$pdf->Cell(70,4,strtoupper($dataSALN['teach_residence']),'B',0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"OFFICE ADDRESS:",0,0,'L');
$pdf->Cell(63,4,strtoupper($current_school_address),'B',1,'L');

$pdf->SetFont('','B',8);
$pdf->Cell(25,4,"",0,0,'L');
$pdf->Cell(70,4,"",'B',0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"",0,0,'L');
$pdf->Cell(63,4,"",'B',1,'L');

$checkSpouse = $conn->query("select * from teachercontacts where (teachCont_teach_no='".$dataSALN['teach_no']."' and teachCont_type='1')");
$dataSpouse = $checkSpouse->fetch_assoc();
$dataSpouse = (isset($dataSpouse) ? $dataSpouse : array(
	"teachCont_lname"=>"",
	"teachCont_fname"=>"",
	"teachCont_mname"=>"",
	"teachCont_position"=>"",
	"teachCont_office"=>"",
	"teachCont_offadd"=>"",
	"teachCont_xname"=>"",
	"teachCont_govid"=>"",
	"teachCont_idno"=>"",
	"teachCont_issuedate"=>""
	
));
$pdf->Cell(0,4,"",0,1,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(25,4,"SPOUSE:",0,0,'L');
$pdf->SetFont('','B',10);
$pdf->Cell(30,4,strtoupper(($dataSpouse['teachCont_lname']==""?"N/A":$dataSpouse['teachCont_lname'])),'B',0,'L');
$pdf->Cell(30,4,strtoupper($dataSpouse['teachCont_fname'])." ".strtoupper($dataSpouse['teachCont_xname']),'B',0,'L');
$pdf->Cell(10,4,strtoupper(($dataSpouse['teachCont_mname']==""?"":substr($dataSpouse['teachCont_mname'],0,1).".")),'B',0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"POSITION:",0,0,'L');
$pdf->Cell(63,4,strtoupper(($dataSpouse['teachCont_position']==""?"N/A":$dataSpouse['teachCont_position'])),'B',1,'L');

$pdf->SetFont('','I',6);
$pdf->Cell(25,4,"",0,0,'L');
$pdf->Cell(30,4,"Family Name",0,0,'L');
$pdf->Cell(30,4,"First Name",0,0,'L');
$pdf->Cell(10,4,"M.I.",0,0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"AGENCY/OFFICE:",0,0,'L');
$pdf->Cell(63,4,strtoupper(($dataSpouse['teachCont_office']==""?"N/A":$dataSpouse['teachCont_office'])),'B',1,'L');

$pdf->SetFont('','I',8);
$pdf->Cell(25,4,"",0,0,'L');
$pdf->Cell(70,4,"",0,0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"OFFICE ADDRESS:",0,0,'L');
$pdf->Cell(63,4,strtoupper(($dataSpouse['teachCont_offadd']==""?"N/A":$dataSpouse['teachCont_offadd'])),'B',1,'L');

$pdf->SetFont('','I',8);
$pdf->Cell(25,4,"",0,0,'L');
$pdf->Cell(70,4,"",0,0,'L');
$pdf->Cell(8,4,"",0,0,'L');
$pdf->SetFont('','B',8);
$pdf->Cell(30,4,"",0,0,'L');
$pdf->Cell(63,4,"",'B',1,'L');

$pdf->Cell(0,3,"",'B',1,'L');

$pdf->Cell(0,3,"",0,1,'L');

$pdf->SetFont('','BU',10);
$pdf->Cell(0,4,"UNMARRIED CHILDREN BELOW EIGHTEEN (18) YEARS OF AGE LIVING IN DECLARANT'S  HOUSEHOLD",'',1,'C');
$pdf->Cell(0,3,"",0,1,'L');

$dateLimit = ($dataSALN['teachSaln_issueyear']-18)."-01-01";
$teachSaln_no=$dataSALN['teachSaln_no'];
$checkDependents = $conn->query("select * from teachercontacts where (teachCont_teach_no='".$dataSALN['teach_no']."' and teachCont_type='2' and 	teachCont_bdate>='".$dateLimit."')");
$header = array('', 'NAME', '', 'DATE OF BIRTH', '', 'AGE','');
$pdf->dependentsTable($header,$checkDependents,$teachSaln_no);

$pdf->Cell(0,3,"",'B',1,'L');

$pdf->Cell(0,3,"",0,1,'L');

$pdf->SetFont('','BU',10);
$pdf->Cell(0,4,"ASSETS, LIABILITIES AND NETWORTH",'',1,'C');

$pdf->SetFont('','I',8);
$pdf->Cell(0,4,"(Including those of the spouse and unmarried children below eighteen (18)",'',1,'C');

$pdf->Cell(0,2,"years of age living in declarant's household)",'',1,'C');

$pdf->SetFont('','B',9);
$pdf->Cell(0,4,"1. ASSETS",0,1,'L');

$pdf->Cell(5,4,"",0,0,'L');
$pdf->Cell(0,8,"a. Real Properties*",0,1,'L');

$checkRealProperties = $conn->query("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['teachSaln_no']."' and teachSalnDet_type='1')");
$header = array('', '', '', '', '', '', '', '', '');
$pdf->SetFont('','',8);
$pdf->realPropertiesTable($header,$checkRealProperties);

$pdf->SetFont('','B',10);
$pdf->Cell(160,4,"Subtotal:",0,0,'R');
$pdf->Cell(35,4,number_format($totalRealProperties,2),'B',1,'R');

$pdf->SetFont('','B',9);
$pdf->Cell(5,4,"",0,0,'L');
$pdf->Cell(0,8,"b. Personal Properties*",0,1,'L');

$checkPersonalProperties = $conn->query("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['teachSaln_no']."' and teachSalnDet_type='2')");
$header = array('', '', '');
$pdf->SetFont('','',8);
$pdf->personalPropertiesTable($header,$checkPersonalProperties);

$pdf->SetFont('','B',10);
$pdf->Cell(160,4,"Subtotal:",0,0,'R');
$pdf->Cell(35,4,number_format($totalPersonalProperties,2),'B',1,'R');

$pdf->Cell(0,4,"",0,1,'R');

$pdf->SetFont('','B',10);
$pdf->Cell(160,4,"TOTAL ASSETS (a+b):",0,0,'R');
$pdf->Cell(35,4,number_format($totalRealProperties+$totalPersonalProperties,2),'B',1,'R');

$pdf->SetFont('','B',9);
$pdf->Cell(0,8,"2. LIABILITIES* ",0,1,'L');
$checkLiabilities = $conn->query("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['teachSaln_no']."' and teachSalnDet_type='3')");
$header = array('', '', '');
$pdf->SetFont('','',8);
$pdf->liabilitiesTable($header,$checkLiabilities);

$pdf->SetFont('','B',10);
$pdf->Cell(160,4,"TOTAL LIABILITIES:",0,0,'R');
$pdf->Cell(35,4,number_format($totalLiabilities,2),'B',1,'R');

$pdf->Cell(0,4,"",0,1,'R');

$pdf->SetFont('','B',11);
$pdf->Cell(160,4,"NET WORTH : Total Assets less Total Liabilities =",0,0,'R');
$pdf->Cell(35,4,number_format(($totalRealProperties+$totalPersonalProperties)-$totalLiabilities,2),'B',1,'R');
// $pdf->AddPage('P'); 

$pdf->ln(8);

$pdf->SetFont('','BU',10);
$pdf->Cell(0,4,"BUSINESS INTERESTS AND FINANCIAL CONNECTIONS",0,1,'C');

$checkBIFC = $conn->query("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['teachSaln_no']."' and teachSalnDet_type='4')");
$countBIFC = $checkBIFC->num_rows;
$pdf->SetFont('','',7);
$pdf->Cell(0,4,"(of Declarant /Declarant�s spouse/ Unmarried Children Below Eighteen (18) years of Age Living in Declarant's Household)",0,1,'C');

$pdf->SetFont('','I',9);
$pdf->Cell(0,2,"[".($countBIFC<1?"X":" ")."] I/We do not have any business interest or financial connection.",'',1,'C');

$pdf->Cell(0,2,"",0,1,'C');

$pdf->SetFont('','',8);
$header = array('NAME OF ENTITY', 'BUSINESS ADDRESS', 'NATURE OF BUSINESS INTEREST', 'DATE OF ACQUISITION');
$pdf->bifcTable($header,$checkBIFC);

$pdf->Cell(0,3,"",'B',1,'L');

$pdf->Cell(0,3,"",0,1,'L');

$pdf->SetFont('','BU',10);
$pdf->Cell(0,4,"RELATIVES IN THE GOVERNMENT SERVICE",0,1,'C');

$checkRelatives = $conn->query("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['teachSaln_no']."' and teachSalnDet_type='5')");
$countRelatives = $checkRelatives->num_rows;
$pdf->SetFont('','I',8);
$pdf->Cell(0,4,"(Within the Fourth Degree of Consanguinity or Affinity. Include also Bilas, Balae and Inso)",0,1,'C');

$pdf->SetFont('','I',9);
$pdf->Cell(0,2,"[".($countRelatives<1?"X":" ")."] I/We do not know of any relative/s in the government service)",'',1,'C');

$pdf->Cell(0,2,"",0,1,'C');

$pdf->SetFont('','',8);
$header = array('NAME OF RELATIVE', 'RELATIONSHIP', 'POSITION', 'AGENCY/ADDRESS');
$pdf->relativesTable($header,$checkRelatives);

$pdf->Cell(0,3,"",0,1,'L');

$pdf->SetFont('','',8);
$html='        I hereby certify that these are true and correct statements of my assets, liabilities, net worth, business interests and financial connections, including those of my spouse and unmarried children below eighteen (18) years of age living in my household, and that to the best of my knowledge, the above-enumerated are names of my relatives in the government within the fourth civil degree of consanguinity or affinity.';
$pdf->WriteHTML($html);
$html='<br>        I hereby authorize the Ombudsman or his/her duly authorized representative to obtain and secure from all appropriate government agencies, including the Bureau of Internal Revenue such documents that may show my assets, liabilities, net worth, business interests and financial connections, to include those of my spouse and unmarried children below 18 years of age living with me in my household covering previous years to include the year I first assumed office in government.';
$pdf->WriteHTML($html);

$pdf->Cell(0,10,"",0,1,'L');
$pdf->Cell(12,3,"Date:",0,0,'L');
$pdf->SetFont('','U',9);
$pdf->Cell(0,3,date("F d, Y"),0,1,'L');

$pdf->Cell(0,10,"",0,1,'L');

$pdf->Cell(80,4,"",'B',0,'L');
$pdf->Cell(35,4,"",0,0,'L');
$pdf->Cell(80,4,"",'B',1,'L');

$pdf->SetFont('','I',8);
$pdf->Cell(80,4,"(Signature of Declarant)",0,0,'C');
$pdf->Cell(35,4,"",0,0,'L');
$pdf->Cell(80,4,"(Signature of Co-Declarant/Spouse)",0,1,'C');

$pdf->Cell(0,4,"",0,1,'L');

$checkTeacherID = $conn->query("select * from teacherids where teacherids_teach_no='".$dataSALN['teach_no']."'");
$dataTeacherID = $checkTeacherID->fetch_assoc();
$pdf->SetFont('','',8);
$pdf->Cell(40,4,"Government Issued ID:",0,0,'L');
$pdf->Cell(40,4,strtoupper(isset($dataTeacherID['teacherids_id'])? $dataTeacherID['teacherids_id'] : ""),'B',0,'L');
$pdf->Cell(35,4,"",0,0,'L');
$pdf->Cell(40,4,"Government Issued ID:",0,0,'L');
$pdf->Cell(40,4,strtoupper($dataSpouse['teachCont_govid']),'B',1,'L');

$pdf->Cell(40,4,"ID No.:",0,0,'L');
$pdf->Cell(40,4,strtoupper(isset($dataTeacherID['teacherids_details']) ? $dataTeacherID['teacherids_details'] : ""),'B',0,'L');
$pdf->Cell(35,4,"",0,0,'L');
$pdf->Cell(40,4,"ID No.",0,0,'L');
$pdf->Cell(40,4,strtoupper($dataSpouse['teachCont_idno']),'B',1,'L');

$pdf->Cell(40,4,"Date Issued:",0,0,'L');
$pdf->Cell(40,4,(isset($dataTeacherID['teacherids_date_issued'])?date('m-d-Y',strtotime($dataTeacherID['teacherids_date_issued'])+8.0*3600) : ""),'B',0,'L');
$pdf->Cell(35,4,"",0,0,'L');
$pdf->Cell(40,4,"Date Issued:",0,0,'L');
$pdf->Cell(40,4,($dataSpouse['teachCont_issuedate']=="" || $dataSpouse['teachCont_issuedate']=="0000-00-00" || $dataSpouse['teachCont_issuedate']=="0001-01-01"?"":date('m-d-Y',strtotime($dataSpouse['teachCont_issuedate'])+8.0*3600)),'B',1,'L');

$pdf->SetFont('','',9);
$pdf->Cell(0,5,"",0,1,'L');

$html='        <b>SUBSCRIBED AND SWORN</b> to before me this ___ day of <b>'.date('F Y').'</b>, affiant exhibiting to me the above-stated government issued identification card.';
$pdf->WriteHTML($html);

$pdf->Cell(0,20,"",0,1,'L');

$pdf->Cell(40,4,"",0,0,'L');
$pdf->Cell(40,4,"",0,0,'L');
$pdf->Cell(45,4,"",0,0,'L');
$pdf->SetFont('','B',12);
$pdf->Cell(70,4,"",0,1,'C');

$pdf->Cell(40,6,"",0,0,'L');
$pdf->Cell(40,6,"",0,0,'L');
$pdf->Cell(45,6,"",0,0,'L');
$pdf->SetFont('','B',10);
$pdf->Cell(70,6,"",'B',1,'C');

$pdf->SetFont('','I',9);
$pdf->Cell(40,4,"",0,0,'L');
$pdf->Cell(40,4,"",0,0,'L');
$pdf->Cell(45,4,"",0,0,'L');
$pdf->Cell(70,4,"(Person Administering Oath)",0,1,'C');


$pdf->Output();
//$pdf->Output('saln.pdf','D');
?>
