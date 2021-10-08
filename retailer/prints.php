<?php
include_once('../_session-retail.php');
$result="-1";
if(isset($_REQUEST['result']))
$result=$_REQUEST['result'];

$query="SELECT * FROM main_transaction_mt where group_id='$result' and user_id='$user_id';";
$res=mysql_query($query);
$num_rows = mysql_num_rows($res);	
if($num_rows>0)
{
	$snum="";
	$sname="";
	$rid="";
	$rname="";
	$rbank="";
	$racc="";
	$tid="";
	$bref="";
	$tdtm="";
	$tdtm2="";
	$amt=0;
	$sur=0;
	$total=0;
	$i=0;
	while($rs = mysql_fetch_assoc($res))
	{
		$snum=$rs['sender_number'];
		$rid=$rs['receiver_id'];
		$tid="";
		
		$st="";
		$st=$rs['eko_transaction_status'];
		if($st==0 || $st==1 || $st==3)
			$st=" IN PROGRESS ";
		if($st==4)
			$st=" PENDING REFUND ";
		if($st==5)
			$st=" REFUNDED ";
		
		if($i==0 && $rs['eko_transaction_status']==2)
		$bref = $bref . "<br> " . $rs['bank_ref_no'];
		else if($i!=0 && $rs['eko_transaction_status']==2)
			$bref = $bref . "<br> " . $rs['bank_ref_no'];
		else if($i==0 && $rs['eko_transaction_status']!=2)
		$bref = $bref . "<br> $st ";
		else if($i!=0 && $rs['eko_transaction_status']!=2)
		$bref = $bref . "<br> $st ";
	
		$tdtm = strtotime($rs['created_on']);
		$tdtm = date("d/M/Y", $tdtm);
		$tdtm2 = strtotime($rs['updated_on']);
		$tdtm2 = date("d/M/Y g:i A", $tdtm2);
		$amt+=$rs['amount'];
		$sur+=$rs['com_charged'];
		$total+=$rs['deducted'];
		$i++;
	}
	$query2="SELECT * FROM eko_sender where sender_number='$snum';";
	$res2=mysql_query($query2);
	while($rs2 = mysql_fetch_assoc($res2))
	{
		$sname=$rs2['sender_name'];
	}
	$query3="SELECT * FROM eko_receiver where receiver_id='$rid';";
	$res3=mysql_query($query3);
	while($rs3 = mysql_fetch_assoc($res3))
	{
		$rname=$rs3['receiver_name'];
		$rbank=$rs3['bank'];
		$racc=$rs3['receiver_acc_no'];
	}
?>
<html>
	<head>
		<title>Print Receipt</title>
		<style>body{background:url(../img/sample.png) no-repeat;}</style>
	</head>
	<body>
		<table cellpadding='0' cellspacing='0'>
			<tr height='50'>
				<td align='center' colspan='2'><b>RECEIPT</b></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td width='350'>Invoice No.: <?php echo "".$result."";?></td>
				<td width='350' align='right'>Date:<?php echo $tdtm;?></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td align='left' colspan='2'><b>TRANSACTION DETAILS</b></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td><b>Sender Name</b></td>
				<td><?php echo $sname;?></td>
			</tr height='30'>
			<tr height='30'>
				<td><b>Sender Mobile</b></td>
				<td><?php echo $snum;?></td>
			</tr height='30'>
			<tr height='30'>
				<td><b>Receiver Name</b></td>
				<td><?php echo $rname;?></td>
			</tr>
			<tr height='30'>
				<td><b>Receiver Bank Name</b></td>
				<td><?php echo $rbank;?></td>
			</tr>
			<tr height='30'>
				<td><b>Receiver Account Number</b></td>
				<td><?php echo $racc;?></td>
			</tr>
			<tr height='30'>
				<td><b>Transaction ID</b></td>
				<td><?php echo "".$result."";?></td>
			</tr>
			<tr height='30'>
				<td><b>Bank Reference Number</b></td>
				<td><?php echo "".$bref."";?></td>
			</tr>
			<tr height='30'>
				<td><b>Date &amp; Time</b></td>
				<td><?php echo $tdtm2;?></td>
			</tr>
			<tr height='30'>
				<td><b>Amount</b></td>
				<td><?php echo $amt;?></td>
			</tr>
			<tr height='30'>
				<td><b>Sur-Charge</b></td>
				<td><?php echo $sur;?></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td><b>TOTAL AMOUNT</b></td>
				<td><b><?php echo $total;?></b></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td align='center' colspan='2'><i>This is a system generated receipt, hence no seal or signature required.</i></td>
			</tr>
			<tr>
				<td colspan='2'>&nbsp;</td>
			</tr>
		</table>
		<input type='button' style='float:right;' onclick="print()" value="print"/>
	</body>
</html>
<?php
}
else
{
	echo "No Receipt Available - Txn No does not exist.";
}
?>
