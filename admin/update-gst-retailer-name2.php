<?php
include_once('../_gyan-info-gst.php');

$qry="SELECT * FROM bankatyf_gst.invoice_01_txn where retailer_name='0' order by retailer_id limit 0,1;";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	echo $rid=$rs['retailer_id'];
	$rname="";
	$qry2="SELECT * FROM bankatyf_local.child_user where user_id='$rid';";
	$res2=mysql_query($qry2);
	while($rs2=mysql_fetch_array($res2))
	{
		echo " ".$rname=$rs2['user_name'];
	}
			
	$update_qry="update bankatyf_gst.invoice_01_txn set retailer_name='$rname' where retailer_id='$rid'";
	mysql_query($update_qry);
}
echo "<meta http-equiv='refresh' content='1'>";

	
?>