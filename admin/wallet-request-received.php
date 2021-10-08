<?php
include_once('../_session-admin.php');

$dts="";
$file="";
$cond="";
if(isset($_REQUEST['dts2']) && isset($_REQUEST['dts3']))
{
	$dts2=$_REQUEST['dts2'];
	$dts3=$_REQUEST['dts3'];
	$file="wallet-request-of-date.csv";
	$cond=" and ((request_date between '$dts2' and '$dts3') or (request_date between '$dts3' and '$dts2'))";
}
else
{
	$file="wallet-request-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";
	$cond="";
}


$query="SELECT * FROM child_wallet_requests where bank_id<100000 $cond order by request_id desc";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
if($num_rows>0)
{
	include '../functions/_ShowAdminBankClient.php';
	include '../functions/_my_uname.php';
	include '../functions/_my_umobile.php';
	$i=0;
	$csv_header = '"Sr.No.","Req Id","Req Date","User ID","User Name","Bank Account","Deposit by","Ref. No.","Amount","Status","Remarks"';
	$csv_header .= "\n";
	$csv_row ='';
	while($rs = mysql_fetch_assoc($result)) 
	{
		$i++;
		
		$pm="";
		if($rs['payment_mode']==1)
		$pm="Demand Draft";
		else if($rs['payment_mode']==2)
		$pm="Cheque";
		else if($rs['payment_mode']==3)
		$pm="NEFT / RTGS";
		else if($rs['payment_mode']==4)
		$pm="IMPS";
		else if($rs['payment_mode']==5)
		$pm="Cash Deposit";
		else if($rs['payment_mode']==6)
		$pm="CDM - Cash Deposit Machine";
		
		$st="";
		if($rs['request_status']==1)
		$st="Received";
		else if($rs['request_status']==2)
		$st="Transferred";
		else if($rs['request_status']==3)
		$st="Rejected";
	
		$nm="";
		$nm=show_my_uname($rs['user_id']);
		$bnk=show_admin_bank_client(1001,$rs['bank_id']);
		$rmk=str_replace("<br>","",$rs['remarks']);
		$csv_row.='"'.$i.'","'.$rs['request_id'].'","'.$rs['deposite_date'].'","'.$rs['user_id'].'","'.$nm.'","'.$bnk.'","'.$pm.'","'.$rs['ref_no'].'","'.$rs['deposit_amount'].'","'.$st.'","'.$rmk.'"';
	$csv_row .= "\n";
	}
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>