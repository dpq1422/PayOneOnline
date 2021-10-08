<?php
function show_company_info($company_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_company where company_id='$company_id'";
	$result=mysql_query($query);
	return $result;
}

function update_company_info($company_id,$cname,$cmob,$cemail,$cadd,$states,$districts,$ccity,$cpin,$cweb,$cpan,$cgst,$cestd,$cpower,$utypes,$uid,$uname)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remarks="last updated by $utypes ($uid - $uname) at $datetime_datetime<br><br>";
	$query="update $bankapi_parent_base.parent_company set company_name='$cname', 
	e_mail='$cemail', contact_no='$cmob', address='$cadd', city_name='$ccity', distt_id='$districts', state_id='$states', area_pin_code='$cpin', website='$cweb', pan_no='$cpan', gst_no='$cgst', estd_in='$cestd', powered_by='$cpower',
	company_remarks=concat('$remarks',company_remarks) 
	where company_id='$company_id'";
	mysql_query($query);
}

function update_company_contact_info($company_id,$cname,$cmob,$cemail,$utypes,$uid,$uname)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remarks="last updated by $utypes ($uid - $uname) at $datetime_datetime<br><br>";
	$query="update $bankapi_parent_base.parent_company set company_name='$cname', 
	e_mail='$cemail', contact_no='$cmob', company_remarks=concat('$remarks',company_remarks) 
	where company_id='$company_id'";
	mysql_query($query);
}
?>