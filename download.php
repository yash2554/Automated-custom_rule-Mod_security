<?php
    
	$post = $_GET['post'];
	$file1 = "./rule/rule_{$post}_file.txt";

    if(!file_exists($file1)) die("I'm sorry, the file doesn't seem to exist.");

    $type = filetype($file1);
    // Get a date and timestamp
    $today = date("F j, Y, g:i a");
    $time = time();
    // Send file headers
    header("Content-type: $type");
    header("Content-Disposition: attachment;filename=rule_{$post}_file.txt");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');
    // Send the file contents.
    set_time_limit(0); 
    readfile($file1);
?>		