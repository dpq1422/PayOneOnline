<?php

include_once('../_gyan-info-admin.php');
include_once('../functions/_update_wallet.php');

$max_user=100000;
$max_qry="select max(user_id) max_user from child_user";
$max_res=mysql_query($max_qry);
while($max_rs = mysql_fetch_assoc($max_res)) {
	$max_user=$max_rs['max_user'];
}
										
for($i=100000;$i<=$max_user;$i++)
{
	update_wallet($i);
}
?>