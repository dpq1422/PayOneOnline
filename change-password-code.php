<?php
include('_common.php');
include('_session.php');

$filled_contact_no=$user_id;
$filled_user_type=$user_type;
$filled_old_pass=$_POST['filled_old_pass'];
$filled_new_pass=$_POST['filled_new_pass'];

if($filled_old_pass==$filled_new_pass)
header("location:change-password.php?msg=same");
else
{
	$query23="update parent_user set pass_word='$filled_new_pass' where user_id='$filled_contact_no' and user_type='$filled_user_type' and pass_word='$filled_old_pass';";
	mysql_query($query23);
	$result23=mysql_affected_rows();

	if($result23>0)
	header("location:change-password.php?msg=done");
	else
	header("location:change-password.php?msg=fail");
}


?>