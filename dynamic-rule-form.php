<?php
include("database/db_conection.php");
	
	$cat=$_REQUEST['cate'];
	$check_option="select vul_num,vul_para,vul_name,vul_parahint from rule_template WHERE vul_num='$cat'";
	$res_fetch=$dbcon->query($check_option);
	if ($res_fetch->num_rows > 0) {
    // output data of each row
    $row = $res_fetch->fetch_assoc(); 
    }

if($cat=="")
{}
	elseif($cat==$row["vul_num"])
{
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<form role="form" align="center" method="post" action="custom_rule.php">
							<table align="center" class="form-group" width="100%" border="0" cellspacing="3" cellpadding="3">
							<tr class="form-group">
							<td class="form-group"></td><td></td>
							<td class="form-group"><input name="vul_num" type="hidden" value="<?php echo $cat;?>"></td>
							</tr>
							<?php $y=0;
							preg_match_all("/([A-z0-9\+\,\(\)\$\|\-\>\^\.\s\@\#\%\/]+)/i",trim($row["vul_parahint"]), $hint);
							preg_match_all("/([A-Z]{2,50}\_[A-Z]{2,50})|([A-Z]{2,50})/i",trim($row["vul_para"]), $matches);
							while(!empty($matches[0][$y])){
							echo "<tr class=\"form-group\">";
							echo "<td class=\"form-group\">".$matches[0][$y]."</td><td>:</td>";
							echo "<td class=\"form-group\"><input class=\"form-control\" placeholder=\"".strtolower($matches[0][$y])."\" name=\"".$y."\" type=\"text\" value=\"\" required></td>";
							echo "<td>&nbsp;&nbsp;<a href=\"#\" data-toggle=\"tooltip\" title=\"".strtolower($hint[0][$y])."\" style=\"color:black;\"><i class=\"fa fa-info-circle\"></i></td>";
							echo "</tr>";
							//echo strtolower($matches[0][$y]);
							$y++;}?>							
							</table>
							<center>
							<input class="btn btn-lg btn-success btn-block" type="submit" value="GENERATE RULE" name="<?php echo strtolower($row["vul_name"]);?>" style="width:250px;">
							</center>
							</form>
<?php
}
?>