<?php
include('_common.php');
include('_session.php');
include('functions/_CountClientMtCharges.php');

$client_id=$_POST['filled_id'];
$val1=$_POST['charge'];
$val2=$_POST['servic'];
$val3=$_POST['operat'];
$val4=$_POST['flat'];
$val5=$_POST['perc'];
$val6=$_POST['amtf'];
$val7=$_POST['amtt'];
$val8=$_POST['source'];
$val9=$_POST['ctype'];
$charges_status=1;
$result24=0;

for($aa=0;$aa<count($val1);$aa++)
{
	$charges_in_id="";
	$service_type_id="";
	$operator_id="";
	$surcharges_fix="";
	$surcharges_percent="";	
	$slab_from="";	
	$slab_to="";	
	$charges_in_id=$val1[$aa];
	$service_type_id=$val2[$aa];
	$operator_id=$val3[$aa];
	$surcharges_fix=$val4[$aa];
	$surcharges_percent=$val5[$aa];		
	$slab_from=$val6[$aa];		
	$slab_to=$val7[$aa];		
	$source_id=$val8[$aa];		
	$charges_type=$val9[$aa];		
	$res_count=count_client_mt_charges($client_id,$charges_in_id,$service_type_id,$operator_id,$slab_from,$slab_to);
	if($res_count==0)
	{
		$query24="insert into parent_charges_out_mt(client_id,charges_in_id,source_id,service_type_id,operator_id,charges_type,slab_from,slab_to,surcharges_fix,surcharges_percent,charges_status,charges_remarks) value('$client_id','$charges_in_id','$source_id','$service_type_id','$operator_id','$charges_type','$slab_from','$slab_to','$surcharges_fix','$surcharges_percent','$charges_status','updated by $user_types ($user_id - $user_name) at $datetime_time');";
	}
	else
	{
		$query24="update parent_charges_out_mt set surcharges_fix='$surcharges_fix', surcharges_percent='$surcharges_percent', charges_type='$charges_type', source_id='$source_id', charges_remarks='updated by $user_types ($user_id - $user_name) at $datetime_time' where client_id='$client_id' and charges_in_id='$charges_in_id' and service_type_id='$service_type_id' and operator_id='$operator_id' and slab_from='$slab_from' and slab_to='$slab_to';";
	}
	$result24+=mysql_query($query24);
}

if($result24>0)
header("location:clients.php");
else
header("location:client-mt-charges.php?id=$client_id&msg=fail");


?>