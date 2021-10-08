<?php
include('../_session-admin.php');

$bname=$_POST['bname'];
$aname=$_POST['aname'];
$ano=$_POST['ano'];
$brname=$_POST['brname'];
$ifsc=$_POST['ifsc'];
$micr=$_POST['micr'];

$query4a="INSERT INTO child_bank(bank_name, account_name, account_no, branch_name, ifsc_code, micr_code, account_remarks) VALUES ('$bname', '$aname', '$ano', '$brname', '$ifsc', '$micr', 'created at $datetime_time');";
$result4=mysql_query($query4a);


if($result4==1)
header("location:bank-details.php");
else
header("location:bank-detail.php?msg=add-bank-detail-fail");

?>