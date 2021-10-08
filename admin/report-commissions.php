<?php
include_once('../_session-admin.php');

$file="commissions-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query = "SELECT etid as 'ORDER', tid as 'TXN NO', source as 'SOURCE NAME', service as 'SERVICE NAME', method as 'CHANNEL NAME', trans_date_time as 'ORDER DATE', retailer_id as 'RETAILER', amount as 'AMOUNT', client_charges as 'CLIENT CHARGE', retailer_gst as 'RET GST', retailer_com as 'RET COMM', admin_gst as 'ADM GST', admin_fee as 'ADM FEE', retailer_charges as 'RET CHARGE', dist_charges as 'DST CHARGE', sd_charges as 'SD CHARGE', admin_charges as 'ADM CHARGE', dist_id as 'DST ID', sd_id as 'SD ID', admin_id as 'ADM ID', retailer_margin as 'RET MARGIN', dist_margin as 'DST MARGIN', sd_margin as 'SD MARGIN', admin_margin as 'ADM MARGIN', retailer_commission as 'RET COMM', retailer_tds as 'RET TDS', retailer_earning as 'RET EARN', dist_commission as 'DST COMM', dist_tds as 'DST TDS', dist_earning as 'DST EARN', sd_commission as 'SD COMM', sd_tds as 'SD TDS', sd_earning as 'SD EARN', admin_tds as 'ADM TDS', admin_earning as 'ADM ERN', admin_commission as 'TOTAL DISTRIBUTION' FROM main_transaction_commission";
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
		
		if($i==2)
		{	
			if($row[$i]==1)
			{
				$csv_row .= '"CHNL 1",';
			}
			else if($row[$i]==2)
			{
				$csv_row .= '"CHNL 2",';
			}
		}
		else if($i==3)
		{	
			if($row[$i]==1)
			{
				$csv_row .= '"MT",';
			}
			else if($row[$i]==2)
			{
				$csv_row .= '"AV",';
			}
		}
		else if($i==4)
		{	
			if($row[$i]==1)
			{
				$csv_row .= '"NEFT",';
			}
			else if($row[$i]==2)
			{
				$csv_row .= '"IMPS",';
			}
			else
			{
				$csv_row .= '"",';
			}
		}
		else
		{	
			$csv_row .= '"' . $row[$i] . '",';
		}
	}
	$csv_row .= "\n";
}
/* Download as CSV File */
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=$file");
echo "";//$csv_header . $csv_row;
exit;
?>