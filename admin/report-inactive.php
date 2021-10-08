<?php
include_once('../_session-admin.php');
include_once '../functions/_my_hname.php';
include_once '../functions/_parent_hname_name.php';

$file="inactive-members-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query_in = "SELECT * FROM child_user where user_type not in(0,1) and wallet_balance=0 order by user_id";
$result_in = mysql_query($query_in);	

$csv_header = '"S.No.","Join Date","User ID","User Name","User Designation","Mobile Number","Parent Name","Parent Designation","Wallet Balance"';
$csv_header .= "\n";

$csv_row ='';
$i=0;
while($row_in = mysql_fetch_array($result_in)) {
	
	$max_uid=$row_in['user_id'];
	$rwb=$row_in['wallet_balance'];
	$max_user=0;
	$max_qry="SELECT count(*) nums FROM child_wallet_remain where user_id=$max_uid";
	$max_res=mysql_query($max_qry);
	while($max_rs = mysql_fetch_assoc($max_res)) {
		$max_user=$max_rs['nums']-1;
	}
	
	if($max_user==0)
		$rwb=$rwb." ( In-active )";
	else
		continue;

	$i++;

	$myhr=$pr_hr="";
	$my_hr=show_my_hname($row_in['user_type']);
	$pr_hr=explode("</td><td>",show_parent_hname_name2($row_in['user_id']));

	$csv_row .= '"'.$i.'","'.$row_in['join_date'].'","'.$row_in['user_id'].'","'.$row_in['user_name'].'","'.$my_hr.'","'.$row_in['user_contact_no'].'","'.$pr_hr[0].'","'.$pr_hr[1].'","'.$rwb.'"';
	$csv_row .= "\n";
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>