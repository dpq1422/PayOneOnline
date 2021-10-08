<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PayOne Report</title>
		<link rel="shortcut icon" type="image/x-icon" href="../img/mentor.ico" />
		<meta name="gwt:property" content="panel="/>
		<!-- 
		<style>
		*{font-family: "Courier New", Courier, monospace;}
		</style>
		-->
	</head>
	<body>	
<?php
	include_once('../_session-admin.php');
	
	$rdate="";
	$val_01=0;
	$val_02=0;
	$val_03=0;
	$val_04=0;
	$val_05=0;
	$val_06=0;
	$val_07=0;
	$val_08=0;
	$val_09=0;
	$val_10=0;
	$val_11=0;
	$val_12=0;
	$val_13=0;
	$val_14=0;
	$val_15=0;
	$val_16=0;
	$val_17=0;
	
	if(isset($_POST['rdate']))
	$rdate=$_POST['rdate'];
	
	if(isset($_REQUEST['rdate']))
	$rdate=$_REQUEST['rdate'];

	if($rdate=="")
	$rdate=$date_time;

	if($rdate!="")
	{
		$qry1="SELECT * FROM all_avon_sonar_admin WHERE report_date='$rdate';";
		$res1=mysql_query($qry1);
		$num_rows1 = mysql_num_rows($res1);
		if($num_rows1==0)
		{
			$qry2="INSERT INTO all_avon_sonar_admin(report_date) VALUES ('$rdate');";
			mysql_query($qry2);
		}
		
		//opening_balance
		$qry_check="SELECT amount_pre amt FROM child_wallet_remain WHERE user_id = 100001 AND wallet_date ='$rdate' ORDER BY wallet_id asc limit 0,1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_01=$rs_check['amt'];
		}
		if($val_01=="")
			$val_01=0;
		if($val_01==0)
		{
			$qry_check="SELECT amount_bal amt FROM child_wallet_remain WHERE user_id = 100001 AND wallet_date =DATE_ADD('$rdate', INTERVAL -1 DAY) ORDER BY wallet_id desc limit 0,1;";
			$res_check=mysql_query($qry_check);
			while($rs_check=mysql_fetch_array($res_check))
			{
				$val_01=$rs_check['amt'];
			}
			if($val_01=="")
				$val_01=0;
		}
		$qry_update="update all_avon_sonar_admin set opening_balance='$val_01' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//wallet_taken_amt,wallet_taken_qty
		$qry_check="SELECT sum(amount_cr) wallet_taken_amt,count(*) wallet_taken_qty FROM child_wallet_remain WHERE user_id = 100001 and transaction_type=1 and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_02=$rs_check['wallet_taken_amt'];
			$val_03=$rs_check['wallet_taken_qty'];
		}
		if($val_02=="")
			$val_02=0;
		if($val_03=="")
			$val_03=0;
		$qry_update="update all_avon_sonar_admin set wallet_taken_amt='$val_02', wallet_taken_qty='$val_03' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//request_received_amt,request_received_qty
		$qry_check="SELECT sum(deposit_amount) request_received_amt,count(*) request_received_qty FROM child_wallet_requests WHERE request_date='$rdate' and bank_id<100000;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_04=$rs_check['request_received_amt'];
			$val_05=$rs_check['request_received_qty'];
		}
		if($val_04=="")
			$val_04=0;
		if($val_05=="")
			$val_05=0;
		$qry_update="update all_avon_sonar_admin set request_received_amt='$val_04', request_received_qty='$val_05' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//request_accepted_amt,request_accepted_qty
		$qry_check="SELECT sum(deposit_amount) request_accepted_amt,count(*) request_accepted_qty FROM child_wallet_requests WHERE request_date='$rdate' and bank_id<100000 and request_status=2;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_06=$rs_check['request_accepted_amt'];
			$val_07=$rs_check['request_accepted_qty'];
		}
		if($val_06=="")
			$val_06=0;
		if($val_07=="")
			$val_07=0;
		$qry_update="update all_avon_sonar_admin set request_accepted_amt='$val_06', request_accepted_qty='$val_07' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//transferred_manually_amt,transferred_manually_qty
		$qry_check="SELECT sum(amount_dr) transferred_manually_amt,count(*) transferred_manually_qty FROM child_wallet_remain WHERE user_id = 100001 and transaction_type=2 and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_08=$rs_check['transferred_manually_amt'];
			$val_09=$rs_check['transferred_manually_qty'];
		}
		if($val_08=="")
			$val_08=0;
		if($val_09=="")
			$val_09=0;
		$qry_update="update all_avon_sonar_admin set transferred_manually_amt='$val_08', transferred_manually_qty='$val_09' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//withdrawn_manually_amt,withdrawn_manually_qty
		$qry_check="SELECT sum(amount_cr) withdrawn_manually_amt,count(*) withdrawn_manually_qty FROM child_wallet_remain WHERE user_id = 100001 and transaction_type in(5,13,21) and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_10=$rs_check['withdrawn_manually_amt'];
			$val_11=$rs_check['withdrawn_manually_qty'];
		}
		if($val_10=="")
			$val_10=0;
		if($val_11=="")
			$val_11=0;
		$qry_update="update all_avon_sonar_admin set withdrawn_manually_amt='$val_10', withdrawn_manually_qty='$val_11' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//day_difference
		$val_12=$val_06+$val_08-$val_10-$val_02;		
		$qry_update="update all_avon_sonar_admin set day_difference='$val_12' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//net_cash
		$qry_check="SELECT net_cash FROM all_avon_sonar_admin WHERE report_date=DATE_ADD('$rdate', INTERVAL -1 DAY);";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_13=$rs_check['net_cash'];
		}
		if($val_13=="")
			$val_13=0;
		$val_13=$val_13+$val_12;
		$qry_update="update all_avon_sonar_admin set net_cash='$val_13' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//closing_balance
		$qry_check="SELECT amount_bal amt FROM child_wallet_remain WHERE user_id = 100001 AND wallet_date ='$rdate' ORDER BY wallet_id desc limit 0,1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_14=$rs_check['amt'];
		}
		if($val_14=="")
			$val_14=0;
		if($val_14==0)
		{
			$val_14=$val_01+$val_02-$val_06-$val_08+$val_10;
		}
		$qry_update="update all_avon_sonar_admin set closing_balance='$val_14' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//SBI
		$qry_check="SELECT txn_bal amt FROM child_bank_records where bank_name='SBI' and bnk_date='$rdate' ORDER BY bnk_id desc limit 0,1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_15=$rs_check['amt'];
		}
		if($val_15=="")
			$val_15=0;
		$qry_update="update all_avon_sonar_admin set bank_sbi='$val_15' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//ICICI
		$qry_check="SELECT txn_bal amt FROM child_bank_records where bank_name='ICICI' and bnk_date='$rdate' ORDER BY bnk_id desc limit 0,1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_16=$rs_check['amt'];
		}
		if($val_16=="")
			$val_16=0;
		$qry_update="update all_avon_sonar_admin set bank_icici='$val_16' where report_date='$rdate';";
		mysql_query($qry_update);
		
		$val_17=$val_13-$val_15-$val_16;
		$qry_update="update all_avon_sonar_admin set cash_in_hand='$val_17' where report_date='$rdate';";
		mysql_query($qry_update);
	}
