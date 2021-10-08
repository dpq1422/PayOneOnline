<?php

@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);

header( 'Content-type: text/html; charset=utf-8' );
include_once('../_gyan-info-admin.php');
//mysql_query("update main_transaction_mt set tid='0' where tid='';");
$id=0;
if(isset($_REQUEST['id']))
	$id=$_REQUEST['id'];
$val='"message":"';
//SELECT * FROM main_transaction_mt where type=1 and response like '%"tid":"%' and response not like '%invalid%' and response like '%"message":"%'
$qry1=$qry2=$link="";
$qry1="SELECT * FROM main_transaction_mt where type=1 and response like '%$val%' and eko_transaction_id>$id order by eko_transaction_id limit 0,40;";
$res=mysql_query($qry1);
while($rs=mysql_fetch_array($res))
{
	$id="";
	$id=$rs['eko_transaction_id'];
	$response="";
	$response=$rs['response'];
	$result="";
	$result= json_decode($response, true);
	$message="";
	$message=$result['message'];
	echo "<br>".$qry2="update main_transaction_mt set response_message='$message' where eko_transaction_id='$id';";
	mysql_query($qry2);
}

$link="update-response-message.php?id=$id";
//echo "$qry1<br>$qry2<br>$link";


echo "<script>window.location.href='$link';</script>";
//sleep(1);
//header("location:$link");
?>