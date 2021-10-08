<?php
$txnid="";
if(isset($_REQUEST['txnid']))
	{
		$txnid=$_REQUEST['txnid'];
	}
if($txnid!="")
	{
	include("db-conn.php");
	$qry="select * from txn_data where txn_id='$txnid';";
	$result=mysql_query($qry);
	while($rs=mysql_fetch_array($result))
		{
?>
		<form method="post">
		Transaction ID<input type="text" readonly value="<?php echo $rs['txn_id'];?>" name="transid"/><br>
		Date<input type="text" readonly value="<?php echo $rs['txn_date_time'];?>" name="date"/><br>
		E-mail<input type="text" readonly value="<?php echo $rs['user_id'];?>" name="email"/><br>
		Amount<input type="text" readonly value="<?php echo $rs['amount'];?>" name="amount"/><br>
		Update Status<select name="tstatus" id="tstatus" class="form-control">
						<option value="100">Success</option>
						<option value="300" selected>Pending</option>
						<option value="200">Failed</option>
					</select><br>
		<input type="submit" value="Update" name="tupdate">
		</form>
<?php		}
	}
	if (isset($_POST['tupdate']))
		{
		$amt=0;
		$amt=$_POST['amount'];
		$id=$_POST['transid'];
		$eml=$_POST['email'];
		$status=$_POST['tstatus'];
		include("db-conn.php");
		$qry="update txn_data set txn_status='$status' where txn_id='$id';";
		mysql_query($qry);
		if($status=='200')
		{
			$bal=0;
			$qry="select * from wallet_data where user_id='$eml' order by wallet_id desc limit 0,1;";
			$result=mysql_query($qry);
			while($rs=mysql_fetch_array($result))
			{
				$bal=$rs['bal_amt'];
			}
			$newbal=$bal+$amt;
			$qry="insert into wallet_data value 
			(NULL,curdate(),curtime(),'$eml','Failed Order $id Refunded',3,'$amt',0,'$newbal','Failed Order $id Refunded');";
			mysql_query($qry);
		}
		echo "<script>window.location.href='user-account.php';</script>";
		}
?>