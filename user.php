<?php
session_start();

if(!$_SESSION['username'])
{
	header("Location: index.php");//redirect to login page to secure the welcome page without login access.
}
include("./database/db_conection.php");
?>
<html>
<head lang="en">
<link rel="icon" href="./database/logo.ico" type="image/ico" />
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="boot/css/bootstrap.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>
        UserDashBoard
    </title>

<script type="text/javascript" src="boot/js/jquery.js"></script>
<script type="text/javascript" src="boot/js-1/jquery.js"></script>
<script language="javascript">
function getXMLHTTP()
{
	var xmlhttp=null;
	try {
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)
		{
			try {
					xmlhttp=new ActiveXobject("Microsoft.XMLHTTP");
				}
				catch(e)
				{
					try {
							xmlhttp=new ActiveXObject("msxml2.XMLHTTP");
						}
						catch(e1)
						{
							xmlhttp=false;
						}
				}
		}
		return xmlhttp;
}
var strurl="dynamic-rule-form.php?cate="+cat;
var req=getXMLHTTP();
function getCat(cat) {
//alert(cat);
                $("#flash").show();
                $("#flash").fadeIn(400).html('<img src="../boot/js-1/ajax-loader.gif" align="absmiddle"> loading.....');
var strurl="dynamic-rule-form.php?cate="+cat;
//alert(strurl);
var req=getXMLHTTP();
if(req==null)
{
alert("browser error");
}
if(req)
{
	req.onreadystatechange=function() {
	if(req.readyState ==4 || req.readyState=="complete") {
		                $("#flash").hide();
document.getElementById("ajaxresult").innerHTML=req.responseText;
	}
	}
	req.open("GET",strurl,true);
	req.send(null);
}
}
</script>


</head>
<style>
    .login-panel {
        margin-top: 100px;
</style>
<body>
<div class="container" style="width:1024px">


            <div class="login-panel panel panel-success">
                <div class="panel-heading">
					<h3 class="panel-title"><a href="user.php">Welcome - <?php echo $_SESSION['username'];?></a><p align="right" style="font-size:150%;"><a href="logout.php">Logout</a></p></h3>
					</div>
					
  
					
					
				<div class="panel-body">				
				<div id="container" align="center"> 
				<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="4" align="left" valign="middle" bgcolor="#008000"><div style="color:#FFF; font-size:15px;">SELECT YOUR VULNERABILITY FROM THE BELOW LIST</div></td>
    </tr>
	<tr><td><br/></td><td><br/></td><td><br/></td></tr>
    <tr>
	<td width="19%" align="left" valign="middle"><strong>CATEGORY</strong></td>
    <td width="0%" align="left" valign="middle"><strong>:</strong></td>
    <td width="29%" align="left" valign="middle"><label>
      <select name="select" id="select"  onChange="getCat(this.value)">
        <option value="" selected="selected">SELECT VULNERABILITY</option>
        <?php
   	$select_category="select * from rule_template ORDER BY `vul_num` limit 1000;";
	$run=$dbcon->query($select_category);
	if($run->num_rows > 0)
	{$i=0;
	while($row = $run->fetch_assoc()){
	echo "<option value=\"{$row["vul_num"]}\" name=\"{$row["vul_num"]}\">{$row["vul_name"]}</option>";
	$i++;}
	}
	?> 
      </select>
    </label></td>
  </tr>
  <tr>
    <td width="10%" align="left" valign="middle"></td>
    <td width="2%" align="left" valign="middle"></td>
    <td colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td colspan="4" align="left" valign="middle">
    <div id="flash"></div>
    <div id="ajaxresult"></div>
    </td>
    </tr>
</table>
				
</div> <!-- #container -->
</div>
</div>
</div>

</body>
</html>