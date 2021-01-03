<?php
session_start();
require ("maincore.php");

/*
$resultAnec = dbquery("SELECT * FROM anecdotal inner join student on anec_stud_no=stud_no WHERE (stud_no='".$_GET['stud_no']."' and anec_desc='-')");
$dataAnec = dbarray($resultAnec);
$countAnec = dbrows($resultAnec);
if($countAnec==0){
	$insertAnec = dbquery("insert into anecdotal(anec_no, anec_stud_no, anec_date, anec_desc, anec_details, anec_user_name) values('', '".$_GET['stud_no']."', NOW(), '-','.','".$_SESSION["userid"] ."')");
	$resultAnec = dbquery("SELECT * FROM anecdotal inner join student on anec_stud_no=stud_no WHERE (stud_no='".$_GET['stud_no']."' and anec_desc='-')");
	$dataAnec = dbarray($resultAnec);
}

*/

$checkLevel = dbquery("select * from studenroll inner join student on enrol_stud_no=stud_no where enrol_stud_no='".$_GET['stud_no']."' order by enrol_sy desc");
$dataLevel = dbarray($checkLevel);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">View / Modify Submitted Credentials</h4>
    </div>
	<form method="post" action="anecdotal.scr.php?Credentials=Yes">
	<input type="hidden" id="stud_no" name="stud_no" required="required" class=" form-control" value="<?php echo $dataLevel['stud_no'];?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Credentials of <strong><?php echo $dataLevel['stud_lrn']." ".strtoupper($dataLevel['stud_lname']).", ".strtoupper($dataLevel['stud_fname'])." ".strtoupper($dataLevel['stud_mname']); ?></strong>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">

						<table width="100%">
							<tr>
								<th>Junior HS</th>
								<th>Senior HS</th>
							</tr>
							<tr>
								<?php
								$fulltext = $dataLevel['stud_credentials'];
								$found=0;
								?>
								
								<?php $found =  strpos($fulltext,"jhsEnv"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhsEnv"> Long Brown Envelop</td>
								<?php $found =  strpos($fulltext,"shsEnv"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shsEnv"> Long Brown Envelop</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhsPho"); ?>
								<td><input type="checkbox"  <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhsPho"> 2x2 Photo ID</td>
								<?php $found =  strpos($fulltext,"shsPho"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shsPho"> 2x2 Photo ID</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhsNso"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhsNso"> NSO Birth Cert. (Pcpy)</td>
								<?php $found =  strpos($fulltext,"shsNso"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shsNso"> NSO Birth Cert (Pcpy)</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhsBir"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhsBir"> Municipal / Live Birth Cert. (Pcpy)</td>
								<?php $found =  strpos($fulltext,"shsBir"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shsBir"> Municipal / Live Birth Cert. (Pcpy)</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhsDip"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhsDip"> Grade 6 Diploma (Pcpy)</td>
								<?php $found =  strpos($fulltext,"shsDip"); ?>
								<td><input type="checkbox"  <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shsDip"> Grade 10 Cert. of Completion (Pcpy)</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhsGoo"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhsGoo"> Good Moral Character</td>
								<?php $found =  strpos($fulltext,"shsGoo"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shsGoo"> Good Moral Character</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhs138"); ?>
								<td><input type="checkbox"  <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhs138"> Form 138 (Previous School)</td>
								<?php $found =  strpos($fulltext,"shs138"); ?>
								<td><input type="checkbox"   <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shs138"> Form 138 (Previous School)</td>
							</tr>
							<tr>
								<?php $found =  strpos($fulltext,"jhs137"); ?>
								<td><input type="checkbox"  <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="jhs137"> Form 137 (Previous School)</td>
								<?php $found =  strpos($fulltext,"shs137"); ?>
								<td><input type="checkbox"  <?php echo ($found==0?"":"checked ");?> id="anec_details" name="anec_details[]" value="shs137"> Form 137 (Previous School)</td>
							</tr>
							<tr>
								<td></td>
								<?php $found =  strpos($fulltext,"shsNca"); ?>
								<td><input type="checkbox"  <?php echo ($found==0?"":"checked ");?>  id="anec_details" name="anec_details[]" value="shsNca"> NCAE Result (Pcpy)</td>
							</tr>
							<tr>
								<td colspan=""><br><small><i>Last modified <?php echo substr($fulltext,strpos($fulltext,"-"),strlen($fulltext));?></small></i></td>

							</tr>
						<table>	
					</div>
				</div>
			</div>		
	
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>