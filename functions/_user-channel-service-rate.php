<?php
include('../_gyan-info-compd.php');
function user_channel_service_rate($uid,$sid,$mid,$amount)
{
	$query="SELECT * FROM child_products_margin_mt where user_id='$uid' and source_id='$sid' and payment_method='$mid'";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$rate=0;
	if($num_rows>0)
	{
		while($r = mysql_fetch_array($result)) {
			if($amount<=0)
			$rate=0;
			else if($amount>0 && $amount<=1000)
			$rate=$r['m_01000'];
			else if($amount>1000 && $amount<=2000)
			$rate=$r['m_02000'];
			else if($amount>2000 && $amount<=3000)
			$rate=$r['m_03000'];
			else if($amount>3000 && $amount<=4000)
			$rate=$r['m_04000'];
			else if($amount>4000 && $amount<=5000)
			$rate=$r['m_05000'];		
			else if($amount>5000 && $amount<=10000)
			$rate=$r['m_10000'];
			else if($amount>10000 && $amount<=15000)
			$rate=$r['m_15000'];
			else if($amount>15000 && $amount<=20000)
			$rate=$r['m_20000'];
			else if($amount>20000 && $amount<=25000)
			$rate=$r['m_25000'];
			else if($amount>25000)
			$rate=0;
		}
	}
	return $rate;
}

?>