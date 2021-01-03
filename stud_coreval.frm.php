<?php
require('maincore.php');

if(isset($_GET['Save']) && $_GET['Save']=="Yes"){
	$coreval_q1 = array($_POST['coreval_q1_1'],$_POST['coreval_q1_2'],$_POST['coreval_q1_3'],$_POST['coreval_q1_4']);
	$coreval_q1_string = serialize($coreval_q1);
	$coreval_q2 = array($_POST['coreval_q2_1'],$_POST['coreval_q2_2'],$_POST['coreval_q2_3'],$_POST['coreval_q2_4']);
	$coreval_q2_string = serialize($coreval_q2);
	$coreval_q3 = array($_POST['coreval_q3_1'],$_POST['coreval_q3_2'],$_POST['coreval_q3_3'],$_POST['coreval_q3_4']);
	$coreval_q3_string = serialize($coreval_q3);
	$coreval_q4 = array($_POST['coreval_q4_1'],$_POST['coreval_q4_2'],$_POST['coreval_q4_3'],$_POST['coreval_q4_4']);
	$coreval_q4_string = serialize($coreval_q4);
	$coreval_q5 = array($_POST['coreval_q5_1'],$_POST['coreval_q5_2'],$_POST['coreval_q5_3'],$_POST['coreval_q5_4']);
	$coreval_q5_string = serialize($coreval_q5);
	$coreval_q6 = array($_POST['coreval_q6_1'],$_POST['coreval_q6_2'],$_POST['coreval_q6_3'],$_POST['coreval_q6_4']);
	$coreval_q6_string = serialize($coreval_q6);
	$coreval_q7 = array($_POST['coreval_q7_1'],$_POST['coreval_q7_2'],$_POST['coreval_q7_3'],$_POST['coreval_q7_4']);
	$coreval_q7_string = serialize($coreval_q7);
	$updateEntry=dbquery("update student_corevalues set coreval_q1='".$coreval_q1_string."', coreval_q2='".$coreval_q2_string."', coreval_q3='".$coreval_q3_string."', coreval_q4='".$coreval_q4_string."', coreval_q5='".$coreval_q5_string."', coreval_q6='".$coreval_q6_string."', coreval_q7='".$coreval_q7_string."' where coreval_no='".$_POST['coreval_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$checkStudent = dbquery("select * from student where stud_no='".$_GET['stud_no']."'");
$dataStudent =dbarray($checkStudent);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	input {
    width: 35px;
	height: 23px;
	font-size:10px;
	text-align: center;
	}
	input[type=date] {
    width: 130px;
    height: 23px;
	}

	</style>
</head>	
<body>
<?php
if(isset($_GET['stud_no']) && isset($_GET['enrol_sy'])){
	$checkEntry = dbquery("select * from student_corevalues where (coreval_stud_no='".$_GET['stud_no']."' and coreval_enrol_sy='".$_GET['enrol_sy']."')");
	$countEntry = dbrows($checkEntry);

	if($countEntry==0){
		$coreval_q1 = array('','','','');
		$coreval_q1_string = serialize($coreval_q1);
		$coreval_q2 = array('','','','');
		$coreval_q2_string = serialize($coreval_q2);
		$coreval_q3 = array('','','','');
		$coreval_q3_string = serialize($coreval_q3);
		$coreval_q4 = array('','','','');
		$coreval_q4_string = serialize($coreval_q4);
		$coreval_q5 = array('','','','');
		$coreval_q5_string = serialize($coreval_q5);
		$coreval_q6 = array('','','','');
		$coreval_q6_string = serialize($coreval_q6);
		$coreval_q7 = array('','','','');
		$coreval_q7_string = serialize($coreval_q7);
		$insertEntry=dbquery("insert into student_corevalues (coreval_no, coreval_stud_no, coreval_enrol_sy, coreval_q1, coreval_q2, coreval_q3, coreval_q4, coreval_q5, coreval_q6, coreval_q7) values ('','".$_GET['stud_no']."','".$_GET['enrol_sy']."','".$coreval_q1_string."','".$coreval_q2_string."','".$coreval_q3_string."','".$coreval_q4_string."','".$coreval_q5_string."','".$coreval_q6_string."','".$coreval_q7_string."')");
	}

	$checkEntry = dbquery("select * from student_corevalues where (coreval_stud_no='".$_GET['stud_no']."' and coreval_enrol_sy='".$_GET['enrol_sy']."')");
	$dataEntry = dbarray($checkEntry);	
	$coreval_q1 = unserialize($dataEntry['coreval_q1']);
	$coreval_q2 = unserialize($dataEntry['coreval_q2']);
	$coreval_q3 = unserialize($dataEntry['coreval_q3']);
	$coreval_q4 = unserialize($dataEntry['coreval_q4']);
	$coreval_q5 = unserialize($dataEntry['coreval_q5']);
	$coreval_q6 = unserialize($dataEntry['coreval_q6']);
	$coreval_q7 = unserialize($dataEntry['coreval_q7']);
}
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Learner's Observed Values (SY <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?> )
		<br><small>
			<?php echo $dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname'];?>
			<?php echo "<em>(".$dataStudent['stud_lrn'].")</em>";?>		
		</small></h4>
      </div>
	  <form name="form1" method="post" action="stud_coreval.frm.php?Save=Yes">
	  <input type="hidden" id="coreval_no" name="coreval_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataEntry["coreval_no"];?>" / autofocus>
      <div class="modal-body">
			<div class="card-body">
				<table border="1" cellspacing="0" cellpadding="1" width="100%">	
					<tr style="background-color: lightgray">
						<td width="15%" align="center" rowspan="2"><strong>Core Values</strong></td>
						<td width="35%" align="center" rowspan="2"><strong>Behavior Statements</strong></td>
						<td width="50%" align="center" colspan="4"><strong>Quarter</strong></td>
					</tr>
					<tr>
						<td widtd="8%" align="center"><strong>1</strong></td>
						<td widtd="8%" align="center"><strong>2</strong></td>
						<td widtd="8%" align="center"><strong>3</strong></td>
						<td widtd="8%" align="center"><strong>4</strong></td>
					</tr>
					<tr height="50">
						<td align="left" rowspan="2">1. Maka-Diyos</td>
						<td align="left">Expresses one's spiritual beliefs while respecting the spiritual beliefs of others</td>
						<td align="center" valign="middle">
							<select name="coreval_q1_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q1['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q1['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q1['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q1['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q1_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q1['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q1['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q1['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q1['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q1_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q1['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q1['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q1['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q1['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q1_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q1['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q1['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q1['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q1['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>			
					</tr>
					<tr height="50">
						<td align="left">Shows adherence to ethical principles by upholding truth</td>
						<td align="center" valign="middle">
							<select name="coreval_q2_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q2['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q2['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q2['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q2['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q2_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q2['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q2['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q2['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q2['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q2_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q2['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q2['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q2['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q2['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q2_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q2['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q2['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q2['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q2['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
					</tr>
					<tr height="50">
						<td align="left" rowspan="2">2. Makatao</td>
						<td align="left">Is sensitive to individual, social, and cultural differences</td>
						<td align="center" valign="middle">
							<select name="coreval_q3_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q3['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q3['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q3['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q3['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q3_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q3['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q3['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q3['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q3['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q3_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q3['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q3['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q3['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q3['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q3_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q3['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q3['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q3['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q3['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
					</tr>
					<tr height="50">
						<td align="left">Demonstrates contributions toward solidarity</td>
						<td align="center" valign="middle">
							<select name="coreval_q4_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q4['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q4['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q4['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q4['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q4_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q4['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q4['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q4['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q4['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q4_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q4['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q4['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q4['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q4['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q4_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q4['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q4['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q4['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q4['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
					</tr>
					<tr height="50">
						<td align="left">3. Makakalikasan</td>
						<td align="left">Cares for the environment and utilizes resources wisely, judiciously, and economically</td>
						<td align="center" valign="middle">
							<select name="coreval_q5_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q5['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q5['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q5['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q5['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q5_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q5['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q5['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q5['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q5['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q5_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q5['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q5['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q5['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q5['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q5_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q5['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q5['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q5['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q5['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
					</tr>
					<tr height="50">
						<td align="left" rowspan="2">4. Makabansa</td>
						<td align="left">Demonstrate pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen</td>
						<td align="center" valign="middle">
							<select name="coreval_q6_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q6['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q6['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q6['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q6['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q6_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q6['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q6['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q6['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q6['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q6_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q6['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q6['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q6['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q6['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q6_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q6['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q6['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q6['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q6['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
					</tr>
					<tr height="50">
						<td align="left">Demonstrates appropriate behavior in carrying out activities in the school, community, and country</td>
						<td align="center" valign="middle">
							<select name="coreval_q7_1" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q7['0']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q7['0']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q7['0']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q7['0']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
						<td align="center" valign="middle">
							<select name="coreval_q7_2" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q7['1']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q7['1']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q7['1']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q7['1']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q7_3" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q7['2']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q7['2']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q7['2']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q7['2']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>						
						<td align="center" valign="middle">
							<select name="coreval_q7_4" class="form-control">
								<option value="">--</option>
								<option value="AO" <?php echo ($coreval_q7['3']=="AO"?"selected":"");?>>AO</option>
								<option value="SO" <?php echo ($coreval_q7['3']=="SO"?"selected":"");?>>SO</option>
								<option value="RO" <?php echo ($coreval_q7['3']=="RO"?"selected":"");?>>RO</option>
								<option value="NO" <?php echo ($coreval_q7['3']=="NO"?"selected":"");?>>NO</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
    </div>
</body>
</html>