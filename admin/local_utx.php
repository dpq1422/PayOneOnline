<html>
<head>
<title>Updating PayOne</title>
<link rel="shortcut icon" type="image/x-icon" href="../img/mentor.ico" />
<meta name="gwt:property" content="panel="/>
<script language="javascript" type="text/javascript">
    var timeleft = 5;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    document.getElementById("progressBar").value = 5 - timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>
<style>
*{font-family: "Courier New", Courier, monospace;}
</style>
</head>
<body>
<table cellspacing="5" cellpadding="5">
<tr>
<td colspan="3" align="center">
<b style='color:#226bfa;'>This is an automated process, please dont refresh the page.</b>
</td>
</tr>
<tr>
<td>
<?php

@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);

header( 'Content-type: text/html; charset=utf-8' );
include_once('../_common-team.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

//////// Updating MT commission of Admin
$qry10="SELECT etid, client_charges, admin_charges, trans_date_time, (admin_charges-admin_fee) mentor, admin_id, admin_commission, sd_id, sd_earning, dist_id, dist_earning, retailer_id, retailer_earning FROM main_transaction_commission where source=1 and service=1 order by etid;";
$res10=mysql_query($qry10);

while($rs10=mysql_fetch_assoc($res10))
{	
	$etid=$rs10['etid'];		
	$dt=$rs10['trans_date_time'];		
	
	$mentor=1;
	$mentor_amt=$rs10['mentor'];
	
	$payone=$rs10['admin_id'];
	$payone_amt=$rs10['admin_commission'];
	
	$sd_id=$rs10['sd_id'];
	$amt1=$rs10['sd_earning'];
	
	$dist_id=$rs10['dist_id'];
	$amt2=$rs10['dist_earning'];
	
	$retailer_id=$rs10['retailer_id'];
	$amt3=$rs10['retailer_earning'];		
	
	$client_charges=$rs10['client_charges'];
	$admin_charges=$rs10['admin_charges'];
	$admin_user_wallet=$client_charges-$admin_charges;
	$admin_bal=wallet_balance(100000);
	$admin_bal2=$admin_bal+$admin_user_wallet;
	
	$val_avail=0;
	$qry_avail="select count(*) num_avail from child_wallet_remain where user_id='100000' and user_id2='$retailer_id' and request_id='$etid' and transaction_type='14' and amount_cr='$admin_user_wallet';";
	$res_avail=mysql_query($qry_avail);
	while($rs_avail=mysql_fetch_array($res_avail))
	{
		$val_avail=$rs_avail['num_avail'];
	}
	if($val_avail==0)
	{	
		$details="";
		$details="Earning from Order No. $etid by user_id $retailer_id Sender Charges:$client_charges Admin Charges:$admin_charges";
		echo "<br><br>".$qry_ins="insert into child_wallet_remain value 
		(NULL, 'date($dt)', 'time($dt)', '100000', '$retailer_id', '$etid', '14', '$details', '$admin_bal', '$admin_user_wallet', '0', '$admin_bal2');";
		mysql_query($qry_ins);
		update_wallet(100000);
		
		echo $statement="<br><br><b>Commission for Order No :</b> $etid, <b>TxnNo :</b> $tid, <b>AC :</b> $payone_amt, <b>SDC :</b> $amt1, <b>DC :</b> $amt2, <b>RC :</b> $amt3";
	}
flush();
ob_flush();		
}





echo "<meta http-equiv='refresh' content='5'>";
?>
</td>
<td width="25"></td>
<td valign="top">
<img src="../img/payone.gif" height="300" alt="Payone is updating transaction status and commissions" title="Payone is updating transaction status and commissions" /><br><br>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<p style="font-weight:bold;color:#226bfa;"> <br>Next process will be executed in <span id="countdowntimer">5</span> Seconds </p>
<progress style="width:100%;" value="0" max="5" id="progressBar"></progress>
</td>
</tr>
</table>
</body>
</html>