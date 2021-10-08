<?php
include_once('../_session-retail.php');

$dwndts="";
if(isset($_REQUEST['dwndts']))
$dwndts=$_REQUEST['dwndts'];

if($dwndts=="")
$file="transactions-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";
else
$file="transactions-of-$dwndts.csv";

$cond="";
if($dwndts!="")
$cond=" and date(created_on)='$dwndts' ";

$grp_ids1="";
$grp_ids2="";
$charges_taken="";

$query = "SELECT * from main_transaction_mt where user_id=$user_id $cond order by eko_transaction_id desc";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
if($num_rows>0)
{
	include '../functions/_my_uname.php';
	$i=0;
	$csv_header = '"Txn No","Order No","Date Time","Product Name","Sender Mobile No","Recipient Mobile No","Beneficiary Name","Bank Name","Account No","Amount","Charges","Total","Status"';
	$csv_header .= "\n";
	$csv_row ='';
	while($rs = mysql_fetch_assoc($result))
	{
		$grp_ids1=$grp_ids2;
		$grp_ids2=$rs['group_id'];
		if($grp_ids1!=$grp_ids2)
			$csv_row .= "\n";
		
		$query1122="select * from main_transaction_mt_bulk where bulk_id='$grp_ids2'";
		$result1122 = mysql_query($query1122);
		while($rs1122 = mysql_fetch_assoc($result1122))
		{
			$charges_taken=$rs1122['receipt_charges'];
		}
		if($grp_ids1==$grp_ids2)
			$charges_taken="";
		
		$status=$rs['eko_transaction_status'];
		if($status==0)
		{
			$status="Not Initiated";
		}
		else if($status==1)
		{
			$status="Initiated";
		}
		else if($status==2)
		{
			$status="Success";
		}
		else if($status==3 || $status==-1)
		{
			$status="In Progress";
		}
		else if($status==4)
		{
			$status="Failed / Pending Refund";
		}
		else if($status==5)
		{
			$status="Refunded";
		}
		else
		{
			$status="Awating Response";
		}
		
		$receiver_number=$rs['receiver_id'];
		
		$query2="SELECT * FROM eko_receiver where receiver_id='$receiver_number'";
		$result2=mysql_query($query2);
		while($rs2 = mysql_fetch_assoc($result2))
		{
			$receiver_number=$rs2['receiver_number'];
		}
		$response_message=$rs['response_message'];
		$response_message=str_replace(" Last_used_OkeyKey: 233","",$response_message);
		if(trim($response_message)=="Transaction successful" || $response_message=="Transaction successful Last_used_OkeyKey: 235")
		{
			$response_message=$rs['tid'];
		}
		
		$trans_type=$rs['type'];
		if($trans_type==1)
			$trans_type="Money Transfer";
		if($trans_type==2)
			$trans_type="Account Verification";
		
		$csv_row.='"'.$rs['group_id'].'","'.$rs['eko_transaction_id'].'","'.$rs['created_on'].'","'.$trans_type.'","'.$rs['sender_number'].'","'.$receiver_number.'","'.$rs['rname'].'","'.$rs['rbname'].'","'.$rs['racc'].'","'.$rs['amount'].'","'.$rs['com_charged'].'","'.$rs['deducted'].'","'.$status.'"';
	$csv_row .= "\n";
	}
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>