<?php
include_once('../_gyan-info-local.php');
$str='%"tid":"%';
$qry="SELECT * FROM alls_verify_all_mt_order where tid>0 and verify_channel1_id=0 order by order_id";
$res=mysql_query($qry);
$i=0;
while($rs=mysql_fetch_array($res))
{
	$oid=$rs['order_id'];
	$tid=$rs['tid'];
	$order_status=$rs['order_status'];
	if($order_status==2)
		$order_status="Success";
	if($order_status==4)
		$order_status="Refund Pending";
	if($order_status==5)
		$order_status="Refunded";
	
	$i++;
	echo "<br>$i oid : $oid";
	
	//Failed updated as Refunded in alls_verify_channel1
	$qry2="SELECT * FROM alls_verify_channel1 where tid='$tid'";
	$res2=mysql_query($qry2);
	$num_rows2 = mysql_num_rows($res2);
	$tid_status=0;
	$verify_channel1_id=0;	
	if($num_rows2>0)
	{
		while($rs2=mysql_fetch_array($res2))
		{
			$tid_status=$rs2['tid_status'];
			if($tid_status=="Success")
				$tid_status=2;
			if($tid_status=="Refund Pending")
				$tid_status=4;
			if($tid_status=="Refunded")
				$tid_status=5;
			$verify_channel1_id=$rs2['tid'];
		}
		$qr1="update alls_verify_all_mt_order set tid_status='$tid_status', verify_channel1_id='$verify_channel1_id' where order_id='$oid'";
		mysql_query($qr1);
		$qr2="update alls_verify_channel1 set order_status='$order_status', verify_order_id='$oid' where tid='$tid'";
		mysql_query($qr2);
	}
	
	
}

echo "<meta http-equiv='refresh' content='2'>";
?>