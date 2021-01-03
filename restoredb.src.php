<?php
// Start the session
session_start();
require ('maincore.php');

$dbconn = mysql_connect('localhost','root','03231979');
mysql_select_db('sanhsmis',$dbconn);

$file = './backupdb/restoredb.sql';

if($fp = file_get_contents($file)) {
  $var_array = explode(';',$fp);
  foreach($var_array as $value) {
    mysql_query($value.';',$dbconn);
  }
}

unlink('./backupdb/restoredb.sql');
header("Location: ".$_SERVER['HTTP_REFERER']);
?>