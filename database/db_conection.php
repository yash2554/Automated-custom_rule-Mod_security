<?php



ini_set('max_execution_time', 600);   

	

$dbcon = new mysqli("sql.com","c20","ya***4","db_tool");



if ($dbcon->connect_error) {

    die("Connection failed: " . $dbcon->connect_error);

} 



?>
