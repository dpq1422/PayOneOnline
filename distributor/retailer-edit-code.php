<?php
include('../_session-team.php');
include('../_common-team.php');

$uid=$_POST['uid'];
$uname=$_POST['uname'];
$uno=$_POST['uno'];
$uadhar=$_POST['uadhar'];
$uemail=$_POST['uemail'];
$uamt=$_POST['uamt'];
$usex=$_POST['usex'];
$udob=$_POST['udob'];
$upan=$_POST['upan'];
$ubank=$_POST['ubank'];
$uacc=$_POST['uacc'];
$uifsc=$_POST['uifsc'];
$ubname=$_POST['ubname'];
$ubadd=$_POST['ubadd'];
$ugst=$_POST['ugst'];

include('../functions/_uploadLogo.php');
$unqtm=date_timestamp_get(date_create());
$doc_1="$user_id-$unqtm-logo";

if(isset($_FILES["ulogo"]))
{
	$file1=$_FILES["ulogo"];
	if(upload_logo($file1,$doc_1)=="")
	{
		$target_dir = "../logo/";
		$imageFileType = pathinfo(basename($file1["name"]),PATHINFO_EXTENSION);
		$target_file = $target_dir . $doc_1 . "." . $imageFileType;
		$file1=move_uploaded_file($_FILES["ulogo"]["tmp_name"], $target_file);
	}
}

$query4a="INSERT INTO child_user_update_request(date_time, user_id, request_by_user_id, user_name, aadhar_no, e_mail, user_contact_no, business_name, pancard_no, sec_amount, gender, date_of_birth, bank, account, ifsc, business_address, gst, business_logo, logo_verified, updated_on, update_status) VALUES ('$datetime_time', '$uid', '$user_id', '$uname', '$uadhar', '$uemail', '$uno', '$ubname', '$upan', '$uamt', '$usex', '$udob', '$ubank', '$uacc', '$uifsc', '$ubadd', '$ugst', '$target_file', 0, NULL, 0);";
mysql_query($query4a);
	
header("location:retailers.php");

?>