<?php
include('../_session-retail.php');
$bid="";
$ifsc="";
if(isset($_POST['bid']))
{
	$bid=$_POST['bid'];
}
if($bid!="")
{
	$query="SELECT * FROM eko_bank where eko_bank_id='$bid'";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	while($r = mysql_fetch_assoc($result)) 
	{
		$ifsc=$r['base_ifsc']."@".$r['verification_available'];
	}
}
echo json_encode($ifsc);
?>