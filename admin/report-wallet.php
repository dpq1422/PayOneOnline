<?php
include_once('../_session-admin.php');
include_once '../functions/_my_hname.php';
include_once '../functions/_parent_hname_name.php';
include_once '../functions/_wallet_balance.php';
include_once('../functions/_update_wallet.php');

for($i=100000;$i<=101000;$i++)
{
	update_wallet($i);
}

$file="member-wallet-balance-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query="SELECT * FROM child_user where user_type not in(0,1) and user_status=1 order by wallet_balance desc,user_id desc";
$result=mysql_query($query);
$i=0;
$csv_header = '"S.No.","User ID","User Name","User Designation","Parent Name","Parent Designation","Current Wallet Balance","STATUS"';
$csv_header .= "\n";
$csv_row ='';
while($rs = mysql_fetch_assoc($result)) 
{
	$i++;	
	$uwb=$rs['wallet_balance'];
	$hrnm=show_my_hname($rs['user_type']);
	$prnt=explode("</td><td>",show_parent_hname_name2($rs['user_id']));
	
	$max_uid=$rs['user_id'];
	$max_user=0;
	$max_qry="SELECT count(*) nums FROM child_wallet_remain where user_id=$max_uid";
	$max_res=mysql_query($max_qry);
	while($max_rs = mysql_fetch_assoc($max_res)) {
		$max_user=$max_rs['nums']-1;
	}
	$st="";
	if($max_user==0)
	{
		$st="Inactive";
	}
	else
	{
		$st="Active";
	}
	
	$csv_row.='"'.$i.'","'.$rs['user_id'].'","'.$rs['user_name'].'","'.$hrnm.'","'.$prnt[0].'","'.$prnt[1].'","'.$rs['wallet_balance'].'","'.$st.'"';
	$csv_row .= "\n";
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>