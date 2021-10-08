<?php
include('../_session-admin.php');

if(isset($_POST['UpdateRatio']))
{
	$operator_id=$_POST['provider'];
	$sadmin=$_POST['surcharges_percent'];
	$retailer=$_POST['retailer_percent'];
	$dist=$_POST['dist_percent'];
	$sd=$_POST['sd_percent'];
	$admin=$_POST['admin_percent'];

	$query_updt="update child_charges_apply set sadmin='$sadmin', retailer='$retailer', dist='$dist', sd='$sd', admin='$admin' where operator_id='$operator_id';";
	mysql_query($query_updt);
}

header("location:commission-show.php");

?>