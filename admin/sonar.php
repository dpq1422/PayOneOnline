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
	$val_07b=0;
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
	$val_18=0;
	$val_19=0;
	
	if(isset($_POST['rdate']))
	$rdate=$_POST['rdate'];
	
	if(isset($_REQUEST['rdate']))
	$rdate=$_REQUEST['rdate'];

	if($rdate=="")
	$rdate=$date_time;

	if($rdate!="")
	{
		$qry1="SELECT * FROM all_avon_sonar_report WHERE report_date='$rdate';";
		$res1=mysql_query($qry1);
		$num_rows1 = mysql_num_rows($res1);
		if($num_rows1==0)
		{
			$qry2="INSERT INTO all_avon_sonar_report(report_date, updated_on) VALUES ('$rdate','$datetime_time');";
			mysql_query($qry2);
		}
		
		//admin_opening_balance
		$qry_check="SELECT amount_bal amt FROM child_wallet_remain WHERE user_id = 100001 AND wallet_date < '$rdate' ORDER BY wallet_id desc limit 0,1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_03=$rs_check['amt'];
		}
		if($val_03=="")
			$val_03=0;
		$qry_update="update all_avon_sonar_report set admin_opening_balance='$val_03' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//admin_wallet_update
		$qry_check="SELECT sum(amount_cr) amt FROM child_wallet_remain WHERE user_id = 100001 and transaction_type in(1,5,21,13) and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_04=$rs_check['amt'];
		}
		if($val_04=="")
			$val_04=0;
		$qry_update="update all_avon_sonar_report set admin_wallet_update='$val_04' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//admin_wallet_transfer
		$qry_check="SELECT sum(amount_dr) amt FROM child_wallet_remain WHERE user_id = 100001 and transaction_type in(2,3) and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_05=$rs_check['amt'];
		}
		if($val_05=="")
			$val_05=0;
		$qry_update="update all_avon_sonar_report set admin_wallet_transfer='$val_05' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//admin_closing_balance
		$qry_check="SELECT amount_bal amt FROM child_wallet_remain WHERE user_id = 100001 AND wallet_date <= '$rdate' ORDER BY wallet_id desc limit 0,1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_06=$rs_check['amt'];
		}
		if($val_06=="")
			$val_06=0;
		$qry_update="update all_avon_sonar_report set admin_closing_balance='$val_06' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//transfer and charges and charged
		$qry_check="SELECT sum(amount) transfer,sum(charges) charges, sum(com_charged) charged FROM main_transaction_mt where date(created_on)='$rdate' and eko_transaction_status=2 and type=1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_07=$rs_check['transfer'];
			$val_08=$rs_check['charges'];
			$val_09=$rs_check['charged'];
		}
		if($val_07=="")
			$val_07=0;
		if($val_08=="")
			$val_08=0;
		if($val_09=="")
			$val_09=0;
		$qry_update="update all_avon_sonar_report set transfer='$val_07', charges='$val_08', charged='$val_09' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//account verification
		$qry_check="SELECT sum(amount) av FROM main_transaction_mt where date(created_on)='$rdate' and eko_transaction_status=2 and type=2;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_07b=$rs_check['av'];
		}
		if($val_07b=="")
			$val_07b=0;
		$qry_update="update all_avon_sonar_report set account_verification='$val_07b' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//not initiated
		$qry_check="SELECT count(*) num FROM main_transaction_mt where date(created_on)='$rdate' and eko_transaction_status in(0,-1);";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_10=$rs_check['num'];
		}
		if($val_10=="")
			$val_10=0;
		$qry_update="update all_avon_sonar_report set today_mt_not_initiated='$val_10' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//success
		$qry_check="SELECT count(*) num FROM main_transaction_mt where date(created_on)='$rdate' and eko_transaction_status=2;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_11=$rs_check['num'];
		}
		if($val_11=="")
			$val_11=0;
		$qry_update="update all_avon_sonar_report set today_mt_success='$val_11' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//in progress
		$qry_check="SELECT count(*) num FROM main_transaction_mt where date(created_on)='$rdate' and eko_transaction_status in(1,3,4);";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_12=$rs_check['num'];
		}
		if($val_12=="")
			$val_12=0;
		$qry_update="update all_avon_sonar_report set today_mt_in_progress='$val_12' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//refunded
		$qry_check="SELECT count(*) num FROM main_transaction_mt where date(created_on)='$rdate' and eko_transaction_status=5;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_13=$rs_check['num'];
		}
		if($val_13=="")
			$val_13=0;
		$qry_update="update all_avon_sonar_report set today_mt_refunded='$val_13' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//total
		$qry_check="SELECT count(*) num FROM main_transaction_mt where date(created_on)='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_14=$rs_check['num'];
		}
		if($val_14=="")
			$val_14=0;
		$qry_update="update all_avon_sonar_report set today_mt_orders='$val_14' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//admin user
		$qry_check="SELECT count(*) num FROM child_user where user_type in(0,1) and join_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_15=$rs_check['num'];
		}
		if($val_15=="")
			$val_15=0;
		$qry_update="update all_avon_sonar_report set today_new_user='$val_15' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//sd
		$qry_check="SELECT count(*) num FROM child_user where user_type in(2) and join_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_16=$rs_check['num'];
		}
		if($val_16=="")
			$val_16=0;
		$qry_update="update all_avon_sonar_report set today_new_sd='$val_16' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//dist
		$qry_check="SELECT count(*) num FROM child_user where user_type in(3) and join_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_17=$rs_check['num'];
		}
		if($val_17=="")
			$val_17=0;
		$qry_update="update all_avon_sonar_report set today_new_dist='$val_17' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//retailer
		$qry_check="SELECT count(*) num FROM child_user where user_type in(11) and join_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_18=$rs_check['num'];
		}
		if($val_18=="")
			$val_18=0;
		$qry_update="update all_avon_sonar_report set today_new_retailer='$val_18' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//all team
		$qry_check="SELECT count(*) num FROM child_user where join_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_19=$rs_check['num'];
		}
		if($val_19=="")
			$val_19=0;
		$qry_update="update all_avon_sonar_report set today_new_all='$val_19' where report_date='$rdate';";
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
				<th colspan="4">Admin</th>
				<th rowspan="2">AcVr</th>
				<th rowspan="2">MnTr</th>
				<th rowspan="2">ActChr</th>
				<th rowspan="2">TknChr</th>
				<th rowspan="2">ScTr</th>
				<th rowspan="2">Not</th>
				<th rowspan="2">Proc</th>
				<th rowspan="2">Ref</th>
				<!--<th rowspan="2">Miss</th>-->
				<th rowspan="2">Total</th>
				<th colspan="5">Team</th>
			</tr>
			<tr bgcolor="#c5c5c5">
				<th>OB</th>
				<th>WU</th>
				<th>WT</th>
				<th>CB</th>
				<th>U</th>
				<th>SD</th>
				<th>D</th>
				<th>R</th>
				<th>All</th>
			</tr>
			<?php
			$i=0;
			$qry4="SELECT * FROM all_avon_sonar_report order by report_date desc;";
			$res4=mysql_query($qry4);
			$a=$b=$c=$d=$e=$f=$g=$h=$ii=$j=$k=$l=$m=$n=$o=0;
			while($rs4=mysql_fetch_array($res4))
			{
				$i++;
				$style="";
				if($i%2==0)
				$style="bgcolor='#e5e5e5'";
				else
				$style="bgcolor='#ffffff'";
			
				$a+=$rs4['transfer'];
				$b+=$rs4['charges'];
				$c+=$rs4['charged'];
				$d+=$rs4['account_verification'];
				$e+=$rs4['today_mt_not_initiated'];
				$f+=$rs4['today_mt_success'];
				$g+=$rs4['today_mt_in_progress'];
				$h+=$rs4['today_mt_refunded'];
				$ii+=$rs4['today_mt_orders'];
				$j+=$rs4['today_new_user'];
				$k+=$rs4['today_new_sd'];
				$l+=$rs4['today_new_dist'];
				$m+=$rs4['today_new_retailer'];
				$n+=$rs4['today_new_all'];
				
				$nums=$rs4['today_mt_success'];
				$nums_av=$rs4['account_verification']/5;
				$nums_t=$nums-$nums_av;
				$val_diff=0;
				$val_diff=$rs4['today_mt_orders']-$rs4['today_mt_success']-$rs4['today_mt_refunded']-$rs4['today_mt_in_progress']-$rs4['today_mt_not_initiated'];
				$o+=$val_diff;
			?>
			<tr <?php echo $style;?>>
				<td title="report date"><?php echo $rs4['report_date'];?></td>
				<td align="right" title="opening balance"><?php echo str_replace(".00","",$rs4['admin_opening_balance']);?></td>
				<td align="right" title="wallet update"><?php echo str_replace(".00","",$rs4['admin_wallet_update']);?></td>
				<td align="right" title="wallet transfer"><?php echo str_replace(".00","",$rs4['admin_wallet_transfer']);?></td>
				<td align="right" title="closing balance"><?php echo str_replace(".00","",$rs4['admin_closing_balance']);?></td>
				<th align="right" title="account verification" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['account_verification'])."<br>($nums_av)";?></th>
				<th align="right" title="money transfer" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['transfer'])."<br>($nums_t)";?></th>
				<td align="right" title="actual charges"><?php echo str_replace(".00","",$rs4['charges']);?></td>
				<th align="right" title="taken charges" <?php if($rs4['charges']!=$rs4['charged']) {echo "bgcolor='#2eb22e'";} else {echo "bgcolor='#6afb92'";}?>><?php echo str_replace(".00","",$rs4['charged']);?></th>
				<th align="right" title="success transaction" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['today_mt_success']);?></th>
				<td align="right" title="not initiated"><?php echo str_replace(".00","",$rs4['today_mt_not_initiated']);?></td>
				<td align="right" title="in progress" <?php if($rs4['today_mt_in_progress']!=0) echo "bgcolor='#7a7acc'"?>><?php echo str_replace(".00","",$rs4['today_mt_in_progress']);?></td>
				<td align="right" title="orders refunded"><?php echo str_replace(".00","",$rs4['today_mt_refunded']);?></td>
				<!--<td align="right" title="missed" <?php if($val_diff!=0) echo "bgcolor='red'"?>><?php echo str_replace(".00","",$val_diff);?></td>-->
				<th align="right" title="total orders" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['today_mt_orders']);?></th>
				<td align="right" title="admin user"><?php echo str_replace(".00","",$rs4['today_new_user']);?></td>
				<td align="right" title="sd"><?php echo str_replace(".00","",$rs4['today_new_sd']);?></td>
				<td align="right" title="dist"><?php echo str_replace(".00","",$rs4['today_new_dist']);?></td>
				<td align="right" title="retailer" bgcolor="#f2a710"><?php echo str_replace(".00","",$rs4['today_new_retailer']);?></td>
				<th align="right" title="total team" bgcolor="#2eb22e"><?php echo str_replace(".00","",$rs4['today_new_all']);?></th>
			</tr>
			<?php
			}
			$nums_av=$d/5;
			$nums_t=$f-$nums_av;			
			?>
			<tr bgcolor="#c5c5c5">
				<td></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th align="right" title="account verification"><?php echo str_replace(".00","",$d)."<br>($nums_av)";?></th>
				<th align="right" title="money transfer"><?php echo str_replace(".00","",$a)."<br>($nums_t)";?></th>
				<th align="right" title="actual charges"><?php echo str_replace(".00","",$b);?></th>
				<th align="right" title="taken charges"><?php echo str_replace(".00","",$c);?></th>
				<th align="right" title="success transfer"><?php echo str_replace(".00","",$f);?></th>
				<th align="right" title="not initiated"><?php echo str_replace(".00","",$e);?></th>
				<th align="right" title="in progress"><?php echo str_replace(".00","",$g);?></th>
				<th align="right" title="orders refunded"><?php echo str_replace(".00","",$h);?></th>
				<!--<th align="right" title="missed"><?php echo str_replace(".00","",$o);?></th>-->
				<th align="right" title="total orders"><?php echo str_replace(".00","",$ii);?></th>
				<th align="right" title="admin user"><?php echo str_replace(".00","",$j);?></th>
				<th align="right" title="sd"><?php echo str_replace(".00","",$k);?></th>
				<th align="right" title="dist"><?php echo str_replace(".00","",$l);?></th>
				<th align="right" title="retailer"><?php echo str_replace(".00","",$m);?></th>
				<th align="right" title="total team"><?php echo str_replace(".00","",$n);?></th>
			</tr>
		</table>
	</body>
</html>