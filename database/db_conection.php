<?php



ini_set('max_execution_time', 600);   

	

$dbcon = new mysqli("sql202.cuccfree.org","cucc0_17702020","yashpatel2554","cucc0_17702020_custom_tool");



if ($dbcon->connect_error) {

    die("Connection failed: " . $dbcon->connect_error);

} 



?>