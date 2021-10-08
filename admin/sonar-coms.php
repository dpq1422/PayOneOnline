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
		<style>
		*{font-size: 13px;}
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
	$val_18=0;
	$val_19=0;
	$val_20=0;
	$val_21=0;
	$val_22=0;
	
	if(isset($_POST['rdate']))
	$rdate=$_POST['rdate'];
	
	if(isset($_REQUEST['rdate']))
	$rdate=$_REQUEST['rdate'];

	if($rdate=="")
	$rdate=$date_time;

	if($rdate!="")
	{
		$qry1="SELECT * FROM all_avon_sonar_report_com WHERE report_date='$rdate';";
		$res1=mysql_query($qry1);
		$num_rows1 = mysql_num_rows($res1);
		if($num_rows1==0)
		{
			$qry2="INSERT INTO all_avon_sonar_report_com(report_date, updated_on) VALUES ('$rdate', '$datetime_time');";
			mysql_query($qry2);
		}
		
		//unit_mt, amount_mt
		$qry_check="SELECT count(*) unit_mt, sum(amount) amount_mt FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_01=$rs_check['unit_mt'];
			$val_02=$rs_check['amount_mt'];
		}
		if($val_01=="")
			$val_01=0;
		if($val_02=="")
			$val_02=0;
		$qry_update="update all_avon_sonar_report_com set unit_mt='$val_01', amount_mt='$val_02' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//unit_av, amount_av
		$qry_check="SELECT count(*) unit_av, sum(amount) amount_av FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=2;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_03=$rs_check['unit_av'];
			$val_04=$rs_check['amount_av'];
		}
		if($val_03=="")
			$val_03=0;
		if($val_04=="")
			$val_04=0;
		$qry_update="update all_avon_sonar_report_com set unit_av='$val_03', amount_av='$val_04' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//fee_admin, gst_admin, fee_taken, gst_taken, fee_retailer, gst_retailer
		$qry_check="SELECT sum(admin_fee) fee_admin, sum(admin_gst) gst_admin, sum(client_charges) fee_taken, sum(client_charges-retailer_charges)*18/118 gst_taken, sum(retailer_charges) fee_retailer, sum(retailer_charges-admin_fee)*18/118 gst_retailer FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_05=$rs_check['fee_admin'];
			$val_06=$rs_check['gst_admin'];
			$val_07=$rs_check['fee_taken'];
			$val_08=$rs_check['gst_taken'];
			$val_09=$rs_check['fee_retailer'];
			$val_10=$rs_check['gst_retailer'];
		}
		if($val_05=="")
			$val_05=0;
		if($val_06=="")
			$val_06=0;
		if($val_07=="")
			$val_07=0;
		if($val_08=="")
			$val_08=0;
		if($val_09=="")
			$val_09=0;
		if($val_10=="")
			$val_10=0;
		$qry_update="update all_avon_sonar_report_com set fee_admin='$val_05', gst_admin='$val_06', fee_taken='$val_07', gst_taken='$val_08', fee_retailer='$val_09', gst_retailer='$val_10' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//com_r, tds_r, earn_r, com_d, tds_d, earn_d, com_s, tds_s, earn_s
		$qry_check="SELECT sum(retailer_commission) com_r, sum(retailer_tds) tds_r, sum(retailer_earning) earn_r, sum(dist_commission) com_d, sum(dist_tds) tds_d, sum(dist_earning) earn_d, sum(sd_commission) com_s, sum(sd_tds) tds_s, sum(sd_earning) earn_s FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=1;";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_11=$rs_check['com_r'];
			$val_12=$rs_check['tds_r'];
			$val_13=$rs_check['earn_r'];
			$val_14=$rs_check['com_d'];
			$val_15=$rs_check['tds_d'];
			$val_16=$rs_check['earn_d'];
			$val_17=$rs_check['com_s'];
			$val_18=$rs_check['tds_s'];
			$val_19=$rs_check['earn_s'];
		}
		if($val_11=="")
			$val_11=0;
		if($val_12=="")
			$val_12=0;
		if($val_13=="")
			$val_13=0;
		if($val_14=="")
			$val_14=0;
		if($val_15=="")
			$val_15=0;
		if($val_16=="")
			$val_16=0;
		if($val_17=="")
			$val_17=0;
		if($val_18=="")
			$val_18=0;
		if($val_19=="")
			$val_19=0;
		$qry_update="update all_avon_sonar_report_com set com_r='$val_11', tds_r='$val_12', earn_r='$val_13', com_d='$val_14', tds_d='$val_15', earn_d='$val_16', com_s='$val_17', tds_s='$val_18', earn_s='$val_19' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//avfee
		$qry_check="SELECT sum(amount_cr) avfee FROM child_wallet_remain where user_id=100000 and transaction_type=19 and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_20=$rs_check['avfee'];
		}
		if($val_20=="")
			$val_20=0;
		$qry_update="update all_avon_sonar_report_com set avfee='$val_20' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//swfee
		$qry_check="SELECT sum(amount_cr-amount_dr) swfee FROM child_wallet_remain where user_id=100005 and transaction_type in(16,18) and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_21=$rs_check['swfee'];
		}
		if($val_21=="")
			$val_21=0;
		$qry_update="update all_avon_sonar_report_com set swfee='$val_21' where report_date='$rdate';";
		mysql_query($qry_update);
		
		//scfee
		$qry_check="SELECT sum(amount_cr) scfee FROM child_wallet_remain where user_id=100005 and transaction_type=17 and wallet_date='$rdate';";
		$res_check=mysql_query($qry_check);
		while($rs_check=mysql_fetch_array($res_check))
		{
			$val_22=$rs_check['scfee'];
		}
		if($val_22=="")
			$val_22=0;
		$qry_update="update all_avon_sonar_report_com set scfee='$val_22' where report_date='$rdate';";
		mysql_query($qry_update);
	}
