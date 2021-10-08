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
	$qry1="SELECT user_id,count(*) num ,sum(amount) amt,sum(charges) chrg,sum(com_charged) chrgd FROM main_transaction_mt where eko_transaction_status=2 and type=1 group by user_id order by sum(amount) desc;";
	$res1=mysql_query($qry1);
	$num_rows1 = mysql_num_rows($res1);
?>
		<center>
		<table cellpadding="5" cellspacing="10">
			<tr>
				<td align="center"><h1>Sonar Date Report<h1></td>
			</tr>
		</table>
		<table cellpadding="10">
			<tr bgcolor="#c5c5c5">
				<th>Sr.No.</th>
				<th>User ID</th>
				<th>User Name</th>
				<th>Orders</th>
				<th>Transaction Amount</th>
				<th>Actual Charges</th>
				<th>Taken Charges</th>
				<th>Report</th>
			</tr>
			<?php
			$a=$b=$c=$d=$e=$i=0;
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
				$vals=$rs1['chrgd']-($rs1['num']*5.90);
				$vals=number_format((float)$vals, 2, '.', '');
				$e+=$vals;
			?>
			<tr <?php echo $style;?>>
				<td><?php echo $i;?></td>
				<td title="User ID" align='right'><?php echo $rs1['user_id'];?></td>
				<td title="User Name" align='right'><?php echo show_my_uname($rs1['user_id']);?></td>
				<td title="Orders" align='right'><?php echo $rs1['num'];?></td>
				<td title="Amount" align='right' bgcolor="#2eb22e"><?php echo $rs1['amt'];?></td>
				<td title="Actual Charges" align='right'><?php echo $rs1['chrg'];?></td>
				<td title="Taken Charges" align='right' <?php if($rs1['chrg']!=$rs1['chrgd']) {echo "bgcolor='#f2a710'";} else {echo "bgcolor='#c27700'";}?>><?php echo $rs1['chrgd'];?></td>
				<td title="Report" align="right"><?php echo $vals;?></td>
			</tr>
			<?php
			}		
			?>
			<tr bgcolor="#c5c5c5">
				<td></td>
				<td></td>
				<td></td>
				<th title="Orders" align='right'><?php echo $a;?></th>
				<th title="Amount" align='right'><?php echo $b;?></th>
				<th title="Actual Charges" align='right'><?php echo $c;?></th>
				<th title="Taken Charges" align='right'><?php echo $d;?></th>
				<th title="Report" align='right'><?php echo $e;?></th>
			</tr>
		</table>
		</center>
	</body>
</html>