<?php
include('_common.php');
include('_session.php');
include('functions/_AdminWalletBalanceShow.php');


$client_id=$_POST['client_id'];
$request_id=$_POST['request_id'];
$userid=$_POST['userid'];
$filled_amount=$_SESSION['dr_amount'];
$request_status=$_POST['request_status'];
$filled_remarks=$_POST['filled_remarks']." by $user_types ($user_id - Source Wallet) at $datetime_time";
$result24=0;
$pre_bal18=admin_distributions();
if($request_status==2)
{
	if($filled_amount<=$pre_bal18)
	{
		$bal2=$filled_amount;
		$bal2=$pre_bal18-$bal2;

		$query4b="insert into parent_wallet_remain value 
		(NULL,'$date_time','$time_time','$client_id','$request_id','2','$filled_remarks',
		'$pre_bal18','0','$filled_amount','$bal2');";
		$result24+=mysql_query($query4b);
		
		$filled_remarks2="Wallet Recieved ".$filled_remarks;
		
		$bal3=$filled_amount;
		$pre_bal13=0;
		$qry_bal2="SELECT * FROM child_wallet_realtime order by wallet_id desc limit 0,1";
		$result_bal2=mysql_query($qry_bal2);
		while($row_bal2=mysql_fetch_array($result_bal2))
		{
			$pre_bal13=$row_bal2['amount_bal'];
		}
		$bal3=$pre_bal13+$bal3;
		$query4c="insert into child_wallet_realtime value 
		(NULL,'$date_time','$time_time','100001','$request_id','0','1','$filled_remarks2',
		'$pre_bal13', '$filled_amount','0','$bal3');";
		$result24+=mysql_query($query4c);
		
		$bal4=$filled_amount;
		$pre_bal12=0;
		$qry_bal2="SELECT * FROM child_wallet_remain where user_id='100001' order by wallet_id desc limit 0,1";
		$result_bal2=mysql_query($qry_bal2);
		while($row_bal2=mysql_fetch_array($result_bal2))
		{
			$pre_bal12=$row_bal2['amount_bal'];
		}
		
		$bal4=$pre_bal12+$bal4;
		$query4c="insert into child_wallet_remain value 
		(NULL,'$date_time','$time_time','100001','0','0','1','$filled_remarks2',
		'$pre_bal12', '$filled_amount','0','$bal4');";
		$result24+=mysql_query($query4c);
	}
	else
	{
		$request_status=1;
		$filled_remarks="<br>Please wait for some time, by $user_types ($user_id - Source Wallet) at $datetime_time";
	}
}

include_once('functions/_zsms.php');
$zsms=create_mentor_wallet_request_msg_reply($request_status,$filled_amount,$datetime_time);
if($zsms!="")
zsms("9864940008",$zsms);
$query24d="update parent_wallet_requests set request_status=$request_status, remarks=concat(remarks,' <br> $filled_remarks') where request_id='$request_id' and client_id='$client_id' and user_id='$userid';";
$result24+=mysql_query($query24d);
$_SESSION['dr_amount']=0;

if($result24>0)
header("location:clients-wallet-requests.php");
else
header("location:wallet-admin-transfer-dr-for-client.php?rid=$request_id&cid=$client_id&msg=distribution-limit-exceed");


?>