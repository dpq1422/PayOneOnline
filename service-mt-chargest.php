<?php
include('_common.php');
include('_session.php');

$id=$_REQUEST['id'];
$sts=$_REQUEST['sts'];

$query18="update parent_charges_in_mt set charges_status='$sts' where charges_in_id='$id';";
$result18=mysql_query($query18);

header("location:service-mt-charges.php");
?>