?>
		<center>
		<table cellpadding="5" cellspacing="10">
			<form method="post">
				<tr>
					<td colspan="2" align="center"><h1>Sonar Report<h1></td>
				</tr>
				<tr>
					<td width="150">Select Date</td>
					<td>
						<input type="date" name="rdate" value="<?php echo $rdate;?>" />
						<input type="submit" name="runSonar" value="Run Report" />
					</td>
				</tr>
			</form>
		</table>
		</center>
		<table cellpadding="10">
			<tr bgcolor="#c5c5c5">
				<th rowspan="2">Rep<br>Date</th>
				<th rowspan="2">Op Bal</th>
				<th rowspan="2">Wal Taken</th>
				<th colspan="2">Wallet Request</th>
				<th colspan="2">Manual</th>
				<th rowspan="2">Day Diff</th>
				<th rowspan="2">Net Cash</th>
				<th rowspan="2">Cl Bal</th>
				<th colspan="2">Bank</th>
				<th rowspan="2">Cash balance</th>
			</tr>
			<tr bgcolor="#c5c5c5">
				<th>Received</th>
				<th>Accepted</th>
				<th>Transafer</th>
				<th>Withdraw</th>
				<th>SBI</th>
				<th>ICICI</th>
			</tr>
			<?php
			$i=0;
			$qry4="SELECT * FROM all_avon_sonar_admin order by report_date desc;";
			$res4=mysql_query($qry4);
			while($rs4=mysql_fetch_array($res4))
			{
				$i++;
				$style="";
				if($i%2==0)
				$style="bgcolor='#e5e5e5'";
				else
				$style="bgcolor='#ffffff'";
			$cb_cal=$rs4['opening_balance']+$rs4['wallet_taken_amt']-$rs4['request_accepted_amt']-$rs4['transferred_manually_amt']+$rs4['withdrawn_manually_amt'];
			
			$cb_real=$rs4['closing_balance'];
			
			if($cb_real==$cb_cal)
			$clr="#2eb22e";
			else
			$clr="pink";
			?>
			<tr <?php echo $style;?>>
				<td title="report date"><?php echo $rs4['report_date'];?></td>
				<td align="right" title="opening balance" bgcolor="#2eb22e"><?php echo str_replace(".00","",$rs4['opening_balance']);?></td>
				<td align="right" title="wallet taken" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['wallet_taken_amt'])."<br>(".str_replace(".00","",$rs4['wallet_taken_qty']).")";?></td>
				<td align="right" title="request received"><?php echo str_replace(".00","",$rs4['request_received_amt'])."<br>(".str_replace(".00","",$rs4['request_received_qty']).")";?></td>
				<td align="right" title="request accepted" bgcolor="#7a7acc"><?php echo str_replace(".00","",$rs4['request_accepted_amt'])."<br>(".str_replace(".00","",$rs4['request_accepted_qty']).")";?></td>
				<td align="right" title="manual transafer" bgcolor="#7a7acc"><?php echo str_replace(".00","",$rs4['transferred_manually_amt'])."<br>(".str_replace(".00","",$rs4['transferred_manually_qty']).")";?></td>
				<td align="right" title="manual withdraw" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['withdrawn_manually_amt'])."<br>(".str_replace(".00","",$rs4['withdrawn_manually_qty']).")";?></td>
				<td align="right" title="day difference"><?php echo str_replace(".00","",$rs4['day_difference']);?></td>
				<td align="right" title="net balance"><?php echo str_replace(".00","",$rs4['net_cash']);?></td>
				<td align="right" title="closing balance" bgcolor="<?php echo $clr?>"><?php echo str_replace(".00","",$cb_real)."<br>Cal: ".str_replace(".00","",$cb_cal);?></td>
				<td align="right" title="sbi balance"><?php echo str_replace(".00","",$rs4['bank_sbi']);?></td>
				<td align="right" title="icici balance"><?php echo str_replace(".00","",$rs4['bank_icici']);?></td>
				<td align="right" title="cash balance" bgcolor="#2eb22e"><?php echo str_replace(".00","",$rs4['cash_in_hand']);?></td>
			</tr>
			<?php
			}		
			?>
			<tr bgcolor="#c5c5c5">
				<td colspan="13"></td>
			</tr>
		</table>
	</body>
</html>