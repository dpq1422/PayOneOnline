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

//////// Updating AV commission of Admin
$qry10="select * from main_transaction_commission where source=1 and service=2 order by etid;";
$res10=mysql_query($qry10);

while($rs10=mysql_fetch_assoc($res10))
{	
	$etid=0;
	$uid=0;
	$etid=$rs10['etid'];
	$uid=$rs10['retailer_id'];
	$trans_date_time=$rs10['trans_date_time'];
	$amount=$rs10['amount'];
	$admin_fee=$rs10['admin_fee'];
	$payone_amt=$amount-$admin_fee;
	
	$val_avail=0;
	$qry_avail="select count(*) num_avail from child_wallet_remain where user_id='100000' and user_id2='$uid' and request_id='$etid' and transaction_type='19' and amount_cr='$payone_amt';";
	$res_avail=mysql_query($qry_avail);
	while($rs_avail=mysql_fetch_array($res_avail))
	{
		$val_avail=$rs_avail['num_avail'];
	}
	if($val_avail==0)
	{	
		$details="";
		$details="Earnings from Account Verification order no: $etid";
	
		$admin_bal=wallet_balance(100000);
		$admin_bal2=$payone_amt+$admin_bal;
		$q_ins="insert into child_wallet_remain value (NULL, date('$trans_date_time'), time('$trans_date_time'), '100000', '$uid', '$etid', '19', 'Earning from Account Verification Order No. $etid by user_id $uid Sender Charges:$amount Admin Charges:$admin_fee', '$admin_bal', '$payone_amt', '0', '$admin_bal2');";
		mysql_query($q_ins);
		update_wallet(100000);
		
		echo $statement="<br><b>Updating Commission for Order No :</b> $etid, <b>AC :</b> $payone_amt";
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