<?php
include("database/db_conection.php");
session_start();
if(!$_SESSION['username'])
{
	header("Location: index.php");//redirect to login page to secure the welcome page without login access.
}
	$vul_num=$_POST['vul_num'];
	$check_rule="select * from rule_template WHERE vul_num='$vul_num'";
	$res_fetch=$dbcon->query($check_rule);
	if ($res_fetch->num_rows > 0) {
    // output data of each row
	}
    $row = $res_fetch->fetch_assoc();
	preg_match_all("/([A-Z]{2,50}\_[A-Z]{2,50})|([A-Z]{2,50})/i",$row["vul_para"],$matches);
	$y=0;
	while(!empty($matches[0][$y]))
	{$y++;
	}
	//echo $matches[0][1];
if(!$_POST){header("Location: user.php");}	
elseif(empty($vul_num))
{header("Location: user.php");}

else{
	$post_array = array();
	$fetch_array = array();
	for($i = 0; $i < $y; $i++)
	{
	$post_array [$i] = $_POST[''.$i];
	$fetch_array[$i] = $matches[0][$i];
	}
    $created_rule = str_replace($fetch_array,$post_array,$row['vul_rule']);}
/*
//txt file genration
$file = "./rule/rule_{$row['vul_num']}_file.txt";
if(file_exists($file))
{
$handle = fopen($file,'w') or die("can't open file");
fwrite($handle, $created_rule);
}
else
{
$handle = fopen($file,'w') or die("can't open file");;
fwrite($handle ,$created_rule);
}
*/	
?>
<html>
<head lang="en">
<link rel="icon" href="./database/logo.ico" type="image/ico" />
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="boot/css/bootstrap.css">
	
	
  <script src="./boot/js/jquery.min.js"></script>
  <script src="./boot/js/bootstrap1.min.js"></script>
	
    <title>
        Created Rule
    </title>

<script type="text/javascript" src="./boot/js/jquery.js"></script>
</head>
<style>
    .login-panel {
        margin-top: 100px;
	}
	h5,h4,h3,h2,h1
	{
		color:red;}
</style>
<body>
<div class="container" style="width:1024px">
 <div class="login-panel panel panel-success">
                <div class="panel-heading">
					<h3 class="panel-title"><a href="user.php">Welcome - <?php echo $_SESSION['username'];?></a><p align="right" style="font-size:150%;"><a href="logout.php">Logout</a></p></h3>
					</div>
				<div class="panel-body">
				<div id="container" align="center"> 
				
				<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
						
							<tr>
							<td><h5>VULNERABILITY NUMBER:</h5><?php echo htmlentities($row['vul_num']);?></td>
							</tr>
							<tr>
							<td><h5>VULNERABILITY NAME:</h5><?php echo htmlentities($row['vul_name']);?></td>
							</tr>
							<tr>
							<td><h4>VULNERABILITY DESCRIPTION:</h4><?php echo htmlentities($row['vul_description']);?></td>
							</tr>
							<tr>
                            <td><h4>CREATED RULE:</h4><textarea rows="10" cols="117"><?php echo $created_rule;?></textarea>
							<button class="btn" data-clipboard-action="copy" data-clipboard-target="textarea">Copy</button>
							<!--clip-board-->
							<script src="./boot/js/clipboard.min.js"></script>
							<script>
							var clipboard = new Clipboard('.btn');
							clipboard.on('success', function(e) {
							console.log(e);
								});
							clipboard.on('error', function(e) {
							console.log(e);
							});
							</script>
							</td>
							</tr>
				</table><br/><br/>
							<button class="btn btn-lg btn-success btn-block" onclick="window.location.href='./user.php'" style="width:250px">Continue</button>
			</div> <!-- #container -->
</div>
</div>
</div>
</body>
</html>