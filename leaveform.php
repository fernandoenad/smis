<?php
session_start();
$school_district="San Agustin NHS - Sagbayan";
$principal="NILO P. SAMPUTON";
$personnel="JUDITH APALE";
$superitendent="NIMFA D. BONGO, EdD, CESO V";

error_reporting(0);
include('includes/config.php');

$leaveid=$_GET['leaveid'];
$sql = "SELECT * FROM tblleaves INNER JOIN tblemployees ON tblleaves.empid=tblemployees.id WHERE tblleaves.id=:leaveid";
$query = $dbh -> prepare($sql);
$query->bindParam(':leaveid',$leaveid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetch(PDO::FETCH_ASSOC);
?>
<html>
	<head>
		<title>Form 6 - Leave Form</title>
	<head>
	<body>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<small>CS FORM NO. 6<br>
				Revised 1984</small><br>
			</td>
		</tr>
		<tr>
			<td align="center"><h2>APPLICATION FOR LEAVE</h2></td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="25%">1. OFFICE/DISTRICT</td>
						<td width="25%">2. NAME (LAST)</td>
						<td width="25%">(FIRST) </td>
						<td width="25%">(MIDDLE)</td>
					</tr>
					<tr>
						<td><strong><?php echo $school_district;?></strong></td>
						<td><strong><?php echo strtoupper($results['LastName']);?></strong></td>
						<td><strong><?php echo strtoupper($results['FirstName']);?></strong></td>
						<td><strong><?php echo strtoupper($results['MiddleName']);?></strong></td>
					</tr>
				</table>
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="25%">3. DATE OF FILING</td>
						<td width="25%">4. POSITION</td>
						<td colspan="2">5. SALARY (MONTHLY) </td>
					</tr>
					<tr>
						<td><strong><?php echo $results['ApplicationDate'];?></strong></td>
						<td><strong><?php echo $results['Position'];?></strong></td>
						<td colspan="2"><strong><?php echo $results['Salary'];?></strong></td>
					</tr>
				</table>
				<hr>
			</td>
		</tr>
		<tr>
			<td align="center" >
				<strong>D E T A I L S &nbsp;O F  &nbsp;A P P L I C A T I O N </strong>
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="65%" valign="top">
							6. A) TYPE OF LEAVE<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Vacation<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;To seek employment<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Other (specify) ______________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Sick<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Maternity<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Others (specify) <img src="box2.png" width="180" height="25"><br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________<br>
							C) NUMBER OF WORKING DAYS APPLIED FOR<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u><?php echo date('d',strtotime($results['ToDate'])- strtotime($results['FromDate']));?></u></strong> days<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCLUSIVE DATES <strong><u><?php echo date('M d, Y',strtotime($results['FromDate']));?> to <?php echo date('M d, Y',strtotime($results['ToDate']));?></u></strong><br>
						</td>
						<td width="35%" valign="top">
							B) WHERE LEAVE WILL BE SPENT<br>
							&nbsp;&nbsp;&nbsp;&nbsp;(1) IN CASE OF VACATION LEAVE<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Within the Philippines	<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Abroad (specify)______________________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;(2) IN CASE OF SICK LEAVE<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;In Hospital (specify) ___________________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________________________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> &nbsp;&nbsp;Out Patient (specify) ___________________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________<br>
							D) COMMUTATION<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> Requested &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20"> Not Requested<br><br>
							<center>
								_________________________________________<br>
								(Signature of Applicant)
							</center>
						</td>
					</tr>
				</table>
				<hr>
			</td>
		</tr>
		<tr>
			<td align="center">
				<strong>D E T A I L S  &nbsp;O F  &nbsp;A C T I O N  &nbsp;O N  &nbsp;A P P L I C A T I O N</strong>
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="60%" valign="top">
							7. A) CERTIFICATION OF LEAVE CREDITS<br><br>
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td>TOTAL</td>
									<td>EARNED LEAVE</td>
									<td>VL</td>
									<td>SL</td>
								</tr>
								<tr>
									<td>As of</td>
									<?php
									$eid=$results['id'];
									$sql = "SELECT SUM(SCNoOfDays) AS totalSC from tblsc where SCEmpId=:eid";
									$query2 = $dbh -> prepare($sql);
									$query2->bindParam(':eid',$eid,PDO::PARAM_STR);
									$query2->execute();
									$results2=$query2->fetch(PDO::FETCH_ASSOC);
									?>
									<td><strong><u><?php echo $results2['totalSC'];?></u></strong></td>
									<td>__________</td>
									<td>__________</td>
								</tr>
								<tr>
									<td colspan="2">TOTAL LEAVE ENJOYED:</td>
									<td>__________</td>
									<td>__________</td>
								</tr>
								<tr>
									<td colspan="2">Balance as of</td>
									<td>__________</td>
									<td>__________</td>
								</tr>
								<tr>
									<td colspan="2">Less this application</td>
									<td>__________</td>
									<td>__________</td>
								</tr>
								<tr>
									<td colspan="2">Balance as of</td>
									<td>__________</td>
									<td>__________</td>
								</tr>
							</table><br>
							<center>
								<strong><u><?php echo $personnel;?></u></strong><br>
								(Personnel Officer)
							</center>
						</td>
						<td width="40%" valign="top">
							B) RECOMMENDATION<br><br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20">&nbsp;&nbsp;Approved<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="box.png" width="20">&nbsp;&nbsp;Disapproved due to ___________________<br><br><br>
							<center>
								<strong><u><?php echo $principal;?></u></strong><br>
								(Authorized Official)
							</center>
						</td>
					</tr>
					<tr>
						<td width="50%">
							C) APPROVED FOR<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________ days with pay<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________ days without pay<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________ Other (specify)<br>
						</td>
						<td width="50%">
							D) DISAPPROVED DUE TO<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________________________________<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________________________________
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				____________________________<br>
				(Signature)<br><br>
				<strong><u><?php echo $superitendent;?></u></strong><br>
				Schools Division Superintendent<br>

			</td>
		</tr>
		<tr>
			<td>DATE: ______________<br></td>
		</tr>
		<tr>
			<td align="center"><strong>I N S T R U C T I O N S</strong><br><br>
			</td>
		</tr>
		<tr>
			<td>
				<ol>
					<li>Application for vacation or sick leave for one full day or more shall be made on this Form and to be accomplished at least in duplicate.</li>
					<li>Application for vacation leave shall be filed in advance or whenever possible five (5) days before going on such leave.</li>
					<li>Application for sick leave filed in advance, or exceeding five (5) days shall be accompanied by a medical certificate.</li>
					<li>An employee who is absent without approved leave shall not be entitled to receive his salary corresponding to the period of his unauthorized leave of absence.</li>
					<li>An application for leave of absence for thirty (30) calendar days or more shall be accompanied by a clearance from money and property accountabilities.</li>
				</ol>
			</td>
		</tr>
	</body>
</html>