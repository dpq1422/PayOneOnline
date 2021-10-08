<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PayOne Report</title>
		<link rel="shortcut icon" type="image/x-icon" href="../img/mentor.ico" />
		<meta name="gwt:property" content="panel="/>
		<script>
		function checkuser()
		{
			var uid=document.getElementById("uid").value;
			
			if(uid.length!=6)
			{
				alert("User ID must be in 6 digits");
				return false;
			}
			return true;
		}
		</script>
		<!-- 
		<style>
		*{font-family: "Courier New", Courier, monospace;}
		</style>
		-->
	</head>
	<body>	
<?php
	include_once('../_session-admin.php');
	
	$uid="";
	
	if(isset($_POST['uid']))
	$uid=$_POST['uid'];
	
	if(isset($_REQUEST['uid']))
	$uid=$_REQUEST['uid'];

	if($uid!="")
	{
		$qry1="SELECT date(created_on) dt,count(*) num ,sum(amount) amt,sum(charges) chrg,sum(com_charged) chrgd FROM main_transaction_mt where eko_transaction_status=2 and user_id='$uid' group by date(created_on) order by date(created_on) desc;";
		$res1=mysql_query($qry1);
		$num_rows1 = mysql_num_rows($res1);
		include_once '../functions/_my_uname.php';
		$uname=show_my_uname($uid);
	}
?>
		<center>
		<table cellpadding="5" cellspacing="10">
			<form method="post" onsubmit="return checkuser()">
				<tr>
					<td colspan="2" align="center"><h1>Sonar User Overall Report<h1></td>
				</tr>
				<tr>
					<td width="150">Enter User ID</td>
					<td>
						<input type="number" name="uid" id="uid" value="<?php echo $uid; ?>" />
						<input type="submit" name="runSonar" value="Run Report" />
					</td>
				</tr>
			</form>
		</table>
		<table cellpadding="10">
			<tr bgcolor="#c5c5c5">
				<th>User ID</th>
				<th>User Name</th>
				<th>Date</th>
				<th>Orders</th>
				<th>Transaction Amount</th>
				<th>Actual Charges</th>
				<th>Taken Charges</th>
			</tr>
			<?php
			if($uid!="")
	{
		$qry1="SELECT date(created_on) dt,count(*) num ,sum(amount) amt,sum(charges) chrg,sum(com_charged) chrgd FROM main_transaction_mt where eko_transaction_status=2 and user_id='$uid' group by date(created_on) order by date(created_on) desc;";
		$res1=mysql_query($qry1);
		$num_rows1 = mysql_num_rows($res1);
		include_once '../functions/_my_uname.php';
		$uname=show_my_uname($uid);
	}
			$a=$b=$c=$d=$i=0;
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
				<td title="User ID" align='right'><?php echo $uid;?></td>
				<td title="User Name" align='right'><?php echo $uname;?></td>
				<td title="Date" align='right'><?php echo $rs1['dt'];?></td>
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