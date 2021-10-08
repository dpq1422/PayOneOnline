<?php
include_once('../_session-admin.php');

$file="admin-wallet-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query="SELECT * FROM child_wallet_remain where user_id=100001 $cond order by wallet_id";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
if($num_rows>0)
{
	include '../functions/_my_uname.php';
	$i=0;
	$csv_header = '"S.No.","Wallet ID","Transaction","User ID","User Name","Pre Bal","Amt Cr","Amt Dr","Balance","Date Time","Remarks"';
	$csv_header .= "\n";
	$csv_row ='';
	while($rs = mysql_fetch_assoc($result)) 
	{
		$i++;
		if($i%2!=0)
		$style="style='background-color:white;'";
		else
		$style="style='background-color:#e5e5e5;'";
		
		$tr_tp=$rs['transaction_type'];
		if($tr_tp=="0") 
		$tr_tp="Account Opened"; 
		else if($tr_tp=="1") 
		$tr_tp="Wallet Amount Received";
		else if($tr_tp=="2")
		$tr_tp="Wallet Transeferred Manual by Admin"; 
		else if($tr_tp=="3")
		$tr_tp="Wallet Transfer on Request by Admin"; 
		else if($tr_tp=="4")
		$tr_tp="Wallet Transferred by Team"; 
		else if($tr_tp=="5")
		$tr_tp="Wallet Withdraw Manual by Admin";
		else if($tr_tp=="6")
		$tr_tp="Order Generated";
		else if($tr_tp=="7")
		$tr_tp="Failed Order Refunded";
		else if($tr_tp=="8" || $tr_tp=="9")
		$tr_tp="Commission";
		else if($tr_tp=="10" || $tr_tp=="11")
		$tr_tp="Surcharges";
		else if($tr_tp=="12" || $tr_tp=="13")
		$tr_tp="Chargeback";
		else if($tr_tp=="14" || $tr_tp=="15")
		$tr_tp="Other";
		else if($tr_tp=="16")
		$tr_tp="Software Amount";
		else if($tr_tp=="17")
		$tr_tp="Security Amuount";
		else if($tr_tp=="18")
		$tr_tp="Created Commission";
		$a+=$rs['amount_pre'];
		$b+=$rs['amount_cr'];
		$c+=$rs['amount_dr'];
		$d+=$rs['amount_bal'];
		
		$to="";
		if($rs['user_id2']!=0)
		{
			$tos=$rs['user_id2'];
			$to=show_my_uname($rs['user_id2']);
		}
		else if($rs['user_id2']==0)
		{
			$tos="100001";
			$to="PAYONE";
		}
		
		$csv_row.='"'.$i.'","'.$rs['wallet_id'].'","'.$tr_tp.'","'.$tos.'","'.$to.'","'.$rs['amount_pre'].'","'.$rs['amount_cr'].'","'.$rs['amount_dr'].'","'.$rs['amount_bal'].'","'.$rs['wallet_date'].' '.$rs['wallet_time'].'","'.$rs['transaction_description'].'"';
	$csv_row .= "\n";
	}
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>