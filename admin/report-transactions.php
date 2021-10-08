<?php
include_once('../_session-admin.php');

$file="transactions-upto-".date("Y/m/d")."-".date("h:i:sa").".csv";

$query = "SELECT eko_transaction_id as 'ORDER', user_id as 'USER', sender_number as 'SENDER', receiver_number as 'RECEIVER', amount as 'AMOUNT', charges as 'CHARGES', com_charged as 'CHARGES TO CLIENT', gst_charged as 'GST TO CLIENT', com_earned as 'COMM', deducted as 'TOTAL DEDUCTED', bal_before as 'PRE AMT', bal_after as 'POST AMT', tid as 'TXN NO', service_tax as 'TAX PAID', fee as 'FEE PAID', collectable_amount as 'TOTAL PAID', balance as 'API BAL', bank_ref_no as 'REF NO', account as 'ACC NO', channel as 'PAYMENT MODE', channel_desc as 'MODE NAME', created_on as 'ORDER DATE', updated_on as 'COMPLETED DATE', eko_transaction_status as 'ORDER STATUS', group_id as 'GRUP TXN NO', source as 'SOURCE NAME', type as 'SERVICE NAME' FROM main_transaction_mt";
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
		if($i==23)
		{
			if($row[$i]==0)
			{
				$csv_row .= '"NOT INITIATED",';
			}
			else if($row[$i]==1)
			{
				$csv_row .= '"INITIATED",';
			}
			else if($row[$i]==2)
			{
				$csv_row .= '"SUCCESS",';
			}
			else if($row[$i]==3)
			{
				$csv_row .= '"RESPONSE AWAITED",';
			}
			else if($row[$i]==4)
			{
				$csv_row .= '"PENDING REFUND",';
			}
			else if($row[$i]==5)
			{
				$csv_row .= '"REFUNDED",';
			}
			else
			{
				$csv_row .= '"UNKNOWN STATUS",';
			}
		}
		else if($i==25)
		{	
			if($row[$i]==1)
			{
				$csv_row .= '"CHNL 1",';
			}
			else if($row[$i]==2)
			{
				$csv_row .= '"CHNL 2",';
			}
			else
			{
				$csv_row .= '"",';
			}
		}
		else if($i==26)
		{	
			if($row[$i]==1)
			{
				$csv_row .= '"MT",';
			}
			else if($row[$i]==2)
			{
				$csv_row .= '"AV",';
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