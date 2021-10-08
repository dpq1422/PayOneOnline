<?php
include('_common.php');
include('_session.php');
include('functions/_AdminWalletBalanceShow.php');

$filled_date=$_POST['filled_date'];
$filled_time=$time_time;
$filled_amount=$_POST['filled_amount'];
$filled_description=$_POST['filled_description'];
$source_wallet=$_POST['source_wallet'];

if($source_wallet==1)
{
	$bal1=$filled_amount;
	$pre_bal19=admin_reals();
	$bal1=$pre_bal19+$bal1;

	$pre_bal23=admin_reals_live();
	$bal1_live=$pre_bal23+$filled_amount;

	$query4a="insert into parent_wallet_realtime value 
	(NULL,'$filled_date','$filled_time','0','0','0','0',
	'1','$filled_description','$pre_bal19','$filled_amount','0','$bal1','$pre_bal23','$filled_amount','0','$bal1_live');";
	$result4=mysql_query($query4a);
}
if($source_wallet==2)
{
	$bal1=$filled_amount;
	$pre_bal19=admin_reals2();
	$bal1=$pre_bal19+$bal1;

	$pre_bal23=admin_reals_live2();
	$bal1_live=$pre_bal23+$filled_amount;

	$query4a="insert into parent_wallet_realtime_aquams value 
	(NULL,'$filled_date','$filled_time','0','0','0','0',
	'1','$filled_description','$pre_bal19','$filled_amount','0','$bal1','$pre_bal23','$filled_amount','0','$bal1_live');";
	$result4=mysql_query($query4a);
}

$bal2=$filled_amount;
$pre_bal17=admin_distributions();
$bal2=$pre_bal17+$bal2;

$query4b="insert into parent_wallet_remain value 
(NULL,'$filled_date','$filled_time','0','0','1','$filled_description',
'$pre_bal17','$filled_amount','0','$bal2');";
$result4+=mysql_query($query4b);



if($result4==2)
header("location:wallet-client.php");
else
header("location:wallet-client.php?msg=fail");


?>