<?php

@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);

header( 'Content-type: text/html; charset=utf-8' );
include_once('../_gyan-info-admin.php');

$qry="SELECT distinct(receiver_id) rid FROM eko_receiver where is_verified=1;";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	$rid=$rs['rid'];
	//INSERT INTO eko_receiver_verified(bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) SELECT bank,ifsc,receiver_acc_no,receiver_name,receiver_id_type,updated_on,source FROM eko_receiver where is_verified=1 and receiver_id in(SELECT distinct(receiver_id) rid FROM eko_receiver where is_verified=1)
}
?>