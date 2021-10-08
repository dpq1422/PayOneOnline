<?php
include('../_gyan-info-compd.php');
$val=0;
if(isset($_REQUEST['val']))
$val=$_REQUEST['val'];

echo $val."<br>";
$qry1="select * from eko_bank limit $val,1;";
$res1=mysql_query($qry1);
$tid="";


while($rs1=mysql_fetch_assoc($res1))
{
	$bank_name=$rs1['name'];
	$bank_id=$rs1['eko_bank_id'];
	$bank_code=$rs1['bank_code'];
	
	echo $qry2="update all_bank_data set eko_bank_name='$bank_name', eko_bank_id='$bank_id' where bank_code='$bank_code';";
	mysql_query($qry2);
}
$val++;
echo "<META http-equiv='refresh' content='1;URL=http://localhost/bankapi/payoneonline.com/login/admin/_update_ifsc.php?val=$val'>";
?>