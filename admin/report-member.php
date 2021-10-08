<?php
include_once('../_session-admin.php');

$file="members-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query = "SELECT join_date 'JOINING DATE',join_time 'JOINING TIME',user_id 'USER ID',hierarchy_name 'DESIGNATION',user_name 'NAME',user_contact_no 'CONTACT NO',e_mail 'E-MAIL' FROM child_user a,child_hierarchy b where a.user_type=b.hierarchy_id and user_id not in(100000,100005) order by user_id";
$result = mysql_query($query);

$num_column = mysql_num_fields($result);		

$csv_header = '';
for($i=0;$i<$num_column;$i++) {
	$csv_header .= '"' . mysql_field_name($result,$i) . '",';
}	
$csv_header .= "\n";

$csv_row ='';
while($row = mysql_fetch_row($result)) {
	for($i=0;$i<$num_column;$i++) {
		$st="";
		$src="";
		$srv="";
			$csv_row .= '"' . $row[$i] . '",';
	}
	$csv_row .= "\n";
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>