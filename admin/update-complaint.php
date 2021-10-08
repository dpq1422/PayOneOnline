<?php
$cid="";
if(isset($_REQUEST['cid']))
	{
		$cid=$_REQUEST['cid'];
	}
if($cid!="")
	{
	include("db-conn.php");
	$qry="select * from complaint_data where complaint_id='$cid';";
	$result=mysql_query($qry);
	while($rs=mysql_fetch_array($result))
		{
?>
		<form method="post">
		ID<input type="text" readonly value="<?php echo $rs['complaint_id'];?>" name="id"/><br>
		Date<input type="text" readonly value="<?php echo $rs['complaint_date_time'];?>" name="date"/><br>
		E-mail<input type="text" readonly value="<?php echo $rs['user_id'];?>" name="email"/><br>
		Transaction ID<input type="text" readonly value="<?php echo $rs['txn_id'];?>" name="transid"/><br>
		Type<input type="text" readonly value="<?php echo $rs['comp_type'];?>" name="ctype"/><br>
		Description<textarea cols="60" rows="5" readonly><?php echo $rs['user_remarks'];?></textarea><br>
		Reply<textarea cols="60" rows="5" name="reply"></textarea><br>
		<input type="submit" value="Reply" name="creply">
		</form>
<?php		}
	}
	if (isset($_POST['creply']))
		{
		$id=$_POST['id'];
		$reply=$_POST['reply'];
		include("db-conn.php");
		$qry="update complaint_data set office_reply='$reply',updated_on=sysdate(),comp_status='1' where complaint_id='$id';";
		mysql_query($qry);
		echo "<script>window.location.href='user-account.php';</script>";
		}
?>