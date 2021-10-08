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
	
	if(isset($_POST['rdate']))
	$rdate=$_POST['rdate'];
	
	if(isset($_REQUEST['rdate']))
	$rdate=$_REQUEST['rdate'];

	if($rdate=="")
	$rdate=$date_time;

	if($rdate!="")
	{
		$qry1="SELECT user_id,count(*) num ,sum(amount) amt,sum(charges) chrg,sum(com_charged) chrgd FROM main_transaction_mt where eko_transaction_status=2 and date(created_on)='$rdate' group by user_id order by sum(amount) desc;";
		$res1=mysql_query($qry1);
		$num_rows1 = mysql_num_rows($res1);
	}
?>
		<center>
		<table cellpadding="5" cellspacing="10">
			<form method="post">
				<tr>
					<td colspan="2" align="center"><h1>Sonar Date Report<h1></td>
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
		<table cellpadding="10">
			<tr bgcolor="#c5c5c5">
				<th>User ID</th>
				<th>User Name</th>
				<th>Orders</th>
				<th>Transaction Amount</th>
				<th>Actual Charges</th>
				<th>Taken Charges</th>
			</tr>
			<?php
			$a=$b=$c=$d=$i=0;
			include_once '../functions/_my_uname.php';
			while($rs1=mysql_fetch_array($res1))
			{
				$i++;
				$style="";
				if($i%2==0)
				$style="bgcolor='#e5e5e5'";
				else
				$style="bgcolor='#ffffff'";
			
				$a+=$rs1['num'];
				$b+=$rs1['amt'];
				$c+=$rs1['chrg'];
				$d+=$rs1['chrgd'];
			?>
			<tr <?php echo $style;?>>
				<td title="User ID" align='right'><?php echo $rs1['user_id'];?></td>
				<td title="User Name" align='right'><?php echo show_my_uname($rs1['user_id']);?></td>
				<td title="Orders" align='right'><?php echo $rs1['num'];?></td>
				<td title="Amount" align='right' bgcolor="#2eb22e"><?php echo $rs1['amt'];?></td>
				<td title="Actual Charges" align='right'><?php echo $rs1['chrg'];?></td>
				<td title="Taken Charges" align='right' <?php if($rs1['chrg']!=$rs1['chrgd']) {echo "bgcolor='#f2a710'";} else {echo "bgcolor='#c27700'";}?>><?php echo $rs1['chrgd'];?></td>
			</tr>
			<?php
			}		
			?>
			<tr bgcolor="#c5c5c5">
				<td></th>
				<th></th>
				<th title="Orders" align='right'><?php echo $a;?></th>
				<th title="Amount" align='right'><?php echo $b;?></th>
				<th title="Actual Charges" align='right'><?php echo $c;?></th>
				<th title="Taken Charges" align='right'><?php echo $d;?></th>
			</tr>
		</table>
		</center>
	</body>
</html>