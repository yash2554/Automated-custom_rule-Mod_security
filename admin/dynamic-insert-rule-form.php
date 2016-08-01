<?php
session_start();

if(!$_SESSION['username'])
{
	header("Location: index.php");//redirect to login page to secure the welcome page without login access.
}
	include("../database/db_conection.php");   
	
	$select_category="select * from rule_template ORDER BY `vul_num` limit 1000;";
	$run=$dbcon->query($select_category);
	if($run->num_rows > 0)
	{$i=0;
	while($row = $run->fetch_assoc()){
	$i++;}
	}
	$lol=$i+1;
	//$lol1=$lol+1;
	$cat=$_REQUEST['cate'];
	//echo $cat;
if(!$cat==0)
{

//for existing rule update
if($cat<$lol)
{	
	$fetch_sql="select * from rule_template WHERE vul_num='$cat'";
	$run1=$dbcon->query($fetch_sql);
	if($run1->num_rows > 0)
	{
	$row1 = $run1->fetch_assoc();
	//echo $row1["vul_rule"];
	}
?>
<form role="form" align="center" method="post" action="up-rule.php">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td><h5>VULNERABILITY NUMBER:</h5><textarea rows="1" cols="116" name="vul_num" required><?php echo htmlentities($cat);?></textarea></td>
							</tr>
							<tr>
							<td><h5>VULNERABILITY NAME:</h5><textarea rows="1" cols="116" name="vul_name" placeholder='VULNERABILITY NAME' required><?php echo htmlentities($row1["vul_name"]);?></textarea></td>
							</tr>
							<tr>
							<td><h4>VULNERABILITY DESCRIPTION:</h4><textarea rows="5" cols="116" name="vul_desc" placeholder='VULNERABILITY DESCRIPTION' required><?php echo htmlentities($row1["vul_description"]);?></textarea></td>
							</tr>
							<tr>
                            <td><h4>CREATED RULE:</h4><textarea rows="10" cols="116" name="vul_rule" placeholder='CREATED RULE' required><?php echo htmlentities($row1["vul_rule"]);?></textarea></td>
							</tr>
							<tr>
                            <td><h4>Parameters:</h4><textarea rows="2" cols="116" name="vul_para" placeholder='{"PARA_METERS"} OR {"PARAMETERS"}' required><?php echo htmlentities($row1["vul_para"]);?></textarea></td>
							</tr>
							<tr>
                            <td><h4>Parameter's Hint:</h4><textarea rows="2" cols="116" name="vul_parahint" placeholder='{"PARAMETERS_HINT"}' required><?php echo htmlentities($row1["vul_parahint"]);?></textarea></td>
							</tr>
							<tr><td></br></td></tr>
</table>
<input class="btn btn-lg btn-success btn-block" type="submit" value="UPDATE" name="update" >
</form>
<?php
}
//for insert new rule 
elseif($cat==$lol)
{	
?>
<form role="form" align="center" method="post" action="up-rule.php">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td><h5>VULNERABILITY NUMBER:</h5><textarea rows="1" cols="116" name="vul_num" required><?php echo htmlentities($cat);?></textarea></td>
							</tr>
							<tr>
							<td><h5>VULNERABILITY NAME:</h5><textarea rows="1" cols="116" name="vul_name" placeholder='VULNERABILITY NAME'  required></textarea></td>
							</tr>
							<tr>
							<td><h4>VULNERABILITY DESCRIPTION:</h4><textarea rows="5" cols="116" name="vul_desc" placeholder='VULNERABILITY DESCRIPTION' required></textarea></td>
							</tr>
							<tr>
                            <td><h4>CREATED RULE:</h4><textarea rows="10" cols="116" name="vul_rule" placeholder='CREATED RULE' required></textarea></td>
							</tr>
							<tr>
                            <td><h4>Parameters:</h4><textarea rows="2" cols="116" name="vul_para" placeholder='{"PARA_METERS"} OR {"PARAMETERS"}' required></textarea></td>
							</tr>
							<tr>
                            <td><h4>Parameter's Hint:</h4><textarea rows="2" cols="116" name="vul_parahint" placeholder='{"PARAMETERS_HINT"}' required></textarea></td>
							</tr>
							
							<tr><td></br></td></tr>
</table>
<input class="btn btn-lg btn-success btn-block" type="submit" value="INSERT" name="insert" >
</form>
<?php
}
//insert parameter for existing rule
elseif($cat==$lol+2)
{	
?>
<?php
//Redirect browser
header("Location: admin_dashboard.php");
 
//Make sure that code below does not get executed when we redirect.
exit;
?>
<?php
}
}
//for empty selection
else{
?>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
</table>
<?php
}
?>