<?php
require ('maincore.php');
## --skip-opt --insert-ignore 
$curD = getcwd();
$curD = substr($curD,0,1);
$d="D:/xampp/mysql/bin/mysqldump --add-drop-table --host=$servername --user=$username --password=$password $dbname > backupdb/db-backup.sql";
$path=$curD.substr($d,1,strlen($d));
exec($path);
/*
backup_tables('localhost','root','03231979','sanhsmis');

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('./backupdb/db-backup.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	//header("Location: ".$_SERVER['HTTP_REFERER']);
	
}
*/
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Backup Database Panel</h4>
    </div>
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">
						<?php 
						if (file_exists("./backupdb/db-backup.sql")){
							echo "The backup has been successfull! <br>Click the Download Backup Now button to proceed!";
						}
						else {
							echo "An error occured, please contact the developer!";
						}
						?>
						
						<span title="Required" class="text-danger"></span></label>
					</div>
				</div>
			</div>			
		</div>
     </div>
	<div class="modal-footer">
		<a href="./backupdb/db-backup.sql" class="btn btn-primary" download>Download Backup Now</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>