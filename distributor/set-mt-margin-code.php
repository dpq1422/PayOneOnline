<?php
include('../_session-admin.php');

$user_id=$_POST['user_id'];
$source_id=$_POST['source_id'];
$payment_method=$_POST['payment_method'];
$c01=$_POST['c01'];
$c02=$_POST['c02'];
$c03=$_POST['c03'];
$c04=$_POST['c04'];
$c05=$_POST['c05'];
$c10=0;
$c15=0;
$c20=0;
$c25=0;
$va=0;
for($aa=0;$aa<count($user_id);$aa++)
{
	$user_idaa=$user_id[$aa];
	$source_idaa=$source_id[$aa];
	$payment_methodaa=$payment_method[$aa];
	if($payment_methodaa=="NEFT")
	$payment_methodaa="1";
	else
	$payment_methodaa="2";
	$c01aa=$c01[$aa];
	$c02aa=$c02[$aa];
	$c03aa=$c03[$aa];
	$c04aa=$c04[$aa];
	$c05aa=$c05[$aa];
	$c10aa=0;
	$c15aa=0;
	$c20aa=0;
	$c25aa=0;
	
	$qry1="update child_products_margin_mt set m_01000='$c01aa', m_02000='$c02aa', m_03000='$c03aa', m_04000='$c04aa', m_05000='$c05aa', m_10000='$c10aa', m_15000='$c15aa', m_20000='$c20aa', m_25000='$c25aa' where user_id='$user_idaa' and source_id='$source_idaa' and payment_method='$payment_methodaa';";
	$va+=mysql_query($qry1);
}

$utp=$_POST['utp'];
if($utp==2 || $utp==3)
header("location:distributors.php");
else
header("location:retailers.php");
?>