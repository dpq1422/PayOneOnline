<?php
include_once('../_gyan-info-trans.php');

$qry="SELECT * FROM child_wallet_remain where transaction_type in(14,19) and request_id=0 order by wallet_id limit 0,25";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	$wid=$rs['wallet_id'];
	
	$val_start='Order No. ';
	$val_end=' by user_id';
	$data=$rs['transaction_description'];
	$pos_start=strpos($data, $val_start);
	$pos_end=strpos($data, $val_end);
	
	echo "<br/>wid : $wid";
	//echo "<br/>pos_start : $pos_start";
	//echo "<br/>pos_end : $pos_end";
	//echo "<br/>data : $data";
	
	$startIndex = min($pos_start+10, $pos_end);
	$length = abs($pos_start+10 - $pos_end);
	$oid = substr($data, $pos_start+10, $length);
	echo ", oid : ($oid)";
	
	$qr="update child_wallet_remain set request_id='$oid' where wallet_id='$wid'";
	mysql_query($qr);
}

echo "<meta http-equiv='refresh' content='1'>";
?>