?>
		<center>
		<table cellpadding="5" cellspacing="10">
			<form method="post">
				<tr>
					<td colspan="2" align="center"><h1>Sonar GST, TDS, Comm Report<h1></td>
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
		<table cellpadding="5">
			<tr bgcolor="#c5c5c5">
				<th rowspan='2'>Rep<br>Date</th>
				<th>MT</th>
				<th>AV</th>
				<th colspan='2'>Admin Paid</th>
				<th colspan='2'>Admin to RT</th>
				<th colspan='2'>RT to CL</th>
				<th colspan='3'>Team Distribution</th>
				<th colspan='5'>Admin Unpaid</th>
				<th colspan='3'>Others</th>
			</tr>
			<tr bgcolor="#c5c5c5">
				<th>Amt (Qty)</th>				
				<th>Amt (Qty)</th>	
				
				<th>Fee</th>				
				<th>GST</th>
				<th>Fee</th>				
				<th>GST</th>				
				<th>Fee</th>				
				<th>GST</th>
				
				<th>Com</th>
				<th>TDS</th>
				<th>Earn</th>
				
				<th>Charges</th>
				<th>-GST</th>
				<th>-TDS</th>
				<th>-Team</th>
				<th>=TTL</th>
				
				<th>avf</th>
				<th>swf</th>
				<th>scf</th>
			</tr>
			<?php
			$i=0;
			$qry4="SELECT * FROM all_avon_sonar_report_com order by report_date desc;";
			$res4=mysql_query($qry4);
			$a=$b=$c=$d=$e=$f=$g=$h=$ii=$j=$k=$l=$m=$n=$o=$p=$q=$r=$s=$t=$u=0;
			while($rs4=mysql_fetch_array($res4))
			{
				$i++;
				$style="";
				if($i%2==0)
				$style="bgcolor='#e5e5e5'";
				else
				$style="bgcolor='#ffffff'";
				
				$a+=$rs4['unit_mt'];
				$b+=$rs4['amount_mt'];
				$c+=$rs4['unit_av'];
				$d+=$rs4['amount_av'];
				$e+=$rs4['fee_admin'];
				$f+=$rs4['gst_admin'];
				$g+=$rs4['fee_retailer'];
				$h+=$rs4['gst_retailer'];
				$ii+=$rs4['fee_taken'];
				$j+=$rs4['gst_taken'];
			
				$k+=$com=$rs4['com_r']+$rs4['com_d']+$rs4['com_s'];
				$l+=$tds=$rs4['tds_r']+$rs4['tds_d']+$rs4['tds_s'];
				$m+=$earn=$rs4['earn_r']+$rs4['earn_d']+$rs4['earn_s'];
				$n+=$admin_charges=$rs4['fee_taken']-$rs4['fee_admin'];
				$o+=$admin_gst=$rs4['gst_taken']+$rs4['gst_retailer'];
				$p+=$admin_tds=$tds;
				$q+=$admin_team=$earn;
				$r+=$rs4['avfee'];
				$s+=$rs4['swfee'];
				$t+=$admin_earning=$admin_charges-$admin_gst-$admin_tds-$admin_team;
				$u+=$rs4['scfee'];
				
				$res_1=str_replace(".00", "", $rs4['amount_mt'])."<br>(".str_replace(".00", "", $rs4['unit_mt']).")";
				$res_2=str_replace(".00", "", $rs4['amount_av'])."<br>(".str_replace(".00", "", $rs4['unit_av']).")";
			?>
			<tr <?php echo $style;?>>
				<td title="report date"><?php echo $rs4['report_date'];?></td>
				<td align="right" title="MT"><?php echo $res_1;?></td>
				<td align="right" title="AV"><?php echo $res_2;?></td>
				<td align="right" title="fee admin"><?php echo str_replace(".00", "", $rs4['fee_admin']);?></td>
				<td align="right" title="gst admin" bgcolor='#2eb22e'><?php echo str_replace(".00", "", $rs4['gst_admin']);?></td>
				<td align="right" title="fee retailer"><?php echo str_replace(".00", "", $rs4['fee_retailer']);?></td>
				<td align="right" title="get retailer" bgcolor='#f2a710'><?php echo str_replace(".00", "", $rs4['gst_retailer']);?></td>
				<td align="right" title="fee taken"><?php echo str_replace(".00", "", $rs4['fee_taken']);?></td>
				<td align="right" title="gst taken" bgcolor='#f2a710'><?php echo str_replace(".00", "", $rs4['gst_taken']);?></td>
				<td align="right" title="com team"><?php echo str_replace(".00", "", $com);?></td>
				<td align="right" title="tds team" bgcolor='#7a7acc'><?php echo str_replace(".00", "", $tds);?></td>
				<td align="right" title="earn team"><?php echo str_replace(".00", "", $earn);?></td>
				<td align="right" title="admin charges" bgcolor='#2eb22e'><?php echo str_replace(".00", "", $admin_charges);?></td>
				<td align="right" title="admin gst to be paid" bgcolor='#f2a710'><?php echo str_replace(".00", "", $admin_gst);?></td>
				<td align="right" title="admin tds to be paid" bgcolor='#7a7acc'><?php echo str_replace(".00", "", $admin_tds);?></td>
				<td align="right" title="commission distribution"><?php echo str_replace(".00", "", $admin_team);?></td>
				<td align="right" title="admin earning" bgcolor='#2eb22e'><?php echo str_replace(".00", "", $admin_earning);?></td>
				<td align="right" title="avf"><?php echo str_replace(".00", "", $rs4['avfee']);?></td>
				<td align="right" title="swf"><?php echo str_replace(".00", "", $rs4['swfee']);?></td>
				<td align="right" title="scf"><?php echo str_replace(".00", "", $rs4['scfee']);?></td>
			</tr>
			<?php
			}
			$res_1=str_replace(".00", "", $b)."<br>(".str_replace(".00", "", $a).")";
			$res_2=str_replace(".00", "", $d)."<br>(".str_replace(".00", "", $c).")";
			?>
			<tr bgcolor="#c5c5c5">
				<th title="report date"></td>
				<th align="right" title="MT"><?php echo $res_1;?></th>
				<th align="right" title="AV"><?php echo $res_2;?></th>
				<th align="right" title="fee admin"><?php echo str_replace(".00", "", $e);?></th>
				<th align="right" title="gst admin"><?php echo str_replace(".00", "", $f);?></th>
				<th align="right" title="fee retailer"><?php echo str_replace(".00", "", $g);?></th>
				<th align="right" title="get retailer"><?php echo str_replace(".00", "", $h);?></th>
				<th align="right" title="fee taken"><?php echo str_replace(".00", "", $ii);?></th>
				<th align="right" title="gst taken"><?php echo str_replace(".00", "", $j);?></th>
				<th align="right" title="com team"><?php echo str_replace(".00", "", $k);?></th>
				<th align="right" title="tds team"><?php echo str_replace(".00", "", $l);?></th>
				<th align="right" title="earn team"><?php echo str_replace(".00", "", $m);?></th>
				<th align="right" title="admin charges"><?php echo str_replace(".00", "", $n);?></th>
				<th align="right" title="admin gst to be paid"><?php echo str_replace(".00", "", $o);?></th>
				<th align="right" title="admin tds to be paid"><?php echo str_replace(".00", "", $p);?></th>
				<th align="right" title="commission distribution"><?php echo str_replace(".00", "", $q);?></th>
				<th align="right" title="admin earning"><?php echo str_replace(".00", "", $t);?></th>
				<th align="right" title="avf"><?php echo str_replace(".00", "", $r);?></th>
				<th align="right" title="swf"><?php echo str_replace(".00", "", $s);?></th>
				<th align="right" title="scf"><?php echo str_replace(".00", "", $u);?></th>
			</tr>
		</table>
	</body>
</html>