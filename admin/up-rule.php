<?php
include("../database/db_conection.php");

	$vul_num =$_POST['vul_num'];
	$vul_name=$_POST['vul_name'];
	$vul_desc=$_POST['vul_desc'];
	$vul_rule=$_POST['vul_rule'];
    $vul_para=$_POST['vul_para'];
	$vul_parahint=$_POST['vul_parahint'];
	
if(isset($_POST['insert']))
{	
	$stmt = $dbcon->prepare("INSERT INTO rule_template(vul_num,vul_name,vul_description,vul_rule,vul_para,vul_parahint) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssss", $vul_num, $vul_name, $vul_desc, $vul_rule, $vul_para, $vul_parahint);
	if ($stmt === false) {
	echo "<script>alert('Error: INSERT FAILED')</script>";
	echo "<script>window.open('admin_dashboard.php','_self')</script>";
	}
	$stmt->execute(); 
	echo "<script>alert('Rule-Inserted-Successfully');</script>";
	echo "<script>window.open('admin_dashboard.php','_self')</script>";
	$stmt->close();
	$dbcon->close();
}
elseif(isset($_POST['update']))
{	
	$stmt = $dbcon->prepare("UPDATE rule_template SET vul_name = ?, vul_description = ?, vul_rule = ?, vul_para = ?, vul_parahint = ? WHERE vul_num = ?");
	$stmt->bind_param('sssssi',$vul_name,$vul_desc,$vul_rule,$vul_para,$vul_parahint,$vul_num);
	if ($stmt === false) {
	echo "<script>alert('Error: UPDATE FAILED')</script>";
	echo "<script>window.open('admin_dashboard.php','_self')</script>";
}
	$stmt->execute(); 
	echo "<script>alert('Rule-Updated-Successfully');</script>";
	echo "<script>window.open('admin_dashboard.php','_self')</script>";
	$stmt->close();
	$dbcon->close();
}
else{header("Location: admin_dashboard.php");}

?>


