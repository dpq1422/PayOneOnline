<?php
include_once('../_session-retail.php');

$file="transactions-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query = "SELECT * FROM `child_wallet_remain` where user_id=$user_id order by wallet_id desc";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
if($num_rows>0)
{
	$i=0;
	$csv_header = '"Wallet Id","Date","Time","Type","Transaction Details","Previous Balance","Amt Cr","Amt Dr","Wallet Balance"';
	$csv_header .= "\n";
	$csv_row ='';
	$aa=$bb=$cc=0;
	while($rs = mysql_fetch_assoc($result))
	{
		$transaction_type=$rs['transaction_type'];
		if($transaction_type==0)
			$transaction_type="Account Opened";
		else if($transaction_type=="1") 
		$transaction_type="Wallet Amount Received";
		else if($transaction_type=="2")
		$transaction_type="Wallet Transeferred Manual by Admin"; 
		else if($transaction_type=="3")
		$transaction_type="Wallet Transfer on Request by Admin"; 
		else if($transaction_type=="4")
		$transaction_type="Wallet Transferred by Team"; 
		else if($transaction_type=="5")
		$transaction_type="Wallet Withdraw Manual by Admin";
		else if($transaction_type=="6")
		$transaction_type="Order Generated";
		else if($transaction_type=="7")
		$transaction_type="Failed Order Refunded";
		else if($transaction_type=="8" || $transaction_type=="9")
		$transaction_type="Commission";
		else if($transaction_type=="10" || $transaction_type=="11")
		$transaction_type="Surcharges";
		else if($transaction_type=="12" || $transaction_type=="13")
		$transaction_type="Chargeback";
		else if($transaction_type=="14" || $transaction_type=="15")
		$transaction_type="Other";
		else if($transaction_type=="16")
		$transaction_type="Software Amount";
		else if($transaction_type=="17")
		$transaction_type="Security Amuount";
		else if($transaction_type=="18")
		$transaction_type="Created Commission";
	
		$tr_desc=explode(" from ",$rs['transaction_description'])[0];
		$aa+=$rs['amount_cr'];
		$bb+=$rs['amount_dr'];
		
		$csv_row.='"'.$rs['wallet_id'].'","'.$rs['wallet_date'].'","'.$rs['wallet_time'].'","'.$transaction_type.'","'.$tr_desc.'","'.$rs['amount_pre'].'","'.$rs['amount_cr'].'","'.$rs['amount_dr'].'","'.$rs['amount_bal'].'"';
	$csv_row .= "\n";
	}
	$cc=$aa-$bb;
	$csv_row.='"","","","","","TOTAL BALANCE","'.$aa.'","'.$bb.'","'.$cc.'"';
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>