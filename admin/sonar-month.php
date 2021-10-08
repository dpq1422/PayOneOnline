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
	$account_verification=0;
	$transfer=0;
	$success=0;
	$in_progress=0;
	$refunded=0;
	$total_txn=0;
	
	$users=0;
	$sd=0;
	$dist=0;
	$ret=0;
	$total_user=0;
	
	$charges=0;
	$gst=0;
	$tds=0;
	$team=0;
	$total_admin=0;
	$avf=0;
	$swf=0;
	$scf=0;
	
	$report_of=$ryear=$rmonth="";
	
	if(isset($_POST['ryear']))
	$ryear=$_POST['ryear'];
	
	if(isset($_REQUEST['ryear']))
	$ryear=$_REQUEST['ryear'];

	if(isset($_POST['rmonth']))
	$rmonth=$_POST['rmonth'];
	
	if(isset($_REQUEST['rmonth']))
	$rmonth=$_REQUEST['rmonth'];

	if($ryear=="")
	$ryear=explode("-",$date_time)[0];

	if($rmonth=="")
	$rmonth=explode("-",$date_time)[2];

	if($rmonth<10)
	$report_of=$ryear."-0".$rmonth;
	else
	$report_of=$ryear."-".$rmonth;

	if($report_of!="" && $rmonth<=12 && strlen($report_of)==7)
	{
		mysql_query("delete from all_avon_sonar_month where report_of ='$report_of';");
		$qry1="SELECT sum(account_verification) account_verification, sum(transfer) transfer, sum(today_mt_success) success, sum(today_mt_in_progress) in_progress, sum(today_mt_refunded) refunded, sum(today_mt_orders) total_txn, sum(today_new_user) users, sum(today_new_sd) sd, sum(today_new_dist) dist, sum(today_new_retailer) ret, sum(today_new_all) total_user FROM all_avon_sonar_report WHERE report_date like '$report_of%';";
		$result1=mysql_query($qry1);
		while($res1=mysql_fetch_array($result1))
		{
			$account_verification=$res1['account_verification'];
			$transfer=$res1['transfer'];
			$success=$res1['success'];
			$in_progress=$res1['in_progress'];
			$refunded=$res1['refunded'];
			$total_txn=$res1['total_txn'];
			$users=$res1['users'];
			$sd=$res1['sd'];
			$dist=$res1['dist'];
			$ret=$res1['ret'];
			$total_user=$res1['total_user'];
			
			$qry11="insert into all_avon_sonar_month(report_of,account_verification,transfer,success,in_progress,refunded,total_txn,users,sd,dist,ret,total_user) values('$report_of','$account_verification','$transfer','$success','$in_progress','$refunded','$total_txn','$users','$sd','$dist','$ret','$total_user');";
			mysql_query($qry11);
		}
		$qry2="SELECT sum(fee_taken-fee_admin) charges, sum(gst_taken+gst_retailer) gst, sum(tds_r+tds_d+tds_s) tds, sum(earn_r+earn_d+earn_s) team, sum(avfee) avf, sum(swfee) swf, sum(scfee) scf FROM all_avon_sonar_report_com WHERE report_date like '$report_of%';";
		$result2=mysql_query($qry2);
		while($res2=mysql_fetch_array($result2))
		{
			$charges=$res2['charges'];
			$gst=$res2['gst'];
			$tds=$res2['tds'];
			$team=$res2['team'];
			$total_admin=$charges-$gst-$tds-$team;
			$avf=$res2['avf'];
			$swf=$res2['swf'];
			$scf=$res2['scf'];
			
			$qry22="update all_avon_sonar_month set charges='$charges', gst='$gst', tds='$tds', team='$team', total_admin='$total_admin', avf='$avf', swf='$swf', scf='$scf' where report_of='$report_of';";
			mysql_query($qry22);
		}
	}
?>
		<center>
		<table cellpadding="5" cellspacing="10">
			<form method="post">
				<tr>
					<td colspan="2" align="center"><h1>Sonar Monthly Report<h1></td>
				</tr>
				<tr>
					<td width="150">Select Year and Month</td>
					<td>
						<select name="rmonth">
							<option></option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
						</select>
						<select name="ryear">
							<option></option>
							<option>2017</option>
							<option>2018</option>
						</select>
						<input type="submit" name="runSonar" value="Run Report" />
					</td>
				</tr>
			</form>
		</table>
		</center>
		<table cellpadding="5">
			<tr bgcolor="#c5c5c5">
				<th>YR-MN</th>
				<th>AV</th>
				<th>MT</th>
				<th>SC</th>
				<th>IP</th>
				<th>RF</th>
				<th>TT</th>
				<th>STF</th>
				<th>SD</th>
				<th>DST</th>
				<th>RET</th>
				<th>TT</th>
				<th>CHG</th>
				<th>GST</th>
				<th>TDS</th>
				<th>COM</th>
				<th>TT</th>
				<th>AVF</th>
				<th>SWF</th>
				<th>SCF</th>
			</tr>
			<?php
			$i=0;
			$qry4="SELECT * FROM all_avon_sonar_month order by report_of desc;";
			$res4=mysql_query($qry4);
			$a=$b=$c=$d=$e=$f=$g=$h=$j=$k=$l=$m=$n=$o=$p=$q=$r=$s=$t=0;
			while($rs4=mysql_fetch_array($res4))
			{
				$i++;
				$style="";
				if($i%2==0)
				$style="bgcolor='#e5e5e5'";
				else
				$style="bgcolor='#ffffff'";
				$a+=$rs4['account_verification'];
				$b+=$rs4['transfer'];
				$c+=$rs4['success'];
				$d+=$rs4['in_progress'];
				$e+=$rs4['refunded'];
				$f+=$rs4['total_txn'];
				$g+=$rs4['users'];
				$h+=$rs4['sd'];
				$j+=$rs4['dist'];
				$k+=$rs4['ret'];
				$l+=$rs4['total_user'];
				$m+=$rs4['charges'];
				$n+=$rs4['gst'];
				$o+=$rs4['tds'];
				$p+=$rs4['team'];
				$q+=$rs4['total_admin'];
				$r+=$rs4['avf'];
				$s+=$rs4['swf'];
				$t+=$rs4['scf'];
			?>
			<tr <?php echo $style;?>>
				<td align="right"><?php echo $rs4['report_of'];?></td>
				<td align="right"><?php echo $rs4['account_verification'];?></td>
				<td align="right"><?php echo $rs4['transfer'];?></td>
				<td align="right"><?php echo $rs4['success'];?></td>
				<td align="right"><?php echo $rs4['in_progress'];?></td>
				<td align="right"><?php echo $rs4['refunded'];?></td>
				<td align="right" bgcolor="#c5c5c5"><?php echo $rs4['total_txn'];?></td>
				<td align="right"><?php echo $rs4['users'];?></td>
				<td align="right"><?php echo $rs4['sd'];?></td>
				<td align="right"><?php echo $rs4['dist'];?></td>
				<td align="right"><?php echo $rs4['ret'];?></td>
				<td align="right" bgcolor="#c5c5c5"><?php echo $rs4['total_user'];?></td>
				<td align="right"><?php echo $rs4['charges'];?></td>
				<td align="right"><?php echo $rs4['gst'];?></td>
				<td align="right"><?php echo $rs4['tds'];?></td>
				<td align="right"><?php echo $rs4['team'];?></td>
				<td align="right" bgcolor="#c5c5c5"><?php echo $rs4['total_admin'];?></td>
				<td align="right"><?php echo $rs4['avf'];?></td>
				<td align="right"><?php echo $rs4['swf'];?></td>
				<td align="right"><?php echo $rs4['scf'];?></td>
			</tr>
			<?php
			}			
			?>
			<tr bgcolor="#c5c5c5">
				<th>Total</td>
				<th align="right"><?php echo number_format((float)$a, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$b, 2, '.', '');?></th>
				<th align="right"><?php echo $c;?></th>
				<th align="right"><?php echo $d;?></th>
				<th align="right"><?php echo $e;?></th>
				<th align="right"><?php echo $f;?></th>
				<th align="right"><?php echo $g;?></th>
				<th align="right"><?php echo $h;?></th>
				<th align="right"><?php echo $j;?></th>
				<th align="right"><?php echo $k;?></th>
				<th align="right"><?php echo $l;?></th>
				<th align="right"><?php echo number_format((float)$m, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$n, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$o, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$p, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$q, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$r, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$s, 2, '.', '');?></th>
				<th align="right"><?php echo number_format((float)$t, 2, '.', '');?></th>
			</tr>
		</table>
	</body>
</html>